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

            <?php if ($_GET['tipo'] == 'diabetes'): ?>

               <div class="col-md-12" style="border-top: 0.5px solid silver">
                  <h4>Antecedenes familiares</h4>
               </div>

               <div class="col-md-2">
                  <label for="obesidad">Obesidad</label><br>

                  <input type="radio" name="obesidad" value="Si"> Si
                  <input style="margin-left: 10px" type="radio" name="obesidad" value="No"> No
               </div>

               <div class="col-md-2">
                  <label for="hta">HTA</label><br>

                  <input type="radio" name="hta" value="Si"> Si
                  <input style="margin-left: 10px" type="radio" name="hta" value="No"> No
               </div>

               <div class="col-md-2">
                  <label for="diabetes">Diabetes</label><br>

                  <input type="radio" name="diabetes" value="Si"> Si
                  <input style="margin-left: 10px" type="radio" name="diabetes" value="No"> No
               </div>

               <div class="col-md-2">
                  <label for="iam">IAM</label><br>

                  <input type="radio" name="iam" value="Si"> Si
                  <input style="margin-left: 10px" type="radio" name="iam" value="No"> No
               </div>

               <div class="col-md-2">
                  <label for="acv">ACV</label><br>

                  <input type="radio" name="acv" value="Si"> Si
                  <input style="margin-left: 10px" type="radio" name="acv" value="No"> No
               </div>

               <div class="col-md-2">
                  <label for="cancer">Cancer</label><br>

                  <input type="radio" name="cancer" value="Si"> Si
                  <input style="margin-left: 10px" type="radio" name="cancer" value="No"> No
               </div>

               <div class="col-md-12" style="margin-top: 20px">
                  <label for="aclaraciones">Aclaraciones</label>
                  <textarea name="aclaraciones" class="form-control"></textarea>
               </div>

               <div class="col-md-12" style="margin-top: 30px; border-top: 0.5px solid silver">
                  <h4>Antecedenes gineco obstetricos</h4>
               </div>

               <div class="col-md-6">
                  <label for="Alguno de sus hijos peso mas de 4kg al nacer?">Alguno de sus hijos peso mas de 4kg al nacer?</label><br>

                  <input type="radio" name="Alguno de sus hijos peso mas de 4kg al nacer?" value="Si"> Si
                  <input style="margin-left: 10px" type="radio" name="Alguno de sus hijos peso mas de 4kg al nacer?" value="No"> No
               </div>

               <div class="col-md-6">
                  <label for="Ha tenido algun aborto, muerte, fetal, neonatal?">Ha tenido algun aborto, muerte, fetal, neonatal?</label><br>

                  <input type="radio" name="Ha tenido algun aborto, muerte, fetal, neonatal?" value="Si"> Si
                  <input style="margin-left: 10px" type="radio" name="Ha tenido algun aborto, muerte, fetal, neonatal?" value="No"> No
               </div>

               <div class="col-md-12" style="margin-top: 30px; border-top: 0.5px solid silver">
                  <h4>Antecedenes personales</h4>
               </div>

               <div class="col-md-2">HTA</div>
               <div class="col-md-2">
                  <input type="radio" name="hta_personal" value="Si"> Si
                  <input style="margin-left: 10px" type="radio" name="hta_personal" value="No"> No
               </div>

               <div class="row"></div>

               <div class="col-md-2">Obesidad</div>
               <div class="col-md-2">
                  <input type="radio" name="obesidad_personal" value="Si"> Si
                  <input style="margin-left: 10px" type="radio" name="obesidad_personal" value="No"> No
               </div>

               <div class="row"></div>

               <div class="col-md-2">Diabetes</div>
               <div class="col-md-2">
                  <input type="radio" name="diabetes_personal" value="Si"> Si
                  <input style="margin-left: 10px" type="radio" name="diabetes_personal" value="No"> No
               </div>

               <div class="row"></div>

               <div class="col-md-2">Fuma</div>
               <div class="col-md-2">
                  <input type="radio" name="fuma" value="Si"> Si
                  <input style="margin-left: 10px" type="radio" name="fuma" value="No"> No
               </div>
               <div class="col-md-2">
                  <input type="text" class="form-control form-control-sm" name="fuma_frencuencia" placeholder="Frecuencia:">
               </div>

               <div class="row"></div>

               <div class="col-md-2">Bebidas alcoholicas</div>
               <div class="col-md-2">
                  <input type="radio" name="bebidas alcoholicas" value="Si"> Si
                  <input style="margin-left: 10px" type="radio" name="bebidas alcoholicas" value="No"> No
               </div>
               <div class="col-md-2">
                  <input type="text" class="form-control form-control-sm" name="bebidas_frencuencia" placeholder="Frecuencia:">
               </div>

               <div class="row"></div>

               <div class="col-md-2">Fondo de ojo anual</div>
               <div class="col-md-2">
                  <input type="radio" name="Fondo de ojo anual" value="Si"> Si
                  <input style="margin-left: 10px" type="radio" name="Fondo de ojo anual" value="No"> No
               </div>

               <div class="row"></div>

               <div class="col-md-2">ECG anual</div>
               <div class="col-md-2">
                  <input type="radio" name="ECG anual" value="Si"> Si
                  <input style="margin-left: 10px" type="radio" name="ECG anual" value="No"> No
               </div>

               <div class="row"></div>

               <div class="col-md-2">Educacion en diabetes</div>
               <div class="col-md-2">
                  <input type="radio" name="Educacion en diabetes" value="Si"> Si
                  <input style="margin-left: 10px" type="radio" name="Educacion en diabetes" value="No"> No
               </div>

               <div class="row"></div>

               <div class="col-md-2">Antecedentes quirurgicos</div>
               <div class="col-md-2">
                  <input type="text" name="Antecedentes quirurgicos" class="form-control form-control-sm">
               </div>

               <div class="row"></div>

               <div class="col-md-12" style="margin-top: 30px; border-top: 0.5px solid silver">
                  <label for="motivo" style="margin-top: 10px">Motivo de la consulta</label>
                  <textarea name="motivo" class="form-control"></textarea>
               </div>

               <div class="row"></div>

               <div class="col-md-12" style="margin-top: 30px; border-top: 0.5px solid silver">
                  <h4>Signos vitales y medidas antropometricas</h4>
               </div>

               <div class="row"></div>

               <div class="col-md-2">
                  <label for="pa">PA</label>
                  <input type="text" class="form-control" name="pa">
               </div>

               <div class="col-md-2">
                  <label for="pulso">Pulso</label>
                  <input type="text" class="form-control" name="pulso">
               </div>

               <div class="col-md-2">
                  <label for="peso">Peso</label>
                  <input type="text" class="form-control" name="peso">
               </div>

               <div class="col-md-2">
                  <label for="talla">Talla</label>
                  <input type="text" class="form-control" name="talla">
               </div>

               <div class="col-md-2">
                  <label for="imc">IMC</label>
                  <input type="text" class="form-control" name="imc">
               </div>

               <div class="col-md-2">
                  <label for="pcintura">P/cintura</label>
                  <input type="text" class="form-control" name="pcintura">
               </div>

               <div class="row"></div>

               <div class="col-md-12" style="margin-top: 30px; border-top: 0.5px solid silver">
                  <label for="Historial de enfermedad actual" style="margin-top: 10px">Historial de enfermedad actual</label>
                  <textarea name="Historial de enfermedad actual" class="form-control"></textarea>
               </div>

               <div class="row"></div>

               <div class="col-md-12" style="margin-top: 30px; border-top: 0.5px solid silver">
                  <label for="Examen fisico" style="margin-top: 10px">Examen fisico</label>
                  <textarea name="Examen fisico" class="form-control"></textarea>
               </div>

               <div class="row"></div>

               <div class="col-md-12" style="margin-top: 30px; border-top: 0.5px solid silver">
                  <label for="Diagnostico presuntivo" style="margin-top: 10px">Diagnostico presuntivo</label>
                  <textarea name="Diagnostico presuntivo" class="form-control"></textarea>
               </div>

               <div class="row"></div>

               <div class="col-md-12" style="margin-top: 30px; border-top: 0.5px solid silver">
                  <label for="Laboratorios, estudios o examenes solicitados" style="margin-top: 10px">Laboratorios, estudios o examenes solicitados</label>
                  <textarea name="Laboratorios, estudios o examenes solicitados" class="form-control"></textarea>
               </div>

               <div class="row"></div>

               <div class="col-md-12" style="margin-top: 30px; border-top: 0.5px solid silver">
                  <label for="Tratamiento" style="margin-top: 10px">Tratamiento</label>
                  <textarea name="Tratamiento" class="form-control"></textarea>
               </div>

               <div class="col-md-12" style="margin-top: 30px; margin-bottom: 30px; border-top: 0.5px solid silver">
                  <h4>Firma y sella del medico</h4>
               </div>

               <div class="col-md-3">Elaborado:</div>

               <div class="col-md-3">
                  ________________________________<br>
                  Lic.Alberto Terrazas C.<br>
                  Coordinador Administrativo<br>
                  unidades de Servicio - F.C.S.H.
               </div>

               <div class="col-md-3">Aprobado:</div>

               <div class="col-md-3">
                  ________________________________<br>
                  Dr. Reinerio Vargas B.<br>
                  Decano<br>
                  F.C.S.u. - u.A.G.R.M
               </div>

               <input type="submit" style="margin: 30px" class="btn btn-primary" value="Registrar">

               <input type="hidden" name="tipo" value="diabetes">

            <?php endif; ?>




            <?php if ($_GET['tipo'] == 'neurologia'): ?>

               <div class="row"></div>

               <div class="col-md-4">
                  <div class="form-group">
                     <label for="datebirth">Fecha de nacimiento</label>
                     <input type="date" class="form-control" name="datebirth">
                  </div>
               </div>

               <div class="col-md-4">
                  <div class="form-group">
                     <label for="procedencia">Procedencia</label>
                     <input type="text" class="form-control" name="procedencia">
                  </div>
               </div>

               <div class="col-md-4">
                  <div class="form-group">
                     <label for="civilstate">Estado civil</label>
                     <select name="civilstate" id="civilstate" class="form-control">
                        <option value=""></option>
                        <option value="Soltero">Soltero</option>
                        <option value="Casado">Casado</option>
                        <option value="Divorciado">Divorciado</option>
                        <option value="Viudo">Viudo</option>
                     </select>
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="form-group">
                     <label for="address">Dirección</label>
                     <input type="text" class="form-control" name="address">
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="form-group">
                     <label for="occupation">Ocupación</label>
                     <input type="text" class="form-control" name="occupation">
                  </div>
               </div>

               <div class="col-md-12">
                  <div class="form-group">
                     <label for="diagnostico">Diagnóstico</label>
                     <textarea name="diagnostico" class="form-control"></textarea>
                  </div>
               </div>

               <input type="submit" style="margin: 30px" class="btn btn-primary" value="Registrar">

               <input type="hidden" name="tipo" value="neurologia">

            <?php endif; ?>

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
            reader.readAsDatauRL(input.files[0]);
         }
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
               response = JSON.parse(response);

               $('.user_photo').attr('src', response.foto);

               $('[name=datebirth]').val(response.datebirth);
               $('[name=edad]').val(response.edad);
               $('[name=civilstate]').val(response.civilstate);
               $('[name=address]').val(response.address);
               $('[name=occupation]').val(response.occupation);
            },
            error: function (error) {
               $('body').html(error.responseText);
            }
         });
      });
   });
</script>

</body>
</html>
