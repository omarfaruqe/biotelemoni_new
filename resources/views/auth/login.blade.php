
@extends('templates.auth')

@section('content')
    <div class="bg-img">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4" style="margin-top: 100px;">
                <h1 class="text-center login-title">Sign in to Biotelemoni</h1>
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
                <div class="account-wall">
                    <img class="profile-img" src="/images/photo.jpg" alt="">
                    <form class="form-signin" role="form" method="POST" action="/auth/login">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="text" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required autofocus>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">
                            Sign in</button>
                        <label class="checkbox pull-left">
                            <input type="checkbox" name="remember" value="remember-me">
                            Remember me
                        </label>
                        <a class="pull-right need-help" href="/password/email">Forgot Your Password?</a><span class="clearfix"></span>
                    </form>
                </div>


            </div>


        </div>
    </div>
    </div>
@endsection
