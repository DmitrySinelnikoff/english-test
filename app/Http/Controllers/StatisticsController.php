<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EnglishWord;
use App\Models\RussianWord;
use App\Models\Tag;
use App\Models\User;
use App\Models\WordView;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class StatisticsController extends Controller
{
    public function index()
    {
        $data = array();
        $data['peopleCount'] = User::count();
        $data['usersCount'] = User::where('user_role_id', 1)->count();
        $data['adminCount'] = User::where('user_role_id', 2)->count();
        $data['registeredPeopleCount'] = EnglishWord::whereDate('created_at', Carbon::today())->count();

        $data['englishWordsCount'] = EnglishWord::where('word_status_id', 2)->count();
        $data['suggestedEnglishWordsCount'] = EnglishWord::where('word_status_id', 1)->count();
        $data['createTodayEnglishWordsCount'] = EnglishWord::whereDate('created_at', Carbon::today())->count();

        $data['russianWordsCount'] = RussianWord::count();
        $data['createTodayRussianWordsCount'] = RussianWord::whereDate('created_at', Carbon::today())->count();

        $data['tagsCount'] = Tag::count();

        $data['viewsCount'] = WordView::count();
        $data['todayViewsCount'] = WordView::whereDate('created_at', Carbon::today())->count();

        $tags = Tag::withCount('words')->get();
        $views = WordView::mostShowed();

        $viewed = [];
        if(Auth::check() == true)
        {
            $viewed = User::viewed();
        }

        return view('statistics', compact('data', 'tags', 'views', 'viewed'));
    }
}
