<?php

namespace App\Http\Controllers\Backend\setup;

use App\Http\Controllers\Controller;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class StudentYearController extends Controller
{
    public function ViewStudentYear(){
        $data['allData'] = StudentYear::all();
        return view('backend.setup.studentYear.view_student_year',$data);
    }


    public function AddStudentYear(){
        return view('backend.setup.studentYear.add_student_year');
    }


    public function StoreStudentYear(Request $request){
        $validateData = $request->validate([
            'name' => 'required|unique:student_years,name',
        ]);

        $data = new StudentYear();
        $data->name = $request->name;
        $data->save();

        $notification  = array(
            'message'=> 'Year Inserted Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('student.year.view')->with($notification);


    }


    public function EditStudentYear($id){
        $editData = StudentYear::find($id);
        return view('backend.setup.studentYear.edit_student_year',compact('editData'));
    }


    public function UpdateStudentYear(Request $request,$id){
        $data = StudentYear::find($id);
        $validateData = $request->validate([
            'name' => 'required|unique:student_years,name,'.$data->id
        ]);
        $data->name = $request->name;
        $data->save();

        $notification  = array(
            'message'=> 'Year Updated Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('student.year.view')->with($notification);

    }


    public function DeleteStudentYear($id){
        $data = StudentYear::find($id);
        $data->delete();
        $notification  = array(
            'message'=> 'Year Delete Successfully',
            'alert-type'=>'info'
        );
        return redirect()->route('student.year.view')->with($notification);
    }
}
