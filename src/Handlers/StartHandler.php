<?php

namespace App\Handlers;


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
        $button->addCallback(['lang_uz'=>"O'zbek tili",'lang_ru'=>"Русский язык"]);
        $this->api->sendMessage($message->chat->id, trans('set-language'),$button,null,'markdown');
    }
}
