<?php

namespace App\Enums;

enum DataProviderYStatusEnum: int
{
    case PAID = 100;
    case PENDING = 200;
    case REJECT = 300;

}
