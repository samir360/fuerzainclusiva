@extends('frontend.layouts.master')
@section('content')

    <section class="bg-half page-next-level">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center text-white">
                        <h4 class="text-uppercase title mb-4">Mis Publicaciones</h4>
                        <ul class="page-next d-inline-block mb-0">
                            <li>
                                <a href="{{route('candidate')}}" class="text-uppercase font-weight-bold">Inicio</a>
                            </li>
                            <li>
                                <span class="text-uppercase text-white font-weight-bold">Páginas</span>
                            </li>
                            <li>
                                <span class="text-uppercase text-white font-weight-bold">Mis Publicaciones</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="section pt-0">
        <div class="container">

            <div class="row">
                <div class="col-lg-12 mt-4 pt-2">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <div class="show-results">
                                <div class="float-left">
                                    <h5 class="text-dark mb-0 pt-2 f-18">Total resultado {{count($myPosts)}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        @if(count($myPosts) > 0)
                            @foreach($myPosts AS $post)
                                @include('frontend.layouts.modal-deleted', ['id' => $post->id])
                                <div class="col-lg-12 mt-4 pt-2">
                                    <div class="job-list-box border rounded">
                                        <div class="p-4">
                                            <div class="row align-items-center">
                                                <div class="col-lg-2">
                                                    <div class="company-logo-img">
                                                        @if($post->company_logo)
                                                            <div id="placeholder" style="text-align: center; width: 100%;">
                                                                <img src="{{ asset('storage/company/' .$post->company_logo)}}" alt="{{$post->company_slug}}"
                                                                     class="img-fluid mx-auto d-block" style="border-radius: 90px; width: 150px;">
                                                            </div>

                                                        @else
                                                            <div id="placeholder" style="text-align: center; width: 100%;">
                                                                <img src="https://via.placeholder.com/300X300//88929f/5a6270C/O https://placeholder.com/"
                                                                     height="150" alt="" class="d-block mx-auto shadow rounded-pill mb-4">
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-7 col-md-9">
                                                    <div class="job-list-desc">
                                                        <h6 class="mb-2"><a href="#" class="text-dark">{{$post['job_title']}}</a></h6>

                                                        <p class="text-muted mb-0">
                                                            <i class="mdi mdi-timer mr-2"></i>
                                                            {{ucfirst(mb_strtolower($post['job_time']))}} {{ucfirst(mb_strtolower($post['schedule']))}}
                                                        </p>

                                                        <ul class="list-inline mb-0">

                                                            <li class="list-inline-item mr-3">
                                                                <p class="text-muted mb-0">
                                                                    <i class="mdi mdi-map-marker mr-2"></i>{{$post['name']}}
                                                                </p>
                                                            </li>

                                                            <li class="list-inline-item mr-3">
                                                                <p class="text-muted mb-0">
                                                                    <i class="mdi mdi-bank mr-2"></i>{{$post['company_name']}}
                                                                </p>
                                                            </li>

                                                            <li class="list-inline-item">
                                                                <p class="text-muted mb-0">
                                                                    <i class="mdi mdi-cash-usd mr-2"></i>{{$post['minimum_salary']}} {{'-'}} {{$post['maximum_salary']}}
                                                                </p>
                                                            </li>
                                                        </ul>


                                                        <ul class="list-inline mb-0">
                                                            <li class="list-inline-item mr-3">
                                                                @if($post['job_status']==\App\Models\PublishedJobs::JOB_ACTIVE)
                                                                    <p class="text-muted mb-0"><i class="mdi mdi-check-circle mr-2"></i>
                                                                        {{ucfirst(mb_strtolower($post['job_status']))}}
                                                                    </p>
                                                                @else
                                                                    <p class="text-muted mb-0"><i class="mdi mdi-close-circle mr-2"></i>
                                                                        {{ucfirst(mb_strtolower($post['job_status']))}}
                                                                    </p>
                                                                @endif
                                                            </li>

                                                            <li class="list-inline-item mr-3">
                                                                <p class="text-muted mb-0">
                                                                    @if($post['gender']==\App\Models\PublishedJobs::GENDER_M)
                                                                        <i class="mdi mdi-gender-male mr-2"></i>
                                                                    @endif

                                                                    @if($post['gender']==\App\Models\PublishedJobs::GENDER_F)
                                                                        <i class="mdi mdi-gender-female mr-2"></i>
                                                                    @endif

                                                                    @if($post['gender']==\App\Models\PublishedJobs::GENDER_O)
                                                                        <i class="mdi mdi-human-male-female mr-2"></i>
                                                                    @endif

                                                                    {{ucfirst(mb_strtolower($post['gender']))}}
                                                                </p>
                                                            </li>

                                                            <li class="list-inline-item mr-3">
                                                                <p class="text-muted mb-0">
                                                                    <i class="mdi mdi-checkbox-multiple-marked-circle-outline mr-2"></i>
                                                                    {{ucfirst(mb_strtolower($post['category_name']))}}
                                                                </p>
                                                            </li>
                                                        </ul>

                                                        <p class="text-muted mb-0">
                                                            <i class="mdi mdi-human-handsup mr-2"></i>
                                                            Experiencia {{ucfirst(mb_strtolower($post['year_of_experience']))}}
                                                        </p>

                                                    </div>
                                                </div>

                                                <div class="col-lg-3 col-md-3">
                                                    <div class="job-list-button-sm text-right">
                                                        <a data-toggle="modal" data-target="#modal-deleted-{{$post->id}}" style="cursor: pointer">
                                                            <span class="badge badge-danger">Eliminar</span>
                                                        </a>

                                                        <div class="mt-3">
                                                            <a href="{{ url('/edit-post-a-job/'.$post['job_slug']) }}" class="btn btn-sm btn-info">Editar</a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>


                                        </div>
                                        <div class="p-3 bg-light">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <div>
                                                        <p class="text-muted mb-0 mo-mb-2">
                                                            <span class="text-dark">Postulados :</span>
                                                            {{count($post->applications)}}
                                                        </p>
                                                    </div>
                                                </div>

                                                @if(count($post->applications) > 0)
                                                    <div class="col-md-2 text-right">
                                                        <div>
                                                            <a href="{{url('candidate-applications/'.Crypt::encryptString($post->id))}}" class="text-primary">
                                                                Ver postulados<i class="mdi mdi-chevron-double-right"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        @else
                            @foreach ($errors->all() as $error)
                                <div class="col-12">
                                    <div class="alert alert-warning" role="alert">{{ $error }}</div>
                                </div>
                            @endforeach
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="application/javascript">
        $('.btn-deleted').on('click', function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.post("{{route('deleted-post')}}", {id: $(this).data("id")})
                .done(function () {
                    location.reload();
                });

        });
    </script>

@stop