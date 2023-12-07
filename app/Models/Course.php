<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['name','hours','teacher_id'];

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }

    public function student(){
        return $this->belongsToMany(Student::class,'course_student')->withTimestamps();
    }
}
