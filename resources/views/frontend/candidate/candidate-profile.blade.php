@extends('frontend.layouts.master')
@section('content')

    <style>
        #s2id_country_id {
            width: 100% !important;
        }

        #s2id_industry_id {
            width: 100% !important;
        }
    </style>

    <section class="bg-half page-next-level">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center text-white">
                        <h4 class="text-uppercase title mb-4">Perfil</h4>
                        <ul class="page-next d-inline-block mb-0">
                            <li>
                                <a href="{{route('jobs')}}" class="text-uppercase font-weight-bold">Inicio</a>
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

            <form id="frm-user-profile">
                <div class="row">
                    <div class="col-lg-12 mt-4 pt-2">
                        <div class="component-wrapper rounded shadow">
                            <div class="p-4 border-bottom bg-light">
                                <h4 class="title mb-0"> Información General </h4>
                            </div>

                            <div class="p-4">
                                <div class="row">

                                    @if(isset($profile) and $profile->photo)
                                        <div id="placeholder" style="text-align: center; width: 100%;">
                                            <img src="{{ asset('storage/photo_users/' .$profile->photo)}}" alt="{{$profile->company_slug}}"
                                                 class="img-fluid mx-auto d-block" style="border-radius: 90px; width: 150px;">
                                        </div>

                                    @else
                                        <div id="placeholder" style="text-align: center; width: 100%;">
                                            <img src="{{ asset('asset/frontend/images/user-avatar.png')}}" alt="avatar"
                                                 class="img-fluid mx-auto d-block" style="border-radius: 90px; width: 150px;">
                                        </div>
                                    @endif


                                    <div id="uploadForm"></div>

                                    <div class="col-md-12" style="padding-bottom: 20px; padding-top: 20px; text-align: center">
                                        <label for="imageUpload" class="btn btn-light btn-block btn-outlined"
                                               onclick="document.getElementById('photo').click()">Seleccionar foto (jpg, jpeg)</label>
                                        <input type="file" id="photo" name="photo" accept="image/jpg, image/jpeg" style="display: none">
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group position-relative">
                                            <label>Nombres <span class="text-danger">*</span></label>
                                            <input name="first_name" id="first_name" type="text" class="form-control required"
                                                   placeholder="Nombre Completo :" autocomplete="off" onkeypress="return soloLetras(event)"
                                                   value="{{isset($user) ? $user->firstname: ''}}">
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group position-relative">
                                            <label>Apellidos <span class="text-danger">*</span></label>
                                            <input name="last_name" id="last_name" type="text" class="form-control required"
                                                   placeholder="Apellido Completo :" autocomplete="off"
                                                   value="{{isset($user) ? $user->lastname: ''}}">
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


                                    <div class="col-md-4 edit_password">
                                        <div class="form-group position-relative">
                                            <label>Correo electrónico <span class="text-danger">*</span></label>
                                            <input name="email" id="email" type="text" class="form-control required"
                                                   placeholder="Correo electrónico :" autocomplete="off"
                                                   value="{{isset($user) ? $user->email: ''}}">
                                        </div>
                                    </div>

                                    <div class="col-md-4 edit_password">
                                        <div class="form-group position-relative">
                                            <label>Teléfono <span class="text-danger">*</span></label>
                                            <input name="phone" id="phone" type="number" class="form-control required" pattern="[0-9]{10}"
                                                   placeholder="Teléfono :" maxlength="20" autocomplete="off"
                                                   value="{{isset($profile) ? $profile->phone: ''}}">
                                        </div>
                                    </div>


                                    <div class="col-md-4 edit_password">
                                        <div class="form-group position-relative">
                                            <label>Género <span class="text-danger">*</span></label>
                                            <select name="gender" id="gender" class="form-control required tdtextarea">
                                                <option value="">Seleccione...</option>
                                                <option value="{{\App\Models\UserProfile::GENDER_M}}"
                                                        {{(isset($profile) and $profile->gender==\App\Models\UserProfile::GENDER_M) ? 'selected' : ''}}>
                                                    {{\App\Models\UserProfile::GENDER_M}}
                                                </option>

                                                <option value="{{\App\Models\UserProfile::GENDER_F}}"
                                                        {{(isset($profile) and $profile->gender==\App\Models\UserProfile::GENDER_F) ? 'selected' : ''}}>
                                                    {{\App\Models\UserProfile::GENDER_F}}
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 new_password" style="display: none;">
                                        <div class="form-group position-relative">
                                            <label>Nueva contraseña <span class="text-danger">*</span></label>
                                            <input name="new_password" id="new_password" type="password" class="form-control required"
                                                   placeholder="Nueva contraseña :" autocomplete="off">
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group position-relative">
                                            <label>Fecha de nacimiento <span class="text-danger">*</span></label>
                                            <input name="birthday" id="birthday" type="text" class="form-control required fecha" readonly="readonly"
                                                   placeholder="Fecha de nacimiento :" autocomplete="off"
                                                   value="{{isset($profile) ? $profile->birthday: ''}}">
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group position-relative">
                                            <label>Provincia <span class="text-danger">*</span></label>
                                            <div class="form-button">

                                                <select id="country_id" name="country_id" class="required tdtextarea select-multiple">
                                                    <option value="">Provincias</option>
                                                    @foreach($countries AS $country)
                                                        <option value="{{$country['id']}}"
                                                                {{((isset($profile) and $profile->country_id==$country['id']) ? 'selected' : '')}}>
                                                            {{ucfirst(mb_strtolower($country['name']))}}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group position-relative">
                                            <label>Educación <span class="text-danger">*</span></label>
                                            <select name="education_id" id="education_id" class="form-control required tdtextarea">
                                                <option value="">Seleccione...</option>
                                                @foreach($education AS $items)
                                                    <option value="{{$items['id']}}"
                                                            {{(isset($profile) and $profile->education_id==$items['id']) ? 'selected' : ''}}>
                                                        {{$items['education_name']}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div><!--end col-->


                                    <div class="col-md-12">
                                        <div class="form-group position-relative">
                                            <label>Dirección <span class="text-danger">*</span></label>
                                            <input name="address" id="address" type="text" class="form-control required"
                                                   placeholder="Dirección completa :" autocomplete="off"
                                                   value="{{isset($profile) ? $profile->address: ''}}">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group position-relative">
                                            <label>Cuéntanos un poco sobre tí <span class="text-danger">*</span></label>
                                            <textarea id="personal_description" name="personal_description"
                                                      class="form-control required">{{$profile->personal_description}}</textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-12">
                        <h5 class="text-dark mt-5">Grado de instrucción :</h5>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="custom-form p-4 border rounded">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group app-label">
                                        <label>Institución <span class="text-danger">*</span></label>
                                        <input id="institution_name" name="institution_name" type="text"
                                               class="form-control resume input-institution" placeholder="">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label>Titulo obtenido <span class="text-danger">*</span></label>
                                        <input id="obtained_title" name="obtained_title" type="text"
                                               class="form-control resume input-institution" placeholder="">
                                    </div>
                                </div>

                                <div class="col-md-2 text-right">
                                    <div class="form-group app-label">
                                        <a href="javascript:void(0)" class="btn btn-secondary-outline mb-3 mr-2 btn-intitution" style="margin-top: 28px">
                                            <i class="fa fa-plus-circle"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-md-12 text-center" id="loading-institution" style="display: none">
                                    <img src="{{ asset('asset/backend/img/loadingfrm.gif')}}">
                                </div>

                                <div class="col-md-12 text-center" id="error-frm-institution" style="display: none; color: #ec5051;">
                                    <p>
                                        <i class="fa fa-exclamation-circle"></i> Verifique los campos del formulario
                                    </p>
                                </div>

                                <div class="row form-group col-md-12" id="institution-list"></div>

                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-12">
                        <h5 class="text-dark mt-5">Experiencia laboral :</h5>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="custom-form p-4 border rounded">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label>Empresa <span class="text-danger">*</span></label>
                                        <input id="company_name" name="company_name" type="text" class="form-control resume input-experience" placeholder="">
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label>Cargo <span class="text-danger">*</span></label>
                                        <input id="company_functions" name="company_functions" type="text"
                                               class="form-control resume input-experience" onkeypress="return soloLetras(event)" placeholder="">
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label>Industria <span class="text-danger">*</span></label>
                                        <select id="industry_id" name="industry_id" class="select-multiple input-experience">
                                            <option value="">Seleccione...</option>
                                            @foreach($industries AS $industry)
                                                <option value="{{$industry['id']}}">
                                                    {{ucfirst(mb_strtolower($industry['industry_name']))}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label>Años <span class="text-danger">*</span></label>
                                        <input id="number_of_years" name="number_of_years" type="number"
                                               class="form-control resume input-experience" pattern="[0-9]{10}" maxlength="2" placeholder="">
                                    </div>
                                </div>


                                <div class="col-md-12 text-right">
                                    <div class="form-group app-label">
                                        <a href="javascript:void(0)" class="btn btn-secondary-outline mb-3 mr-2 btn-experience">
                                            <i class="fa fa-plus-circle"></i></a>
                                    </div>
                                </div>


                                <div class="col-md-12 text-center" id="loading-experience" style="display: none">
                                    <img src="{{ asset('asset/backend/img/loadingfrm.gif')}}">
                                </div>

                                <div class="col-md-12 text-center" id="error-frm-experience" style="display: none; color: #ec5051;">
                                    <p>
                                        <i class="fa fa-exclamation-circle"></i> Verifique los campos del formulario
                                    </p>
                                </div>

                                <div class="row form-group col-md-12" id="experience-list"></div>

                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-12">
                        <h5 class="text-dark mt-5">Referencias personales:</h5>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="custom-form p-4 border rounded">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label>Nombre completo <span class="text-danger">*</span></label>
                                        <input id="full_name" name="full_name" type="text" class="form-control resume input-reference"
                                               onkeypress="return soloLetras(event)" placeholder="">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label>Teléfono</label>
                                        <input id="reference_phone" name="reference_phone" type="number" class="form-control resume input-reference"
                                               pattern="[0-9]{10}" maxlength="20" placeholder="">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label>Cargo</label>
                                        <input id="charge" name="charge" type="text" class="form-control resume input-reference" placeholder="">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label>Correo electrónico</label>
                                        <input id="reference_email" name="reference_email" type="text" class="form-control resume input-reference"
                                               placeholder="">
                                    </div>
                                </div>

                                <div class="col-md-12 text-right">
                                    <div class="form-group app-label">
                                        <a href="javascript:void(0)" class="btn btn-secondary-outline mb-3 mr-2 btn-reference">
                                            <i class="fa fa-plus-circle"></i>
                                        </a>
                                    </div>
                                </div>


                                <div class="col-md-12 text-center" id="loading-reference" style="display: none">
                                    <img src="{{ asset('asset/backend/img/loadingfrm.gif')}}">
                                </div>

                                <div class="col-md-12 text-center" id="error-frm-reference" style="display: none; color: #ec5051;">
                                    <p>
                                        <i class="fa fa-exclamation-circle"></i> Verifique los campos del formulario
                                    </p>
                                </div>

                                <div class="row form-group col-md-12" id="reference-list"></div>

                            </div>

                        </div>
                    </div>
                </div>


                <div class="row form-group">
                    <div class="col-md-12 text-center" id="loading" style="display: none">
                        <img src="{{ asset('asset/backend/img/loadingfrm.gif')}}">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-sm-12 text-center">

                        <p style="display: none; color: #ec5051;" id="error-frm">
                            <i class="fa fa-exclamation-circle"></i> Verifique los campos del formulario
                        </p>

                        @if(!isset($profile))
                            <input type="hidden" id="route" name="route" value="store">
                            <input type="submit" id="submit" name="send" class="btn btn-primary btn-frm submit" value="Registrar Perfil">
                        @else
                            <input type="hidden" id="route" name="route" value="update">
                            <input type="submit" id="submit" name="send" class="btn btn-primary btn-frm submit" value="Modificar Perfil">
                        @endif
                    </div><!--end col-->
                </div><!--end row-->

            </form>

        </div>
    </section>

@section('script')
    @include('frontend.functions.candidate-profile')
@endsection
@stop