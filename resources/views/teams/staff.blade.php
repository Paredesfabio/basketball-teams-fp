@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center teams-board">

            <div class="row justify-content-center teams-board" style="background-color: var(--primary) !important;color:white;border-radius: 0px;">
                <div class="col-lg-12">
                    <a class="btn btn-outline-primary" style="margin-bottom: 10px;" href="{{route('team.details', $team->id)}}" role="button">Go back</a>
                    <span class="section-title">{{ $team->name }} Staff</span>
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

            <form action="{{ route('staff.store') }}" method="POST">
                @csrf

                <input name="team_id" type="hidden" value="{{ $team->id }}">

                <div class="row">

                    <div class="col-md-6">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror">
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12" style="padding-top: 10px;">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select @error('role') is-invalid @enderror" placeholder="Select Role">
                            <option value="2">Head Coach</option>
                            <option value="3">Assistant Coach</option>
                            <option value="4">Trainer</option>
                        </select>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12" style="padding-top: 15px;">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
@endsection
