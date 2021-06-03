<script type='text/javascript'>

    $(document).ready(function () {
        $(".edit-register").on("click", function () {
            var dataId = $(this).attr("data-id");
            var url = '{{ route("edit_menu", ":id") }}';
            url = url.replace(':id', dataId);
            window.location.href = url;
        });

        $(".delete-register").on("click", function () {
            var dataId = $(this).attr("data-id");
            modalDelete(dataId);
        });


        $("table tbody").sortable({
            update: function (event, ui) {
                var arrayId = [];
                $(this).children().each(function (index) {
                    //$(this).find('td').last().html(index + 1);
                    var id = $(this).attr("data-id");
                    if (typeof (id) != 'undefined') {
                        arrayId.push(id);
                    }
                });

                var url = "{{ route('update-position') }}";
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "POST",
                    url: url,
                    data: {'arrayId': JSON.stringify(arrayId)},//capturo array
                    success: function (respuesta) {
                        if (respuesta.exito_details == 1) {
                            var url = "{{ route('menu-details') }}";
                            $('#dataMenu').load(url);
                        }
                    }
                });
            }
        });

    });

    function refresh() {
        window.location.href = "{{ route('menu') }}";
    }

    $("body").on('submit', '#form-menu', function (event) {

        event.preventDefault()
        if ($('#form-menu').valid()) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#loading').show();
            $('.botones').attr('disabled', true);
            var ruta = $("input[name='ruta']").val();

            if (ruta == 'store') {
                var rutaController = "{{ route('storeMenu') }}";
            } else {
                var rutaController = "{{ route('updateMenu') }}";
            }
            var formData = new FormData(document.getElementById("form-menu"));

            $.ajax({
                type: "POST",
                url: rutaController,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                data: formData,
                success: function (respuesta) {

                    $('#loading').hide();
                    showAlert(respuesta.alert, respuesta.status);

                    if (respuesta.status == 'success') {
                        setTimeout(function () {
                            $('#form-menu')[0].reset();
                        }, 2000);
                    }

                    setTimeout(function () {
                        $('.botones').attr('disabled', false);
                    }, 2000);

                }
            });
        }
    });

    function modalDelete(id) {
        $('#id_eliminar').val(id);
        $('#modal-danger').modal('show');
    }

    function deleteData() {

        var id = $('#id_eliminar').val();
        var rutaController = "{{ route('destroy-menu') }}";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: rutaController,
            cache: false,
            dataType: 'json',
            data: {id: id},
            success: function (respuesta) {
                if (respuesta.exito == 1) {
                    $('#contenidomodal').hide();
                    $('#modal-danger').modal('hide');
                    refresh();
                }
                if (respuesta.error == 1) {
                    MensajeForm('error_sql');
                }
            }
        });
    }

    function mostrarSubdirectorios(tipo) {
        if (tipo == 1) {
            $('#selectSubMenu').hide();
            $('#div_icono').show();
        } else {
            $('#selectSubMenu').show();
            $('#div_icono').hide();
        }
    }
</script>
