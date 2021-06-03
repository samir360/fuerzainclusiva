@if(count($institutions) > 0)
    <div class="col-md-12 text-left"><h5>Grado de instrucción agregados </h5></div>

    @foreach($institutions AS $items)
        <div class="col-md-12 text-left">
            <i class="fa fa-trash" style="color: #999999; cursor: pointer" onclick="deleteInstituttion({{$items->id}})"></i>
            {{$items->institution_name}} / {{$items->obtained_title}}
        </div>
    @endforeach
@endif