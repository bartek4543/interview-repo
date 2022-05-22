@extends('template')
@section('pageContent')
    @include('navigation')

    <form method="post" action="/user/{{ $user->id }}/update">
        {{ csrf_field() }}
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="{{ $user->name }}"><br>
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email" value="{{ $user->email }}"><br><br>
        <button type="submit">Update</button>
    </form>
@endsection
