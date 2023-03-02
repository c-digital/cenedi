<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php if(isset($client)){ ?>
	<h4 class="customer-profile-group-heading">Consultas</h4>

	<div>
		<a href="/admin/consultas/crear" class="btn btn-info mright5 test pull-left display-block">Nueva consulta</a>
	</div>

	<div style="margin-top: 50px">
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
		      <?php foreach ($consultas as $consulta): ?>
		        <tr>
		            <td><?php echo $consulta->id; ?></td>
		            <td><?php echo $consulta->paciente; ?></td>
		            <td><?php echo $consulta->profesional; ?></td>
		            <td><?php echo $consulta->fecha; ?></td>
		            <td>
		               <a class="btn btn-default btn-xs" href="/admin/consultas/editar/<?php echo $consulta->id; ?>"><i class="fa fa-edit"></i> Editar</a>
		               <a onclick="confirm_delete(event, this)" class="btn btn-danger btn-xs" href="/admin/consultas/eliminar/<?php echo $consulta->id; ?>"><i class="fa fa-trash"></i> Eliminar</a>
		            </td>
		        </tr>
		      <?php endforeach; ?>
		  </tbody>
		</table>
		</div>
	</div>
<?php } ?>

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
