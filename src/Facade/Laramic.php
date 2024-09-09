<?php

namespace Laramic\Mailer\Facade;

use Laramic\Mailer\Models\MailServer;
use Illuminate\Support\Facades\Facade;

/**
 * @method static void use (MailServer $mailServer)
 * @method static bool ping(MailServer $mailServer, string $to = null)
 * @method static bool testMail(MailServer $mailServer)
 */
class Laramic extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laramic.manager';
    }
}
