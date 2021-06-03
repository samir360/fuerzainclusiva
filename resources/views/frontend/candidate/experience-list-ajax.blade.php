@if(count($experiences) > 0)
    <div class="col-md-12 text-left"><h5>Experiencia laboral agregadas </h5></div>

    @php
        $experience=null;
    @endphp
    @foreach($experiences AS $experience)

        @php
            $industries=$experience->industry
        @endphp

        <div class="col-md-12 text-left">
            <i class="fa fa-trash" style="color: #999999; cursor: pointer" onclick="deleteExperience({{$experience->id}})"></i>
            {{$experience->company_name}} / {{$industries->industry_name}} / {{$experience->company_functions}} / {{'Años: '.$experience->number_of_years}}
        </div>
    @endforeach
@endif