<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskContorller extends Controller
{

    public function index(){
        $tasks = DB::table('tasks')->orderBy('name', 'asc')->get();
        // $tasks = Task::all();
        return view('tasks/index', compact('tasks'));
    }

    public function show($id){
        $task = DB::table('tasks')->find($id);
        return view('task', compact('task'));
    }

    public function store(Request $request){
        $task = DB::table('tasks')->insert([
            'name' => $request->name,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // $validated = $request->validate([
        //     'name' => 'required|max:15|min:3'
        // ]);
        // $task = new Task();
        // $task->name = $request->name;
        // $task->save();   
        return redirect()->back();
    }

    public function destroy($id){
        $delete = DB::table('tasks')->where('id', $id)->delete();
        // Task::find($id)->delete();
        return redirect()->back();
    }

    public function edit($id){
        $task = DB::table('tasks')->find($id);
        // $tasks = Task::all();
        $tasks = DB::table('tasks')->orderBy('name', 'asc')->get();
        return view('tasks.edit', compact('task','tasks'));
    }

    public function update(Request $request){
        // $tasks = Task::all();
        $tasks = DB::table('tasks')->orderBy('name', 'asc')->get();
        $task = DB::table('tasks')->where('id', $request->id)->update([
            'name'=>$request->name
        ]);
        return redirect('/');
    }
    
}
