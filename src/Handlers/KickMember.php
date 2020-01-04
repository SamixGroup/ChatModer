<?php

namespace App\Handlers;

use App\User;
use Zetgram\ApiAbstract;
use Zetgram\Handlers\MessageHandler;
use Zetgram\Types\Message;

class KickMember extends MessageHandler
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
            $this->api->kickChatMember(
                $message->chat->id,
                $message->replyToMessage->from->id
            );
            $this->api->sendMessage(
                $message->chat->id,
                trans('kicked',['name'=>$message->replyToMessage->from->firstName])
            );
        }catch(Exception $e){
            echo 'oops';
        }
    }
}
