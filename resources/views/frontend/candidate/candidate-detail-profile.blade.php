@extends('frontend.layouts.master')
@section('content')

    <!-- Start home -->
    <section class="bg-half page-next-level">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="candidates-profile-details text-center">

                        @if(isset($profile) and $profile->photo)
                            <div id="placeholder" style="text-align: center; width: 100%;">
                                <img src="{{ asset('storage/photo_users/' .$profile->photo)}}" alt="{{$profile->company_profile_slug}}"
                                     class="img-fluid mx-auto d-block" style="border-radius: 90px; width: 150px;">
                            </div>

                        @else
                            <div id="placeholder" style="text-align: center; width: 100%;">
                                <img src="{{ asset('asset/frontend/images/user-avatar.png')}}" alt="avatar"
                                     class="img-fluid mx-auto d-block" style="border-radius: 90px; width: 150px;">
                            </div>
                        @endif

                        <h5 class="text-white mb-2">{{$profile->profile_full_name}}</h5>
                        <p class="text-white-50 h6 mb-2"><i class="mdi mdi-email mr-2"></i>{{$userProfile->email}}</p>
                        <p class="text-white-50 h6 mb-2"><i class="mdi mdi-phone mr-2"></i>{{$profile->phone}}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- CANDIDATES PROFILE START -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="text-dark">Un poco sobre mí :</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 mt-3">
                    <div class="border rounded p-4">
                        <p class="text-muted">{{$profile->personal_description}}</p>


                        <ul class="list-inline pt-3 border-top mb-0">
                            <li class="list-inline-item mr-3">
                                <a href="" class="text-muted f-15 mb-0">
                                    <i class="mdi mdi-map-marker mr-2"></i> {{$profile->address.'. '.$country}}
                                </a>
                            </li>

                            <li class="list-inline-item mr-3">
                                <a href="" class="text-muted f-15 mb-0"><i class="mdi mdi-email mr-2"></i> {{$userProfile->email}}</a>
                            </li>

                            <li class="list-inline-item mr-3">
                                <a href="" class="text-muted f-15 mb-0"><i class="mdi mdi-cellphone-iphone mr-2"></i>{{$profile->phone}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


            @if(count($institutions) > 0)
                <div class="row">
                    <div class="col-lg-12 mt-4 pt-2">
                        <h4 class="text-dark">Educación :</h4>
                    </div>
                </div>

                <div class="row">

                    @foreach($institutions AS $institution)
                        <div class="col-lg-4 col-md-6 mt-4 pt-5">
                            <div class="border rounded candidates-profile-education text-center text-muted">
                                <div class="profile-education-icon border rounded-pill bg-white text-primary">
                                    <i class="mdi mdi-36px mdi-home-modern"></i>
                                </div>
                                <h6 class="text-uppercase f-17">{{$institution->institution_name}}</h6>
                                {{--                        <p class="f-14 mb-1">May 2016 - April 2017</p>--}}
                                <p class="pb-3 mb-0">{{$institution->obtained_title}}</p>

                                {{--                        <p class="pt-3 border-top mb-0">Suspendisse faucibus et pellentesque egestas lacus ante convallis.</p>--}}
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif


            @if(count($experiences) > 0)
                <div class="row">
                    <div class="col-lg-12 mt-4 pt-2">
                        <h4 class="text-dark">Experiencia laboral :</h4>
                    </div>
                </div>

                <div class="row">
                    @foreach($experiences AS $experience)
                        <div class="col-lg-4 col-md-6 mt-4 pt-5">
                            <div class="border rounded candidates-profile-education text-center text-muted">
                                <div class="profile-education-icon border rounded-pill bg-white text-primary">
                                    <i class="mdi mdi-36px mdi-home-assistant"></i>
                                </div>
                                <h6 class="text-uppercase f-17">{{$experience->company_name}}</h6>
                                <p class="f-14 mb-1">{{$experience->number_of_years}} Año{{(($experience->number_of_years > 1) ? 's' : '')}}</p>
                                <p class="pb-3 mb-0">{{$experience->company_functions}}</p>
                                <p class="pt-3 border-top mb-0">Industria: {{$experience->industry->industry_name}}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif



            @if(count($references) > 0)
                <div class="row">
                    <div class="col-lg-12 mt-4 pt-2">
                        <h4 class="text-dark">Referencias personales :</h4>
                    </div>
                </div>

                <div class="row">
                    @foreach($references AS $reference)
                        <div class="col-lg-4 col-md-6 mt-4 pt-5">
                            <div class="border rounded candidates-profile-education text-center text-muted">
                                <div class="profile-education-icon border rounded-pill bg-white text-primary">
                                    <i class="mdi mdi-36px mdi-human-handsup"></i>
                                </div>
                                <h6 class="text-uppercase f-17"><i class="mdi mdi-account"></i> {{$reference->full_name}}</h6>
                                <p class="f-14 mb-1"><i class="mdi mdi-archive"></i> {{$reference->charge}}</p>
                                <p class="pb-3 mb-0"><i class="mdi mdi-phone"></i> {{$reference->reference_phone}}</p>
                                <p class="pt-3 border-top mb-0"><i class="mdi mdi-email"></i> {{$reference->reference_email}}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

            @endif
        </div>
    </section>

@section('script')
    @include('frontend.functions.candidate-profile')
@endsection
@stop