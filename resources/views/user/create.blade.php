@extends('template')
@section('pageContent')
    @include('navigation')

    <form method="post" action="/user/create">
        {{ csrf_field() }}
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" ><br>
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email" ><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" ><br>
        <label for="passwordConfirmation">Password confirmation:</label><br>
        <input type="password" id="passwordConfirmation" name="password_confirmation" ><br><br>

        <button type="submit">Save</button>
    </form>
@endsection
