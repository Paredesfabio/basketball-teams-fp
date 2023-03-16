@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row justify-content-center teams-board" style="background-color: var(--primary) !important;color:white;border-radius: 0px;">
            <div class="col-lg-12">
                <h3 class="title-text">Division {{ $division->name }} - All teams</h2>
            </div>
        </div>

        {{--  <div class="row justify-content-center teams-board">
            <div class="col-lg-6">
                <h3 class="title-text">Division {{ $division->name }} - All teams</h2>
            </div>
            <div class="col-lg-6 float-end">
                @if(auth()->check())
                    <a class="btn btn-outline-primary float-end" href="#" role="button">Add Team</a>
                @endif
            </div>
        </div>  --}}
        <div class="row justify-content-center teams-board" style="border-radius: 0px;">

            @foreach ($teams as $team)
                <div class="col-lg-6 col-md-6 col-sm-12" style="padding:10px;">
                    <div class="card" style="width: 100%; height: 200px;">
                        <div class="card-body">
                        <h5 class="card-title">
                            <img src="{{ url(@$team->icon)}}" class="img-fluid rounded-start teams-icon" alt="{{ @$team->name}}">
                            {{ $team->name }}
                        </h5>
                        <p class="card-text custom-card-text">{{ $team->about}}</p>
                        <a href="{{route('team.details', ['team' => $team->id])}}" class="card-link">Profile</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
