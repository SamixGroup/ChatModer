<?php

namespace App\Filters;

use Zetgram\Filters\FilterInterface;
use Zetgram\Types\Update;
use Zetgram\ApiAbstract;

class ChatAdminFilter implements FilterInterface
{

    /**
     * @var \Zetgram\ApiAbstract $api
     */
    private ApiAbstract $api;

    public function __construct(ApiAbstract $api){
        $this->api = $api;
    }

    public function check(Update $update, ...$params): bool
    {
        if(!isset($update->message))
            return false;

        if($update->message->chat->type !== 'supergroup')
           return false;
        if(!isset($update->message->replyToMessage)){
            $this->api->sendMessage(
                $update->message->chat->id,
                trans('reply-empty'),
                null,
                $update->message->messageId
            );
            return false;
        }
        
        $status = $this->api->getChatMember($update->message->chat->id,$update->message->from->id)->status;
        $replyS = $this->api->getChatMember($update->message->chat->id,$update->message->replyToMessage->from->id)->status;
        return ($status == "administrator" or $status == "creator") and ($replyS !== "administrator" and $replyS !== "creator");
    }
}