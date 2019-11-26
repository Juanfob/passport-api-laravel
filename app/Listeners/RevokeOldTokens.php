<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\Events\AccessTokenCreated;

class RevokeOldTokens
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param AccessTokenCreated $event
     */
    public function handle(AccessTokenCreated $event)
    {
        DB::table('oauth_access_token')
            ->where('id', '<>',$event->tokenId)
            ->where('id',$event->userId)
            ->where('client_id', $event->clientId)
            ->update(['revoked' => true]);
    }
}
