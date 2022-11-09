<?php
namespace App\Classes;

use Mailjet\Client;
use Mailjet\Resources;

class MailClass
{
    private $api_key = '081b560fac34e51781f9b5dd6331a103';
    private $secret_key = '8f43a96ed8e7bcf5c714a4d067a57006';

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
                    'TemplateID' => 4344168, 
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