<?php

namespace App\Models;

use Doctrine\Inflector\Rules\Word;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WordView extends Model
{
    use HasFactory;

    public function wordView()
    {
        return $this->belongsTo(Word::class);
    }

    public static function createViewLog($word) {
        $wordViews = new WordView();
        $wordViews->english_word_id = $word->id;
        $wordViews->session_id = request()->getSession()->getId();
        $wordViews->user_id = (auth()->check())?auth()->id():null;
        $wordViews->ip = request()->ip();
        $wordViews->agent = request()->header('User-Agent');
        $wordViews->save();
    }

    public static function mostShowed() {
        return EnglishWord::join("word_views", "word_views.english_word_id", "=", "english_words.id")
            ->where('english_words.status', 1)
            ->groupBy("english_words.id")
            ->orderBy(DB::raw('COUNT(english_words.id)'), 'desc')
            ->limit(50)
            ->get([DB::raw('COUNT(english_words.id) as total_views'), 'english_words.*']);
    }
}
