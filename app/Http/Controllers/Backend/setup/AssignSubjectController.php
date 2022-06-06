<?php

namespace App\Http\Controllers\Backend\setup;

use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use App\Models\SchoolSubject;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class AssignSubjectController extends Controller
{
    public function ViewAssignSubject(){
                // $data['allData'] = AssignSubject::all();
                $data['allData'] = AssignSubject::select('class_id')->groupby('class_id')->get();
                return view('backend.setup.assignSubject.view_assign_subject',$data);
    }


    public function AddAssignSubject(){
            $data['subjects'] = SchoolSubject::all();
            $data['classes'] = StudentClass::all();
            return view('backend.setup.assignSubject.add_assign_subject',$data);
    }


    public function StoreAssignSubject(Request $request){
        $countSubject = count($request->subject_id);
        if($countSubject != NULL){
            for($i=0; $i<$countSubject; $i++){
                $assign_subject = new AssignSubject();
                $assign_subject->class_id = $request->class_id;
                $assign_subject->subject_id = $request->subject_id[$i];
                $assign_subject->full_mark = $request->full_mark[$i];
                $assign_subject->pass_mark = $request->pass_mark[$i];
                $assign_subject->subjective_mark = $request->subjective_mark[$i];
                $assign_subject->save();
            }
        }
        $notification  = array(
            'message'=> 'Assign Subject Inserted Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('assign.subject.view')->with($notification);
    }


    public function EditAssignSubject($class_id){
        $data['editData'] = AssignSubject::where('class_id',$class_id)->orderBy('subject_id','asc')->get();

        $data['subjects'] = SchoolSubject::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.assignSubject.edit_assign_subject',$data);
    }


    public function UpdateAssignSubject(Request $request,$class_id){
        if($request->subject_id == NULL){
            $notification  = array(
                'message'=> 'You did not select any subject',
                'alert-type'=>'error'
            );
            return redirect()->route('edit.assign.subject',$class_id)->with($notification);
        }
        else{
            AssignSubject::where('class_id',$class_id)->delete();
            $countSubject = count($request->subject_id);
                for($i=0; $i<$countSubject; $i++){
                    $assign_subject = new AssignSubject();
                    $assign_subject->class_id = $request->class_id;
                    $assign_subject->subject_id = $request->subject_id[$i];
                    $assign_subject->full_mark = $request->full_mark[$i];
                    $assign_subject->pass_mark = $request->pass_mark[$i];
                    $assign_subject->subjective_mark = $request->subjective_mark[$i];
                    $assign_subject->save();
                }
            $notification  = array(
                'message'=> 'Assign Subject Updated Successfully',
                'alert-type'=>'success'
            );
            return redirect()->route('assign.subject.view')->with($notification);
        }
    }


    public function DetailsAssignSubject($class_id){
        $data['detailsData'] = AssignSubject::where('class_id',$class_id)->orderBy('subject_id','asc')->get();
        return view('backend.setup.assignSubject.details_assign_subject',$data);
    }
}
