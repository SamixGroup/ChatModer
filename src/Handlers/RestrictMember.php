<?php

namespace App\Handlers;

use App\User;
use Zetgram\ApiAbstract;
use Zetgram\Handlers\MessageHandler;
use Zetgram\Types\Message;

class RestrictMember extends MessageHandler
{
    /**
     * @var ApiAbstract
     */
    private ApiAbstract $api;

    public function __construct(ApiAbstract $api)
    {
        $this->api = $api;
    }

    public function handleMessage(Message $message)
    {
        try{
            $this->api->restrictChatMember(
                $message->chat->id,
                $message->replyToMessage->from->id,
                time()+1800
            );
            $this->api->sendMessage(
                $message->chat->id,
                trans('restricted',['name'=>$message->replyToMessage->from->firstName])
            );
        }catch(Exception $e){
            echo 'oops';
        }
    }
}