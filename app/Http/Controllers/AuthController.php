<?php

namespace App\Http\Controllers;

use App\Models\User;
use Google_Client;
use Google_Service_Drive;
use Google_Service_Gmail;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    private $scopeArray = ['https://www.googleapis.com/auth/gmail.readonly', 'https://www.googleapis.com/auth/drive.readonly'];

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function redirectToGoogle()
    {
        if (Auth::check()) {
            return redirect('/manage-files/step1');
        } else {
            return Socialite::driver('google')->scopes($this->scopeArray)->redirect();
        }
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->scopes($this->scopeArray)->user();

        $appUser = User::where('email', $user->email)->first();

        if ($appUser) {
            User::where('email', $user->email)->update(['google_token' => $user->token]);
            Auth::login($appUser);
            // 这里可以处理用户信息，如保存到数据库等
            return redirect('/manage-files/step1');
        } else {
            // 如果用戶不存在，創建新用戶
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                // 其他用戶屬性
            ]);

            // 登入新用戶
            Auth::login($newUser);

            // 設定 Google Token
            auth()->user()->update(['google_token' => $user->token]);

            // 这里可以处理用户信息，如保存到数据库等
            return redirect('/manage-files/step1');
        }
    }

    private function getGmail($token)
    {
        $client = new Google_Client();
        $client->setAuthConfig(json_decode(env('GOOGLE_CREDENTIALS'), true));
        $client->setAccessType('offline');
        $client->setRedirectUri('http://localhost'); // 设置为你的重定向 URI

        // 创建 Gmail 服务
        $service = new Google_Service_Gmail($client);

        // 获取访问令牌（access token）
        $accessToken = $token;

        // 设置访问令牌
        $client->setAccessToken($accessToken);

//        $query = 'has:attachment';
        // 获取邮件列表
        $results = $service->users_messages->listUsersMessages('me', ['q' => 'has:attachment', 'maxResults' => 1]); // 获取100封邮件，以确保包含10封附件邮件

// 遍历邮件并获取主题、日期和附件信息
        $emails = [];
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
                if (isset($part['body']['attachmentId'])) {
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
                    dd('success');
                }
            }

            if (!empty($attachments)) {
                $emails[] = ['subject' => $subject, 'date' => $date, 'attachments' => $attachments];
            }
        }

// 对邮件按日期排序
//        usort($emails, function ($a, $b) {
//            return strtotime($b['date']) - strtotime($a['date']);
//        });

// 获取前10封邮件
//        $latestEmails = array_slice($emails, 0, 10);

        dd($emails);
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
        $results = $driveService->files->listFiles();
// 遍历文件列表
        $folders = [];
        foreach ($results->getFiles() as $file) {
            if ($file->getMimeType() === 'application/vnd.google-apps.folder') {
                $folders[] = [
                    'name' => $file->getName(),
                    'id' => $file->getId(),
                    'mimeType' => $file->getMimeType(),
                    'webViewLink' => $file->getWebViewLink(),
//                    'children' => $this->getGoogleDriveList($token, $file->getId()), // 递归调用
                ];
            }
        }
        return $folders;
    }
}
