<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class TasksController extends Controller
{
    //一覧表示処理
    public function index()
    {
        $tasks = Task::all();
        
        return view('tasks.index', [
            'tasks' => $tasks, ]);
        
    }

    //新規登録画面表示処理
    public function create()
    {
        $task = new Task;
        
        return view('tasks.create',[
            'task'=> $task,
            ]);
    }

    //新規登録処理
    public function store(Request $request)
    {   
        $this->validate($request, [
            'status' => 'required|max:10',
            'content'=> 'required',
        ]);
        
        $task = new Task;
        $task->status = $request->status;
        $task->content = $request->content;
        $task->save();

        return redirect('/');
    }

    //取得表示処理
    public function show($id)
    {
        $task = Task::find($id);

        return view('tasks.show', [
            'task' => $task,
        ]);
    }

    //更新画面表示処理
        public function edit($id)
    {
        $task = Task::find($id);
        
        return view('tasks.edit', ['task' => $task,]);
    }

    //更新処理
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'status'=>'required|max:10',
            'content'=>'required',
            ]);
            
        
        $task = Task::find($id);
        $task->status = $request->status;
        $task->content = $request->content;
        $task->save();

        return redirect('/');
    }

    //削除処理
        public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();

        return redirect('/');
    }
}
