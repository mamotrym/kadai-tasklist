<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class TaskController extends Controller
{
    //一覧表示
    public function index()
    {
        $tasks = Task::all();
        
        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }

    //新規登録画面（フォーム）
    public function create()
    {
        $task = new Task;
        
        return view('tasks.create', [
            'task' => $task,
        ]);
    }

    //新規登録処理
    public function store(Request $request)
    {
        $task = new Task;
        $task->content = $request->content;
        $task->save();
        
        return redirect('/');
    }

    // 詳細画面（id値）
    public function show($id)
    {
        $task = Task::findOrFail($id);
        
        return view('tasks.show', [
            'task' => $task,
        ]);
    }

    // 更新画面（フォーム）
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        
        return view('tasks.edit', [
            'task' => $task,
        ]);
    }

    // 更新処理
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        
        $task->content = $request->content;
        $task->save();
        
        return redirect('/');
    }

    // 削除処理
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        
        $task->delete();
        
        return redirect('/');
    }
}