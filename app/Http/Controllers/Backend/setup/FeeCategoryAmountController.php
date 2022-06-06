<?php

namespace App\Http\Controllers\Backend\setup;

use App\Http\Controllers\Controller;
use App\Models\FeeCategory;
use App\Models\FeeCategoryAmount;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;

class FeeCategoryAmountController extends Controller
{
    public function ViewFeeAmount(){
        // $data['allData'] = FeeCategoryAmount::all();
        $data['allData'] = FeeCategoryAmount::select('fee_category_id')->groupby('fee_category_id')->get();
        return view('backend.setup.feeAmount.view_fee_amount',$data);
    }


    public function AddFeeAmount(){
        $data['fee_category'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.feeAmount.add_fee_amount',$data);
    }


    public function StoreFeeAmount(Request $request){
        $countClass = count($request->class_id);
        if($countClass != NULL){
            for($i=0; $i<$countClass; $i++){
                $fee_amount = new FeeCategoryAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];
                $fee_amount->save();
            }
        }
        $notification  = array(
            'message'=> 'Fee Amount Inserted Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('fee.amount.view')->with($notification);
    }


    public function EditFeeAmount($fee_category_id){
        $data['editData'] = FeeCategoryAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id','asc')->get();
        $data['fee_category'] = FeeCategory::all();
        $data['classes'] = StudentClass::all(); 
        return view('backend.setup.feeAmount.edit_fee_amount',$data);
    }


    public function UpdateFeeAmount(Request $request,$fee_category_id){
        if($request->class_id == NULL){
            $notification  = array(
                'message'=> 'You did not select any class or amount ',
                'alert-type'=>'error'
            );
            return redirect()->route('fee.amount.edit',$fee_category_id)->with($notification);
        }
        else{
            FeeCategoryAmount::where('fee_category_id',$fee_category_id)->delete();
            $countClass = count($request->class_id);
                for($i=0; $i<$countClass; $i++){
                    $fee_amount = new FeeCategoryAmount();
                    $fee_amount->fee_category_id = $request->fee_category_id;
                    $fee_amount->class_id = $request->class_id[$i];
                    $fee_amount->amount = $request->amount[$i];
                    $fee_amount->save();
                }
            $notification  = array(
                'message'=> 'Fee Amount Updated Successfully',
                'alert-type'=>'success'
            );
            return redirect()->route('fee.amount.view')->with($notification);
        }
    }


    public function DetailsFeeCategory($fee_category_id){
        $data['detailsData'] = FeeCategoryAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id','asc')->get();
        return view('backend.setup.feeAmount.details_fee_amount',$data);
    }
}
