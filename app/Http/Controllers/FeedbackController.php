<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedbackRequest;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class FeedBackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::all()->paginate(45);
        return view('feedback.index', compact('feedbacks'));
    }

    public function create()
    {
        return view('feedback.create');
    }

    public function store(FeedbackRequest $request)
    {
        $data = $request->validated();
        Feedback::firstOrCreate([
            'user_id' => Auth::user()->id,
            'text' => $data['message']
        ]);
        return redirect()->route('home.show');
    }

    public function show(Feedback $feedback)
    {
        return view('feedback.show', compact('feedback'));
    }

    public function destroy(Feedback $feedback)
    {
        $feedback->delete();
        return redirect()->route('feedback.index');
    }
}
