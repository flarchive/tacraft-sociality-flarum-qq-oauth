<?php

declare(strict_types=1);

namespace TacraftSociality\QqOauth;

use Flarum\Extend;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\User\Event\RegisteringFromProvider;
use TacraftSociality\QqOauth\Api\Controllers\DeleteIconController;
use TacraftSociality\QqOauth\Api\Controllers\UploadIconController;
use TacraftSociality\QqOauth\Forum\Controllers\QQAuthController;
use TacraftSociality\QqOauth\Listeners\SyncQQAvatar;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/less/forum.less'),

    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/less/admin.less'),

    new Extend\Locales(__DIR__.'/locale'),

    (new Extend\Routes('forum'))
        ->get('/auth/qq', 'auth.qq', QQAuthController::class),

    (new Extend\Routes('api'))
        ->post('/qq-oauth/icon', 'qq-oauth.icon.upload', UploadIconController::class)
        ->delete('/qq-oauth/icon', 'qq-oauth.icon.delete', DeleteIconController::class),

    (new Extend\Event())
        ->listen(RegisteringFromProvider::class, SyncQQAvatar::class),

    (new Extend\Settings())
        ->default(Settings::APP_ID, '')
        ->default(Settings::APP_SECRET, '')
        ->default(Settings::ICON_PATH, '')
        ->default(Settings::SYNC_AVATAR, '1')
        ->serializeToForum('qqOAuthIconUrl', Settings::ICON_PATH, function ($value): ?string {
            return Settings::iconUrl($value);
        })
        ->serializeToForum('qqOAuthEnabled', Settings::APP_ID, function ($value): bool {
            if (! is_string($value) || trim($value) === '') {
                return false;
            }

            $secret = resolve(SettingsRepositoryInterface::class)->get(Settings::APP_SECRET, '');

            return is_string($secret) && trim($secret) !== '';
        }),
];
