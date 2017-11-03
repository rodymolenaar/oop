@include('errors')

<div class="panel panel-default">
    <div class="panel-heading">
        <input type="text" name="title" class="form-control" placeholder="Title" value="{{ isset($task) ? $task->title : '' }}" focus>
    </div>
    <div class="panel-body">
        <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <textarea name="description" rows="4" class="form-control" placeholder="Describe your task">{{ isset($task) ? $task->description : '' }}</textarea>
        </div>
        <div class="form-group">
            <input type="text" name="assigned" class="form-control" placeholder="Assignee" value="{{ isset($task) ? $task->assigned : '' }}">
        </div>
        <label for="attachment">Attachment</label>
        @if (isset($task->file))
            <div class="form-group">
                <a href="oop/tasks/{{ $task->id }}/attachment">{{ $task->file_name }}</a>
            </div>
        @endif
        <input type="file" name="attachment">
    </div>
    <div class="panel-footer">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</div>