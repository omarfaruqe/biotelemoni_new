
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

            <ul class="tab-group">
                <li class="tab active"><a href="#signup">Sign Up</a></li>
                <li class="tab"><a href="#login">Log In</a></li>
            </ul>

            <div class="tab-content">
                <div id="signup">   
                    <h1>Sign Up for Free</h1>

                    <form action="/" method="post">
                        <form class="form-signin" role="form" method="POST" action="/auth/login">
                        <div class="top-row">
                            <div class="field-wrap">
                                <label>
                                    First Name<span class="req">*</span>
                                </label>
                                <input type="text" required autocomplete="off" />
                            </div>

                            <div class="field-wrap">
                                <label>
                                    Last Name<span class="req">*</span>
                                </label>
                                <input type="text"required autocomplete="off"/>
                            </div>
                        </div>

                        <div class="field-wrap">
                            <label>
                                Email Address<span class="req">*</span>
                            </label>
                            <input type="email"required autocomplete="off"/>
                        </div>

                        <div class="field-wrap">
                            <label>
                                Set A Password<span class="req">*</span>
                            </label>
                            <input type="password"required autocomplete="off"/>
                        </div>

                        <button type="submit" class="button button-block"/>Get Started</button>

                    </form>

                </div>

                <div id="login">   
                    <h1>Sign in to Pyramid Payments</h1>

                    <form role="form" method="POST" action="/auth/login">
                         <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="field-wrap">
                            <label>
                                Email Address<span class="req">*</span>
                            </label>
                            <input value="{{ old('email') }}" type="email"required autocomplete="off"/>
                        </div>

                        <div class="field-wrap">
                            <label>
                                Password<span class="req">*</span>
                            </label>
                            <input type="password"required autocomplete="off"/>
                        </div>
                        <label class="checkbox pull-left">
                            <input type="checkbox" name="remember" value="remember-me">
                            Remember me
                        </label>
                        <p class="forgot"><a href="#">Forgot Password?</a></p>
                        <button type="submit" class="button button-block"/>Log In</button>
                    </form>

                </div>

            </div><!-- tab-content -->

        </div> <!-- /form -->
    </div>
</div>
@endsection
