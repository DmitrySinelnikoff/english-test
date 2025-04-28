<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RussianWord extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function original()
    {
        return $this->belongsToMany(EnglishWord::class, 'english_russian_words');
    }

    public function englishRussian()
    {
        return $this->hasMany(EnglishRussianWord::class);
    }
}
