@extends('frontend.layouts.master')
@section('content')


    <section class="bg-half page-next-level">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center text-white">
                        <img src="{{asset('asset/frontend/images/busqueda-empleo.png')}}" alt="fuerzainclusiva.com">
                        <h4 class="text-uppercase title mb-4">Mis postulaciones</h4>
                        <ul class="page-next d-inline-block mb-0">
                            <li><a href="{{route('jobs')}}" class="text-uppercase font-weight-bold">Inicio</a></li>
                            <li><a href="#" class="text-uppercase font-weight-bold">Trabajos</a></li>
                            <li>
                                <span class="text-uppercase text-white font-weight-bold">Mis postulaciones</span>
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
                        @foreach($aplications AS $aplication)
                            <div class="col-lg-4 col-md-6 mt-4 pt-2">
                                <div class="list-grid-item rounded">
                                    <div class="grid-item-content p-3">

                                        <div class="grid-list-img mt-3">

                                            @if($aplication->company_logo)
                                                    <img src="{{ asset('storage/company/' .$aplication->company_logo)}}" alt="{{$aplication->company_slug}}"
                                                         class="img-fluid d-block" style="border-radius: 90px; width: 100px;">
                                            @else
                                                <img src="https://via.placeholder.com/300X300//88929f/5a6270C/O https://placeholder.com/"
                                                     height="150" alt="" class="img-fluid d-block">
                                            @endif


                                        </div>

                                        <div class="grid-list-desc mt-3">
                                            <h5 class="mb-1">
                                                <a href="{{url('job-detail/'.Crypt::encryptString($aplication->job_slug.'-'.$aplication->id))}}" class="text-dark">
                                                    {{$aplication->job_title}}
                                                </a>
                                            </h5>
                                            <p class="text-muted f-14 mb-1">
                                                @if($aplication->gender==\App\Models\PublishedJobs::GENDER_M)
                                                    <i class="mdi mdi-gender-male mr-2"></i>
                                                @endif

                                                @if($aplication->gender==\App\Models\PublishedJobs::GENDER_F)
                                                    <i class="mdi mdi-gender-female mr-2"></i>
                                                @endif

                                                @if($aplication->gender==\App\Models\PublishedJobs::GENDER_O)
                                                    <i class="mdi mdi-human-male-female mr-2"></i>
                                                @endif

                                                {{ucfirst(mb_strtolower($aplication->gender))}}
                                            </p>

                                            <p class="text-muted mb-1">
                                                <i class="mdi mdi-cash-usd mr-2"></i> {{$aplication->minimum_salary .' - '.$aplication->maximum_salary}}
                                            </p>

                                            <p class="text-muted mb-1">
                                                <i class="mdi mdi-timer mr-2"></i>
                                                {{ucfirst(mb_strtolower($aplication->job_time))}} {{ucfirst(mb_strtolower($aplication->schedule))}}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="apply-button p-3 border-top">
                                        <i class="mdi mdi-calendar mr-2"></i>
                                        {{date('d/m/Y', strtotime($aplication->created_at))}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 mt-4 pt-2">
                    @if (isset($aplications))
                        {{ $aplications->appends(((isset($filter)) ? $filter : ''))->links() }}
                    @endif
                </div>
            </div>
        </div>
    </section>

@stop