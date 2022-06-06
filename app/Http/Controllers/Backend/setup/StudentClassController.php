<?php

namespace App\Http\Controllers\Backend\setup;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class StudentClassController extends Controller
{
    public function ViewStudentClass(){
        $data['allData'] = StudentClass::all();
        return view('backend.setup.studentClass.view_student_class',$data);
    }


    public function AddStudentClass(){
        return view('backend.setup.studentClass.add_class');
    }


    public function StoreStudentClass(Request $request){
        $validateData = $request->validate([
            'name' => 'required|unique:student_classes,name',
        ]);

        $data = new StudentClass();
        $data->name=$request->name;
        $data->save();

        $notification  = array(
            'message'=> 'Class Inserted Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('student.class.view')->with($notification);
    }


    public function EditStudentClass($id){
        $editData = StudentClass::find($id);
        return view('backend.setup.studentClass.edit_class',compact('editData'));
    }


    public function UpdateStudentClass(Request $request,$id){
        $data = StudentClass::find($id);
        $validateData = $request->validate([
            'name' => 'required|unique:student_classes,name,'.$data->id
        ]);
        $data->name = $request->name;
        $data->save();

        $notification  = array(
            'message'=> 'Class Updated Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('student.class.view')->with($notification);
    }


    public function DeleteStudentClass($id){
        $deleteData = StudentClass::find($id);
        $deleteData->delete();

        $notification  = array(
            'message'=> 'Class Delete Successfully',
            'alert-type'=>'info'
        );
        return redirect()->route('student.class.view')->with($notification);
    }
}
