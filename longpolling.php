<?php
declare(strict_types=1);

use App\Filters\ChatAdminFilter;
use App\Filters\PrivateChatFilter;
use App\Filters\ReplyAnswerFilter;
use App\Filters\CallbackQuery;

use App\Handlers\PrivateChatHandler;
use App\Handlers\ReplyAnswerHandler;
use App\Handlers\StartHandler;
use App\Handlers\HelpButtonHandler;
use App\Handlers\KickMember;
use App\Handlers\RestrictMember;
use App\Handlers\SetLanguage;
use Zetgram\Bot;

require __DIR__ . '/boot.php';

/**
 * @var \Zetgram\Bot $bot
 */
$api = $container->get(\Zetgram\ApiAbstract::class);
$bot = new Bot($api, $container);


// $bot->addRoute(AdminChatHandler::class,AdminFilter::class);
$bot->hears('\/start.*', StartHandler::class,PrivateChatFilter::class);
$bot->hears('!kick.*',KickMember::class,ChatAdminFilter::class);
$bot->hears('!ro.*',RestrictMember::class,ChatAdminFilter::class);
$bot->hears('!ban.*',BanMember::class,ChatAdminFilter::class);

$bot->action('lang_.*',SetLanguage::class,CallbackQuery::class);
$bot->action('help',HelpButtonHandler::class,CallbackQuery::class);

$bot->run();