@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row justify-content-center teams-board" style="background-color: var(--primary) !important;color:white;border-radius: 0px;">
            <div class="col-lg-12">
                <span class="section-title">All players</span>
            </div>
        </div>

        <div class="row justify-content-center teams-board">

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Player</th>
                        <th scope="col">Team</th>
                        <th scope="col">Number</th>
                        <th scope="col">Position</th>
                        <th scope="col">Height</th>
                        <th scope="col">Weight</th>
                        <th scope="col">Experience</th>
                        <th scope="col">Country</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($players as $player)
                        <tr>
                            <th>
                                <img src="{{getImageFile($player->attributes->image)}}" class="img-fluid rounded-start teams-icon" alt="{{ @$player->name}}">
                                <a href="{{route('player.details', ['player' => $player->id])}}" class="card-link">{{ $player->name }}</a>
                            </th>
                            <td>{{ $player->team->name }}</td>
                            <td>{{ $player->attributes->number }}</td>
                            <td>{{ $player->attributes->position }}</td>
                            <td>{{ $player->attributes->height }}</td>
                            <td>{{ $player->attributes->weight }} lbs</td>
                            <td>
                                @if($player->attributes->experience > 0)
                                    {{ $player->attributes->experience }}
                                @else
                                    R
                                @endif
                            </td>
                            <td>{{ $player->attributes->country->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $players->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>
    </div>
@endsection
