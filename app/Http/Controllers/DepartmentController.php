<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class DepartmentController extends Controller
{
    //
    
    public function getData() {
        $dep = DB::table('departments')
        ->orderBy('id', 'asc')
        ->get();
        return response() -> json($dep);
    }

    public function createDepartment() {
        return view('departments.create');
    }

    public function storeDepartment(Request $request) {
        $data = $request->validate([
            'departmentName'=>'required'
        ]);

        $newDepartment = Department::create($data);

        return response()->json($newDepartment);
    }

    public function updateDepartment(Request $request, $id) {
        $data = $request->validate([
            'departmentName' => 'required'
        ]);
    
        $updateDepartment = Department::where('id', $id)->update($data);
    
        return response()->json($updateDepartment);
    }

    public function deleteDepartment ($id) {
        // dd($id);
        // $deleteDepartment = Department::where('id', $id)->delete();

        // return response()->json($deleteDepartment);
        $department = Department::find($id);

        if($department) {
            $department->delete();
            return response()->json(['status' => 404, 'message' => 'Department deleted successfully'],200);
        } else {
            return response()->json(['status' => 404, 'message' => 'No such data found'],200);
        }
    }
}
