<?php


namespace App\Filters;


use Zetgram\Filters\FilterInterface;
use Zetgram\Types\Update;

class ReplyAnswerFilter implements FilterInterface
{

    public function check(Update $update, ...$params): bool
    {
        if(!isset($update->message))
            return false;
        echo '1';
        if(!isset($update->message->replyToMessage))
            return false;
        echo '2';
        if($update->message->replyToMessage->from->id !== (int)getenv('BOT_ID'))
            return false;
        echo '3';
        if(isset($update->message->replyToMessage->forwardFrom))
            return true;
        echo '4';
        return isset($update->message->replyToMessage->forwardSenderName);
    }
}