<?php

namespace App\Enums;

enum StatusCodeTypeEnum: string
{
    case PAID = 'paid';
    case PENDING = 'pending';
    case REJECT = 'reject';

}
