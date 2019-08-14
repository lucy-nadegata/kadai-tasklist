@extends('layouts.app')

@section('content')

    <h1>id = {{ $message->id }} のタスクの詳細ページ</h1>

    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <td>{{ $message->id }}</td>
        </tr>
        <tr>
            <th>メッセージ</th>
            <td>{{ $message->content }}</td>
        </tr>
    </table>
    
    {!! link_to_route('tasks.edit', 'このタスクを編集', ['id' => $message->id], ['class' => 'btn btn-light']) !!}

    {!! Form::model($message, ['route' => ['tasks.destroy', $message->id], 'method' => 'delete']) !!}
        {!! Form::submit('完了', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
    
@endsection