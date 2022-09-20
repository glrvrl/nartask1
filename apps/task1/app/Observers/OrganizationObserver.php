<?php

namespace App\Observers;

use App\Models\Organization;
use App\Models\OrganizationUser;
use Illuminate\Support\Str;


class OrganizationObserver
{
    /**
     * Handle the Organization "created" event.
     *
     * @param \App\Models\Organization $organization
     *
     * @return void
     */
    public function created(Organization $organization)
    {
        $uuid = Str::uuid();
        while (Organization::where("uuid", $uuid)->count() > 0) {
            $uuid = Str::uuid();
        }
        $organization->uuid = $uuid;
        $organization->save();

        if (OrganizationUser::query()->where('email', $organization->email)->count() === 0) {

            $mail_name      = substr($organization->email, 0, strpos($organization->email, '@'));
            $search_array   = ['.', '_', 0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
            $replace_array  = [' ', ' ', '', '', '', '', '', '', '', '', '', '',];
            $generated_name = ucwords(str_replace($search_array, $replace_array, $mail_name));

            OrganizationUser::query()->create(
                [
                    'name'  => $generated_name,
                    'email' => $organization->email,
                ]
            );

        }
    }
}
