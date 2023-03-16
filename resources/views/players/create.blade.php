@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center teams-board">

            <div class="row justify-content-center teams-board" style="background-color: var(--primary) !important;color:white;border-radius: 0px;">
                <div class="col-lg-12">
                    <a class="btn btn-outline-primary" style="margin-bottom: 10px;" href="{{route('team.details', $team->id)}}" role="button">Go back</a>
                    <span class="section-title">Add new player to {{ $team->name }}</span>
                </div>
            </div>

            <hr>

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

            <form action="{{ route('player.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input name="team_id" type="hidden" value="{{ $team->id }}">
                <input name="role" type="hidden" value="1">

                <div class="row">
                    <div class="profile-top mb-4">
                        <div class="d-flex align-items-center">
                            <div class="profile-image radius-50">
                                <img id="target1" src="{{getImageFile('img/player_default.png')}}">
                                <div class="custom-fileuplode">
                                    <label for="fileuplode" class="file-uplode-btn bg-hover text-white radius-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--bx" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24" data-icon="bx:bx-edit"><path fill="currentColor" d="m7 17.013l4.413-.015l9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583v4.43zM18.045 4.458l1.589 1.583l-1.597 1.582l-1.586-1.585l1.594-1.58zM9 13.417l6.03-5.973l1.586 1.586l-6.029 5.971L9 15.006v-1.589z"></path><path fill="currentColor" d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01c-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2z"></path></svg>
                                    </label>
                                    <input type="file" id="fileuplode" name="image" accept="image/*" onchange="previewFile(this)">
                                </div>
                            </div>
                            <div>
                                <p class="font-medium font-15 color-heading">Select Picture</p>
                                <p class="font-14">Accepted Image Files: JPEG, JPG, PNG</p>
                            </div>
                        </div>
                        @if ($errors->has('image'))
                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('image') }}</span>
                        @endif
                    </div>
                </div>

                <div class="row" style="padding-top: 10px;">
                    <div class="col-md-12" style="padding-top: 15px;">
                        <h3>Player Info</h3>
                    </div>
                </div>

                <div class="row create-player-form">

                    <div class="col-md-6 section-player">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}"
                            class="form-control @error('first_name') is-invalid @enderror">
                    </div>

                    <div class="col-md-6 section-player">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}"
                        class="form-control @error('last_name') is-invalid @enderror">
                    </div>

                    <div class="col-md-6 section-player">
                        <label class="form-label">Country</label>
                        <select name="country_id" class="form-select @error('country_id') is-invalid @enderror" placeholder="Select Country">
                            @foreach ($countries as $country)
                                <option {{ old('country_id') == $country->id ? "selected" : "" }} value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 section-player">
                        <label class="form-label">School</label>
                        <input type="text" name="school" value="{{ old('school') }}"
                            class="form-control @error('school') is-invalid @enderror">
                    </div>

                    <div class="col-md-6 section-player">
                        <label class="form-label">Number</label>
                        <input type="number" name="number" value="{{ old('number') }}"
                            min="0" oninput="this.value=(this.value < 0) ? 0 : this.value;"
                            class="form-control @error('number') is-invalid @enderror">
                    </div>

                    <div class="col-md-6 section-player">
                        <label class="form-label">Position</label>
                        <select name="position" class="form-select @error('position') is-invalid @enderror" placeholder="Select Role">
                            <option {{ old('position') == 'G' ? "selected" : "" }} value="G">Guard</option>
                            <option {{ old('position') == 'F' ? "selected" : "" }} value="F">Forward</option>
                            <option {{ old('position') == 'F-G' ? "selected" : "" }} value="F-G">Forward-Guard</option>
                            <option {{ old('position') == 'C-F' ? "selected" : "" }} value="C-F">Center-Forward</option>
                            <option {{ old('position') == 'C' ? "selected" : "" }} value="C">Center</option>
                        </select>
                    </div>

                    <div class="col-md-6 section-player">
                        <label class="form-label">Birthdate</label>
                        <input type="date" name="birth_date" value="{{ old('birth_date') }}" class="form-control @error('birth_date') is-invalid @enderror">
                    </div>

                    <div class="col-md-6 section-player">
                        <label class="form-label">Draft date</label>
                        <input type="date" name="draft_date" value="{{ old('draft_date') }}" class="form-control @error('draft_date') is-invalid @enderror">
                    </div>

                    <div class="col-md-6 section-player">
                        <label class="form-label">Height</label>
                        <input type="text" name="height" value="{{ old('height') }}" class="form-control @error('height') is-invalid @enderror">
                    </div>

                    <div class="col-md-6 section-player">
                        <label class="form-label">Weight</label>
                        <input type="number" name="weight" value="{{ old('weight') }}" class="form-control @error('weight') is-invalid @enderror"
                            min="0" oninput="this.value=(this.value < 0) ? 0 : this.value;">
                    </div>

                    <div class="col-md-12 section-player">
                        <label class="form-label">About me</label>
                        <textarea name="about_me" class="form-control @error('about_me') is-invalid @enderror" rows="3" placeholder="About me">{{ old('about_me') }}</textarea>
                    </div>

                </div>

                <div class="row" style="padding-top: 10px;">
                    <div class="col-md-12" style="padding-top: 15px;">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
@endsection
