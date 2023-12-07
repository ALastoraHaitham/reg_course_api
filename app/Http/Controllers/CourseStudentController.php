<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CourseStudentController extends Controller
{
    use ApiResponse;
    public function index()
    {
        $result = DB::table('course_student')->get();
        return $this->success_response($result);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, int $id)
    {
        $validation = $this->rules($request);
        if ($validation->fails()) {
            return $this->failed_response($validation->errors(), 404);
        }
        $student = Student::find($id);
        $student->courses()->attach($request->all());
        return $this->success_response($student);
    }

    public function findCourse(Request $request)
    {
        $validation = $this->rules($request);
        if ($validation->fails()) {
            return $this->faild_response(result: $validation->errors(), code: 404);
        }
        $result = Course::has('hours')->get();
        return $this->success_response($result);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $result = DB::table('course_student')->find($id);
        if (!is_null($result)) {
            return $this->success_response($result);
        } else {
            return $this->failled_response(code: 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        // $obj = Course::find($id);
        // if(!is_null($$obj)) {
        //     $result = tap($obj)->update($request->all());
        //     return $this->success_response($result);
        // } else {
        //     return $this->failled_response(code: 404);
        // }
    }

    function rules(Request $request)
    {
        return Validator::make($request->all(), [
            'name' => 'required|unique:courses,name',
            'teacher_id' => 'required',
        ]);
    }
}
