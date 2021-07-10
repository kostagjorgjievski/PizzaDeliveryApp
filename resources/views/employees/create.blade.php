@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            {{ isset($employee) ? 'Edit employee' : 'Add new employee'}}
        </div>
        <div class="card-body">

            @include('partials.errors')

            <form action="{{ isset($employee) ? route('employees.update', $employee->id) : route('employees.store') }}" method="POST">
                @csrf

                @if(isset($employee))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ isset($employee) ? $employee->name : '' }}" autocomplete="name" autofocus>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" type="email" id="email" name="email" value="{{ isset($employee) ? $employee->email : '' }}" autocomplete="email">
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" class="form-control"  id="phone" name="phone" value="{{ isset($employee) ? $employee->phone : '' }}" autocomplete="phone" autofocus>
                </div>
                
                @if(!isset($employee))
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control"  id="password" name="password" value="">
                    </div>

                    <div class="form-group">
                        <label for="password-confirm">Confirm Password</label>
                        <input type="password" class="form-control"  id="cpassword" name="cpassword" value="">
                    </div>
                @endif

                <div class="form-group">
                    <button class="btn btn-success">
                        {{ isset($employee) ? 'Update Info' : 'Create New Employee' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection