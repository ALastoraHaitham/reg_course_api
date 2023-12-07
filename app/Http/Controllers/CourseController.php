<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\traits\ApiResponse;

class CourseController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = Course::all();
        return $this->success_response($result);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $this->rules($request);
        if( $validation->fails() ) {
            return $this->faild_response(result: $validation->errors(),code:404);
        }
        $result = Course::insert($request->all());
        return $this->success_response($result);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $result = Course::find($id);
        if(!is_null($result)) {
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
        $obj = Course::find($id);
        if(!is_null($$obj)) {
            $result = tap($obj)->update($request->all());
            return $this->success_response($result);
        } else {
            return $this->failled_response(code: 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }

    function rules(Request $request) {
        return Validator::make($request->all(),[
            'name'=>'required|unique:courses,name',
            'hours'=>'required',
            'teacher_id'=>'required',
        ]);
    }
}
