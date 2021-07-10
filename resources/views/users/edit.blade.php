@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">Editing Profile</div>
        <div class="card-body">
            @include('partials.errors')
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
                </div>

                <div class="form-group">
                    <label for="name">Email</label>
                    <input type="text" class="form-control" name="email" id="email" value="{{ $user->email }}">
                </div>

                <div class="form-group">
                    <label for="name">Phone</label>
                    <input type="text" class="form-control" name="phone" id="phone" value="{{ $user->phone }}">
                </div>

                <button type="submit" class="btn btn-success">Update Profile</button>
                <a href="{{ route('users.index') }}" class="btn btn-primary text-white">Cancel</a>



            </form>
        </div>
</div>

@endsection
