<script type='text/javascript'>

    $(document).ready(function () {
        $(".edit-register").on("click", function () {
            var dataId = $(this).attr("data-id");
            var url = '{{ route("edit-static-page", ":id") }}';
            url = url.replace(':id', dataId);
            window.location.href = url;
        });

        $(".delete-register").on("click", function () {
            var dataId = $(this).attr("data-id");
            modalDelete(dataId);
        });
    });

    function refresh() {
        window.location.href = "{{ route('static-page') }}";
    }

    $("body").on('submit', '#form-static-page', function (event) {

        event.preventDefault()
        if ($('#form-static-page').valid()) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#loading').show();
            $('.botones').attr('disabled', true);

            var formData = new FormData(document.getElementById("form-static-page"));
            var ruta = $("input[name='ruta']").val();

            if (ruta == 'store') {
                var rutaController = "{{ route('store-static-page') }}";
            } else {
                var rutaController = "{{ route('update-static-page') }}";
            }

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

                    setTimeout(function () {
                        $('#form-static-page')[0].reset();
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
        var rutaController = "{{ route('destroy-static-page') }}";

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
                if (respuesta.status == 'success') {
                    $('#contenidomodal').hide();
                    $('#modal-danger').modal('hide');
                    refresh();
                }
                if (respuesta.status == 'fail') {
                    showAlert(respuesta.alert, respuesta.status);
                }
            }
        });
    }
</script>
