<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Lists extends Controller
{
    public function index()
    {
        // $name = "John Doe";
        return View('todolist');
    }

    public function add(Request $request)
    {
        $data = new Task;
        $data->description=$request->description;
        $data->status='pending';
        $data->save();
        return View('todolist');
        // return response()->json(['message'=>'Task added successfully']);
    }

    function get_data() {
        $data = Task::where('status','pending')->get();
        
        return response()->json($data);
    }

    public function updatedata(Request $request)
    {
        $data = Task::find($request->id);
        $data->status = 'completed';
        $data->update();
        return View('todolist');
    }

    function deletedata(Request $request) {
        Task::where('id',$request->id)->delete();
        echo "Data deleted successfully";
    }

}
