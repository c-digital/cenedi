<div class="modal" tabindex="-1" id="<?php echo 'info_' . $sesion->id; ?>" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Información</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Cliente: <?php echo $sesion->paciente; ?></p>
        <p>Nro. factura: <?php echo $sesion->nro_factura; ?></p>
        <p>Tratamiento: <?php echo $sesion->tratamiento; ?></p>
        <p>Cantidad: <?php echo $sesion->cantidad; ?></p>

        <?php if (count(json_decode($sesion->realizados, true))): ?>
          <hr>

          <p><b>Sesiones realizadas:</b></p>

          <?php $i = 1; foreach (json_decode($sesion->realizados) as $item): ?>
            <?php
              $ci = &get_instance();
              $query = $ci->db->query("SELECT * FROM tblstaff WHERE staffid = $item->user");
              $user = $query->row();
              $user = $user->firstname . ' ' . $user->lastname;
            ?>

            <p>Sesion #<?php echo $i; ?></p>
            <p>Fecha: <?php $date = new DateTime($item->date); echo $date->format('d/m/Y'); ?></p>
            <p>Usuario: <?php echo $user; ?></p>
          <?php $i = $i + 1; endforeach; ?>
        <?php endif; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>