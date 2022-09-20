<?php

namespace App\Observers;

use App\Models\OrganizationUser;
use App\Notifications\WelcomeEmailNotification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class OrganizationUserObserver
{
    /**
     * Handle the OrganizationUser "created" event.
     *
     * @param \App\Models\OrganizationUser $organizationUser
     *
     * @return void
     */
    public function created(OrganizationUser $organizationUser)
    {
        $uuid = Str::uuid();
        while (OrganizationUser::where("uuid", $uuid)->count() > 0) {
            $uuid = Str::uuid();
        }
        $password                   = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz'),
            1, 6);
        $organizationUser->uuid     = $uuid;
        $organizationUser->password = Hash::make($password);
        $organizationUser->save();

        $organizationUser->notify(new WelcomeEmailNotification($password, $organizationUser->name));
    }

}
