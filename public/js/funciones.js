
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

$('#enviar_valoracion_id').click(function () {
    if ($('#puntuacion_id').val() < 0){
        $('#resultado_valoracion_id').empty().html('<p class="alert alert-warning" role="alert"> Error. Selecciona una valoracion </p> ');
    }
    else{
       document.getElementById('valoraciones_form_id').submit();
    }



});







