@extends('frontend.layouts.master-register-login')
@section('content')

    <style>
        @media only screen and (max-width: 1000px) {
            .img-fluid {
                display: none !important;
            }
        }
    </style>

    <!-- Hero Start -->
    <section class="vh-100" style="background: url('{{ asset('asset/frontend/images/fondo-generico.jpg')}}') center center;">
        <div class="home-center">
            <div class="home-desc-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-6">
                            <div class="login-page bg-white shadow rounded p-4">
                                <div class="text-center">
                                    <h4 class="mb-4">Iniciar Sesión</h4>
                                </div>
                                <form class="login-form" id="frm-login">
                                    <div class="row">

                                        <div style="width: 100%; position: relative;">
                                            <img src="{{asset('asset/frontend/images/login.jpg')}}" class="img-fluid mx-auto d-block"  alt="fuerzainclusiva.com"
                                            style="  width: 100%; max-width: 170px; height: auto; position: absolute; left: 350px;">
                                        </div>

                                        <div class="col-lg-8">
                                            <div class="form-group position-relative">
                                                <label>Correo electrónico <span class="text-danger">*</span></label>
                                                <input type="email" class="form-control required email" placeholder="Email" name="email" id="email">
                                            </div>
                                        </div>

                                        <div class="col-lg-8">
                                            <div class="form-group position-relative">
                                                <label>Contraseña <span class="text-danger">*</span></label>
                                                <input type="password" class="form-control required" placeholder="Password" name="password" id="password">
                                            </div>
                                        </div>

                                        <div class="col-lg-8">
                                            <p class="float-right forgot-pass">
                                                <a href="{{route('password.request')}}" class="text-dark font-weight-bold">
                                                    Olvidaste tu contraseña?
                                                </a>
                                            </p>
                                        </div>

                                        <div class="col-md-8 text-center" id="loading-login" style="display: none">
                                            <img src="{{ asset('asset/backend/img/loadingfrm.gif')}}">
                                        </div>

                                        <div class="col-lg-8 mb-0">
                                            <button class="btn btn-primary w-100 frm-login" type="submit">Iniciar Sesión</button>
                                        </div>

                                        <div class="col-8 text-center">
                                            <p class="mb-0 mt-3"><small class="text-dark mr-2">No estás registrado ?</small>
                                                <a href="{{route('register')}}" class="text-dark font-weight-bold">
                                                    Registrarme
                                                </a>
                                            </p>
                                        </div>
                                    </div>

                                </form>
                            </div><!---->
                        </div> <!--end col-->
                    </div><!--end row-->
                </div> <!--end container-->
            </div>
        </div>
    </section><!--end section-->
    <!-- Hero End -->
@stop