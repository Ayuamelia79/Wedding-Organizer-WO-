@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Dashboard Pengantin</h2>
    <p>Selamat datang, {{ Auth::user()->name }}</p>

    <form method="POST" action="/logout-pengantin">
        @csrf
        <button class="btn btn-danger">Logout</button>
    </form>
</div>
@endsection
