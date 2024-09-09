<?php

namespace Laramic\Mailer\Enums;

use Bi\Helpers\Traits\Enum\ArrayableEnumTrait;
use Bi\Helpers\Traits\Enum\RandomableEnumTrait;
use Bi\Helpers\Traits\Enum\FilterableEnumTrait;

enum LaramicLogTypeEnum: string
{
    use ArrayableEnumTrait;
    use RandomableEnumTrait;
    use FilterableEnumTrait;

    case PING = 'ping';

    case TEST_MAIL = 'test';

    case SEND = 'send';

    case FAIL = 'fail';
}
