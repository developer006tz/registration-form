<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class District extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'regions_id'];

    protected $searchableFields = ['*'];

    public function regions()
    {
        return $this->belongsTo(Regions::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
