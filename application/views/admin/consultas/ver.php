<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php init_head(); ?>

<div id="wrapper" class="customer_profile">
   <div class="content">
      <div class="row" style="background: white;">
         <?php echo form_open('/admin/consultas/modificar', ['enctype' => 'multipart/form-data', 'method' => 'POST']); ?>
            <div class="col-md-11">
               <h3>Ver consulta</h3>
            </div>

            <div class="col-md-1">
               <a href="/admin/consultas" title="Volver a atras">
                  <i class="pull-right fa fa-times"></i>
               </a>
            </div>

            <div class="col-md-2">
               <img style="width: 210px; height: 210px" class="img-responsive img-circle" src="<?php echo ($foto_perfil) ? '/uploads/consultas/' . $foto_perfil : '/assets/images/user-placeholder.jpg' ?>" alt="">
            </div>

            <div class="col-md-8">
               <label for="id_cliente">Paciente</label>
               <select readonly name="id_client" class="form-control">
                  <option value=""></option>
                  <?php foreach ($clientes as $cliente): ?>
                     <option <?php echo ($cliente->userid == $consulta->id_client) ? 'selected' : ''; ?> value="<?php echo $cliente->userid; ?>"><?php echo $cliente->company; ?></option>
                  <?php endforeach; ?>
               </select>
            </div>

            <div class="col-md-2">
               <label for="edad">Edad</label>
               <input readonly type="text" class="form-control" name="edad" value="<?php echo $consulta->edad; ?>">
            </div>

            <div class="col-md-8" style="margin-top: 20px">
               <label for="id_cliente">Profesional</label>
               <select readonly name="id_staff" class="form-control">
                  <option value=""></option>
                  <?php foreach ($profesionales as $profesional): ?>
                     <option <?php echo ($profesional->staffid == $consulta->id_staff) ? 'selected' : ''; ?> value="<?php echo $profesional->staffid; ?>"><?php echo $profesional->firstname; ?></option>
                  <?php endforeach; ?>
               </select>
            </div>

            <div class="col-md-2" style="margin-top: 20px">
               <label for="monto">Monto a cobrar</label>
               <input readonly type="text" class="form-control" name="monto" value="<?php echo $consulta->monto; ?>">
            </div>

            <div class="col-md-12" style="margin-top: 30px; padding-top: 20px; border-top: 1px solid silver">
               <div class="row">
                  <div class="col-md-12">
                     <h4>Anamnesis</h4>
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="anamnesis[general]">Información general</label>
                        <textarea readonly name="anamnesis[general]" cols="30" rows="10" class="form-control"><?php echo $anamnesis->general; ?></textarea>
                     </div>

                     <div class="row" style="margin-top: 50px">
                        <div class="col-md-3">
                           <label for="peso">Peso</label>
                           <input readonly type="text" class="form-control" name="anamnesis[peso]" value="<?php echo $anamnesis->peso; ?>">
                        </div>

                        <div class="col-md-3">
                           <label for="altura">Altura</label>
                           <input readonly type="text" class="form-control" name="anamnesis[altura]" value="<?php echo $anamnesis->altura; ?>">
                        </div>

                        <div class="col-md-3">
                           <label for="imc">IMC</label>
                           <input readonly type="text" class="form-control" name="anamnesis[imc]" value="<?php echo $anamnesis->imc; ?>">
                        </div>

                        <div class="col-md-3">
                           <label for="temperatura">Temperatura</label>
                           <input readonly type="text" class="form-control" name="anamnesis[temperatura]" value="<?php echo $anamnesis->temperatura; ?>">
                        </div>
                     </div>

                     <div class="row" style="margin-top: 10px">
                        <div class="col-md-3">
                           <label for="presion_sanguinea_sistolica">P. anguinea sistolica</label>
                           <input readonly type="text" class="form-control" name="anamnesis[presion_sanguinea_sistolica]" value="<?php echo $anamnesis->presion_sanguinea_sistolica; ?>">
                        </div>

                        <div class="col-md-3">
                           <label for="presion_sanguinea_diastolica">P. sanguinea diastolica</label>
                           <input readonly type="text" class="form-control" name="anamnesis[presion_sanguinea_diastolica]" value="<?php echo $anamnesis->presion_sanguinea_diastolica; ?>">
                        </div>

                        <div class="col-md-3">
                           <label for="frecuencia_respiratoria">Frecuencia respiratoria</label>
                           <input readonly type="text" class="form-control" name="anamnesis[frecuencia_respiratoria]" value="<?php echo $anamnesis->frecuencia_respiratoria; ?>">
                        </div>

                        <div class="col-md-3">
                           <label for="frecuencia_cardiaca">Frecuencia cardiaca</label>
                           <input readonly type="text" class="form-control" name="anamnesis[frecuencia_cardiaca]" value="<?php echo $anamnesis->frecuencia_cardiaca; ?>">
                        </div>
                     </div>

                     <div class="row" style="margin-top: 10px">
                        <div class="col-md-3">
                           <label for="imc_20">Exceso de peso, IMC 20</label>
                           <input readonly type="text" class="form-control" name="anamnesis[imc_20]" value="<?php echo $anamnesis->imc_20; ?>">
                        </div>

                        <div class="col-md-3">
                           <label for="imc_30">Exceso de peso, IMC 30</label>
                           <input readonly type="text" class="form-control" name="anamnesis[imc_30]" value="<?php echo $anamnesis->imc_30; ?>">
                        </div>
                     </div>

                     <div class="row" style="margin-top: 30px">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label for="examen_fisico">Examen físico</label>
                              <textarea readonly name="anamnesis[examen_fisico]" cols="30" rows="10" class="form-control"><?php echo $anamnesis->examen_fisico; ?></textarea>
                           </div>
                        </div>
                     </div>

                     <div class="row" style="margin-top: 30px">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label for="diagnostico">Diagnostico</label>
                              <textarea readonly name="anamnesis[diagnostico]" cols="30" rows="10" class="form-control"><?php echo $anamnesis->diagnostico; ?></textarea>
                           </div>
                        </div>
                     </div>

                     <div class="row" style="margin-top: 30px">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label for="cei10">CEI-10</label>
                              <select readonly style="height: 150px" name="anamnesis[cie10]" class="form-control">
                                 <?php foreach ($enfermedades as $enfermedad): ?>
                                    <option <?php echo (isset($anamnesis->cie10) and in_array($enfermedad->codigo . ' - ' . $enfermedad->descripcion, $anamnesis->cie10)) ? 'selected' : ''; ?> value="<?php echo $enfermedad->codigo . ' - ' . $enfermedad->descripcion; ?>"><?php echo $enfermedad->codigo . ' - ' . $enfermedad->descripcion; ?></option>
                                 <?php endforeach; ?>
                              </select>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="anamnesis">Actividad fisica</label>
                        <input readonly class="form-control" name="anamnesis[actividad_fisica]" value="<?php echo $anamnesis->actividad_fisica; ?>">
                     </div>

                     <div class="form-group">
                        <label for="anamnesis">Etilismo</label>
                        <input readonly class="form-control" name="anamnesis[etilismo]" value="<?php echo $anamnesis->etilismo; ?>">
                     </div>

                     <div class="form-group">
                        <label for="anamnesis">Fumador</label>
                        <input readonly class="form-control" name="anamnesis[fumador]" value="<?php echo $anamnesis->fumador; ?>">
                     </div>

                     <div class="form-group">
                        <label for="anamnesis">Drogas</label>
                        <input readonly class="form-control" name="anamnesis[drogas]" value="<?php echo $anamnesis->drogas; ?>">
                     </div>

                     <div class="form-group">
                        <label for="anamnesis">Alergias</label>
                        <input readonly class="form-control" name="anamnesis[alergias]" value="<?php echo $anamnesis->alergias; ?>">
                     </div>

                     <div class="form-group">
                        <label for="anamnesis">Diabetes</label>
                        <input readonly class="form-control" name="anamnesis[diabetes]" value="<?php echo $anamnesis->diabetes; ?>">
                     </div>

                     <div class="form-group">
                        <label for="anamnesis">Enfermedades cronicas</label>
                        <input readonly class="form-control" name="anamnesis[enfermedades_cronicas]" value="<?php echo $anamnesis->enfermedades_cronicas; ?>">
                     </div>

                     <div class="form-group">
                        <label for="anamnesis">Hipertension</label>
                        <input readonly class="form-control" name="anamnesis[hipertension]" value="<?php echo $anamnesis->hipertension; ?>">
                     </div>

                     <div class="form-group">
                        <label for="anamnesis">Neoplasma</label>
                        <input readonly class="form-control" name="anamnesis[neoplasma]" value="<?php echo $anamnesis->neoplasma; ?>">
                     </div>

                     <div class="form-group">
                        <label for="anamnesis">Medicamentos a pedido</label>
                        <input readonly class="form-control" name="anamnesis[medicamentos_pedido]" value="<?php echo $anamnesis->medicamentos_pedido; ?>">
                     </div>

                     <div class="form-group">
                        <label for="anamnesis">Metodos anticonceptivos</label>
                        <input readonly class="form-control" name="anamnesis[metodos_anticonceptivos]" value="<?php echo $anamnesis->metodos_anticonceptivos; ?>">
                     </div>

                     <div class="form-group" style="margin-top: 30px">
                        <div class="panel panel-default">
                           <div class="panel-heading">Fotos</div>

                           <div class="panel-body">
                              <?php foreach (json_decode($consulta->fotos) as $foto): ?>
                                 <a href="<?php echo '/uploads/consultas/' . $foto; ?>" data-title="<?php echo $foto; ?>" data-lightbox="fotos">
                                    <img width="25%" src="<?php echo '/uploads/consultas/' . $foto; ?>" alt="">
                                 </a>
                              <?php endforeach; ?>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-md-12">
                     <div class="form-group">
                        <label for="prescripcion_medica">Prescripcion medica</label>
                        <textarea readonly cols="30" rows="10" name="anamnesis[prescripcion_medica]" class="form-control"><?php echo $anamnesis->prescripcion_medica; ?></textarea>
                     </div>
                  </div>
               </div>
            </div>

            <input type="hidden" name="id" value="<?php echo $consulta->id; ?>">
         <?php echo form_close(); ?>
      </div>
   </div>
</div>

<?php init_tail(); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.css" integrity="sha512-Woz+DqWYJ51bpVk5Fv0yES/edIMXjj3Ynda+KWTIkGoynAMHrqTcDUQltbipuiaD5ymEo9520lyoVOo9jCQOCA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" integrity="sha512-k2GFCTbp9rQU412BStrcD/rlwv1PYec9SNrkbQlo6RZCf75l6KcC3UwDY8H5n5hl4v77IDtIPwOk9Dqjs/mMBQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
   $(document).ready(function () {
      $('#user').change(function () {
         input = this;
         if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (event) {
               $('.user_photo').attr('src', event.target.result);
            }
            reader.readAsDataURL(input.files[0]);
         }
      });
   });
</script>

</body>
</html>
