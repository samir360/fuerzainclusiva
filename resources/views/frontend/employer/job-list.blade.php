@extends('frontend.layouts.master')
@section('content')

    <style>
        #s2id_country_id {
            width: 260px !important;
        }
    </style>

    <!-- Start home -->
    <section class="bg-half page-next-level">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center text-white">
                        <img src="{{asset('asset/frontend/images/busqueda-empleo.png')}}" alt="fuerzainclusiva.com">
                        <h4 class="text-uppercase title mb-4">LISTA DE TRABAJOS</h4>
                        <ul class="page-next d-inline-block mb-0">
                            <li><a href="{{route('jobs')}}" class="text-uppercase font-weight-bold">Inicio</a></li>
                            <li><a href="#" class="text-uppercase font-weight-bold">Trabajos</a></li>
                            <li>
                                <span class="text-uppercase text-white font-weight-bold">Lista de trabajos</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end home -->


    <div class="container">
        <div class="home-form-position">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="home-registration-form job-list-reg-form bg-light shadow p-4 mb-3">
                        <form class="registration-form" id="registration-form" action="{{route('jobs-list')}}">
                            <div class="row">

                                <div class="col-lg-3 col-md-6">
                                    <div class="registration-form-box">
                                        <input type="text" id="search" name="filter[search]" class="form-control" placeholder="Titulo...">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="registration-form-box">
                                        <select id="country_id" name="filter[country_id]" class="select-multiple">
                                            <option value="">Provincias</option>
                                            @foreach($countries AS $country)
                                                <option value="{{$country['id']}}"
                                                        {{((isset($filterJobs['country_id']) and $filterJobs['country_id']==$country['id']) ? 'selected' : '')}}>
                                                    {{ucfirst(mb_strtolower($country['name']))}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6">
                                    <div class="registration-form-box">
                                        <select id="category_id" name="filter[category_id]" class="select-multiple">
                                            <option value="">Categories...</option>
                                            @foreach($categories AS $category)
                                                <option value="{{$category->id}}"
                                                        {{((isset($filterJobs['category_id']) and $filterJobs['category_id']==$category->id) ? 'selected' : '')}} >
                                                    {{$category->category_name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="registration-form-box">
                                        <input type="submit" id="submit" name="send" class="submitBnt btn btn-primary btn-block" value="Buscar">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="section pt-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="section-title text-center mb-4 pb-2">
                        <h4 class="title title-line pb-5">Encuentra trabajo</h4>
                        <p class="text-muted para-desc mx-auto mb-1"> Cuentanos sobre tu proyecto, y te ayudaremos a encontrar prospecto.</p>
                    </div>
                </div>
            </div>


            @if(count($jobs) == 0)
                <div class="row justify-content-center">
                    <div class="col-6">
                        <div class="section-title text-center mb-4 pb-2">

                            @foreach ($errors->all() as $error)
                                <div class="alert alert-warning" role="alert">{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                </div>

            @else

                <div class="row">

                    <div class="col-lg-3">
                        <form id="form-filter-panel" action="{{route('jobs-list')}}">
                            @include('frontend.employer.filters-job-list')
                        </form>
                    </div>

                    <div class="col-lg-9 mt-4 pt-2">

                        <div class="row">

                            @foreach($jobs AS $job)

                                @php
                                    $application=$user->applications()->where('published_jobs_id', '=', $job->id)->first();
                                @endphp


                                <div class="col-lg-12 mt-4 pt-2">
                                    <div class="job-list-box border rounded">
                                        <div class="p-3">
                                            <div class="row align-items-center">

                                                <div class="col-lg-2">
                                                    <div class="company-logo-img">

                                                        @if($job->company_logo)
                                                            <a href="{{url('company-detail-profile/'.Crypt::encryptString($job->company_slug.'-'.$job->id_company))}}"
                                                               class="btn  btn-primary-outline btn-sm" style="border: none;">
                                                                <img src="{{ asset('storage/company/' .$job->company_logo)}}" alt="{{$job->company_slug}}"
                                                                     class="img-fluid mx-auto d-block" style="border-radius: 90px; width: 150px;">
                                                            </a>
                                                        @else
                                                            <img src="https://via.placeholder.com/300X300//88929f/5a6270C/O https://placeholder.com/"
                                                                 height="150" alt="" class="d-block mx-auto shadow rounded-pill mb-4">
                                                        @endif
                                                    </div>
                                                </div>


                                                <div class="col-lg-7 col-md-9">
                                                    <div class="job-list-desc">
                                                        <h6 class="mb-2">
                                                            <a href="{{url('job-detail/'.Crypt::encryptString($job->job_slug.'-'.$job->id))}}" class="text-dark">
                                                                {{$job->job_title}}
                                                            </a>
                                                        </h6>

                                                        <ul class="list-inline mb-0">
                                                            <li class="list-inline-item mr-3">
                                                                <p class="text-muted mb-0">
                                                                    @if($job['gender']==\App\Models\PublishedJobs::GENDER_M)
                                                                        <i class="mdi mdi-gender-male mr-2"></i>
                                                                    @endif

                                                                    @if($job['gender']==\App\Models\PublishedJobs::GENDER_F)
                                                                        <i class="mdi mdi-gender-female mr-2"></i>
                                                                    @endif

                                                                    @if($job['gender']==\App\Models\PublishedJobs::GENDER_O)
                                                                        <i class="mdi mdi-human-male-female mr-2"></i>
                                                                    @endif

                                                                    {{ucfirst(mb_strtolower($job['gender']))}}
                                                                </p>
                                                            </li>

                                                            <li class="list-inline-item">
                                                                <p class="text-muted mb-0">
                                                                    <i class="mdi mdi-bulletin-board mr-2"></i>
                                                                    {{ucfirst(mb_strtolower($job['category_name']))}}
                                                                </p>
                                                            </li>
                                                        </ul>


                                                        <ul class="list-inline mb-0">
                                                            <li class="list-inline-item mr-3">
                                                                <p class="text-muted mb-0">
                                                                    <i class="mdi mdi-cash-usd mr-2"></i> {{$job->minimum_salary .' - '.$job->maximum_salary}}
                                                                </p>
                                                            </li>

                                                            <li class="list-inline-item">
                                                                <p class="text-muted mb-0">
                                                                    <i class="mdi mdi-home-map-marker text-primary mr-2"></i> {{$job['name']}}
                                                                </p>
                                                            </li>

                                                            <li class="list-inline-item">
                                                                <p class="text-muted mb-0">
                                                                    <i class="mdi mdi-school mr-2"></i>
                                                                    {{ucfirst(mb_strtolower($job['education_name']))}}
                                                                </p>
                                                            </li>
                                                        </ul>

                                                        <ul class="list-inline mb-0">
                                                            <li class="list-inline-item mr-3">
                                                                <p class="text-muted mb-0">
                                                                    <i class="mdi mdi-timer mr-2"></i>
                                                                    {{ucfirst(mb_strtolower($job['job_time']))}} {{ucfirst(mb_strtolower($job['schedule']))}}
                                                                </p>
                                                            </li>

                                                            <li class="list-inline-item">
                                                                <p class="text-muted mb-0">
                                                                    <i class="mdi mdi-calendar mr-2"></i> Experiencia:
                                                                    {{ucfirst(mb_strtolower($job['year_of_experience']))}}
                                                                </p>
                                                            </li>
                                                        </ul>

                                                    </div>
                                                </div>


                                                <div class="col-lg-3 col-md-3">
                                                    <div class="job-list-button-sm text-right">
                                                        <span class="badge badge-light">
                                                             <i class="mdi mdi-calendar mr-2"></i>
                                                        {{date('d/m/Y', strtotime($job['created_at']))}}
                                                        </span>

                                                        @if(!$application)
                                                            <div class="mt-3" id="btn-apply-{{$job->id}}">
                                                                <a href="javascript:void(0)" data-id="{{$job->id}}" class="btn btn-sm btn-primary apply">
                                                                    Postularme
                                                                </a>
                                                            </div>
                                                        @endif

                                                        <div class="mt-3" id="btn-postulate-{{$job->id}}" style="display: none">
                                                            <a href="javascript:void(0)" class="btn btn-sm btn-info">
                                                                Postulado
                                                            </a>
                                                        </div>

                                                        @if($application)
                                                            <div class="mt-3">
                                                                <a href="javascript:void(0)" class="btn btn-sm btn-info">
                                                                    Postulado
                                                                </a>
                                                            </div>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-lg-12 mt-4 pt-2">
                            @if (isset($jobs))
                                {{ $jobs->appends(((isset($filter)) ? $filter : ''))->links() }}
                            @endif
                        </div>

                    </div>
                </div>
            @endif
        </div>
    </section>

@endsection

@section('script')
    <script type="application/javascript">
        $(document).ready(function () {
            $('.select-multiple').select2();
        });


        $(".filter-panel").click(function () {
            $("#form-filter-panel").submit();
        });


        $(".apply").on('click', function () {
            var id = $(this).data("id");


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "{{route('job-apply')}}",
                cache: false,
                dataType: 'json',
                data: {'id': id},
                success: function (respuesta) {

                    if (respuesta.status = 'success') {
                        $('#btn-apply-' + id).hide();
                        $('#btn-postulate-' + id).show();
                    }


                }
            });

        });

    </script>
@endsection

