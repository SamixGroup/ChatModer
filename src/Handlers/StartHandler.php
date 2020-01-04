<?php

namespace App\Handlers;

use App\User;
use Zetgram\ApiAbstract;
use Zetgram\Handlers\MessageHandler;
use Zetgram\Types\Message;
use Zetgram\InlineKeyboard;
use Zetgram\Types\InlineKeyboardMarkup;


class StartHandler extends MessageHandler
{
    /**
     * @var \Zetgram\ApiAbstract $api
     */
    private ApiAbstract $api;

    public function __construct(ApiAbstract $api)
    {
        $this->api = $api;
    }

    public function handleMessage(Message $message)
    {
        $button = new InlineKeyboard();
        $button->addUrl(['t.me/zetgram'=>'Zetgram']);
        $button->addCallback(['help'=>"Qo'llanma"]);
        $this->api->sendMessage($message->chat->id, trans('welcome'),$button,null,'markdown');
        User::add($message->from->id);
    }
}
