<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class StudentController extends Controller
{
    
    public function getStudent() {
        $stud = DB::table('students')
        ->orderBy('id', 'asc')
        ->get();
        return response() -> json($stud);
    }


    public function addStudent(Request $request) {
   
        $data = $request->validate([
            'firstName' => 'required',
            'lastName' =>'required',
            'DOB' => 'required',
            'address' => 'required'
        ]);
        $newStudent = Student::create($data);

        return response()->json($newStudent);
      
    }

    public function updateStudent(Request $request, $id) {
        $data = $request->validate([
            'firstName' => 'required',
            'lastName' =>'required',
            'DOB' => 'required',
            'address' => 'required'
        ]);
    
        $updateStudent = student::where('id', $id)->update($data);
    
        return response()->json($updateStudent);
    }

    public function deleteStudent ($id) {

        $student = Student::find($id);

        if($student) {
            $student->delete();
            return response()->json(['status' => 404, 'message' => 'Student deleted successfully'],200);
        } else {
            return response()->json(['status' => 404, 'message' => 'No such data found'],200);
        }
    }

}
