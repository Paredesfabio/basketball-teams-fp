@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('layouts.messages')

        <div class="row justify-content-center teams-board" style="background-color: var(--primary) !important;color:white;border-radius: 0px;">
            <div class="col-lg-12">
                @if (auth()->check())
                    <a class="btn btn-outline-primary" style="margin-bottom: 10px;" href="{{ route('team.create') }}" role="button">Add Team</a>
                @endif
                <span class="section-title">All teams</span>
            </div>
        </div>

        <div class="row justify-content-center teams-board">

            @foreach ($divisions as $division)
                <div class="col-lg-4 col-md-6 col-sm-12" style="padding: 10px">
                    <h5 class="card-title" style="padding-bottom: 10px;">{{ @$division->name }}</h5>

                    @foreach ($teams as $team)
                        @if ($team->division->name === $division->name)
                            <div class="card team-card">
                                <div class="card-body" style="padding: 0px;">
                                    <h5 class="card-title" style="font-size: 15px;">
                                        <img src="{{ url(@$team->icon) }}" class="img-fluid teams-icon radius-50" alt="{{ @$team->name }}">
                                        <a href="{{ route('team.details', ['team' => $team->id]) }}" class="card-link team-name">{{ $team->name }}</a>
                                    </h5>
                                </div>
                            </div>

                        @endif
                    @endforeach

                </div>
            @endforeach

        </div>
    </div>
@endsection
