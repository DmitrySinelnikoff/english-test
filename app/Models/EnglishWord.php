<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnglishWord extends Model
{
    use HasFactory;

    protected $guarded = false;

    protected $casts = [
        'status' => StatusEnum::class,
    ];

    public function translate() {
        return $this->belongsToMany(RussianWord::class, 'english_russian_words');
    }

    public function tag() {
        return $this->belongsToMany(Tag::class, 'tag_words');
    }

    public function wordView()
    {
        return $this->hasMany(WordView::class);
    }

    public function englishRussian()
    {
        return $this->hasMany(EnglishRussianWord::class);
    }

    public static function getTranslate(string $word){
        return EnglishWord::where('word', $word)->first()->translate->first()->word;
    }
}
