
// function cambioCliente() {
//     alert('hola');
// }

// $('#select_usuario_id').change(function () {
//     if ($('#select_usuario_id').val() != 0)
//         $('#result-btn').empty().html('<button type="summit" class="btn btn-success btn-md btn-block">Aceptar</button>');
//
//     else
//         $('#result-btn').empty();
//
// });
//
// $('#select_usuario_id').change(function () {
//     $("#btn_select_usuario").attr('href', 'home/' + $('#select_usuario_id').val());
//     // $("#btn_select_usuario").attr('href', 'kk');
//
//
// });
//

// Bind click to OK button within popup
$('#confirm-delete').on('click', '.btn-ok', function(e) {

    var $modalDiv = $(e.delegateTarget);
    var id = $(this).data('recordId');
document.getAtt

    $modalDiv.addClass('loading');
    $.post('/api/record/' + id).then(function() {
        $modalDiv.modal('hide').removeClass('loading');
    });
});

// Bind to modal opening to set necessary data properties to be used to make request
// $('#confirm-delete').on('show.bs.modal', function(e) {
//     var data = $(e.relatedTarget).data();
//     $('.title', this).text(data.recordTitle);
//     $('.btn-ok', this).data('recordId', data.recordId);
// });

$(document).on("click", ".abre-modal-borrar", function () {
    var myBookId = $(this).data('id');
    $(".modal-body").empty().html('<p>'+myBookId+'</p>');
});


$('#enviar_valoracion_id').click(function () {
    if ($('#puntuacion_id').val() < 0){
        $('#resultado_valoracion_id').empty().html('<p class="alert alert-warning" role="alert"> Error. Selecciona una valoracion </p> ');
    }
    else{

        if (  document.getElementById('form-update-valoracion') != null) {
            document.getElementById('form-update-valoracion').submit();
        }
        else {
            document.getElementById('form-store-valoracion').submit();
        }
    }

});







