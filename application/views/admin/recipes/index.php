<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php init_head(); ?>

<div id="wrapper">
   <div class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="panel_s">
               <div class="panel-body">
                  <table>
                     <tr>
                        <td width="100%">
                           <h4>Recipes</h4>
                        </td>

                        <td>
                           <a href="/admin/recipes/create" class="btn btn-primary">Nuevo recipe</a>
                        </td>
                     </tr>
                  </table>

                  <hr class="hr-panel-heading" />

                  <div class="table-responsive">
                      <table class="table table-striped table-bordeless">
                          <thead>
                              <tr>
                                  <th>ID</th>
                                  <th>Paciente</th>
                                  <th>Profesional</th>
                                  <th>Fecha</th>
                                  <th>Acciones</th>
                              </tr>
                          </thead>

                          <tbody>
                              <?php foreach ($recipes as $recipe): ?>
                                <tr>
                                    <td><?php echo $recipe->id; ?></td>
                                    <td><?php echo $recipe->paciente; ?></td>
                                    <td><?php echo $recipe->profesional; ?></td>
                                    <td><?php echo $recipe->fecha; ?></td>
                                    <td>
                                       <a class="btn btn-default btn-xs" target="_blank" href="/admin/recipes/print/<?php echo $recipe->id; ?>">
                                          <i class="fa fa-eye"></i> Ver
                                       </a>

                                       <a class="btn btn-default btn-xs" href="/admin/recipes/edit/<?php echo $recipe->id; ?>">
                                          <i class="fa fa-edit"></i> Editar
                                       </a>

                                       <a onclick="confirm_delete(event, this)" class="btn btn-danger btn-xs" href="/admin/consultas/eliminar/<?php echo $recipe->id; ?>">
                                          <i class="fa fa-trash"></i> Eliminar
                                       </a>
                                    </td>
                                </tr>
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
