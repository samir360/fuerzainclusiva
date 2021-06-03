<!-- all jobs start -->

<section class="section bg-light">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="section-title text-center mb-4 pb-2">
                    <h4 class="title title-line pb-5">Encuentra Candidatos</h4>
                    <p class="text-muted para-desc mx-auto mb-1"> Encuentra los mejores prospectos.</p>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="tab-content mt-2" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="recent-job" role="tabpanel" aria-labelledby="recent-job-tab">
                        <div class="row">

                            @if(count($candidates) > 0)
                            @foreach($candidates AS $candidate)
                                <div class="col-lg-12">
                                    <div class="job-box bg-white overflow-hidden border rounded mt-4 position-relative overflow-hidden">

                                        <div class="p-4">
                                            <div class="row align-items-center">
                                                <div class="col-md-2">
                                                    <div class="mo-mb-2">
                                                        @if($candidate->photo)
                                                            <div id="placeholder" style="text-align: center; width: 100%;">
                                                                <img src="{{ asset('storage/photo_users/' .$candidate->photo)}}" alt="{{$candidate->profile_slug}}"
                                                                     class="d-block mx-auto shadow rounded-pill mb-4" style=" width: 100px;">
                                                            </div>

                                                        @else
                                                            <div id="placeholder" style="text-align: center; width: 100%;">
                                                                <img src="{{ asset('asset/frontend/images/user-avatar.jpg')}}"
                                                                     class="d-block mx-auto shadow rounded-pill mb-4" style="width: 100px;">
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div>
                                                        <h5 class="f-18"><a href="{{url('candidate-detail-profile/'.Crypt::encryptString($candidate->profile_slug.'-'.$candidate->user_id))}}" class="text-dark">{{$candidate->profile_full_name}}</a></h5>
                                                        <ul class="list-inline mb-0">
                                                            <li class="list-inline-item mr-3">
                                                                <p class="text-muted mb-0">
                                                                    @if($candidate->gender==\App\Models\PublishedJobs::GENDER_M)
                                                                        <i class="mdi mdi-gender-male mr-2"></i>
                                                                    @endif

                                                                    @if($candidate->gender==\App\Models\PublishedJobs::GENDER_F)
                                                                        <i class="mdi mdi-gender-female mr-2"></i>
                                                                    @endif

                                                                    {{ucfirst(mb_strtolower($candidate->gender))}}
                                                                </p>
                                                            </li>

                                                            <li class="list-inline-item">
                                                                <p class="text-muted mb-0 mo-mb-2">
                                                                    <i class="mdi mdi-school mr-2"></i>
                                                                    {{ucwords(mb_strtolower($candidate->education_name))}}
                                                                </p>
                                                            </li>

                                                            <li class="list-inline-item">
                                                                <p class="text-muted mb-0 mo-mb-2">
                                                                    <i class="mdi mdi-phone mr-2"></i> {{$candidate->phone}}
                                                                </p>
                                                            </li>
                                                        </ul>

                                                        <ul class="list-inline mb-0">
                                                            <li class="list-inline-item mr-3">
                                                                <p class="text-muted mb-0">
                                                                    <i class="mdi mdi-home-map-marker text-primary mr-2"></i> {{$candidate->name}}
                                                                </p>
                                                            </li>

                                                            <li class="list-inline-item mr-3">
                                                                <p class="text-muted mb-0">
                                                                    <i class="mdi mdi-email mr-2"></i> {{$candidate->email}}
                                                                </p>
                                                            </li>

                                                        </ul>

                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="job-list-button-sm text-right">
                                                        <span class="badge badge-success">
                                                             <i class="mdi mdi-calendar mr-2"></i>
                                                        {{date('d/m/Y', strtotime($candidate->created_at))}}
                                                        </span>

                                                        <div class="mt-3">
                                                            <a href="{{url('candidate-detail-profile/'.Crypt::encryptString($candidate->profile_slug.'-'.$candidate->user_id))}}" class="btn btn-primary-outline btn-sm">Perfil</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach

                            @else
                                    <div class="col-lg-12 mt-4 pt-2">
                                        <div class="section-title text-center mb-4 pb-2">

                                            @foreach ($errors->all() as $error)
                                                <div class="alert alert-warning" role="alert">{{ $error }}</div>
                                            @endforeach
                                        </div>
                                    </div>
                            @endif

                        </div>


                        <div class="col-lg-12 mt-4 pt-2">
                            @if (isset($candidates))
                                {{ $candidates->appends(((isset($filter)) ? $filter : ''))->links() }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>