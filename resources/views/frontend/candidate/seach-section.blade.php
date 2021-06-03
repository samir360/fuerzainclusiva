<style>
    #s2id_country_id{
        width: 300px!important;
    }
</style>

<section class="bg-home bg-half">
    <div class="bg-overlay"></div>
    <div class="home-center">
        <div class="home-desc-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="title-heading text-center text-white">
                            <img src="{{asset('asset/frontend/images/busqueda-postulantes.png')}}" alt="fuerzainclusiva.com">
                            <h6 class="small-title text-uppercase text-light mb-3">Encuentra los mejores frelance</h6>
                            <h1 class="heading font-weight-bold mb-4">La forma más eficiente de conseguir candidatos</h1>
                        </div>
                    </div>
                </div>

                <div class="home-form-position">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="home-registration-form p-4 mb-3">
                                <form class="registration-form" action="{{route('candidate-list')}}">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-6">
                                            <div class="registration-form-box">

                                                <div class="registration-form-box">
                                                    <input type="text" id="search" name="filter[search]" class="form-control" placeholder="Nombres...">
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-6">
                                            <div class="registration-form-box">
                                                <select id="country_id" name="filter[country_id]" class="select-multiple">
                                                    <option value="">Provincias</option>
                                                    @foreach($countries AS $country)
                                                        <option value="{{$country['id']}}"
                                                                {{((isset($filterJobs) and $filterJobs['country_id']==$country['id']) ? 'selected' : '')}}>
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
                                                                {{isset($filterJobs) and $filterJobs['education_id']==$items->id ? 'selected' : ''}} >
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
        </div>
    </div>
</section>

<script type="application/javascript">
    $(document).ready(function () {
        $('.select-multiple').select2();
    });
</script>