<?php

namespace App\Observers;

use App\Models\Organization;
use Illuminate\Support\Str;


class OrganizationObserver
{
    /**
     * Handle the Organization "created" event.
     *
     * @param  \App\Models\Organization  $organization
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
    }
}
