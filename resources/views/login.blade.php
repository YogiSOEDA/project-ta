<!DOCTYPE html>
<html lang="en">

    <head>
        @include('template.head')
    </head>

    <body class="hold-transition login-page">
        <div class="login-box">
            {{-- <div class="login-logo">
            <a href="../../index2.html">
                <img src="{{ asset('img/logo.png') }}" alt="Alam Raya" class="brand-image" style="opacity: .8">
            </a>
            {{-- <b>Admin</b>LTE</a> --}}
            {{-- </div> --}}
            <!-- /.login-logo -->
            <div class="card">
                <div class="login-logo">
                    <a href="../../index2.html">
                        <img src="{{ asset('img/logo.png') }}" alt="Alam Raya" class="brand-image" style="opacity: .8">
                    </a>
                    {{-- <b>Admin</b>LTE</a> --}}
                </div>
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Sign in to start your session</p>

                    <form action="{{ route('postlogin') }}" method="post">
                        {{ csrf_field() }}
                        <div class="input-group mb-3">
                            <input type="username" class="form-control @error('username') is-invalid @enderror"
                                id="username" name="username" placeholder="Username" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="row">
                            {{-- <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div> --}}
                            <!-- /.col -->
                            <div class="col-12">
                                <div class="col-5 float-sm-right">
                                    {{-- <div class="float-sm-right"></div> --}}
                                    <button type="submit" class="btn btn-success btn-block">Sign In</button>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                    {{-- <div class="social-auth-links text-center mb-3">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                    </a>
                </div> --}}
                    <!-- /.social-auth-links -->

                    {{-- <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="/register" class="text-center">Register a new membership</a>
                </p> --}}
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->
        @include('sweetalert::alert')

        @include('template.script')
    </body>

</html>
