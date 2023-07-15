<?php

namespace App\Enums;

enum DataProviderXStatusEnum: int
{
    case PAID = 1;
    case PENDING = 2;
    case REJECT = 3;

}
