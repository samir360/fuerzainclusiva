@extends('frontend.layouts.master')
@section('content')

    <section class="bg-half page-next-level">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center text-white">
                        <img src="{{asset('asset/frontend/images/busqueda-empleo.png')}}" alt="fuerzainclusiva.com">
                        <h4 class="text-uppercase title mb-4">Detalle del trabajo</h4>
                        <ul class="page-next d-inline-block mb-0">
                            <li><a href="{{route('jobs')}}" class="text-uppercase font-weight-bold">Inicio</a></li>
                            <li><a href="#" class="text-uppercase font-weight-bold">Trabajos</a></li>
                            <li>
                                <span class="text-uppercase text-white font-weight-bold">Detalle del trabajo</span>
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
                <div class="col-lg-12">
                    <h4 class="text-dark mb-3">{{$job->job_title}}</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 col-md-7">
                    <div class="job-detail border rounded p-4">
                        <div class="job-detail-content">

                            @if(isset($job) and $job->company_logo)
                                <div id="placeholder" style="text-align: center; width: 100%;">
                                    <img src="{{ asset('storage/company/' .$job->company_logo)}}" alt="{{$job->company_slug}}"
                                         class="img-fluid float-left mr-md-3 mr-2 mx-auto d-block" style="border-radius: 90px; width: 150px;">
                                </div>

                            @else
                                <div id="placeholder" style="text-align: center; width: 100%;">
                                    <img src="https://via.placeholder.com/300X300//88929f/5a6270C/O https://placeholder.com/"
                                         height="150" alt="" class="img-fluid float-left mr-md-3 mr-2 mx-auto d-block">
                                </div>
                            @endif


                            <div class="job-detail-com-desc overflow-hidden d-block">
                                <h4 class="mb-2"><a href="#" class="text-dark">{{$job->company_title}}</a></h4>

                                @if($job->website)
                                    <p class="text-muted mb-0"><i class="mdi mdi-link-variant mr-2"></i>{{$job->website}}</p>
                                @endif

                                <p class="text-muted mb-0"><i class="mdi mdi-map-marker mr-2"></i> {{$job->name}}</p>
                            </div>
                        </div>

                        <div class="job-detail-desc mt-4" style="padding: 15px;">
                            <p class="text-muted mb-3">{{$job->company_desciption}}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="text-dark mt-4">Descipción del trabajo:</h5>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="job-detail border rounded mt-2 p-4">
                                <div class="job-detail-desc">
                                    <p class="text-muted mb-3">{{$job->job_description}}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-4 col-md-5 mt-4 mt-sm-0">
                    <div class="job-detail border rounded p-4">
                        <h5 class="text-muted text-center pb-2"><i class="mdi mdi-map-marker mr-2"></i>Especificaciones</h5>

                        <div class="job-detail-location pt-4 border-top">
                            <div class="job-details-desc-item">
                                <div class="float-left mr-2">
                                    <i class="mdi mdi-bank text-muted"></i>
                                </div>
                                <p class="text-muted mb-2">: {{$job->company_name}}</p>
                            </div>

                            <div class="job-details-desc-item">
                                <div class="float-left mr-2">
                                    <i class="mdi mdi-email text-muted"></i>
                                </div>
                                <p class="text-muted mb-2">: {{$job->email_address}}</p>
                            </div>

                            @if($job->website)
                                <div class="job-details-desc-item">
                                    <div class="float-left mr-2">
                                        <i class="mdi mdi-web text-muted"></i>
                                    </div>
                                    <p class="text-muted mb-2">: {{$job->website}}</p>
                                </div>
                            @endif

                            <div class="job-details-desc-item">
                                <div class="float-left mr-2">
                                    <i class="mdi mdi-cellphone-iphone text-muted"></i>
                                </div>
                                <p class="text-muted mb-2">: {{$job->person_phone}}</p>
                            </div>

                            <div class="job-details-desc-item">
                                <div class="float-left mr-2">
                                    <i class="mdi mdi-currency-usd text-muted"></i>
                                </div>
                                <p class="text-muted mb-2">: ${{$job->minimum_salary}} - ${{$job->maximum_salary}}</p>
                            </div>

                            <div class="job-details-desc-item">
                                <div class="float-left mr-2">
                                    <i class="mdi mdi-security text-muted"></i>
                                </div>
                                <p class="text-muted mb-2">: {{ucwords(mb_strtolower($job->year_of_experience))}}</p>
                            </div>

                            <div class="job-details-desc-item">
                                <div class="float-left mr-2">
                                    <i class="mdi mdi-clock-outline text-muted"></i>
                                </div>
                                <p class="text-muted mb-2">: {{ucwords(mb_strtolower($job->schedule))}}</p>
                            </div>

                            <div class="job-details-desc-item">
                                <div class="float-left mr-2">
                                    <i class="mdi mdi-school text-muted"></i>
                                </div>
                                <p class="text-muted mb-2">: {{ucwords(mb_strtolower($job->education_name))}}</p>
                            </div>


                            <div class="job-details-desc-item">
                                <div class="float-left mr-2">
                                    @if($job['gender']==\App\Models\PublishedJobs::GENDER_M)
                                        <i class="mdi mdi-gender-male mr-2"></i>
                                    @endif

                                    @if($job['gender']==\App\Models\PublishedJobs::GENDER_F)
                                        <i class="mdi mdi-gender-female mr-2"></i>
                                    @endif

                                    @if($job['gender']==\App\Models\PublishedJobs::GENDER_O)
                                        <i class="mdi mdi-human-male-female mr-2"></i>
                                    @endif

                                </div>
                                <p class="text-muted mb-2">: {{ucfirst(mb_strtolower($job['gender']))}}</p>
                            </div>

                        </div>
                    </div>

                    @if($application)
                    <div class="job-detail border rounded mt-4">
                        <a href="javascript:void(0)" class="btn btn-info btn-block">Postulado</a>
                    </div>
                    @endif

                    <div class="job-detail border rounded mt-4" id="btn-postulate-{{$job['id']}}" style="display: none">
                        <a href="javascript:void(0)" data-id="{{$job['id']}}" class="btn btn-info btn-block">Postulado</a>
                    </div>

                    @if(!$application)
                    <div class="job-detail border rounded mt-4" id="btn-apply-{{$job['id']}}">
                        <a href="javascript:void(0)" data-id="{{$job['id']}}" class="btn btn-primary btn-block apply">Postularme</a>
                    </div>
                        @endif

                </div>
            </div>
        </div>
    </section>
@endsection


@section('script')
    <script type="application/javascript">

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
