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

$bot->addRoute(PrivateChatHandler::class, PrivateChatFilter::class);

$bot->addCallbackRoute(HelpButtonHandler::class,CallbackQuery::class);
$bot->run();