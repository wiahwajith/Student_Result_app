<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'students_details';


    public function Account()
    {
        return $this->hasOne(User::class);
    }
    public function Result()
    {
        return $this->hasMany(Result::class , 'student_id' , 'id');
    }

}
