<?php

namespace App\Http\Controllers\Backend\setup;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use Illuminate\Http\Request;

class ExamTypeController extends Controller
{
    public function ViewExamType(){
        $data['allData'] = ExamType::all();
        return view('backend.setup.examType.view_exam_type',$data);
    }


    public function AddExamType(){
        return view('backend.setup.examType.add_exam_type');
    }


    public function StoreExamType(Request $request){
        $validateData = $request->validate([
            'name' => 'required|unique:exam_types,name',
        ]);

        $data = new ExamType();
        $data->name = $request->name;
        $data->save();

        $notification  = array(
            'message'=> 'Exam Type Inserted Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('exam.type.view')->with($notification);
    }


    public function EditExamType($id){
        $editData = ExamType::find($id);
        return view('backend.setup.examType.edit_exam_type',compact('editData'));
    }


    public function UpdateExamType(Request $request,$id){
        $data = ExamType::find($id);
        $validateData = $request->validate([
            'name' => 'required|unique:exam_types,name,'.$data->id
        ]);
        $data->name = $request->name;
        $data->save();

        $notification  = array(
            'message'=> 'Exam Type Updated Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('exam.type.view')->with($notification);
    }


    public function DeleteExamType($id){
        $data = ExamType::find($id);
        $data->delete();
        $notification  = array(
            'message'=> 'Exam Type Delete Successfully',
            'alert-type'=>'info'
        );
        return redirect()->route('exam.type.view')->with($notification);
    }
}
