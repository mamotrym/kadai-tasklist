@extends('layouts.app')

@section('content')

    @if (Auth::check())
    <h1 class=h3>{{ Auth::user()->name }}のタスク一覧</h1>
    
        @if (count($tasks) > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>ステータス</th>
                        <th>タスク</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                    <tr>
                        {{-- 詳細ページリンク --}}
                        <td>{!! link_to_route('tasks.show', $task->id, ['task' => $task->id]) !!}</td>
                        <td>{{ $task->status }}</td>
                        <td>{{ $task->content }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        
        @endif
        
        {{-- ページネーションへのリンク --}}
        {{ $tasks->links() }}
        
        {{-- 新規作成ページリンク --}}
        {!! link_to_route('tasks.create', '新規タスクの作成', [], ['class' => 'btn btn-sm btn-primary']) !!}

    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1 class="h3 mb-4">タスクリストへようこそ</h1>
                <p>タスクリストのご利用にはユーザ登録を行ってください。</p>
                {{-- ユーザ登録ページへのリンク --}}
                {!! link_to_route('signup.get', '新規ユーザ登録', [], ['class' => 'btn btn-md btn-primary']) !!}
            </div>
        </div>

    @endif
    
@endsection