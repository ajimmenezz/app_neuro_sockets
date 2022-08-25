<?php

namespace App\Http\Controllers;

use App\Models\Questions;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    public function showQuestions()
    {
        return view('questions.main', [
            'questions' => Questions::getQuestions()
        ]);
    }
}
