<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnglishRussianWord extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function englishWord()
    {
        return $this->hasOne(EnglishWord::class, "id", "english_word_id");
    }

    public function russianWord()
    {
        return $this->hasOne(RussianWord::class, "id", "russian_word_id");
    }

    public function testResults()
    {
        return $this->hasMany(TestQuestion::class);
    }

}
