<?php

namespace App\Enums;

use Henzeb\Enumhancer\Concerns\Enhancers;

enum UserRegistrationStatus
{
    use Enhancers;

    const UNPAID = 0;
    const SUBSCRIBED_COMPLETED = 1;
}
