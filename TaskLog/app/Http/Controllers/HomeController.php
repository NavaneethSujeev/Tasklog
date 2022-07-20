<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\task;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class HomeController extends Controller
{
    public function homepage(){
        return view('homepage');
    }
    public function addtask(){
        return view('addtask');
    }
    public function doaddtask(Request $request){
        $store            = new task();
        $store->task      = $request->Task;
        $store->userid    = Auth::user()->id;
        $store->date      = $request->Date;
        $store->starttime = $request->starttime;
        $store->endtime   = $request->endtime;
        $store->save();
        return redirect()->back()->with('message', 'Task Added');
    }
    public function taskdetails(){
        if(Auth::user()->user_type == "supervisor"){
            $tasks  = User::select('Users.name','Tasks.userid','Tasks.id','Tasks.date','Tasks.starttime','Tasks.endtime','Tasks.status')->Join('Tasks', 'Tasks.userid', '=', 'Users.id')->orderby('Users.id')->get();
            return view('taskview',compact('tasks'));

        }else{
            $tasks  = task::where('userid',Auth::user()->id)->get();
            return view('taskdetails',compact('tasks'));
        }
    }   
    public function edittask(Request $request){
        $tasks  = task::where('id',$request->id)->first();
        return $tasks;
    }  
    public function updatetask(Request $request){
        
        $update  = task::where('id',$request->id)
                        ->update([
                            'task'      => $request->Task,
                            'date'      =>$request->Date,
                            'starttime' => $request->starttime,
                            'endtime'   => $request->endtime
                        ]);
        return $update;

    }  
    public function addstaff(){
        return view('staffadd');
    } 
    public function doaddstaff(Request $request){

        $password = Hash::make($request->pswd);

        $addstaff            = new User();
        $addstaff->name      = $request->name;
        $addstaff->email     = $request->email;
        $addstaff->password  = $password;
        $addstaff->save();
        return redirect('/addstaff')->with('message', 'Staff Created');
    } 
    public function changestatus(Request $request){
        $id      = $request->id;
        $status  = $request->status;
        if($status== "Reject"){
            $statusid = 1;
        }else{
            $statusid = 0;
        }
        $update  = task::where('id',$id)
        ->update([
            'status'      => $statusid
        ]);
        return $update;
    } 
    public function logout(){
        Auth::logout();
        return redirect('/')->with('message', 'Logout Successfully');
    } 
    
}
