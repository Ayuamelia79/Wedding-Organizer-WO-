@extends('layouts.app')

@section('content')
<div class="container" style="max-width:480px;margin:3rem auto;">
    <h3 class="text-center">Login Pengantin</h3>

    @if ($errors->has('login'))
    <div class="alert alert-danger">{{ $errors->first('login') }}</div>
    @endif

    <form action="{{ route('login.pengantin') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button class="btn btn-primary w-100">Login</button>
    </form>
</div>
@endsection
