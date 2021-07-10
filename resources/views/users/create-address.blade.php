@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">{{isset($address) ? 'Update Address' : 'Add new address'}}</div>
        <div class="card-body">
            @include('partials.errors')
            <form action="{{ isset($address) ? route('addresses.update', $address->id) : route('addresses.store') }}" method="POST">
                @csrf
                @if(isset($address))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="name">Address</label>
                    <textarea class="form-control" name="address" id="address" cols="2" rows="2" style="resize: none;">{{isset($address) ? $address->address : ''}}</textarea>
                </div>

                <div class="form-group">
                    <label for="municipality">Municipality</label>
                    <select name="municipality" id="municipality" class="form-control">
                        <option value="Aerodrom" 
                        @if(isset($address))
                            @if($address->municipality == 'Aerodrom')
                                selected
                            @endif
                        @endif
                        >
                            Aerodrom
                        </option>
                        <option value="Centar"
                        @if(isset($address))
                            @if($address->municipality == 'Centar')
                                selected
                            @endif
                        @endif
                        >
                            Centar
                        </option>
                        <option value="KiselaVoda"
                        @if(isset($address))
                            @if($address->municipality == 'KiselaVoda')
                                selected
                            @endif
                        @endif
                        >
                            Kisela Voda
                        </option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">{{isset($address) ? 'Update Address' : 'Create address' }}</button>
                <a href="{{ route('users.index') }}" class="btn btn-primary text-white">Cancel</a>



            </form>
        </div>
</div>

@endsection
