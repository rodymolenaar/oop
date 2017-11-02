@extends('app')

@section('content')
    <div class="container">
        <h1>YOUR TASKS!!!!</h1>

        <form action="/tasks/create" method="POST">
        @include('task.form')
        </form>

        @if (count($tasks) > 0)
            @foreach ($tasks as $task)
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $task->title }}</div>
                    <div class="panel-body">
                        @if ($task->description)
                            {{ $task->description }}
                        @else
                            <em class="text-muted">No description</em>
                        @endif
                    </div>
                    <div class="panel-footer">
                        <a href="/tasks/{{ $task->id }}" class="btn btn-primary">Edit</a>
                        <a href="/tasks/{{ $task->id }}/attachment" class="btn btn-default">Attachment</a>
                        <button class="btn btn-info">Mark as done</button>
                    </div>
                </div>
            @endforeach
        @else
            <h2>NO TASKS!!!</h2>
        @endif
    </div>
@stop