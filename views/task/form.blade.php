@include('errors')

<div class="panel panel-default">
    <div class="panel-heading">
        <input type="text" name="title" class="form-control" placeholder="Title" value="{{ isset($task) ? $task->title : '' }}" focus>
    </div>
    <div class="panel-body">
        <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">
        <textarea name="description" rows="4" class="form-control" placeholder="Describe your task">{{ isset($task) ? $task->description : '' }}</textarea>
    </div>
    <div class="panel-footer">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</div>