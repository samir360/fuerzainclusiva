<!-- all jobs start -->

<section class="section bg-light">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="section-title text-center mb-4 pb-2">
                    <h4 class="title title-line pb-5">Encuentra trabajo</h4>
                    <p class="text-muted para-desc mx-auto mb-1"> Cuentanos sobre tu proyecto, y te ayudaremos a encontrar prospecto.</p>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="tab-content mt-2" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="recent-job" role="tabpanel" aria-labelledby="recent-job-tab">
                        <div class="row">
                            @foreach($jobs AS $job)

                                @php
                                    $application=$user->applications()->where('published_jobs_id', '=', $job->id)->first();
                                @endphp

                                <div class="col-lg-12">
                                    <div class="job-box bg-white overflow-hidden border rounded mt-4 position-relative overflow-hidden">

                                        <div class="p-4">
                                            <div class="row align-items-center">
                                                <div class="col-md-2">
                                                    <div class="mo-mb-2">
                                                        @if($job->company_logo)

                                                            <div id="placeholder" style="text-align: center; width: 100%;">
                                                                <a href="{{url('company-detail-profile/'.Crypt::encryptString($job->company_slug.'-'.$job->id_company))}}"
                                                                   class="btn btn-primary-outline btn-sm">
                                                                    <img src="{{ asset('storage/company/' .$job->company_logo)}}" alt="{{$job->company_slug}}"
                                                                         class="img-fluid mx-auto d-block" style="border-radius: 90px; width: 150px;">
                                                                </a>

                                                            </div>

                                                        @else
                                                            <div id="placeholder" style="text-align: center; width: 100%;">
                                                                <img src="https://via.placeholder.com/300X300//88929f/5a6270C/O https://placeholder.com/"
                                                                     height="150" alt="" class="d-block mx-auto shadow rounded-pill mb-4">
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-md-8">
                                                    <div>
                                                        <h5 class="f-18">
                                                            <a href="{{url('job-detail/'.Crypt::encryptString($job->job_slug.'-'.$job->id))}}" class="text-dark">
                                                                {{$job->job_title}}
                                                            </a>
                                                        </h5>
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
                                                                <p class="text-muted mb-0 mo-mb-2">
                                                                    <i class="mdi mdi-school mr-2"></i>
                                                                    {{ucfirst(mb_strtolower($job['education_name']))}}
                                                                </p>
                                                            </li>

                                                            <li class="list-inline-item">
                                                                <p class="text-muted mb-0 mo-mb-2">
                                                                    <i class="mdi mdi-cash-usd mr-2"></i> {{$job->minimum_salary .' - '.$job->maximum_salary}}
                                                                </p>
                                                            </li>
                                                        </ul>

                                                        <ul class="list-inline mb-0">
                                                            <li class="list-inline-item mr-3">
                                                                <p class="text-muted mb-0">
                                                                    <i class="mdi mdi-home-map-marker text-primary mr-2"></i> {{$job['name']}}
                                                                </p>
                                                            </li>

                                                            <li class="list-inline-item">
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

                                                            <li class="list-inline-item">
                                                                <p class="text-muted mb-0">
                                                                    <i class="mdi mdi-bulletin-board mr-2"></i>
                                                                    {{ucfirst(mb_strtolower($job['category_name']))}}
                                                                </p>
                                                            </li>

                                                        </ul>

                                                    </div>
                                                </div>

                                                <div class="col-lg-2 col-md-3">
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
            </div>
        </div>
    </div>
</section>
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