<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserLanguage extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['user_id', 'language_id'];

    protected $searchableFields = ['*'];

    protected $table = 'user_languages';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
