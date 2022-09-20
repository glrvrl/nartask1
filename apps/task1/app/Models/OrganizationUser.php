<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class OrganizationUser extends Model
{
    use HasFactory;
    use Notifiable;

    protected $guarded = [];

    protected $hidden = ['password'];

    public function organizations()
    {
        return $this->hasMany(Organization::class, 'email', 'email');
    }
}
