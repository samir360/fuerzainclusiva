@extends('frontend.layouts.master-register-login')
@section('content')

    <!-- Hero Start -->
    <section class="vh-100" style="background: url('{{ asset('asset/frontend/images/fondo-generico.jpg')}}') center center;">
        <div class="home-center">
            <div class="home-desc-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="login_page bg-white shadow rounded p-4">
                                <div class="text-center">
                                    <h4 class="mb-4">Crear Cuenta</h4>
                                </div>
                                <form class="login-form" id="frm-register">
                                    <input type="hidden" name="user_status" id="user_status" value="ACTIVO">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group position-relative">
                                                <label>Nombres <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control required" placeholder="Ingresa tus nombres" name="firstname" id="firstname">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group position-relative">
                                                <label>Apellidos <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control required" placeholder="Ingresa tus apellidos" name="lastname" id="lastname">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group position-relative">
                                                <label>Correo electrónico <span class="text-danger">*</span></label>
                                                <input type="email" class="form-control required email" placeholder="Ingresa correo electrónico" name="email" id="email">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group position-relative">
                                                <label>Contraseña <span class="text-danger">*</span></label>
                                                <input type="password" class="form-control required" placeholder="Password" name="password" id="password">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group position-relative">
                                                <label>¿ Que quiere ser ? <span class="text-danger">*</span></label>
                                                <select name="rol_id" id="rol_id" class="form-control required tdtextarea">
                                                    <option value="">Seleccione...</option>
                                                    <option value="3">Empleador </option>
                                                    <option value="4">Candidato </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12 text-center" id="loading-register" style="display: none">
                                           <img src="{{ asset('asset/backend/img/loadingfrm.gif')}}">
                                        </div>

                                        <div class="col-md-12">
                                            <button class="btn btn-primary w-100 btn-frm" type="submit">Registrarme</button>
                                        </div>

                                        <div class="col-12 text-center">
                                            <p class="mb-0 mt-3"><small class="text-dark mr-2">Ya te encuentras registrado ?</small>
                                                <a href="{{route('login-user')}}" class="text-dark font-weight-bold">
                                                    Iniciar Sesión
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div> <!--end col-->
                    </div><!--end row-->
                </div> <!--end container-->
            </div>
        </div>
    </section><!--end section-->
    <!-- Hero End -->
@stop