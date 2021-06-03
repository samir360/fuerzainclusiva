@extends('frontend.layouts.master')
@section('content')

    <section class="bg-half page-next-level">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center text-white">
                        <h4 class="text-uppercase title mb-4">Perfil</h4>
                        <ul class="page-next d-inline-block mb-0">
                            <li>
                                <a href="{{route('candidate')}}" class="text-uppercase font-weight-bold">Inicio</a>
                            </li>
                            <li>
                                <span class="text-uppercase text-white font-weight-bold">Páginas</span>
                            </li>
                            <li>
                                <span class="text-uppercase text-white font-weight-bold">Perfil</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mt-4 pt-2">
                    <div class="component-wrapper rounded shadow">
                        <div class="p-4 border-bottom bg-light">
                            <h4 class="title mb-0"> Modificar Perfil </h4>
                        </div>

                        <div class="p-4">
                            <form id="frm-employer-profile">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group position-relative">
                                            <label>Nombres <span class="text-danger">*</span></label>
                                            <input name="firstname" id="firstname" type="text" class="form-control required"
                                                   placeholder="Nombres :" autocomplete="off"
                                                   value="{{isset($user) ? $user->firstname: ''}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group position-relative">
                                            <label>Apellidos <span class="text-danger">*</span></label>
                                            <input name="lastname" id="lastname" type="text" class="form-control required"
                                                   placeholder="Apellidos :" autocomplete="off"
                                                   value="{{isset($user) ? $user->lastname: ''}}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group position-relative">
                                            <label>Correo electrónico <span class="text-danger">*</span></label>
                                            <input name="email" id="email" type="text" class="form-control required"
                                                   placeholder="Correo electrónico :" autocomplete="off"
                                                   value="{{isset($user) ? $user->email: ''}}">
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group position-relative">
                                            <label>Cambiar Contraseña ? <span class="text-danger">*</span></label>
                                            <select name="change_password" id="change_password" class="form-control required tdtextarea">
                                                <option value="NO">NO</option>
                                                <option value="SI">SI</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 new_password" style="display: none;">
                                        <div class="form-group position-relative">
                                            <label>Nueva contraseña <span class="text-danger">*</span></label>
                                            <input name="new_password" id="new_password" type="password" class="form-control required"
                                                   placeholder="Nueva contraseña :" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="col-md-12 text-center" id="loading" style="display: none">
                                        <img src="{{ asset('asset/backend/img/loadingfrm.gif')}}">
                                    </div>

                                </div><!--end row-->
                                <div class="row">
                                    <div class="col-sm-12 text-center">
                                        <input type="hidden" id="route" name="route" value="update">
                                        <input type="submit" id="submit" name="send" class="btn btn-primary btn-frm" value="Modificar Perfil">
                                    </div><!--end col-->
                                </div><!--end row-->
                            </form><!--end form-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@section('script')
    @include('frontend.functions.employer-profile')
@endsection
@stop