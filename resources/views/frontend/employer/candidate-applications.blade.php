@extends('frontend.layouts.master')
@section('content')


    <section class="bg-half page-next-level">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center text-white">
                        <h4 class="text-uppercase title mb-4">{{isset($PublishedJob) ? $PublishedJob->job_title : 'Postulados'}}</h4>
                        <ul class="page-next d-inline-block mb-0">
                            <li><a href="{{route('candidate')}}" class="text-uppercase font-weight-bold">Inicio</a></li>
                            <li><a href="#" class="text-uppercase font-weight-bold">Trabajos</a></li>
                            <li>
                                <span class="text-uppercase text-white font-weight-bold">postulados</span>
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
                    <div class="row">
                        @foreach($candidates AS $candidate)
                            <div class="col-lg-4 col-md-6 mt-4 pt-2">
                                <div class="list-grid-item rounded">
                                    <div class="grid-item-content p-3">

                                        <div class="grid-list-img mt-3">


                                            @if(isset($candidate) and $candidate->photo)
                                                <div id="placeholder" style="text-align: center; width: 100%;">
                                                    <img src="{{ asset('storage/photo_users/' .$candidate->photo)}}" alt="{{$candidate->profile_slug}}"
                                                         class="img-fluid d-block" style="border-radius: 90px; width: 100px;">
                                                </div>

                                            @else
                                                <div id="placeholder" style="text-align: center; width: 100%;">
                                                    <img src="{{ asset('asset/frontend/images/user-avatar.png')}}" alt="avatar"
                                                         class="img-fluid d-block" style="border-radius: 90px; width: 100px;">
                                                </div>
                                            @endif


                                        </div>

                                        <div class="grid-list-desc mt-3">
                                            <h5 class="mb-1">
                                                <a href="{{url('candidate-detail-profile/'.Crypt::encryptString($candidate->profile_slug.'-'.$candidate->user_id))}}"
                                                   class="text-dark"> {{$candidate->profile_full_name}}
                                                </a>
                                            </h5>
                                            <p class="text-muted f-14 mb-1">
                                                @if($candidate->gender==\App\Models\PublishedJobs::GENDER_M)
                                                    <i class="mdi mdi-gender-male mr-2"></i>
                                                @endif

                                                @if($candidate->gender==\App\Models\PublishedJobs::GENDER_F)
                                                    <i class="mdi mdi-gender-female mr-2"></i>
                                                @endif

                                                @if($candidate->gender==\App\Models\PublishedJobs::GENDER_O)
                                                    <i class="mdi mdi-human-male-female mr-2"></i>
                                                @endif

                                                {{ucfirst(mb_strtolower($candidate->gender))}}
                                            </p>

                                            <p class="text-muted f-14 mb-1">
                                                <i class="mdi mdi-phone mr-2"></i>
                                                {{$candidate->phone}}
                                            </p>

                                            <p class="text-muted f-14 mb-1">
                                                <i class="mdi mdi-map mr-2"></i>
                                                {{$candidate->name}}
                                            </p>

                                            <p class="text-muted f-14 mb-1">
                                                <i class="mdi mdi-library mr-2"></i>
                                                {{$candidate->education_name}}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="apply-button p-3 border-top">
                                        <i class="mdi mdi-calendar mr-2"></i>
                                        {{date('d/m/Y', strtotime($candidate->birthday))}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 mt-4 pt-2">
                    @if (isset($candidates))
                        {{ $candidates->appends(((isset($filter)) ? $filter : ''))->links() }}
                    @endif
                </div>
            </div>
        </div>
    </section>

@stop