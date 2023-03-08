<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php init_head(); ?>

<div id="wrapper">
	<div class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="panel-s">
					<div class="panel-body">
						<h3>Agregar nuevo recipe</h3>

						<hr>

						<form action="/admin/recipes/store" method="POST">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="id_client">Paciente</label>
										<select name="id_client" class="form-control">
											<option value=""></option>

											<?php foreach ($pacientes as $pacient): ?>
												<option value="<?php echo $pacient->userid; ?>"><?php echo $pacient->company; ?></option>
											<?php endforeach; ?>
										</select>
									</div>	
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label for="id_professional">Profesional</label>
										<select name="id_professional" class="form-control">
											<option value=""></option>

											<?php foreach ($profesionales as $profesional): ?>
												<option value="<?php echo $profesional->staffid; ?>"><?php echo $profesional->firstname . ' ' . $profesional->lastname; ?></option>
											<?php endforeach; ?>
										</select>
									</div>	
								</div>

								<hr>

								<div class="col-md-12">
									<label for="descripcion">Descripción</label>
									<textarea name="descripcion" class="form-control"></textarea>
								</div>

								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

								<div class="col-md-12" style="margin-top: 30px">
									<input type="submit" class="btn btn-primary" value="Registrar">
									<a href="/admin/recipes" class="btn btn-dnager">Atrás</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php init_tail(); ?>
