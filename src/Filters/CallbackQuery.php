<?php

namespace App\Filters;

use Zetgram\Filters\FilterInterface;
use Zetgram\Types\Update;

class CallbackQuery implements FilterInterface
{

    public function check(Update $update, ...$params): bool
    {
        if(!isset($update->callbackQuery))
            return false;
        
        return true;
    }
}