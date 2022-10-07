<?php
namespace App\Classes;

use Mailjet\Client;
use Mailjet\Resources;

class MailClass
{
    private $api_key = 'faec735eeeb57e2f1aefd9c86a759d99';
    private $secret_key = '59c8b588e4bf92baf1d6eb229417728d';

    public function send($to_email, $to_name, $subject, $content)
    {
        $mj = new Client($this->api_key, $this->secret_key,true,['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "robin@lasuperferme.fr",
                        'Name' => "La Super Ferme"
                    ],
                    'To' => [
                        [
                            'Email' => $to_email,
                            'Name' => $to_name
                        ]
                    ],
                    'TemplateID' => 4250731, 
                    'TemplateLanguage' => true,
                    'Subject' => $subject,
                    'Variables' => [
                        'content' => $content,
                    ]
                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success();
    }
}