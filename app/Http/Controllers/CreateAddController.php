<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateWordRequest;
use App\Models\Words;
use Doctrine\Inflector\Rules\Word;
use Illuminate\Support\Facades\DB;

class CreateWordController extends Controller
{
    public function index(CreateWordRequest $request)
    {
        $words = Words::created(['Word' => 'a', 'Translation' => 'a', 'Tag' => 'a']);

        return $words;
    }
}
