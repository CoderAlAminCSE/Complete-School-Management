<?php

namespace App\Http\Controllers\Backend\setup;

use App\Http\Controllers\Controller;
use App\Models\SchoolSubject;
use Illuminate\Http\Request;

class SchoolSubjectController extends Controller
{
    public function ViewExamType(){
        $data['allData'] = SchoolSubject::all();
        return view('backend.setup.schoolSubject.view_school_subject',$data);
    }


    public function AddSchoolSubject(){
        return view('backend.setup.schoolSubject.add_school_subject');
    }


    public function StoreSchoolSubject(Request $request){
        $validateData = $request->validate([
            'name' => 'required|unique:school_subjects,name',
        ]);

        $data = new SchoolSubject();
        $data->name = $request->name;
        $data->save();

        $notification  = array(
            'message'=> 'Subject Inserted Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('school.subject.view')->with($notification);
    }


    public function EditSchoolSubject($id){
        $editData = SchoolSubject::find($id);
        return view('backend.setup.schoolSubject.edit_school_subject',compact('editData'));
    }


    public function UpdateSchoolSubject(Request $request,$id){
        $data = SchoolSubject::find($id);
        $validateData = $request->validate([
            'name' => 'required|unique:school_subjects,name,'.$data->id
        ]);
        $data->name = $request->name;
        $data->save();

        $notification  = array(
            'message'=> 'Subject Updated Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('school.subject.view')->with($notification);
    }


    public function DeleteSchoolSubject($id){
        $data = SchoolSubject::find($id);
        $data->delete();
        $notification  = array(
            'message'=> 'Subject Delete Successfully',
            'alert-type'=>'info'
        );
        return redirect()->route('school.subject.view')->with($notification);
    }
}
