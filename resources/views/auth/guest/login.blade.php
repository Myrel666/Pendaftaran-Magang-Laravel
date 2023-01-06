@extends('layouts.auth')

@section('content')
<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="../../index2.html" class="h1"><b>{{ env('APP_NAME') }}</b></a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="{{ route('auth') }}" method="post">
          @csrf
          @if (Session::has('message'))
          <div class="alert alert-danger" role="alert">
            {{ Session::get('message') }}
          </div>
          @endif
          @if (Session::has('reset_password'))
          <div class="alert alert-success" role="alert">
            {{ Session::get('reset_password') }}
          </div>
          @endif
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" name="email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="icheck-primary">
                <input type="checkbox" id="remember" name="remember" value="1">
                <label for="remember">
                  Remember Me
                </label>

              </div>
            </div>
            <!-- /.col -->
            <div class="col-6">
              <p class="mt-1 text-end">
                <a href="{{ route('forget.password.get') }}">I forgot my password</a>
              </p>
            </div>
            <!-- /.col -->
            <div class="col-12 mt-1">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <!-- <div class="social-auth-links text-center mt-2 mb-3">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> -->
        <!-- /.social-auth-links -->

      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->
@endsection