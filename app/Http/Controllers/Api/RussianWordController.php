<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RussianWord;
use Illuminate\Http\Request;

class RussianWordController extends Controller
{
    public function index(Request $request)
    {
        $words = RussianWord::select('id', 'word');

        $search = $request->get('q');
        if($search != '') {
            $words = $words->where('word', 'LIKE', '%' . $search . '%');
        }

        $words = $words->get();

        return response()->json($words);
    }
}