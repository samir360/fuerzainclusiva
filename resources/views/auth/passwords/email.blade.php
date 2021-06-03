@extends('frontend.layouts.master-register-login')
@section('content')

    <!-- Hero Start -->
    <section class="vh-100" style="background: url('{{ asset('asset/frontend/images/clients/register.jpg')}}') center center;">
        <div class="home-center">
            <div class="home-desc-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6">
                            <div class="login-page bg-white shadow rounded p-4">
                                <div class="text-center">
                                    <h4 class="mb-4">Recuperar contraseña</h4>
                                </div>

                                <form method="POST" action="{{ route('password.email') }}" id="frm-email-password">
                                    @csrf

                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group position-relative">
                                                <label>Correo electrónico <span class="text-danger">*</span></label>
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror

                                            </div>
                                        </div>

                                        <div class="col-md-12 text-center" id="loading-login" style="display: none">
                                            <img src="{{ asset('asset/backend/img/loadingfrm.gif')}}">
                                        </div>

                                        <div class="col-lg-12 mb-0">
                                            <button class="btn btn-primary w-100 frm-email-password" type="button">Enviar</button>
                                        </div>

                                        <div class="col-12 text-center">
                                            <p class="mb-0 mt-3"><small class="text-dark mr-2">Estás registrado ?</small>
                                                <a href="{{route('login-user')}}" class="text-dark font-weight-bold">
                                                    Iniciar Sesión
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

    <script type="application/javascript">
        $(".frm-email-password").click(function() {
            $('#loading-login').show();
            $("#frm-email-password").submit();
        });
    </script>

@stop
