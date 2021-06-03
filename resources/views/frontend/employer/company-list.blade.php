@extends('frontend.layouts.master')
@section('content')

    <section class="bg-half page-next-level">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center text-white">
                        <h4 class="text-uppercase title mb-4">Mis Compañia</h4>
                        <ul class="page-next d-inline-block mb-0">
                            <li>
                                <a href="{{route('jobs')}}" class="text-uppercase font-weight-bold">Inicio</a>
                            </li>
                            <li>
                                <span class="text-uppercase text-white font-weight-bold">Páginas</span>
                            </li>
                            <li>
                                <span class="text-uppercase text-white font-weight-bold">Mis Compañia</span>
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
                                    <h5 class="text-dark mb-0 pt-2 f-18">Total resultado 0-20</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        @foreach($companies AS $company)

                            @include('frontend.layouts.modal-deleted', ['id' => $company->id])

                            <div class="col-lg-12 mt-4 pt-2">
                                <div class="job-list-box border rounded">
                                    <div class="p-3">
                                        <div class="row align-items-center">
                                            <div class="col-lg-2">
                                                <div class="company-logo-img">

                                                    @if($company->company_logo)

                                                        <img src="{{ asset('storage/company/' .$company->company_logo)}}" alt="{{$company->company_slug}}"
                                                             class="img-fluid mx-auto d-block" style="border-radius: 10px;">
                                                    @else
                                                        <img src="https://via.placeholder.com/300X300//88929f/5a6270C/O https://placeholder.com/"
                                                             height="120" alt="" class="d-block mx-auto shadow rounded-pill mb-4">
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="col-lg-7 col-md-9">
                                                <div class="job-list-desc">
                                                    <h6 class="mb-2"><a href="#" class="text-dark">{{$company->company_name}}</a></h6>
                                                    <p class="text-muted mb-0"><i class="mdi mdi-account-group mr-2"></i>{{$company->person_contact}}</p>
                                                    <ul class="list-inline mb-0">

                                                        <li class="list-inline-item mr-3">
                                                            <p class="text-muted mb-0"><i class="mdi mdi-email mr-2"></i>{{$company->company_email}}</p>
                                                        </li>

                                                        <li class="list-inline-item">
                                                            <p class="text-muted mb-0"><i class="mdi mdi-phone mr-2"></i>{{$company->person_phone}}</p>
                                                        </li>
                                                    </ul>

                                                    @if($company['company_status']==\App\Models\Company::COMPANY_ACTIVE)
                                                        <p class="text-muted mb-0"><i class="mdi mdi-check-circle mr-2"></i>
                                                            {{ucfirst(mb_strtolower($company->company_status))}}
                                                        </p>
                                                    @else
                                                        <p class="text-muted mb-0"><i class="mdi mdi-close-circle mr-2"></i>
                                                            {{ucfirst(mb_strtolower($company->company_status))}}
                                                        </p>
                                                    @endif

                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-md-3">
                                                <div class="job-list-button-sm text-right">
                                                    <a data-toggle="modal" data-target="#modal-deleted-{{$company->id}}" style="cursor: pointer">
                                                        <span class="badge badge-danger">Eliminar</span>
                                                    </a>

                                                    <div class="mt-3">
                                                        <a href="{{url('company-edit/'.$company->company_slug)}}" class="btn btn-sm btn-info">Editar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script type="application/javascript">
        $('.btn-deleted').on('click',function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.post( "{{route('deleted-company')}}", { id: $(this).data("id")})
                .done(function() {
                    location.reload();
                });

        });
    </script>

@stop