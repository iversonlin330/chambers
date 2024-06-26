<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Google\Client;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;
use Google\Service\Gmail;
use Google_Service_Gmail;
use Illuminate\Http\Request;
use Google_Client;
use Illuminate\Support\Facades\Auth;
use Google_Service_Drive;
use Illuminate\Support\Facades\Storage;

class ManageFileController extends Controller
{
    /**
     * @var Google_Client
     */
    private $googleClient;

    public function __construct()
    {
        $this->googleClient = new Google_Client();
        $this->googleClient->setAuthConfig(json_decode(env('GOOGLE_CREDENTIALS'), true));
        $this->googleClient->setAccessType('offline');
        $this->googleClient->setRedirectUri('http://localhost'); // 设置为你的重定向 URI
//        $this->googleClient->setAccessToken(Auth::user()->google_token);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function step1()
    {
        $this->googleClient->setAccessToken(Auth::user()->google_token);
        $service = new Google_Service_Gmail($this->googleClient);

        $results = $service->users_messages->listUsersMessages('me', ['q' => 'has:attachment', 'maxResults' => 10]); // 获取100封邮件，以确保包含10封附件邮件

// 遍历邮件并获取主题、日期和附件信息
        $emails = [];
        $files = [];
        foreach ($results->getMessages() as $message) {
            $email = $service->users_messages->get('me', $message->getId());
            $subject = '';
            $date = '';
            $attachments = [];

            foreach ($email->getPayload()->getHeaders() as $header) {
                if ($header->getName() === 'Subject') {
                    $subject = $header->getValue();
                }
                if ($header->getName() === 'Date') {
                    $date = $header->getValue();
                }
            }

            foreach ($email->getPayload()->getParts() as $part) {
                if (isset($part['body']['attachmentId']) && $part['filename']) {
//                    $attachmentId = $part['body']['attachmentId'];
//                    $attachment = $service->users_messages_attachments->get('me', $message->getId(), $attachmentId);
//                    $attachments[] = [
//                        'filename' => $part['filename'],
//                        'size' => $attachment->getSize(),
//                    ];
                    $attachmentId = $part['body']['attachmentId'];
                    $attachment = $service->users_messages_attachments->get('me', $message->getId(), $attachmentId);
                    $filename = $part['filename'];
                    // 下载附件到本地文件
                    $attachmentData = base64_decode($attachment->getData());
                    $tempPath = storage_path("app/public/$filename");
                    // 将附件保存到暂存路径
                    file_put_contents($tempPath, $attachmentData);
//                    dd('success');
                    $files[] = $part['filename'];
                }
            }

            if (!empty($attachments)) {
                $emails[] = ['subject' => $subject, 'date' => $date, 'attachments' => $attachments];
            }
        }


        //
//        $client = new Google_Client();
//        $client->setAuthConfig(json_decode(env('GOOGLE_CREDENTIALS'), true));
//        $client->setAccessType('offline');
//        $client->setRedirectUri('redirect_uri'); // 设置为你的重定向 URI
//
//        $service = new Google_Service_Gmail($client);
//
//        $results = $service->users_messages->listUsersMessages('me', ['q' => 'has:attachment', 'maxResults' => 10]);
//
//        foreach ($results->getMessages() as $message) {
//            $message = $service->users_messages->get('me', $message->getId());
//            // 处理邮件内容
//            dd($message);
//        }

        // 初始化 Google 客户端
//        $client = new Google_Client();
//        $client->setAuthConfig(json_decode(env('GOOGLE_CREDENTIALS'), true));
//        $client->setAccessType('offline');
//        $client->setRedirectUri('http://localhost'); // 设置为你的重定向 URI
//
//        // 创建 Gmail 服务
//        $service = new Google_Service_Gmail($client);
//
//        // 获取访问令牌（access token）
//        $accessToken = $client->fetchAccessTokenWithAuthCode('YOUR_AUTHORIZATION_CODE');
//
//        // 设置访问令牌
//        $client->setAccessToken($accessToken);
//
//        // 获取邮件列表
//        $results = $service->users_messages->listUsersMessages('me', ['maxResults' => 10]);
//
//        // 遍历邮件并获取主题和日期
//        $emails = [];
//        foreach ($results->getMessages() as $message) {
//            $email = $service->users_messages->get('me', $message->getId());
//            $subject = '';
//            $date = '';
//            foreach ($email->getPayload()->getHeaders() as $header) {
//                if ($header->getName() === 'Subject') {
//                    $subject = $header->getValue();
//                }
//                if ($header->getName() === 'Date') {
//                    $date = $header->getValue();
//                }
//            }
//            $emails[] = ['subject' => $subject, 'date' => $date];
//        }

        return view('manage-file.step1', compact('files'));
    }

    public function step2()
    {
        $folders = $this->getGoogleDriveList(Auth::user()->google_token);
        return view('manage-file.step2', compact('folders'));
    }

    private function getGoogleDriveList($token, $parentId = null)
    {
        $client = new Google_Client();
        $client->setAuthConfig(json_decode(env('GOOGLE_CREDENTIALS'), true));
        $client->setAccessType('offline');

// 创建 Google Drive 服务
        $driveService = new Google_Service_Drive($client);

        $client->setAccessToken($token);

        $queryParams = [];
        if ($parentId !== null) {
            $queryParams['q'] = "'$parentId' in parents";
        }

// 获取文件列表
        $results = $driveService->files->listFiles([
            'fields' => 'files(id, name, mimeType, webViewLink, modifiedTime)',
        ]);
// 遍历文件列表
        $folders = [];
        foreach ($results->getFiles() as $file) {
            if ($file->getMimeType() === 'application/vnd.google-apps.folder') {
                $folders[] = [
                    'name' => $file->getName(),
                    'id' => $file->getId(),
                    'mimeType' => $file->getMimeType(),
                    'webViewLink' => $file->getWebViewLink(),
                    'updated_time' => date('Y-m-d H:i:s', strtotime($file->getModifiedTime())),
//                    'children' => $this->getGoogleDriveList($token, $file->getId()), // 递归调用
                ];
            }
        }
        return $folders;
    }

    public function uploadFile(Request $request)
    {
        $data = $request->all();
        $parentFolderIds = $data['folders'];
        $files = $data['files'];
        $this->googleClient->setAccessToken(Auth::user()->google_token);

        $driveService = new Drive($this->googleClient);
        foreach ($files as $file) {
            $fileMetadata = new DriveFile([
                'name' => $file['inputValue'],
                'parents' => $parentFolderIds // 將檔案上傳到指定的父資料夾
            ]);

            $content = Storage::get('public/' . $file['checkboxValue']);
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, storage_path('app/public/' . $file['checkboxValue']));
            finfo_close($finfo);

            $driveService->files->create($fileMetadata, [
                'data' => $content,
                'mimeType' => $mimeType,
                'uploadType' => 'multipart'
            ]);
        }
    }

    public function step3()
    {
        //
        $events = Event::all();
        return view('manage-file.step3', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
