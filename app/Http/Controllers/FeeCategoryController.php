<?php

namespace App\Http\Controllers;

use App\Models\FeeCategory;
use Illuminate\Http\Request;

class FeeCategoryController extends Controller
{
    public function ViewFeeCat(){
        $data['allData'] = FeeCategory::all();
        return view('backend.setup.feeCategory.view_fee_cat',$data);
    }


    public function AddFeeCategory(){
        return view('backend.setup.feeCategory.add_fee_cat');
    }


    public function StoreFeeCategory(Request $request){
        $validateData = $request->validate([
            'name' => 'required|unique:fee_categories,name',
        ]);

        $data = new FeeCategory();
        $data->name = $request->name;
        $data->save();

        $notification  = array(
            'message'=> 'Category Inserted Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('fee.category.view')->with($notification);
    }


    public function EditFeeCategory($id){
        $editData = FeeCategory::find($id);
        return view('backend.setup.feeCategory.edit_fee_category',compact('editData'));
    }


    public function UpdateFeeCategory(Request $request,$id){
        $data = FeeCategory::find($id);
        $validateData = $request->validate([
            'name' => 'required|unique:fee_categories,name,'.$data->id
        ]);
        $data->name = $request->name;
        $data->save();

        $notification  = array(
            'message'=> 'Category Updated Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('fee.category.view')->with($notification);
    }


    public function DeleteFeeCategory($id){
        $data = FeeCategory::find($id);
        $data->delete();
        $notification  = array(
            'message'=> 'Category Delete Successfully',
            'alert-type'=>'info'
        );
        return redirect()->route('fee.category.view')->with($notification);
    }
} 
