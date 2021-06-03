<script type='text/javascript'>

    $(document).ready(function () {
        $(".edit-register").on("click", function () {
            var dataId = $(this).attr("data-id");
            var url = '{{ route("edit_submenu", ":id") }}';
            url = url.replace(':id', dataId);
            window.location.href = url;
        });

        $(".delete-register").on("click", function () {
            var dataId = $(this).attr("data-id");
            modalDelete(dataId);
        });
    });

    function refresh() {
        window.location.href = "{{ route('submenu') }}";
    }

    $("body").on('submit', '#form-sub-menu', function (event) {

        event.preventDefault()
        if ($('#form-sub-menu').valid()) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#loading').show();
            $('.botones').attr('disabled', true);

            var rutaController = "{{ route('updateSubMenu') }}";

            var formData = new FormData(document.getElementById("form-sub-menu"));

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
                            refresh();
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
        var rutaController = "{{ route('destroyMenu') }}";

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
</script>
