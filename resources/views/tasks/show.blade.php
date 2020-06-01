@extends('layouts.app')

@section('content')

    <h1 class="h3">{{ $task->id }}タスクの詳細</h1>
    
    <div class="card mb-3">
        <div class="card-header">id:{{ $task->id }}</div>
        <div class="card-body">
            <p class="card-text">ステータス：{{ $task->status }}</p>
            <p class="card-text">{{ $task->content }}</p>
        </div>
    </div>
    
    @if (Auth::id() == $task->user_id)
    {{-- 編集ページリンク --}}
    {!! link_to_route('tasks.edit', 'このタスクを編集', ['task' => $task->id], ['class' => 'btn btn-sm btn-secondary mb-2']) !!}
    
    {{-- 削除フォーム --}}
    {!! Form::model($task, ['route' => ['tasks.destroy', $task->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除する', ['class' => 'btn btn-sm btn-danger']) !!}
    {!! Form::close() !!}
    
    @endif

@endsection