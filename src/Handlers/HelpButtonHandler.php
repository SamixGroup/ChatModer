<?php

namespace App\Handlers;

use Zetgram\Handlers\CallbackQueryHandler;
use Zetgram\ApiAbstract;
use Zetgram\InlineKeyboard;
use App\User;

class HelpButtonHandler extends CallbackQueryHandler
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
        $locale = User::getLocale($callback->from->id);
        echo $locale;
        $button = [
            'inline_keyboard'=>[
                [['text'=>'Zetgram','url'=>'https://t.me/zet_gram']],
                [['url'=>'https://github.com/samixgroup/chatmoder','text'=>'Source code']]
                ]
            ];
        $this->api->editMessageText($callback->from->id,$callback->message->messageId,null,trans('help',[],$locale),'markdown',$button);
    }
}

