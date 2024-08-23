<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\Fasades\validator;
use App\Models\Task;

class Lists extends Controller
{
    public function index()
    {
        return View('todolist');
    }

    public function add(Request $request)
    {
        $message = ['description.unique'=>'task already exists'];
        $this->validate($request, [
            'description'=>'required|unique:task',
        ],$message);
        $data = new Task;
        $data->description=$request->description;
        $data->status='Not completed';
        $data->save();
        return View('todolist');
        // return response()->json(['message'=>'Task added successfully']);
        return redirect()->back()->with('message',"This is Success Message");
    }

    function get_data() {
        $data = Task::where('status','Not completed')->get();
        
        return response()->json($data);
    }

    function showalldata() {
        $data = Task::all();
        
        return response()->json($data);
    }

    function getalldata() {
        $data = Task::all();
        
        return response()->json($data);
    }

    public function updatedata(Request $request)
    {
        $data = Task::find($request->id);
        $data->status = 'Completed';
        $data->update();
        return View('todolist');
    }

    function deletedata(Request $request) {
        Task::where('id',$request->id)->delete();
    }

}
