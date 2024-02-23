@extends('layout.auth')
@section('title', 'App Login')
@section('content')
    <section class="section register d-flex flex-column align-items-center justify-content-center py-4"
        style="max-width: 100%;
    overflow-x: hidden;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                    <div class="card mb-3 mt-4">
                        <div class="card-body">

                            <div class="pt-4 pb-2 flex-column">
                                <div class="d-flex justify-content-center py-4">
                                    <a href="#" class="logo d-flex align-items-center w-auto">
                                        <img src="assets/img/logo.png" alt="">
                                        <span class="d-none d-lg-block">ReportExport</span>
                                    </a>
                                </div><!-- End Logo -->
                            </div>

                            <form class="row g-3 needs-validation" method="post" action="{{ route('login') }}">
                                @csrf
                                <div class="col-12">
                                    <label for="yourUsername" class="form-label">Username</label>
                                    <div class="input-group has-validation">

                                        <input type="text" name="email" class="form-control" id="yourUsername"
                                            required="">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        <div class="invalid-feedback">Please enter your username.</div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="yourPassword" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="yourPassword"
                                        required="">
                                    <div class="invalid-feedback">Please enter your password!</div>
                                </div>

                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" value="true"
                                            id="rememberMe">
                                        <label class="form-check-label" for="rememberMe">Remember me</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit">Login</button>
                                </div>

                            </form>

                        </div>
                    </div>


                </div>
            </div>
        </div>

    </section>
@endsection
