<?php

namespace App\Http\Controllers\Backend\setup;

use App\Http\Controllers\Controller;
use App\Models\StudentGroup;
use Illuminate\Http\Request;

class StudentGroupController extends Controller
{
    public function ViewStudentGroup(){
        $data['allData'] = StudentGroup::all();
        return view('backend.setup.studentGroup.view_student_group',$data);
    }


    public function AddStudentGroup(){
        return view('backend.setup.studentGroup.add_student_group');
    }


    public function StoreStudentGroup(Request $request){
        $validateData = $request->validate([
            'name' => 'required|unique:student_groups,name',
        ]);

        $data = new StudentGroup();
        $data->name = $request->name;
        $data->save();

        $notification  = array(
            'message'=> 'Group Inserted Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('student.group.view')->with($notification);
    }

    
    public function EditStudentGroup($id){
            $editData = StudentGroup::find($id);
            return view('backend.setup.studentGroup.edit_student_group',compact('editData'));
        
    }


    public function UpdateStudentGroup(Request $request,$id){
        $data = StudentGroup::find($id);
        $validateData = $request->validate([
            'name' => 'required|unique:student_groups,name,'.$data->id
        ]);
        $data->name = $request->name;
        $data->save();

        $notification  = array(
            'message'=> 'Group Updated Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('student.group.view')->with($notification);
    }


    public function DeleteStudentGroup($id){
        $data = StudentGroup::find($id);
        $data->delete();
        $notification  = array(
            'message'=> 'Group Delete Successfully',
            'alert-type'=>'info'
        );
        return redirect()->route('student.group.view')->with($notification);
    }
}


