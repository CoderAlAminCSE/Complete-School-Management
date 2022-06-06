<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    public function UserView(){
        //$Alldata=User::all();
        $data['alldata']=User::where('usertype','Admin')->get();
        return view('backend/user/view_user',$data);
    }

    public function UserAdd(){
        return view('backend.user.add_user');
    }

    public function UserStore(Request $request){
        $validateData = $request->validate([
            'email' => 'required|unique:users',
            'name' => 'required'
        ]);

        $data= new User();
        $code=rand(0000,9999);
        $data->usertype='Admin';
        $data->role=$request->role;
        $data->name=$request->name;
        $data->email=$request->email;
        $data->password=bcrypt($code);
        $data->code=$code;
        $data->save();

        $notification  = array(
            'message'=> 'User Inserted Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('user.view')->with($notification);
    }


    public function UserEdit($id){
        $editData=User::find($id);
        return view('backend.user.edit_user',compact('editData'));
    }


    public function UpdateStore(Request $request, $id){
        $data=User::find($id);
        $data->name=$request->name;
        $data->email=$request->email;
        $data->role=$request->role;
        $data->save();

        $notification  = array(
            'message'=> 'User Update Successfully',
            'alert-type'=>'info'
        );
        return redirect()->route('user.view')->with($notification);
    }


    public function DeleteUser($id){
        $data=User::find($id);
        $data->delete();

        $notification  = array(
            'message'=> 'User Delete Successfully',
            'alert-type'=>'info'
        );
        return redirect()->route('user.view')->with($notification);
    }


}
