<?php

namespace App\Observers;

use App\Models\OrganizationUser;
use Faker\Core\Number;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Notifications\WelcomeEmailNotification;

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
        $password = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz'),1,6);
        $organizationUser->uuid = $uuid;
        $organizationUser->password = Hash::make($password);
        $organizationUser->save();

        $organizationUser->notify(new WelcomeEmailNotification($password));
    }

}
