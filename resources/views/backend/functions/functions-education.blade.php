<script type='text/javascript'>

    $(document).ready(function () {
        $(".edit-register").on("click", function () {
            var dataId = $(this).attr("data-id");
            var url = '{{ route("edit-educations", ":id") }}';
            url = url.replace(':id', dataId);
            window.location.href = url;
        });

        $(".delete-register").on("click", function () {
            var dataId = $(this).attr("data-id");
            modalDelete(dataId);
        });
    });

    function refresh() {
        window.location.href = "{{ route('educations') }}";
    }

    $("body").on('submit', '#form_education', function (event) {

        event.preventDefault()
        if ($('#form_education').valid()) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#loading').show();
            $('.botones').attr('disabled', true);

            var formData = new FormData(document.getElementById("form_education"));
            var ruta = $("input[name='ruta']").val();

            if (ruta == 'store') {
                var rutaController = "{{ route('store-educations') }}";
            } else {
                var rutaController = "{{ route('update-educations') }}";
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

                    if (ruta == 'update') {
                        refresh();
                    }

                    setTimeout(function () {
                        $('#form_education')[0].reset();
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
        var rutaController = "{{ route('destroy-educations') }}";

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
                    refresh();
                }
                if (respuesta.status == 'fail') {
                    MensajeForm(respuesta.alert);
                }
            }
        });
    }
</script>
