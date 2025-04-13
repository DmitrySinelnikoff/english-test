<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PartOfSpeech;

class PartOfSpeechController extends Controller
{
    public function index()
    {
        $partsOfSpech = PartOfSpeech::all();
        return response()->json($partsOfSpech);
    }
}