<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'departmentName'
    ];

    // public function getDepartment() {
    //     $result = DB::table('departments')->get();
    //     echo($result)''
    //     return result
    //     // return "Department data has been received!";
    // }

    public function courses()
    {
        return $this->hasMany(Course::class, 'departmentId');
    }
}
