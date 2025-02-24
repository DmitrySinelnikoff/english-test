<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestQuestion extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function wordCombination()
    {
        return $this->hasOne(EnglishRussianWord::class, "id", "english_russian_word_id");
    }

    public function testWord()
    {
        return $this->hasMany(TestWord::class);
    }
}
