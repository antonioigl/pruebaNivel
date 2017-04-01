{{--Modal confirmar borrado--}}
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Confirmar Borrado</h4>
            </div>

            <div class="modal-body">
                <p>Se borrar&aacute; la valoraci&oacute;n de la pel&iacute;cula: <strong><span class="titulo-pelicula"></span></strong></p>
                <p>¿Est&aacute;s seguro?</p>
                <p class="debug-url"></p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-danger btn-ok" href="valoracion-remove/" id="confirmar-borrar">Borrar</a>
            </div>
        </div>
    </div>
</div>