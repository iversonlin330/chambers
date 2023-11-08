<?php

namespace App\Http\Controllers;

use Google\Client;
use Google\Service\Gmail;
use Google_Client;
use Google_Service_Gmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->scopes(['https://www.googleapis.com/auth/gmail.readonly'])->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->scopes(['https://www.googleapis.com/auth/gmail.readonly'])->user();

        $client = new Google_Client();
        $client->setAuthConfig(json_decode(env('GOOGLE_CREDENTIALS'), true));
        $client->setAccessType('offline');
        $client->setRedirectUri('http://localhost'); // 设置为你的重定向 URI

        // 创建 Gmail 服务
        $service = new Google_Service_Gmail($client);

        // 获取访问令牌（access token）
        $accessToken = $user->token;

        // 设置访问令牌
        $client->setAccessToken($accessToken);

//        $query = 'has:attachment';
        // 获取邮件列表
        $results = $service->users_messages->listUsersMessages('me', [ 'maxResults' => 1]); // 获取100封邮件，以确保包含10封附件邮件

// 遍历邮件并获取主题、日期和附件信息
        $emails = [];
        foreach ($results->getMessages() as $message) {
            $email =  $service->users_messages->get('me', $message->getId());
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
                    dd($attachmentData);
                    file_put_contents("path/to/save/$filename", $attachmentData);
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


        // 这里可以处理用户信息，如保存到数据库等
        return redirect('/home');
    }
}
