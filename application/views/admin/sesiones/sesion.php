<div class="modal" tabindex="-1" id="<?php echo 'sesion_' . $sesion->id; ?>" role="dialog">
  <div class="modal-dialog" role="document">
    <?php echo form_open('/admin/sesiones/actualizar', ['method' => 'POST']); ?>
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Realizar sesión</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
                <p>¿Está seguro que desea realizar la sesión?</p>
                <input type="hidden" name="id" value="<?php echo $sesion->id; ?>">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" onClick="saveCanvas_<?php echo $sesion->id; ?>()" class="btn btn-primary">Confirmar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
    <?php echo form_close(); ?>
  </div>
</div>