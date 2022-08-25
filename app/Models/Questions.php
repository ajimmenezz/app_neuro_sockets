<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Questions extends Model
{
    use HasFactory;

    protected $table = 'questions';
    protected $fillable = ['UserId', 'Question', 'Readed'];

    public static function getQuestions()
    {
        return Questions::leftJoin('t_additional_user_information as ti', 'ti.UserId', '=', 'questions.UserId')
            ->select(
                'questions.Id',
                'questions.created_at',
                'questions.Question',
                'questions.Readed',
                DB::raw('if(ti.Firstname is not null, CONCAT(ti.Firstname, " ", ti.Lastname, " ", ti.MLastname), "") AS FullName')
            )
            ->orderBy('questions.created_at', 'desc')
            ->get();
    }
}
