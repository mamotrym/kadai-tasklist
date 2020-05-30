@extends('layouts.app')

@section('content')

    <h1 class="h3">タスクの新規作成</h1>
    
        <div class="row">
            <div class="col-6">
            {!! Form::model($task, ['route' => 'tasks.store']) !!}
            
                <div class="form-group">
                    {!! Form::label('status', 'ステータス:') !!}
                    {!! Form::text('status', null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('content', 'タスク:') !!}
                    {!! Form::text('content', null, ['class' => 'form-control']) !!}
                </div>
                
                {!! Form::submit('登録', ['class' => 'btn btn-sm btn-primary']) !!}
            
            {!! Form::close() !!}
        </div>
    </div>

@endsection