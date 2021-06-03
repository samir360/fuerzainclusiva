<script type='text/javascript'>

    function refresh() {
        window.location.href = "{{ route('faq') }}";
    }

    $("body").on('submit', '#form-faq', function (event) {

        event.preventDefault()
        if ($('#form-faq').valid()) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#loading').show();
            $('.botones').attr('disabled', true);

            var formData = new FormData(document.getElementById("form-faq"));
            var ruta = $("input[name='ruta']").val();

            if (ruta == 'store') {
                var rutaController = "{{ route('store-faq') }}";
            } else {
                var rutaController = "{{ route('update-faq') }}";
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

                    if(respuesta.edit){
                        refresh();
                    }

                    setTimeout(function () {
                        $('#form-faq')[0].reset();
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
        var rutaController = "{{ route('destroy-faq') }}";

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
