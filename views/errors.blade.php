@if(count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors[0] as $field => $errors)
            <li>{{ $field }}
                <ul>
                    @foreach ($errors as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
</div>
@endif