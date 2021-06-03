@extends('frontend.layouts.master')
@section('content')

    <section class="bg-half page-next-level">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center text-white">
                        <h4 class="text-uppercase title mb-4">{{isset($postAJob) ? 'Modificar' : 'Crear un'}} trabajo nuevo </h4>
                        <ul class="page-next d-inline-block mb-0">
                            <li>
                                <a href="{{route('candidate')}}" class="text-uppercase font-weight-bold">Inicio</a>
                            </li>
                            <li>
                                <span class="text-uppercase text-white font-weight-bold">Publicar un trabajo</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="rounded shadow bg-white p-4">
                        <div class="custom-form">
                            <div id="message3"></div>
                            <form method="post" name="frm-job" id="frm-job">
                                <h4 class="text-dark mb-3">{{isset($postAJob) ? 'Modificar' : 'Publicar un nuevo'}} trabajo: </h4>
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group app-label mt-2">
                                            <label class="text-muted">Título del trabajo <span class="text-danger">*</span></label>
                                            <input id="job_title" name="job_title" type="text" class="form-control required" placeholder=""
                                                   autocomplete="off" value="{{isset($postAJob) ? $postAJob->job_title : ''}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group app-label mt-2">
                                            <label class="text-muted">Tipo de trabajo <span class="text-danger">*</span></label>
                                            <div class="form-button">
                                                <select id="job_time" name="job_time" class="form-control required tdtextarea">
                                                    <option data-display="El tipo de trabajo" value="">El tipo de trabajo</option>
                                                    <option value="{{\App\Models\PublishedJobs::JOB_TIME_COMPLETO}}"
                                                            {{((isset($postAJob) and $postAJob->job_time==\App\Models\PublishedJobs::JOB_TIME_COMPLETO) ? 'selected' : '')}}>
                                                        {{\App\Models\PublishedJobs::JOB_TIME_COMPLETO}}
                                                    </option>

                                                    <option value="{{\App\Models\PublishedJobs::JOB_TIME_PARCIAL}}"
                                                            {{((isset($postAJob) and $postAJob->job_time==\App\Models\PublishedJobs::JOB_TIME_PARCIAL) ? 'selected' : '')}}>
                                                        {{\App\Models\PublishedJobs::JOB_TIME_PARCIAL}}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label mt-2">
                                            <label class="text-muted">Categoría de trabajo <span class="text-danger">*</span></label>
                                            <div class="form-button">
                                                <select id="category_id" name="category_id" class="form-control required tdtextarea">
                                                    <option value="">Categoría</option>
                                                    @foreach($categories AS $category)
                                                        <option value="{{$category['id']}}"
                                                                {{((isset($postAJob) and $postAJob->category_id==$category['id']) ? 'selected' : '')}}>
                                                            {{strtoupper($category['category_name'])}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group app-label mt-2">
                                            <label class="text-muted">Salario mínimo <span class="text-danger">*</span></label>
                                            <input id="minimum_salary" name="minimum_salary" type="number" class="form-control resume required"
                                                   placeholder="$8000" maxlength="10" value="{{isset($postAJob) ? $postAJob->minimum_salary : ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label mt-2">
                                            <label class="text-muted">Salario máximo <span class="text-danger">*</span></label>
                                            <input id="maximum_salary" name="maximum_salary" type="number" class="form-control resume required"
                                                   placeholder="$20000" maxlength="10" value="{{isset($postAJob) ? $postAJob->maximum_salary : ''}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group app-label mt-2">
                                            <label class="text-muted">Nivel de educación <span class="text-danger">*</span></label>
                                            <div class="form-button">
                                                <select name="education_id" id="education_id" class="form-control required tdtextarea">
                                                    <option value="">Nivel</option>
                                                    @foreach($education AS $item)
                                                        <option value="{{$item['id']}}"
                                                                {{((isset($postAJob) and $postAJob->education_id==$item['id']) ? 'selected' : '')}}>
                                                            {{strtoupper($item['education_name'])}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group app-label mt-2">
                                            <label class="text-muted">Año de experiencia <span class="text-danger">*</span></label>
                                            <div class="form-button">
                                                <select id="year_of_experience" name="year_of_experience" class="form-control required tdtextarea">
                                                    <option value="">Experiencia</option>
                                                    <option value="{{\App\Models\PublishedJobs::EXPERIENCE_1}}"
                                                            {{((isset($postAJob) and $postAJob->year_of_experience==\App\Models\PublishedJobs::EXPERIENCE_1) ? 'selected' : '')}}>
                                                        {{\App\Models\PublishedJobs::EXPERIENCE_1}}
                                                    </option>

                                                    <option value="{{\App\Models\PublishedJobs::EXPERIENCE_2}}"
                                                            {{((isset($postAJob) and $postAJob->year_of_experience==\App\Models\PublishedJobs::EXPERIENCE_2) ? 'selected' : '')}}>
                                                        {{\App\Models\PublishedJobs::EXPERIENCE_2}}
                                                    </option>

                                                    <option value="{{\App\Models\PublishedJobs::EXPERIENCE_3}}"
                                                            {{((isset($postAJob) and $postAJob->year_of_experience==\App\Models\PublishedJobs::EXPERIENCE_3) ? 'selected' : '')}}>
                                                        {{\App\Models\PublishedJobs::EXPERIENCE_3}}
                                                    </option>

                                                    <option value="{{\App\Models\PublishedJobs::EXPERIENCE_MAS}}"
                                                            {{((isset($postAJob) and $postAJob->year_of_experience==\App\Models\PublishedJobs::EXPERIENCE_MAS) ? 'selected' : '')}}>
                                                        {{\App\Models\PublishedJobs::EXPERIENCE_MAS}}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group app-label mt-2">
                                            <label class="text-muted">Sitio web <span class="text-danger">*</span></label>
                                            <input id="website" name="website" type="url" class="form-control resume"
                                                   placeholder="" value="{{isset($postAJob) ? $postAJob->website : ''}}">
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group app-label mt-2">
                                            <label class="text-muted">Provincias <span class="text-danger">*</span></label>
                                            <div class="form-button">

                                                <select id="country_id" name="country_id" class="required tdtextarea select-multiple">
                                                    <option value="">Provincias</option>
                                                    @foreach($countries AS $country)
                                                        <option value="{{$country['id']}}"
                                                                {{((isset($postAJob) and $postAJob->country_id==$country['id']) ? 'selected' : '')}}>
                                                            {{ucfirst(mb_strtolower($country['name']))}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group app-label mt-2">
                                            <label class="text-muted">Dirección de correo electrónico <span class="text-danger">*</span></label>
                                            <input id="email_address" name="email_address" type="email" class="form-control resume required email"
                                                   placeholder="" value="{{isset($postAJob) ? $postAJob->email_address : ''}}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group app-label mt-2">
                                            <label class="text-muted">Género <span class="text-danger">*</span></label>
                                            <div class="form-button">
                                                <select name="gender" id="gender" class="form-control required tdtextarea">
                                                    <option value="">Género</option>

                                                    <option value="{{\App\Models\PublishedJobs::GENDER_M}}"
                                                            {{((isset($postAJob) and $postAJob->gender==\App\Models\PublishedJobs::GENDER_M) ? 'selected' : '')}}>
                                                        {{\App\Models\PublishedJobs::GENDER_M}}
                                                    </option>

                                                    <option value="{{\App\Models\PublishedJobs::GENDER_F}}"
                                                            {{((isset($postAJob) and $postAJob->gender==\App\Models\PublishedJobs::GENDER_F) ? 'selected' : '')}}>
                                                        {{\App\Models\PublishedJobs::GENDER_F}}
                                                    </option>

                                                    <option value="{{\App\Models\PublishedJobs::GENDER_O}}"
                                                            {{((isset($postAJob) and $postAJob->gender==\App\Models\PublishedJobs::GENDER_O) ? 'selected' : '')}}>
                                                        {{\App\Models\PublishedJobs::GENDER_O}}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group app-label mt-2">
                                            <label class="text-muted">Horario <span class="text-danger">*</span></label>
                                            <div class="form-button">
                                                <select id="schedule" name="schedule" class="form-control required tdtextarea">
                                                    <option value="">Horario</option>

                                                    <option value="{{\App\Models\PublishedJobs::SCHEDULE_M}}"
                                                            {{((isset($postAJob) and $postAJob->schedule==\App\Models\PublishedJobs::SCHEDULE_M) ? 'selected' : '')}}>
                                                        {{\App\Models\PublishedJobs::SCHEDULE_M}}
                                                    </option>

                                                    <option value="{{\App\Models\PublishedJobs::SCHEDULE_N}}"
                                                            {{((isset($postAJob) and $postAJob->schedule==\App\Models\PublishedJobs::SCHEDULE_N) ? 'selected' : '')}}>
                                                        {{\App\Models\PublishedJobs::SCHEDULE_N}}
                                                    </option>

                                                    <option value="{{\App\Models\PublishedJobs::SCHEDULE_A}}"
                                                            {{((isset($postAJob) and $postAJob->schedule==\App\Models\PublishedJobs::SCHEDULE_A) ? 'selected' : '')}}>
                                                        {{\App\Models\PublishedJobs::SCHEDULE_A}}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group app-label mt-2">
                                            <label class="text-muted">Descripción del trabajo <span class="text-danger">*</span></label>
                                            <textarea id="job_description" name="job_description" rows="6"
                                                      class="form-control resume required tdtextarea">{{isset($postAJob) ? $postAJob->job_description : ''}}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 text-center" id="loading" style="display: none">
                                        <img src="{{ asset('asset/backend/img/loadingfrm.gif')}}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mt-2 text-center">
                                        @if(isset($postAJob))
                                            <input type="hidden" id="route" name="route" value="update">
                                            <input type="hidden" id="id" name="id" value="{{$postAJob->id}}">
                                            <button type="submit" class="btn btn-primary btn-frm">Modificar trabajo</button>
                                        @else
                                            <input type="hidden" id="route" name="route" value="store">
                                            <button type="submit" class="btn btn-primary btn-frm">Publicar trabajo</button>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@section('script')
    @include('frontend.functions.post-a-job')
@endsection
@stop