<?php

namespace Laramic\Mailer\Enums;

use Bi\Helpers\Traits\Enum\ArrayableEnumTrait;
use Bi\Helpers\Traits\Enum\RandomableEnumTrait;
use Bi\Helpers\Traits\Enum\FilterableEnumTrait;

enum LaramicServerTypeEnum: string
{
    use ArrayableEnumTrait;
    use RandomableEnumTrait;
    use FilterableEnumTrait;

    case SMTP = 'smtp';
    case IMAP = 'imap';
    case POP3 = 'pop3';
}
