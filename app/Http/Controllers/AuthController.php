<?php

namespace App\Http\Controllers;

use Google\Client;
use Google\Service\Gmail;
use Google_Client;
use Google_Service_Gmail;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
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

        // 获取邮件列表
        $results = $service->users_messages->listUsersMessages('me', ['maxResults' => 10]);

        // 遍历邮件并获取主题和日期
        $emails = [];
        foreach ($results->getMessages() as $message) {
            $email = $service->users_messages->get('me', $message->getId());
            $subject = '';
            $date = '';
            foreach ($email->getPayload()->getHeaders() as $header) {
                if ($header->getName() === 'Subject') {
                    $subject = $header->getValue();
                }
                if ($header->getName() === 'Date') {
                    $date = $header->getValue();
                }
            }
            $emails[] = ['subject' => $subject, 'date' => $date];
        }

        dd($emails);


        // 这里可以处理用户信息，如保存到数据库等
        return redirect('/home');
    }
}
