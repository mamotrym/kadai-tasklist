@extends('layouts.app')

@section('content')

    <h1 class="h3">タスクの編集</h1>
    
    <div class="row">
        <div class="col-6">
            {!! Form::model($task, ['route' => ['tasks.update', $task->id], 'method' => 'put']) !!}

                <div class="form-group">
                    {!! Form::label('status', 'ステータス:') !!}
                    {!! Form::text('status', null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('content', 'タスク:') !!}
                    {!! Form::text('content', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('更新', ['class' => 'btn btn-sm btn-primary']) !!}

            {!! Form::close() !!}
            <div>投稿USER：{{ $task->user_id }}</div>
        </div>
    </div>

@endsection