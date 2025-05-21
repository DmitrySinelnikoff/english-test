<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartOfSpeech extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function words() {
        return $this->hasOne(EnglishRussianWord::class, 'part_of_speech_id', 'id');
    }
}
