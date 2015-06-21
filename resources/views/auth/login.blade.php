@extends('templates.auth')
@section('content')
    <div class="container">
        <div class="row">

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form">

                <h1>Sign in to Pyramid Payments</h1>

                <form role="form" method="POST" action="/auth/login">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="field-wrap">
                        <label>
                            Email Address<span class="req">*</span>
                        </label>
                        <input name="email" value="{{ old('email') }}" type="email" required autocomplete="off"/>
                    </div>

                    <div class="field-wrap">
                        <label>
                            Password<span class="req">*</span>
                        </label>
                        <input name="password" type="password" required autocomplete="off"/>
                    </div>

                    <div>
                        <label class="checkbox pull-left">
                            <input type="checkbox" name="remember" value="remember-me">
                            Remember me
                        </label>

                        <p class="forgot pull-right"><a href="#">Forgot Password?</a></p>
                    </div>



                    <button type="submit" class="button button-block"/>
                    Log In</button>

                </form>

            </div>


        </div>
        <!-- /form -->
    </div>
    </div>
@endsection
