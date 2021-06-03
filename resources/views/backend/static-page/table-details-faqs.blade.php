<table class="table table-hover text-nowrap">    <thead>    <tr>        <th>Opciones</th>        <th>Preguntas</th>        <th class="text-center">Orden</th>        <th class="text-center">Estatus</th>    </tr>    </thead>    <tbody>    @if(count($faqs)>0)        @foreach($faqs AS $items)            <tr data-id="{{$items->id}}" style="cursor: move">                <td>                    <div class="btn-group">                        <button type="button" class="btn btn-secondary btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">                            <span class="sr-only">Toggle Dropdown</span>                            <div class="dropdown-menu" role="menu" id="{{$items->id}}">                                <a class="dropdown-item edit-register" data-id="{{$items->id}}"> <i class="fa fa-edit"></i> Editar</a>                                <a class="dropdown-item delete-register" data-id="{{$items->id}}"> <i class="fa fa-trash"></i> Eliminar</a>                            </div>                        </button>                    </div>                </td>                <td>{{$items->question }}</td>                <td class="text-center">{{$items->orden}}</td>                <td class="text-center">                    @if($items->faq_status == \App\Models\StaticPage::STATIC_PAGE_ACTIVE)                        <span class="badge bg-green">{{\App\Models\StaticPage::STATIC_PAGE_ACTIVE}}</span>                    @else                        <span class="badge bg-red">{{\App\Models\StaticPage::STATIC_PAGE_INACTIVE}}</span>                    @endif                </td>            </tr>        @endforeach()    @else        <tr>            <td colspan="5">                @foreach ($errors->all() as $error)                    <div class="alert alert-info alert-dismissible">                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>                        <p><i class="icon fas fa-info"></i> {{ $error }}</p>                    </div>                @endforeach            </td>        </tr>    @endif    </tbody></table><script type='text/javascript'>    $(document).ready(function () {        $(".edit-register").on("click", function () {            var dataId = $(this).attr("data-id");            var url = '{{ route("edit-faq", ":id") }}';            url = url.replace(':id', dataId);            window.location.href = url;        });        $(".delete-register").on("click", function () {            var dataId = $(this).attr("data-id");            modalDelete(dataId);        });        $("table tbody").sortable({            update: function (event, ui) {                var arrayId = [];                $(this).children().each(function (index) {//$(this).find('td').last().html(index + 1);                    var id = $(this).attr("data-id");                    if (typeof (id) != 'undefined') {                        arrayId.push(id);                    }                });                $.ajaxSetup({                    beforeSend: function (xhr, type) {                        if (!type.crossDomain) {                            xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));                        }                    },                });                var url = "{{ route('update-faq') }}";                $.ajax({                    type: "POST",                    url: url,                    data: {'arrayId': JSON.stringify(arrayId)},//capturo array                    success: function (respuesta) {                        if (respuesta.status == 'success') {                            var url = "{{ route('faq-details') }}";                            $('#table-faqs').load(url);                        }                    }                });            }        });    });</script>