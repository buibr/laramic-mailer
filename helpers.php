<?php

use Illuminate\Support\Facades\Cache;
use Laramic\Mailer\Models\MailServer;


if (!function_exists('laramicMailServers')) {

    function laramicMailServers()
    {
        return Cache::remember(MailServer::CACHE_KEY, 86400, function () {
            $list = MailServer::all()
                ->pluck('mail_host', 'id')
                ->prepend(' - Select mail server', '');

            $fixed = collect(config('mail.servers'))
                ->prepend(' --- Config ---- ', null);

            return collect($list->toArray() + $fixed->toArray());
        });
    }
}

