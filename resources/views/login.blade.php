
@extends('layouts.app')
@section('content')

        <div class="maincard">
            <div class="login">
                <h1 class="maincard-title">Login</h1>

                <div class="maincard-form">
                    <form method="POST" action="{{ route('/postlogin') }}">
                    @csrf
                        <input type="email" placeholder="Email" name="email" id="">
                        <input type="password" placeholder="Password" name="password" id="">
                        <input type="submit" id="btn" value="Login">
                    </form>
                </div>
            </div>

            <div class="register">
                <h1 class="maincard-title">Register</h1>

                <div class="maincard-form">
                    <form method="POST" action="{{ route('/postsignup') }}">
                        @csrf
                        <input type="email" placeholder="Email" name="email" id="">
                        <input type="text" placeholder="Username" name="name" id="">
                        <input type="password" placeholder="Password" name="password" id="">
                        <div class="remember">
                            <input type="checkbox" name="remember" id="checkbox">
                            <label for="remember">Rules Accepted</label><br>
                        </div>
                        <input type="submit" id="btn" value="Register">
                    </form>
                </div>

            </div>
        </div>
@endsection