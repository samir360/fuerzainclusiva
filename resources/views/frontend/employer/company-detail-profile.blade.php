@extends('frontend.layouts.master')
@section('content')

    <!-- Start home -->
    <section class="bg-half page-next-level">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center text-white">
                        <h4 class="text-uppercase title mb-4">Perfil compañia</h4>
                        <ul class="page-next d-inline-block mb-0">
                            <li><a href="{{route('jobs')}}" class="text-uppercase font-weight-bold">Inicio</a></li>
                            <li><a href="#" class="text-uppercase font-weight-bold">Trabajos</a></li>
                            <li>
                                <span class="text-uppercase text-white font-weight-bold">Perfil compañia</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end home -->


    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-sm-center">


                        @if(isset($company) and $company->company_logo)
                            <div id="placeholder" style="text-align: center; width: 100%;">
                                <img src="{{ asset('storage/company/' .$company->company_logo)}}" alt="{{$company->company_slug}}"
                                     class="img-fluid mx-md-auto d-block" style="border-radius: 90px; width: 150px;">
                            </div>

                        @else
                            <div id="placeholder" style="text-align: center; width: 100%;">
                                <img src="https://via.placeholder.com/300X300//88929f/5a6270C/O https://placeholder.com/"
                                     height="150" alt="" class="d-block mx-auto shadow rounded-pill mb-4">
                            </div>
                        @endif


                        <h4 class="mt-3">{{$company->company_name}}</h4>
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item mr-3">
                                <p class="text-muted mb-0"><i class="mdi mdi-map-marker mr-2"></i> {{$company->company_location}}</p>
                            </li>

                            <li class="list-inline-item">
                                <p class="text-success mb-0"><i class="mdi mdi-home-modern mdi-18px mr-2"></i>{{$industry->industry_name}}</p>
                            </li>
                        </ul>

                        <ul class="list-inline mb-2">
{{--                            <li class="list-inline-item mr-3 ">--}}
{{--                                <p class="text-muted"><i class="mdi mdi-earth mr-2"></i>{{$company->company_email}}</p>--}}
{{--                            </li>--}}

                            <li class="list-inline-item mr-3">
                                <p class="text-muted"><i class="mdi mdi-email mr-2"></i>{{$company->company_email}}</p>
                            </li>

                            <li class="list-inline-item">
                                <p class="text-muted"><i class="mdi mdi-cellphone-iphone mr-2"></i>{{$company->person_phone}}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 mt-4 pt-2">
                    <h4>A que nos dedicamos :</h4>
                    <div class="rounded border p-4 mt-3">
                        <p class="text-muted">{{$company->company_desciption}}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop