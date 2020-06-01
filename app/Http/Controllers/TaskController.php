<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class TaskController extends Controller
{
    //一覧表示
    public function index()
    {
        $data = [];
        if (\Auth::check()){  //認証済みの場合
            //認証済みユーザを取得
            $user = \Auth::user();
            //ユーザ投稿一覧を取得
            //$tasks = Task::orderBy('id', 'asc')->paginate(25);
            $tasks = $user->tasks()->orderBy('id', 'desc')->paginate(25);
            
            $data = [
                'user' => $user,
                'tasks' => $tasks,
            ];
        }
        
        return view('tasks.index', $data);
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
        
        // バリデーション
        $this->validate($request, [
            'status' => 'required|max:10',
            'content' => 'required|max:255',
        ]);
        /*
        *ユーザ認証をつける前
        $task = new Task;
        $task->status = $request->status;
        $task->content = $request->content;
        $task->save();
        */
        // 認証済みユーザの投稿として作成
        $request->user()->tasks()->create([
            'status' => $request->status,
            'content' => $request->content,
        ]);
        
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
        $this->validate($request, [
            'status' => 'required|max:10',
            'content' => 'required|max:255',
        ]);
        
        $task = Task::findOrFail($id);
        /*ユーザ認証をつける前*/
        $task->status = $request->status;
        $task->content = $request->content;
        $task->save();
        
        /*
        // 認証済みユーザの投稿として更新
        $request->user()->tasks()->create([
            'status' => $request->status,
            'content' => $request->content,
        ]);
        */
        
        return redirect('/');
    }

    // 削除処理
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        
        // 認証済みユーザがその投稿の所有者である場合は投稿を削除
        if (\Auth::id() === $task->user_id) {
            $task->delete();
        }
        
        return redirect('/');
    }
}
