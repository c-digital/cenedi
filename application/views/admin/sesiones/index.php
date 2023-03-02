<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php init_head(); ?>

<div id="wrapper">
   <div class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="panel_s">
               <div class="panel-body">
                  <div class="_buttons">
                     <div class="visible-xs">
                     </div>
                  </div>

                  <h3>
                     Sesiones
                  </h3>

                  <form>
                     <div class="input-group">
                        <input style="width: 100%" type="text" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" name="search" placeholder="Ingrese el nombre del paciente a buscar...">

                        <div class="input-group-btn">
                           <button class="btn btn-default"> <i class="fa fa-search"></i> Buscar</button>
                        </div>
                     </div>
                  </form>

                  <hr class="hr-panel-heading">

                  <div class="table-responsive">
                      <table class="table table-striped table-bordeless">
                          <thead>
                              <tr>
                                  <th>ID</th>
                                  <th>Cliente</th>
                                  <th>Tratamiento</th>
                                  <th>Estado</th>
                                  <th>Acciones</th>
                              </tr>
                          </thead>

                          <tbody>
                              <?php foreach ($sesiones as $sesion): ?>
                                <tr>
                                    <td><?php echo $sesion->id; ?></td>
                                    <td><?php echo $sesion->paciente; ?></td>
                                    <td><?php echo $sesion->tratamiento; ?></td>
                                    <td><?php echo count(json_decode($sesion->realizados, true)) . ' sesiones realizadas de ' . $sesion->cantidad . ' contradas'; ?></td>
                                    <td>
                                       <?php if (count(json_decode($sesion->realizados, true)) < $sesion->cantidad): ?>
                                          <a class="btn btn-default btn-xs" href="#" data-toggle="modal" data-target="<?php echo '#sesion_' . $sesion->id ?>">
                                             <i class="fa fa-check"></i> Realizar sesión
                                          </a>
                                       <?php endif; ?>

                                       <a class="btn btn-default btn-xs" href="#" data-toggle="modal" data-target="<?php echo '#info_' . $sesion->id ?>">
                                          <i class="fa fa-list"></i> Información
                                       </a>
                                    </td>
                                </tr>

                                <?php include 'sesion.php'; ?>
                                <?php include 'info.php'; ?>
                              <?php endforeach; ?>
                          </tbody>
                      </table>
                  </div>

               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<?php init_tail(); ?>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
   function confirm_delete(event, that) {
      event.preventDefault();

      Swal.fire({
        title: 'Estas seguro?',
        text: "Leugo no podras revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Aceptar'
      }).then((result) => {
         if (result.isConfirmed) {
            href = $(that).attr('href');
            window.location.href = href;
         }
      });
   }
</script>

</body>
</html>
