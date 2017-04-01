

$(document).on("click", ".abre-modal-borrar", function () {
    var titulo_pelicula = ($(this).data('id')).split('|')[0];
    var valoracion_id = ($(this).data('id')).split('|')[1];

    $(".titulo-pelicula").empty().html('<p>'+titulo_pelicula+'</p>');

    var url = document.getElementById('confirmar-borrar').href;

    $('#confirmar-borrar').attr('href', url+valoracion_id);

});

$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

    $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
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







