@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Oops!</strong> Something went wrong.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
