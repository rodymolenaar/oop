@extends('app')

@section('content')
    <div class="container">
        <h1>Edit task</h1>

        <form action="oop/tasks/{{ $task->id }}" method="POST" enctype="multipart/form-data">
            @include('task.form')
        </form>
    </div>
@stop