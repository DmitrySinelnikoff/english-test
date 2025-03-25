<?php

namespace App\Models;

use App\Enums\RoleEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public static function viewed() {
        return EnglishWord::join("word_views", "word_views.english_word_id", "=", "english_words.id")
        ->groupBy("english_words.id", 'word_views.created_at')
        ->where('word_views.user_id', Auth::user()->id)
        ->where('english_words.word_status_id', 2)
        ->orderBy(DB::raw('word_views.created_at'), 'desc')
        ->limit(50)
        ->get(['english_words.*']);
    }

    public function tests()
    {
        return $this->hasMany(Test::class);
    }

    public function userSumResult() 
    {
        $tests = $this->tests()->get();
        $result = 0;
        foreach ($tests as $test) {
            $result += $test->questions()->where('result', 2)->count();
        }
        return $result;
    }

    public function userTestCount()
    {
        $tests = $this->tests()->get();
        $result = 0;

        foreach ($tests as $test) {
            $result += $test->completeTests() == 10 ? 1 : 0;
        }

        return $result;
    }

    public function trueAnswerPercente()
    {
        $trueAnswer = $this->userSumResult();
        $allAnswer = $this->tests()->count();

        if($trueAnswer == 0 || $allAnswer == 0)
            return 0;

        $trueAnswerPercente = round($trueAnswer / $allAnswer * 10);
        return $trueAnswerPercente;
    }
}
