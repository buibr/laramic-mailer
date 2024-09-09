<?php

namespace Laramic\Mailer\Seeders;

use Illuminate\Database\Seeder;
use Laramic\Mailer\Models\MailServer;
use Laramic\Mailer\Enums\LaramicServerTypeEnum;

class LaramicSeeder extends Seeder
{


    public function run()
    {
        MailServer::create([
            'type'            => LaramicServerTypeEnum::SMTP->value,
            'primary'         => 1,
            'mail_host'       => 'sandbox.smtp.mailtrap.io',
            'mail_port'       => '2525',
            'mail_username'   => '594bb11e7c95f1',
            'mail_password'   => 'd8039f7c89f9c9',
            'mail_encryption' => 'tls',
        ]);
    }
}
