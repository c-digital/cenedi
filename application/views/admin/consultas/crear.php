<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php init_head(); ?>

<div id="wrapper" class="customer_profile">
   <div class="content">
      <div class="row" style="background: white;">
         <?php echo form_open('/admin/consultas/guardar', ['enctype' => 'multipart/form-data', 'method' => 'POST']); ?>
            <div class="col-md-11">
               <h3>Agregar nueva consulta</h3>
            </div>

            <div class="col-md-1">
               <a href="/admin/consultas" title="Volver a atras">
                  <i class="pull-right fa fa-times"></i>
               </a>
            </div>

            <div class="col-md-2">
               <img style="width: 210px; height: 210px" class="img-responsive img-circle user_photo" style="cursor: pointer" src="/assets/images/user-placeholder.jpg" alt="">

               <input type="file" style="display: none;" name="foto_perfil" id="user">
            </div>

            <div class="col-md-8">
               <label for="id_cliente">Paciente</label>
               <select name="id_client" class="form-control">
                  <option value=""></option>
                  <?php foreach ($clientes as $cliente): ?>
                     <option value="<?php echo $cliente->userid; ?>"><?php echo $cliente->company; ?></option>
                  <?php endforeach; ?>
               </select>
            </div>

            <div class="col-md-2">
               <label for="edad">Edad</label>
               <input type="text" class="form-control" name="edad">
            </div>

            <div class="col-md-8" style="margin-top: 20px">
               <label for="id_cliente">Profesional</label>
               <select name="id_staff" class="form-control">
                  <option value=""></option>
                  <?php foreach ($profesionales as $profesional): ?>
                     <option value="<?php echo $profesional->staffid; ?>"><?php echo $profesional->firstname; ?></option>
                  <?php endforeach; ?>
               </select>
            </div>

            <div class="col-md-2" style="margin-top: 20px">
               <label for="monto">Monto a cobrar</label>
               <input type="text" class="form-control" name="monto">
            </div>

            <div class="col-md-12" style="margin-top: 30px; padding-top: 20px; border-top: 1px solid silver">
               <div class="row">
                  <div class="col-md-12">
                     <h4>Anamnesis</h4>
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="anamnesis[general]">Información general</label>
                        <textarea name="anamnesis[general]" cols="30" rows="10" class="form-control"></textarea>
                     </div>

                     <div class="row" style="margin-top: 50px">
                        <div class="col-md-3">
                           <label for="peso">Peso</label>
                           <input type="number" class="form-control" id="peso" name="anamnesis[peso]">
                        </div>

                        <div class="col-md-3">
                           <label for="altura">Altura</label>
                           <input type="number" class="form-control" id="altura" name="anamnesis[altura]">
                        </div>

                        <div class="col-md-3">
                           <label for="imc">IMC</label>
                           <input type="text" readonly id="imc" class="form-control" name="anamnesis[imc]">
                        </div>

                        <div class="col-md-3">
                           <label for="temperatura">Temperatura</label>
                           <input type="text" class="form-control" name="anamnesis[temperatura]">
                        </div>
                     </div>

                     <div class="row" style="margin-top: 10px">
                        <div class="col-md-3">
                           <label for="presion_sanguinea_sistolica">P. anguinea sistolica</label>
                           <input type="text" class="form-control" name="anamnesis[presion_sanguinea_sistolica]">
                        </div>

                        <div class="col-md-3">
                           <label for="presion_sanguinea_diastolica">P. sanguinea diastolica</label>
                           <input type="text" class="form-control" name="anamnesis[presion_sanguinea_diastolica]">
                        </div>

                        <div class="col-md-3">
                           <label for="frecuencia_respiratoria">Frecuencia respiratoria</label>
                           <input type="text" class="form-control" name="anamnesis[frecuencia_respiratoria]">
                        </div>

                        <div class="col-md-3">
                           <label for="frecuencia_cardiaca">Frecuencia cardiaca</label>
                           <input type="text" class="form-control" name="anamnesis[frecuencia_cardiaca]">
                        </div>
                     </div>

                     <div class="row" style="margin-top: 10px">
                        <div class="col-md-3">
                           <label for="imc_20">Exceso de peso, IMC 20</label>
                           <input type="text" class="form-control" name="anamnesis[imc_20]">
                        </div>

                        <div class="col-md-3">
                           <label for="imc_30">Exceso de peso, IMC 30</label>
                           <input type="text" class="form-control" name="anamnesis[imc_30]">
                        </div>
                     </div>

                     <div class="row" style="margin-top: 30px">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label for="examen_fisico">Examen físico</label>
                              <textarea name="anamnesis[examen_fisico]" cols="30" rows="10" class="form-control"></textarea>
                           </div>
                        </div>
                     </div>

                     <div class="row" style="margin-top: 30px">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label for="diagnostico">Diagnostico</label>
                              <textarea name="anamnesis[diagnostico]" cols="30" rows="10" class="form-control"></textarea>
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-12" style="margin-top: 30px">
                           <div class="form-group">
                              <label for="cie10">CIE-10</label>
                              <select style="height: 150px" name="anamnesis[cie10]" class="form-control">
                                 <?php foreach ($enfermedades as $enfermedad): ?>
                                    <option value="<?php echo $enfermedad->codigo . ' - ' . $enfermedad->descripcion; ?>"><?php echo $enfermedad->codigo . ' - ' . $enfermedad->descripcion; ?></option>
                                 <?php endforeach; ?>
                              </select>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="anamnesis">Actividad fisica</label>
                        <input class="form-control" name="anamnesis[actividad_fisica]">
                     </div>

                     <div class="form-group">
                        <label for="anamnesis">Etilismo</label>
                        <input class="form-control" name="anamnesis[etilismo]">
                     </div>

                     <div class="form-group">
                        <label for="anamnesis">Fumador</label>
                        <input class="form-control" name="anamnesis[fumador]">
                     </div>

                     <div class="form-group">
                        <label for="anamnesis">Drogas</label>
                        <input class="form-control" name="anamnesis[drogas]">
                     </div>

                     <div class="form-group">
                        <label for="anamnesis">Alergias</label>
                        <input class="form-control" name="anamnesis[alergias]">
                     </div>

                     <div class="form-group">
                        <label for="anamnesis">Diabetes</label>
                        <input class="form-control" name="anamnesis[diabetes]">
                     </div>

                     <div class="form-group">
                        <label for="anamnesis">Enfermedades cronicas</label>
                        <input class="form-control" name="anamnesis[enfermedades_cronicas]">
                     </div>

                     <div class="form-group">
                        <label for="anamnesis">Hipertension</label>
                        <input class="form-control" name="anamnesis[hipertension]">
                     </div>

                     <div class="form-group">
                        <label for="anamnesis">Neoplasma</label>
                        <input class="form-control" name="anamnesis[neoplasma]">
                     </div>

                     <div class="form-group">
                        <label for="anamnesis">Medicamentos a pedido</label>
                        <input class="form-control" name="anamnesis[medicamentos_pedido]">
                     </div>

                     <div class="form-group">
                        <label for="anamnesis">Metodos anticonceptivos</label>
                        <input class="form-control" name="anamnesis[metodos_anticonceptivos]">
                     </div>

                     <div class="form-group" style="margin-top: 30px">
                        <div class="panel panel-default">
                           <div class="panel-heading">Fotos</div>

                           <div class="panel-body">
                              <input type="file" multiple name="fotos[]">
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-md-12">
                     <div class="form-group">
                        <label for="prescripcion_medica">Prescripcion medica</label>
                        <textarea cols="30" rows="10" name="anamnesis[prescripcion_medica]" class="form-control"></textarea>
                     </div>
                  </div>

                  <div class="col-md-12">
                     <button type="submit" class="btn btn-info">Registrar consulta</button>
                  </div>
               </div>
            </div>
         <?php echo form_close(); ?>
      </div>
   </div>
</div>

<?php init_tail(); ?>

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

      $('.img-circle').click(function () {
         $('[name=foto_perfil]').click();
      });

      function imc() {
         peso = $('#peso').val();
         altura = $('#altura').val();

         if (peso != '') {
            peso = parseInt(peso);
         }

         if (altura != '') {
            altura = parseInt(altura);
         }

         if (peso != '' && altura == '') {
            $('#imc').val(peso);
         }

         if (altura != '' && peso == '') {
            $('#imc').val(altura * altura);
         }

         if (peso != '' && altura != '') {
            $('#imc').val(peso + (altura * altura));
         }
      }

      $('#peso').change(function () {
         imc();
      });

      $('#altura').change(function () {
         imc();
      });

      $('[name=id_client]').on('change', function () {
         value = $(this).val();
         console.log(value);

         $.ajax({
            type: 'POST',
            url: '/admin/consultas/foto',
            data: {
               id: value
            },
            success: function (response) {
               $('.user_photo').attr('src', response);
            }
         });
      });
   });
</script>

</body>
</html>
