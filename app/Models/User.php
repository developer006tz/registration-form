<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles;
    use Notifiable;
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'dob',
        'district_id',
        'regions_id',
    ];

    protected $searchableFields = ['*'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'dob' => 'date',
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function regions()
    {
        return $this->belongsTo(Regions::class);
    }

    public function userLanguages()
    {
        return $this->hasMany(UserLanguage::class);
    }

    public function isSuperAdmin(): bool
    {
        return $this->hasRole('super-admin');
    }
}
