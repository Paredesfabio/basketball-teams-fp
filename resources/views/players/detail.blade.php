@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row justify-content-center teams-board" style="background-color: var(--primary);color: white;border-radius:0px;">
            <div class="card" style="width: 100%;border: 0px; background-color: transparent;padding: 0px;">
                <div class="row">
                    <div class="col-md-4 col-md-4 col-sm-12 col-xs-12" style="display: flex;justify-content: center;">
                        <img src="{{ getImageFile($player->attributes->image) }}" class="img-fluid radius-50"
                            alt="{{ @$player->name }}" style="width: 200px;height: 200px;">
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <div class="card-body">
                            <p class="card-text">{{ $player->team->name }} | {{ '#' . $player->attributes->number }} |
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
                            </p>
                            <h2 class="card-title">{{ $player->name }}</h2>
                            <table class="table" style="color: var(--white-text);text-align: center;">
                                <tr>
                                    <td class="table-text-player">HEIGHT</td>
                                    <td class="table-text-player">WEIGHT</td>
                                    <td class="table-text-player">COUNTRY</td>
                                    <td class="table-text-player">AGE</td>
                                </tr>
                                <tr>
                                    <td class="table-content-player">{{ $player->attributes->height }}</td>
                                    <td class="table-content-player">{{ $player->attributes->weight }} lbs</td>
                                    <td class="table-content-player">{{ Str::upper($player->attributes->country->name) }}</td>
                                    <td class="table-content-player">{{ $player->attributes->age }} years</td>
                                </tr>
                                <tr>
                                    <td class="table-text-player">BIRTHDATE</td>
                                    <td class="table-text-player">DRAFT</td>
                                    <td class="table-text-player">EXPERIENCE</td>
                                    <td class="table-text-player">SCHOOL</td>
                                </tr>
                                <tr>
                                    <td class="table-content-player">{{ $player->attributes->birth_date->format('j F, Y') }}</td>
                                    <td class="table-content-player">{{ $player->attributes->draft_date->format('j F, Y') }}</td>
                                    <td class="table-content-player">
                                        @if($player->attributes->experience > 0)
                                            {{ $player->attributes->experience }} Years
                                        @else
                                            ROOKIE
                                        @endif
                                    </td>
                                    <td class="table-content-player">{{ $player->attributes->school }}</td>
                                </tr>
                            </table>
                            @if (auth()->check())
                                <div class="dropdown float-start" style="margin-bottom: 10px;">
                                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                                        id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                        Actions
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <li>
                                            <a href="{{ route('player.edit', $player->id) }}" class="dropdown-item">Edit</a>
                                        </li>
                                        <li class="delete-button">
                                            <form action="{{ route('player.delete',$player->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item button alert-delete-player" data-toggle="tooltip" title='Delete'>Delete</button>
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

        <div class="row justify-content-center">

            <h3 class="title-text">Player Info</h2>
                <p> {{ $player->attributes->about_me }}</p>

                <hr>

                <h3 class="title-text">Last 5 Games</h2>

                    <table class="table-responsive table-hover" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Game Date</th>
                                <th>Matchup</th>
                                <th>W/L</th>
                                <th>MIN</th>
                                <th>PTS</th>
                                <th>FGM</th>
                                <th>FGA</th>
                                <th>FG%</th>
                                <th>3PM</th>
                                <th>3PA</th>
                                <th>3P%</th>
                                <th>FTM</th>
                                <th>FTA</th>
                                <th>FT%</th>
                                <th>REB</th>
                                <th>AST</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> MAR 13, 2023</td>
                                <td>BOS @ HOU</td>
                                <td>L</td>
                                <td>41</td>
                                <td>22</td>
                                <td>8</td>
                                <td>22</td>
                                <td>36.4</td>
                                <td>2</td>
                                <td>>10</td>
                                <td>20.0</td>
                                <td>4</td>
                                <td>4</td>
                                <td>100</td>
                                <td>8</td>
                                <td>6</td>
                            </tr>
                            <tr>
                                <td> MAR 12, 2023</td>
                                <td>BOS @ MIA</td>
                                <td>L</td>
                                <td>41</td>
                                <td>22</td>
                                <td>8</td>
                                <td>22</td>
                                <td>36.4</td>
                                <td>2</td>
                                <td>>10</td>
                                <td>20.0</td>
                                <td>4</td>
                                <td>4</td>
                                <td>100</td>
                                <td>8</td>
                                <td>6</td>
                            </tr>
                            <tr>
                                <td> MAR 11, 2023</td>
                                <td>BOS @ ATL</td>
                                <td>L</td>
                                <td>41</td>
                                <td>22</td>
                                <td>8</td>
                                <td>22</td>
                                <td>36.4</td>
                                <td>2</td>
                                <td>>10</td>
                                <td>20.0</td>
                                <td>4</td>
                                <td>4</td>
                                <td>100</td>
                                <td>8</td>
                                <td>6</td>
                            </tr>
                            <tr>
                                <td> MAR 03, 2023</td>
                                <td>BOS @ POR</td>
                                <td>L</td>
                                <td>41</td>
                                <td>22</td>
                                <td>8</td>
                                <td>22</td>
                                <td>36.4</td>
                                <td>2</td>
                                <td>>10</td>
                                <td>20.0</td>
                                <td>4</td>
                                <td>4</td>
                                <td>100</td>
                                <td>8</td>
                                <td>6</td>
                            </tr>
                            <tr>
                                <td> MAR 02, 2023</td>
                                <td>BOS @ BKN</td>
                                <td>L</td>
                                <td>41</td>
                                <td>22</td>
                                <td>8</td>
                                <td>22</td>
                                <td>36.4</td>
                                <td>2</td>
                                <td>>10</td>
                                <td>20.0</td>
                                <td>4</td>
                                <td>4</td>
                                <td>100</td>
                                <td>8</td>
                                <td>6</td>
                            </tr>
                        </tbody>
                    </table>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script type="text/javascript">
        $('.alert-delete-player').click(function(event){
            var form =  $(this).closest("form");
            event.preventDefault();
            Swal.fire({
                title: 'DELETE PLAYER',
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
