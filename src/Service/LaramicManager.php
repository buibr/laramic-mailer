<?php

namespace Laramic\Mailer\Service;

use Illuminate\Mail\MailManager;
use Illuminate\Support\Facades\Auth;
use Laramic\Mailer\Models\MailServer;
use Laramic\Mailer\Enums\LaramicLogTypeEnum;


class LaramicManager extends MailManager
{
    public static function use(MailServer $mailServer): self
    {
        $mailer = $mailServer->getMailer();
        return new self($mailer);
    }

    public function ping(MailServer $mailServer): bool
    {
        try {
            // Create a Swift_SmtpTransport instance with the provided mail server settings
            $transport = $mailServer->getTransport();

            $response = $transport->ping();

            $mailServer->logs()->create([
                'type' => LaramicLogTypeEnum::PING,
                'success' => (bool)$response,
                'rawResponse' => $response,
            ]);

            return (bool)$response;
        } catch (\Exception $e) {
            $mailServer->logs()->create([
                'type' => LaramicLogTypeEnum::PING,
                'success' => false,
                'rawResponse' => $e->getMessage(),
            ]);

            return false;
        }
    }

    public function testMail(MailServer $mailServer, string $to = null): bool
    {
        try {
            // Create a Swift_SmtpTransport instance with the provided mail server settings
            $transport = $mailServer->getTransport();

            // If the email is sent successfully, return true
            $mailer = new \Swift_Mailer($transport);

            $message = (new \Swift_Message('Test email'))
                ->setFrom([$mailServer->mail_username => $mailServer->mail_from_name])
                ->setTo(Auth::user()->email)
                ->setBody('Test email body');

            $response = $mailer->send($message);

            $mailServer->logs()->create([
                'type' => LaramicLogTypeEnum::TEST_MAIL,
                'success' => (int)$response >= 1,
                'rawResponse' => $response,
            ]);

            return (int)$response >= 1;
        } catch (\Exception $e) {

            $mailServer->logs()->create([
                'type' => LaramicLogTypeEnum::TEST_MAIL,
                'success' => false,
                'rawResponse' => $e->getMessage(),
            ]);

            return false;
        }
    }
}
