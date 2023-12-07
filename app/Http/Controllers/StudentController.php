<?php

namespace App\Http\Controllers;


use App\Models\Student;
use App\traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = Student::all();
        return $this->success_response($result);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $validation = $this->rules($request);
        // if( $validation->fails() ) {
        //     return $this->failled_response(result: $validation->errors(),code:404);
        // }
        $result = Student::insert($request->all());
        return $this->success_response($result);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $result = Student::find($id);
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
        $obj = Student::find($id);
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
    public function destroy(Student $student)
    {
        //
    }

    function rules(Request $request) {
        return Validator::make($request->all(),[
            'name'=>'required|unique:students,name',
            'email'=>'required|unique:students,email',
        ]);
    }
}
