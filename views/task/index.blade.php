@extends('app')

@section('content')
    <div class="container">
        <form action="/oop/tasks/create" method="POST" enctype="multipart/form-data" style="margin-top: 25px;">
        @include('task.form')
        </form>

        @if (count($tasks) > 0)
            @foreach ($tasks as $task)
                <div class="panel panel-default" @if($task->done)style="opacity: .5;"@endif>
                    <div class="panel-heading">{{ $task->title }}</div>
                    <div class="panel-body">
                        @if ($task->description)
                            {{ $task->description }}
                        @else
                            <em class="text-muted">No description</em>
                        @endif

                        @if (isset($task->assigned))
                            <div class="form-group" style="margin-top: 10px;">
                                <label>Assigned to</label>
                                <div>{{ $task->assigned }}</div>
                            </div>
                        @endif

                        @if (isset($task->file))
                                <div class="form-group" style="margin-top: 10px;">
                                    <label>Attachment</label>
                                    <a href="/oop/tasks/{{ $task->id }}/attachment" style="display: block;">{{ $task->file_name }}</a>
                                </div>
                        @endif
                    </div>
                    <div class="panel-footer">
                        <form action="/oop/tasks/{{ $task->id }}/done" method="POST" style="display: inline-block;">
                            <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">
                            @if ($task->done)
                                <button type="submit" class="btn btn-info">Mark as todo</button>
                            @else
                                <button type="submit" class="btn btn-info">Mark as done</button>
                            @endif
                        </form>
                        <a href="/oop/tasks/{{ $task->id }}" class="btn btn-primary">Edit</a>
                        <form action="/oop/tasks/{{ $task->id }}/delete" method="POST" style="display: inline-block;">
                            <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <h2 class="text-center" style="margin-top: 20vh;">No tasks found, have a nice day!</h2>
        @endif
    </div>
@stop