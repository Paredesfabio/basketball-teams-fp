@extends('layouts.app')

@section('content')
    <div class="container-fluid wrapper">
        <div class="row justify-content-center">
            @foreach ($divisions as $division)

                <div class="col-lg-4 col-md-6 col-sm-12" style="padding: 10px">
                    <div class="card division-card" onclick="window.location='{{ url("division/".$division->id) }}'">
                        <div class="card-body">
                            <h5 class="card-title">{{ @$division->name }}</h5>
                            <p class="card-text custom-card-text">{{ @$division->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
