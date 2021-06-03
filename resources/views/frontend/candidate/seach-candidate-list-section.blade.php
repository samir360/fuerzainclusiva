<style>
    #s2id_country_id{
        width: 270px!important;
    }
</style>

<section class="bg-half page-next-level">
    <div class="bg-overlay"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="text-center text-white">
                    <img src="{{asset('asset/frontend/images/busqueda-postulantes.png')}}" alt="fuerzainclusiva.com">
                    <h4 class="text-uppercase title mb-4">Candidatos</h4>
                    <ul class="page-next d-inline-block mb-0">
                        <li><a href="{{route('candidate')}}" class="text-uppercase font-weight-bold">Inicio</a></li>
                        <li><a href="#" class="text-uppercase font-weight-bold">Perfil</a></li>
                        <li>
                            <span class="text-uppercase text-white font-weight-bold">Candidatos</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>



<div class="container">
    <div class="home-form-position">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="home-registration-form job-list-reg-form bg-light shadow p-4">
                    <form class="registration-form" action="{{route('candidate-list')}}">
                        <div class="row">

                            <div class="col-lg-3 col-md-6">
                                <div class="registration-form-box">
                                    <input type="text" id="search" name="filter[search]" class="form-control" placeholder="Nombres..."
                                    value="{{((isset($filter['search'])) ? $filter['search'] : '')}}">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="registration-form-box">
                                    <select id="country_id" name="filter[country_id]" class="select-multiple">
                                        <option value="">Provincias</option>
                                        @foreach($countries AS $country)
                                            <option value="{{$country['id']}}"
                                                    {{((isset($filter['country_id']) and $filter['country_id']==$country['id']) ? 'selected' : '')}}>
                                                {{ucfirst(mb_strtolower($country['name']))}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <div class="registration-form-box">
                                    <select id="education_id" name="filter[education_id]" class="select-multiple">
                                        <option value="">Educación...</option>
                                        @foreach($education AS $items)
                                            <option value="{{$items->id}}"
                                                    {{isset($filter['education_id']) and $filter['education_id']==$items->id ? 'selected' : ''}} >
                                                {{$items->education_name}}
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

<script type="application/javascript">
    $(document).ready(function () {
        $('.select-multiple').select2();
    });
</script>