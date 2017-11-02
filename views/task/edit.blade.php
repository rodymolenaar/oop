@extends('app')

@section('content')
    <div class="container">
        <h1>Edit task</h1>

        <form action="/tasks/{{ $task->id }}" method="POST">
            @include('task.form')
        </form>
    </div>
@stop