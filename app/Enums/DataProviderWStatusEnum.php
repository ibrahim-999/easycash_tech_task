<?php

namespace App\Enums;

enum DataProviderWStatusEnum: string
{
    case PAID = 'done';
    case PENDING = 'wait';
    case REJECT = 'nope';

}
