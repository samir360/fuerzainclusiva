@if(count($references) > 0)

    <div class="col-md-12 text-left"><h5>Referencia personales agregadas </h5></div>

    @foreach($references AS $reference)

        <div class="col-md-12 text-left">
            <i class="fa fa-trash" style="color: #999999; cursor: pointer" onclick="deleteReference({{$reference->id}})"></i>
            {{$reference->full_name}} / {{$reference->reference_phone}} / {{$reference->charge}} / {{$reference->reference_email}}
        </div>
    @endforeach

@endif