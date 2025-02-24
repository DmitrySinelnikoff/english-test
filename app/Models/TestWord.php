<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestWord extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function russianWord()
    {
        return $this->hasOne(RussianWord::class, "id", "russian_word_id");
    }
}
