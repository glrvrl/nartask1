<?php

namespace App\Observers;

use App\Models\OrganizationUser;
use Illuminate\Support\Str;

class OrganizationUserObserver
{
    /**
     * Handle the OrganizationUser "created" event.
     *
     * @param  \App\Models\OrganizationUser  $organizationUser
     * @return void
     */
    public function created(OrganizationUser $organizationUser)
    {
        $uuid = Str::uuid();
        while (OrganizationUser::where("uuid", $uuid)->count() > 0) {
            $uuid = Str::uuid();
        }
        $organizationUser->uuid = $uuid;
        $organizationUser->save();
    }
}
