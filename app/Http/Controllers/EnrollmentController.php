<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enrollment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class EnrollmentController extends Controller
{
    public function getEnrollment() {
        // $en = DB::table('enrollments')->get();
        // return response() -> json($en);

        $enrollments = Enrollment::select('enrollments.*', 'firstName', 'lastName', 'address', 'DOB', 'courseName', 'departmentId')
            ->join('students', 'enrollments.studentId', '=', 'students.id')
            ->join('courses', 'enrollments.courseId', '=', 'courses.id')
            ->orderBy('enrollments.id', 'asc')
            ->get();
    
        return response()->json($enrollments);

    }


    public function addEnrollment(Request $request) {
   
        $data = $request->validate([
            'studentId' => 'required',
            'courseId' =>'required',
            'enrollment_date' => 'required',
        ]);
        $newEnrollment = Enrollment::create($data);

        return response()->json($data);
      
    }

    public function updateEnrollment(Request $request, $id) {
        $data = $request->validate([
            'studentId' => 'required',
            'courseId' =>'required',
            'enrollment_date' => 'required',
        ]);
    
        $updateEnrollment = Enrollment::where('id', $id)->update($data);
    
        return response()->json($updateEnrollment);
    }

    public function deleteEnrollment ($id) {

        $enrollment = Enrollment::find($id);

        if($enrollment) {
            $enrollment->delete();
            return response()->json(['status' => 404, 'message' => 'Student deleted successfully'],200);
        } else {
            return response()->json(['status' => 404, 'message' => 'No such data found'],200);
        }
    }
}
