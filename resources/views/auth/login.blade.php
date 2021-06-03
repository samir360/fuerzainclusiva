@extends('backend.layouts.master-login')
@section('content')
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-form-title" style="background-image: url({{ asset('asset/img/mh-lg.jpg') }});">
                    <span class="login100-form-title-1">
						<img src="{{ asset('asset/backend/img/logo.png') }}" style="margin-top: 10px;margin-bottom: 13px; width: 80%;"/>
					</span>
                    <span class="login100-form-title-1" style="font-size: 12px; color: #124A86">
						REGISTROS / PROCESOS /REPORTES / ESTADISTICAS
					</span>
                </div>
                <form id="iniciar_session" class="login100-form" action="" aria-label="{{ __('Login') }}">
                    @csrf

                    <div class="wrap-input100 validate-input m-b-26">
                        <span class="label-input100">Email</span>
                        <input class="input100 required email" autofocus type="text" id="email" name="email" placeholder="Introduzca su email" value="desarrollo@gmail.com">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-18">
                        <span class="label-input100">Contrase&ntilde;a</span>
                        <input class="input100 required" type="password" name="password" id="password" placeholder="Indroduzca su contrase&ntilde;a"
                               value="123456">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="flex-sb-m w-full p-b-30">
                        <div class="contact100-form-checkbox">
                            <label class="label-checkbox100" for="ckb1"></label>
                        </div>

                        <div>
                            <a href="{{url('/backend/password_recovery')}}" class="txt1">
                                ¿ Olvidaste tu contrase&ntilde;a ?
                            </a>
                        </div>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn Botones">
                            {{ __('INGRESAR AL SISTEMA') }}
                        </button>
                    </div>

                    <div class="container-login100-form-btn" style="margin-top: 10px; display: none" id="loading">
                        <img src='{{ asset('asset/backend/login/images/loadingfrm.gif') }}' style="margin-left: 46%"/>
                    </div>
                </form>
                <div style="text-align: center; font-size: 12px; color: #1b1b1b;">Fuerza exclusiva Copyright &copy; {{date('Y')}} Sistema de Gestion</div>
            </div>
        </div>
    </div>
@stop