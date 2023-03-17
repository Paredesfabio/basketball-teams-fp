@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row justify-content-center teams-board" style="background-color: {{ $team->color }};color: white;border-radius: 0px;">
            <div class="card" style="width: 100%;border: 0px; background-color: transparent;">
                <div class="row">
                    <div class="col-md-4 col-md-4 col-sm-12 col-xs-12" style="display: flex;justify-content: center;">
                        <img src="{{ url(@$team->icon)}}" class="img-fluid rounded-start" alt="{{ @$team->name}}"
                        style="width: 200px;height: 200px;">
                    </div>
                    <div class="col-lg-8 col-md-8 col-xs-12">
                        <div class="card-body">
                            <h5 class="card-title">{{ @$team->name }}</h5>
                            <p class="card-text">{{ $team->id }}th in {{ $team->division->name }}</p>
                            <p class="card-text"><small>Last updated 3 mins ago</small></p>
                            @if (auth()->check())
                                <div class="dropdown float-start" style="margin-bottom: 10px;">
                                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                        Actions
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <li>
                                            <a href="{{ route('player.create',$team->id) }}" class="dropdown-item">Add Player</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('staff.create',$team->id) }}" class="dropdown-item">Add Staff</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('team.edit',$team->id) }}" class="dropdown-item">Edit</a>
                                        </li>
                                        <li class="delete-button">
                                            <form action="{{ route('team.delete',$team->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item button alert-delete" data-toggle="tooltip" title='Delete'>Delete</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br><br>

        @include('layouts.messages')

        <div class="row teams-board" style="border-radius: 0px;">
            <div class="col-12">
                <h3 class="title-text align-middle">ROSTER</h3>
            </div>
            <hr>


            @foreach ($team->players as $player)
                @if($player->role === 1)
                    <ol class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">
                                    <img src="{{getImageFile($player->attributes->image)}}" class="img-fluid radius-50 teams-icon" alt="{{ @$player->name}}">
                                    <span style="padding-left: 10px;">
                                        <a href="{{route('player.details', ['player' => $player->id])}}" class="card-link">{{ $player->name }}</a>
                                    </span>
                                </div>
                                @if ($player->attributes->position === 'F')
                                    Forward
                                @elseif ($player->attributes->position === 'F-G')
                                    Forward-Guard
                                @elseif ($player->attributes->position === 'G')
                                    Guard
                                @elseif ($player->attributes->position === 'C-F')
                                    Center-Forward
                                @else
                                    Center
                                @endif
                                | {{ Str::upper($player->attributes->country->name) }}
                            </div>
                            <span class="badge bg-primary rounded-pill">{{ '#' . $player->attributes->number }}</span>
                        </li>
                    </ol>
                @endif
            @endforeach
        </div>

        <br><br>

        <div class="row teams-board" style="border-radius: 0px;">
            <h3 class="title-text">COACHING STAFF</h2>
            <hr>
            @foreach ($team->players as $player)
                @if(in_array($player->role, [2,3,4]))
                    <div class="col-12">
                        <div class="card" style="width: 100%;border: 0px;">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <h4>
                                        @if ($player->role === 2)
                                            Head Coach
                                        @elseif ($player->role === 3)
                                            Assistant Coach
                                        @else
                                            Trainer
                                        @endif
                                        <span style="font-size:15px; font-weight: bold;">{{ $player->name }}</span>
                                    </h4>

                                </li>
                            </ul>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script type="text/javascript">
        $('.alert-delete').click(function(event){
            var form =  $(this).closest("form");
            event.preventDefault();
            Swal.fire({
                title: 'DELETE TEAM',
                text: 'Do you want to continue ?',
                icon: 'warning',
                showConfirmButton: true,
                showDenyButton: true,
                confirmButtonText: 'Confirm',
                denyButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) form.submit();
            })

        });
    </script>

@endsection

