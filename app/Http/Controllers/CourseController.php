<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
class CourseController extends Controller
{
    public function getCourses() {
        // $cours = DB::table('courses')->get();
        // return response() -> json($cours);

        $courses = Course::select('courses.*', 'departments.departmentName')
            ->join('departments', 'courses.departmentId', '=', 'departments.id')
            ->orderBy('courses.id', 'asc')
            ->get();
    
        return response()->json($courses);
    }

    public function addCourse(Request $request) {
        $data = $request->validate([
            'courseName' => 'required',
            'departmentId' => 'required'
        ]);

        $newCourse = Course::create($data);

        return response()->json($newCourse);
    }

    public function updateCourse(Request $request, $id) {
        $data = $request->validate([
            'courseName' => 'required',
            'departmentId' => 'required'
        ]);
    
        $updateCourse = Course::where('id', $id)->update($data);
    
        return response()->json($updateCourse);
    }

    public function deleteCourse ($id) {
        $course = Course::find($id);

        if($course) {
            $course->delete();
            return response()->json(['status' => 404, 'message' => 'Course deleted successfully'],200);
        } else {
            return response()->json(['status' => 404, 'message' => 'No such data found'],200);
        }
    }
}
