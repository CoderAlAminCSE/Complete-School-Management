<?php

namespace App\Http\Controllers\Backend\setup;

use App\Http\Controllers\Controller;
use App\Models\StudentShift;
use Illuminate\Http\Request;

class StudentShiftController extends Controller
{
    public function ViewStudentShift(){
        $data['allData'] = StudentShift::all();
        return view('backend.setup.studentShift.view_student_shift',$data);
    }


    public function AddStudentShift(){
        return view('backend.setup.studentShift.add_student_shift');
    }


    public function StoreStudentYear(Request $request){
        $validateData = $request->validate([
            'name' => 'required|unique:student_shifts,name',
        ]);

        $data = new StudentShift();
        $data->name = $request->name;
        $data->save();

        $notification  = array(
            'message'=> 'Shift Inserted Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('student.shift.view')->with($notification);
    }


    public function EditStudentShift($id){
        $editData = StudentShift::find($id);
        return view('backend.setup.studentShift.edit_student_shift',compact('editData'));
    }


    public function UpdateStudentShift(Request $request,$id){
        $data = StudentShift::find($id);
        $validateData = $request->validate([
            'name' => 'required|unique:student_shifts,name,'.$data->id
        ]);
        $data->name = $request->name;
        $data->save();

        $notification  = array(
            'message'=> 'Shift Updated Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('student.shift.view')->with($notification);
    }


    public function DeleteStudentShift($id){
        $data = StudentShift::find($id);
        $data->delete();
        $notification  = array(
            'message'=> 'Shift Delete Successfully',
            'alert-type'=>'info'
        );
        return redirect()->route('student.shift.view')->with($notification);
    }
}
