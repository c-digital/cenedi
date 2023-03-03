<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php init_head(); ?>

<div id="wrapper">
   <div class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="panel_s">
               <div class="panel-body">
                  <div class="_buttons">
                     <form action="">
                        <table>
                           <tr>
                              <td>
                                 <!-- <a href="/admin/consultas/crear" class="btn btn-info">
                                    Nueva consulta
                                 </a> -->

                                 <div class="dropdown">
                                   <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                     Nueva consulta
                                     <span class="caret"></span>
                                   </button>
                                   <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                     <li><a href="/admin/consultas/crear?tipo=neurologia">Neurologia</a></li>
                                     <li><a href="/admin/consultas/crear?tipo=diabetes">Diabetes</a></li>
                                   </ul>
                                 </div>
                              </td>
                           </tr>

                           <tr>
                              <td>&nbsp;</td>
                           </tr>

                           <tr>
                              <td>
                                 Estado
                              </td>

                              <td>&nbsp;</td>

                              <td>
                                 Nombre del paciente
                              </td>

                              <td>&nbsp;</td>

                              <td>
                                 Fecha desde
                              </td>

                              <td>&nbsp;</td>

                              <td>
                                 Fecha hasta
                              </td>
                           </tr>

                           <tr>
                              <td>
                                 <select name="estado" class="form-control">
                                    <option value=""></option>
                                    <option <?php echo (isset($_GET['estado']) && $_GET['estado'] == 'Pendiente') ? 'selected' : ''; ?> value="Pendiente">Pendiente</option>
                                    <option <?php echo (isset($_GET['estado']) && $_GET['estado'] == 'En atención') ? 'selected' : ''; ?> value="En atención">En atención</option>
                                    <option <?php echo (isset($_GET['estado']) && $_GET['estado'] == 'Terminada') ? 'selected' : ''; ?> value="Terminada">Terminada</option>
                                    <option <?php echo (isset($_GET['estado']) && $_GET['estado'] == 'Cancelada') ? 'selected' : ''; ?> value="Cancelada">Cancelada</option>
                                 </select>
                              </td>

                              <td>&nbsp;</td>

                              <td>
                                 <input type="text" name="paciente" value="<?php echo (isset($_GET['paciente'])) ? $_GET['paciente'] : ''; ?>" class="form-control">
                              </td>

                              <td>&nbsp;</td>

                              <td>
                                 <input type="date" placeholder="Fecha desde" name="fecha_desde" value="<?php echo (isset($_GET['fecha_desde'])) ? $_GET['fecha_desde'] : ''; ?>" class="form-control">
                              </td>

                              <td>&nbsp;</td>

                              <td>
                                 <input type="date" placeholder="Fecha hast" name="fecha_hasta" value="<?php echo (isset($_GET['fecha_hasta'])) ? $_GET['fecha_hasta'] : ''; ?>" class="form-control">
                              </td>

                              <td>&nbsp;</td>

                              <td>
                                 <button type="submit" class="btn btn-default"><i class="fa fa-eye"></i> Buscar</button>
                              </td>
                           </tr>
                        </table>
                     </form>

                     <div class="visible-xs">
                        <div class="clearfix"></div>
                     </div>
                  </div>

                  <div class="clearfix"></div>

                  <hr class="hr-panel-heading" />

                  <div class="clearfix mtop20"></div>

                  <div class="table-responsive">
                      <table class="table table-striped table-bordeless">
                          <thead>
                              <tr>
                                  <th>ID</th>
                                  <th>Paciente</th>
                                  <th>Profesional</th>
                                  <th>Fecha</th>
                                  <th>Tipo</th>
                                  <th>Estado</th>
                                  <th>Acciones</th>
                              </tr>
                          </thead>

                          <tbody>
                              <?php foreach ($consultas as $consulta): ?>
                                <tr>
                                    <td><?php echo $consulta->id; ?></td>
                                    <td><?php echo $consulta->paciente; ?></td>
                                    <td><?php echo $consulta->profesional; ?></td>
                                    <td><?php echo $consulta->fecha; ?></td>
                                    <td><?php echo $consulta->tipo; ?></td>
                                    <td><?php echo ($consulta->estado) ? $consulta->estado : 'En espera'; ?></td>
                                    <td>
                                       <?php if (!$consulta->estado): ?>
                                          <a class="btn btn-default btn-xs" href="/admin/consultas/editar/<?php echo $consulta->id; ?>?estado=En atención">
                                             <i class="fa fa-check"></i> Atender
                                          </a>

                                          <a class="btn btn-default btn-xs" href="/admin/consultas/editar/<?php echo $consulta->id; ?>?estado=Cancelar">
                                             <i class="fa fa-times"></i> Cancelar
                                          </a>
                                       <?php endif; ?>

                                       <a class="btn btn-default btn-xs" href="/admin/consultas/ver/<?php echo $consulta->id; ?>">
                                          <i class="fa fa-eye"></i> Ver
                                       </a>

                                       <a class="btn btn-default btn-xs" href="/admin/consultas/editar/<?php echo $consulta->id; ?>?tipo=<?php echo $consulta->tipo; ?>">
                                          <i class="fa fa-edit"></i> Editar
                                       </a>

                                       <a onclick="confirm_delete(event, this)" class="btn btn-danger btn-xs" href="/admin/consultas/eliminar/<?php echo $consulta->id; ?>">
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
