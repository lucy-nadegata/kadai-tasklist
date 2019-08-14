@extends('layouts.app')

@section('content')

    <h1>タスク一覧</h1>

    @if (count($messages) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>タスク</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($messages as $message)
                <tr>
                    <td>{!! link_to_route('tasks.show', $message->id, ['id' => $message->id]) !!}</td>
                    <td>{{ $message->content }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {!! link_to_route('tasks.create','新規タスクの追加',[],['class' => 'btn btn-primary']) !!}

@endsection