<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EventUsers extends Model
{
    use HasFactory;

    protected $table = 't_users';

    public static function getUserName($id)
    {
        $query = DB::table('t_additional_user_information')
            ->select('Firstname', 'Lastname', 'MLastname')
            ->where('UserId', $id)
            ->first();

        if ($query) {
            return $query->Firstname . ' ' . $query->Lastname . ' ' . $query->MLastname;
        } else {
            return 'No name';
        }
    }
}
