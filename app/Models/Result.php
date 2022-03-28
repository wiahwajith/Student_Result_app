<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Result extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject_id',
        'exam_id',
        'attempt',
        'marks',
        'gpa',
        'exam_date',
      ];

    public function studentDetails()
    {
        return $this->belongsTo(Student::class);
    }
    public function Exam()
    {
        return $this->hasMany(Exam::class , 'id' , 'exam_id');
    }
    public function Subject()
    {
        return $this->hasMany(Subject::class , 'id' , 'subject_id');
    }
}
