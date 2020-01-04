<?php

namespace App\Handlers;

use Zetgram\Handlers\CallbackQueryHandler;
use Zetgram\ApiAbstract;
use Zetgram\InlineKeyboard;
use App\User;


class SetLanguage extends CallbackQueryHandler
{
    /**
     * @var \Zetgram\ApiAbstract $api
     */
    private ApiAbstract $api;

    public function __construct(ApiAbstract $api)
    {
        $this->api = $api;
    }
    public function handleCallbackQuery($callback)
    { 
        $locale = str_replace('lang_','',$callback->data);
        User::add($callback->from->id,$locale);
        $button = new InlineKeyboard();
        $button->addUrl(['t.me/zetgram'=>'Zetgram']);
        $button->addCallback(['help'=>"Qo'llanma"]);
        $this->api->sendMessage($callback->message->chat->id, trans('welcome',[],$locale),$button,null,'markdown');
        $this->api->deleteMessage($callback->message->chat->id,$callback->message->messageId);
    }
}

