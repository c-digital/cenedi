<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php init_head(); ?>

<div id="wrapper" class="customer_profile">
   <div class="content">
      <div class="row" style="background: white;">
         <?php echo form_open('/admin/consultas/modificar', ['enctype' => 'multipart/form-data', 'method' => 'POST']); ?>
            <div class="col-md-11">
               <h3>Agregar nueva consulta</h3>
            </div>

            <div class="col-md-1">
               <a href="/admin/consultas" title="Volver a atras">
                  <i class="pull-right fa fa-times"></i>
               </a>
            </div>

            <div class="col-md-2">
               <img style="width: 210px; height: 210px" class="img-responsive img-circle user_photo" style="cursor: pointer" src="<?php echo ($foto_perfil) ? '/uploads/consultas/' . $foto_perfil : '/assets/images/user-placeholder.jpg' ?>" alt="">

               <input type="file" style="display: none;" name="foto_perfil" id="user">
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
               <input type="text" readonly class="form-control" name="edad" value="<?php echo $consulta->edad; ?>">
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
               <input type="text" readonly class="form-control" name="monto" value="<?php echo $consulta->monto; ?>">
            </div>

            <?php if ($consulta->tipo == 'diabetes'): ?>

               <div class="col-md-12" style="border-top: 0.5px solid silver">
                  <h4>Antecedenes familiares</h4>
               </div>

               <div class="col-md-2">
                  <label for="obesidad">Obesidad</label><br>

                  <input disabled type="radio" name="obesidad" value="Si" <?php echo $anamnesis['obesidad'] == 'Si' ? 'checked' : '' ?>> Si
                  <input disabled style="margin-left: 10px" type="radio" name="obesidad" value="No" <?php echo $anamnesis['obesidad'] == 'No' ? 'checked' : '' ?>> No
               </div>

               <div class="col-md-2">
                  <label for="hta">HTA</label><br>

                  <input disabled type="radio" name="hta" value="Si" <?php echo $anamnesis['hta'] == 'Si' ? 'checked' : '' ?>> Si
                  <input disabled style="margin-left: 10px" type="radio" name="hta" value="No" <?php echo $anamnesis['hta'] == 'No' ? 'checked' : '' ?>> No
               </div>

               <div class="col-md-2">
                  <label for="diabetes">Diabetes</label><br>

                  <input disabled type="radio" name="diabetes" value="Si" <?php echo $anamnesis['diabetes'] == 'Si' ? 'checked' : '' ?>> Si
                  <input disabled style="margin-left: 10px" type="radio" name="diabetes" value="No" <?php echo $anamnesis['diabetes'] == 'No' ? 'checked' : '' ?>> No
               </div>

               <div class="col-md-2">
                  <label for="iam">IAM</label><br>

                  <input disabled type="radio" name="iam" value="Si" <?php echo $anamnesis['iam'] == 'Si' ? 'checked' : '' ?>> Si
                  <input disabled style="margin-left: 10px" type="radio" name="iam" value="No" <?php echo $anamnesis['iam'] == 'No' ? 'checked' : '' ?>> No
               </div>

               <div class="col-md-2">
                  <label for="acv">ACV</label><br>

                  <input disabled type="radio" name="acv" value="Si" <?php echo $anamnesis['acv'] == 'Si' ? 'checked' : '' ?>> Si
                  <input disabled style="margin-left: 10px" type="radio" name="acv" value="No" <?php echo $anamnesis['acv'] == 'No' ? 'checked' : '' ?>> No
               </div>

               <div class="col-md-2">
                  <label for="cancer">Cancer</label><br>

                  <input disabled type="radio" name="cancer" value="Si" <?php echo $anamnesis['cancer'] == 'Si' ? 'checked' : '' ?>> Si
                  <input disabled style="margin-left: 10px" type="radio" name="cancer" value="No" <?php echo $anamnesis['cancer'] == 'No' ? 'checked' : '' ?>> No
               </div>

               <div class="col-md-12" style="margin-top: 20px">
                  <label for="aclaraciones">Aclaraciones</label>
                  <textarea readonly name="aclaraciones" class="form-control"><?php echo $anamnesis['aclaraciones']; ?></textarea>
               </div>

               <div class="col-md-12" style="margin-top: 30px; border-top: 0.5px solid silver">
                  <h4>Antecedenes gineco obstetricos</h4>
               </div>

               <div class="col-md-6">
                  <label for="Alguno de sus hijos peso mas de 4kg al nacer?">Alguno de sus hijos peso mas de 4kg al nacer?</label><br>

                  <input disabled type="radio" name="Alguno de sus hijos peso mas de 4kg al nacer?" value="Si" <?php echo $anamnesis['Alguno de sus hijos peso mas de 4kg al nacer?'] == 'Si' ? 'checked' : '' ?>> Si
                  <input disabled style="margin-left: 10px" type="radio" name="Alguno de sus hijos peso mas de 4kg al nacer?" value="No" <?php echo $anamnesis['Alguno de sus hijos peso mas de 4kg al nacer?'] == 'No' ? 'checked' : '' ?>> No
               </div>

               <div class="col-md-6">
                  <label for="Ha tenido algun aborto, muerte, fetal, neonatal?">Ha enido algun aborto, muerte, fetal, neonatal?</label><br>

                  <input disabled type="radio" name="Ha tenido algun aborto, muerte, fetal, neonatal?" value="Si" <?php echo $anamnesis['Ha tenido algun aborto, muerte, fetal, neonatal?'] == 'Si' ? 'checked' : '' ?>> Si
                  <input disabled style="margin-left: 10px" type="radio" name="Ha enido algun aborto, muerte, fetal, neonatal?" value="No" <?php echo $anamnesis['Ha tenido algun aborto, muerte, fetal, neonatal?'] == 'No' ? 'checked' : '' ?>> No
               </div>

               <div class="col-md-12" style="margin-top: 30px; border-top: 0.5px solid silver">
                  <h4>Antecedenes personales</h4>
               </div>

               <div class="col-md-2">HTA</div>
               <div class="col-md-2">
                  <input disabled type="radio" name="hta_personal" value="Si" <?php echo $anamnesis['hta_personal'] == 'Si' ? 'checked' : '' ?>> Si
                  <input disabled style="margin-left: 10px" type="radio" name="hta_personal" value="No" <?php echo $anamnesis['hta_personal'] == 'No' ? 'checked' : '' ?>> No
               </div>

               <div class="row"></div>

               <div class="col-md-2">Obesidad</div>
               <div class="col-md-2">
                  <input disabled type="radio" name="obesidad_personal" value="Si" <?php echo $anamnesis['obesidad_personal'] == 'Si' ? 'checked' : '' ?>> Si
                  <input disabled style="margin-left: 10px" type="radio" name="obesidad_personal" value="No" <?php echo $anamnesis['obesidad_personal'] == 'No' ? 'checked' : '' ?>> No
               </div>

               <div class="row"></div>

               <div class="col-md-2">Diabetes</div>
               <div class="col-md-2">
                  <input disabled type="radio" name="diabetes_personal" value="Si" <?php echo $anamnesis['diabetes_personal'] == 'Si' ? 'checked' : '' ?>> Si
                  <input disabled style="margin-left: 10px" type="radio" name="diabetes_personal" value="No" <?php echo $anamnesis['diabetes_personal'] == 'No' ? 'checked' : '' ?>> No
               </div>

               <div class="row"></div>

               <div class="col-md-2">Fuma</div>
               <div class="col-md-2">
                  <input disabled type="radio" name="fuma" value="Si" <?php echo $anamnesis['fuma'] == 'Si' ? 'checked' : '' ?>> Si
                  <input disabled style="margin-left: 10px" type="radio" name="fuma" value="No" <?php echo $anamnesis['fuma'] == 'No' ? 'checked' : '' ?>> No
               </div>
               <div class="col-md-2">
                  <input disabled type="text" class="form-control form-control-sm" name="fuma_frencuencia" placeholder="Frecuencia:" value="<?php echo $anamnesis['fuma_frecuencia'] ?>">
               </div>

               <div class="row"></div>

               <div class="col-md-2">Bebidas alcoholicas</div>
               <div class="col-md-2">
                  <input disabled type="radio" name="bebidas alcoholicas" value="Si" <?php echo $anamnesis['bebidas alcoholicas'] == 'Si' ? 'checked' : '' ?>> Si
                  <input disabled style="margin-left: 10px" type="radio" name="bebidas alcoholicas" value="No" <?php echo $anamnesis['bebidas alcoholicas'] == 'No' ? 'checked' : '' ?>> No
               </div>
               <div class="col-md-2">
                  <input disabled type="text" class="form-control form-control-sm" name="bebidas_frencuencia" placeholder="Frecuencia:" value="<?php echo $anamnesis['bebidas_frecuencia'] ?>">
               </div>

               <div class="row"></div>

               <div class="col-md-2">Fondo de ojo anual</div>
               <div class="col-md-2">
                  <input disabled type="radio" name="Fondo de ojo anual" value="Si" <?php echo $anamnesis['Fondo de ojo anual'] == 'Si' ? 'checked' : '' ?>> Si
                  <input disabled style="margin-left: 10px" type="radio" name="Fondo de ojo anual" value="No" <?php echo $anamnesis['Fondo de ojo anual'] == 'No' ? 'checked' : '' ?>> No
               </div>

               <div class="row"></div>

               <div class="col-md-2">ECG anual</div>
               <div class="col-md-2">
                  <input disabled type="radio" name="ECG anual" value="Si" <?php echo $anamnesis['ECG anual'] == 'Si' ? 'checked' : '' ?>> Si
                  <input disabled style="margin-left: 10px" type="radio" name="ECG anual" value="No" <?php echo $anamnesis['ECG anual'] == 'No' ? 'checked' : '' ?>> No
               </div>

               <div class="row"></div>

               <div class="col-md-2">Educacion en diabetes</div>
               <div class="col-md-2">
                  <input disabled type="radio" name="Educacion en diabetes" value="Si" <?php echo $anamnesis['Educaciu00f3n en diabetes'] == 'Si' ? 'checked' : '' ?>> Si
                  <input disabled style="margin-left: 10px" type="radio" name="Educacion en diabetes" value="No" <?php echo $anamnesis['Educaciu00f3n en diabetes'] == 'No' ? 'checked' : '' ?>> No
               </div>

               <div class="row"></div>

               <div class="col-md-2">Antecedentes quirurgicos</div>
               <div class="col-md-2">
                  <input disabled type="text" name="Antecedentes quirurgicos" class="form-control form-control-sm" value="<?php echo $anamnesis['Antecedentes quirurgicos'] ?>">
               </div>

               <div class="row"></div>

               <div class="col-md-12" style="margin-top: 30px; border-top: 0.5px solid silver">
                  <label for="motivo" style="margin-top: 10px">Motivo de la consulta</label>
                  <textarea disabled name="motivo" class="form-control"><?php echo $anamnesis['motivo'] ?></textarea>
               </div>

               <div class="row"></div>

               <div class="col-md-12" style="margin-top: 30px; border-top: 0.5px solid silver">
                  <h4>Signos vitales y medidas antropometricas</h4>
               </div>

               <div class="row"></div>

               <div class="col-md-2">
                  <label for="pa">PA</label>
                  <input disabled type="text" class="form-control" name="pa" value="<?php echo $anamnesis['pa']; ?>">
               </div>

               <div class="col-md-2">
                  <label for="pulso">Pulso</label>
                  <input disabled type="text" class="form-control" name="pulso" value="<?php echo $anamnesis['pulso']; ?>">
               </div>

               <div class="col-md-2">
                  <label for="peso">Peso</label>
                  <input disabled type="text" class="form-control" name="peso" value="<?php echo $anamnesis['peso']; ?>">
               </div>

               <div class="col-md-2">
                  <label for="talla">Talla</label>
                  <input disabled type="text" class="form-control" name="talla" value="<?php echo $anamnesis['talla']; ?>">
               </div>

               <div class="col-md-2">
                  <label for="imc">IMC</label>
                  <input disabled type="text" class="form-control" name="imc" value="<?php echo $anamnesis['imc']; ?>">
               </div>

               <div class="col-md-2">
                  <label for="pcintura">P/cintura</label>
                  <input disabled type="text" class="form-control" name="pcintura" value="<?php echo $anamnesis['pcintura']; ?>">
               </div>

               <div class="row"></div>

               <div class="col-md-12" style="margin-top: 30px; border-top: 0.5px solid silver">
                  <label for="Historial de enfermedad actual" style="margin-top: 10px">Historial de enfermedad actual</label>
                  <textarea disabled name="Historial de enfermedad actual" class="form-control"><?php echo $anamnesis['Historial de enfermedad actual']; ?></textarea>
               </div>

               <div class="row"></div>

               <div class="col-md-12" style="margin-top: 30px; border-top: 0.5px solid silver">
                  <label for="Examen fisico" style="margin-top: 10px">Examen fisico</label>
                  <textarea disabled name="Examen fisico" class="form-control"><?php echo $anamnesis['Examen fisico']; ?></textarea>
               </div>

               <div class="row"></div>

               <div class="col-md-12" style="margin-top: 30px; border-top: 0.5px solid silver">
                  <label for="Diagnostico presuntivo" style="margin-top: 10px">Diagnostico presuntivo</label>
                  <textarea disabled name="Diagnostico presuntivo" class="form-control"><?php echo $anamnesis['Diagnostico presuntivo']; ?></textarea>
               </div>

               <div class="row"></div>

               <div class="col-md-12" style="margin-top: 30px; border-top: 0.5px solid silver">
                  <label for="Laboratorios, estudios o examenes solicitados" style="margin-top: 10px">Laboratorios, estudios o examenes solicitados</label>
                  <textarea disabled name="Laboratorios, estudios o examenes solicitados" class="form-control"><?php echo $anamnesis['Laboratorios, estudios o examenes solicitados']; ?></textarea>
               </div>

               <div class="row"></div>

               <div class="col-md-12" style="margin-top: 30px; border-top: 0.5px solid silver">
                  <label for="Tratamiento" style="margin-top: 10px">Tratamiento</label>
                  <textarea disabled name="Tratamiento" class="form-control"><?php echo $anamnesis['Tratamiento']; ?></textarea>
               </div>

               <div class="col-md-12" style="margin-top: 30px; margin-bottom: 30px; border-top: 0.5px solid silver">
                  <h4>Firma y sella del medico</h4>
               </div>

               <div class="col-md-3">Elaborado:</div>

               <div class="col-md-3">
                  ________________________________<br>
                  Lic.Alberto Terrazas C.<br>
                  Coordinador Administrativo<br>
                  Unidades de Servicio - F.C.S.H.
               </div>

               <div class="col-md-3">Aprobado:</div>

               <div class="col-md-3">
                  ________________________________<br>
                  Dr. Reinerio Vargas B.<br>
                  Decano<br>
                  F.C.S.U. - U.A.G.R.M
               </div>

               <input type="submit" style="margin: 30px" class="btn btn-primary" value="Registrar">

               <input type="hidden" name="tipo" value="diabetes" value="<?php echo $consulta->tipo ?>">

            <?php endif; ?>




            <?php if ($consulta->tipo == 'neurologia'): ?>

               <div class="row"></div>

               <div class="col-md-4">
                  <div class="form-group">
                     <label for="datebirth">Fecha de nacimiento</label>
                     <input readonly type="date" class="form-control" name="datebirth" value="<?php echo $client->datebirth ?>">
                  </div>
               </div>

               <div class="col-md-4">
                  <div class="form-group">
                     <label for="procedencia">Procedencia</label>
                     <input type="text" readonly class="form-control" name="procedencia" value="<?php echo $anamnesis['procedencia'] ?>">
                  </div>
               </div>

               <div class="col-md-4">
                  <div class="form-group">
                     <label for="civilstate">Estado civil</label>
                     <select readonly name="civilstate" id="civilstate" class="form-control">
                        <option value=""></option>
                        <option <?php echo $client->civilstate == 'Soltero' ? 'selected' : '' ?> value="Soltero">Soltero</option>
                        <option <?php echo $client->civilstate == 'Casado' ? 'selected' : '' ?> value="Casado">Casado</option>
                        <option <?php echo $client->civilstate == 'Divorciado' ? 'selected' : '' ?> value="Divorciado">Divorciado</option>
                        <option <?php echo $client->civilstate == 'Viudo' ? 'selected' : '' ?> value="Viudo">Viudo</option>
                     </select>
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="form-group">
                     <label for="address">Dirección</label>
                     <input readonly type="text" class="form-control" name="address" value="<?php echo $client->address; ?>">
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="form-group">
                     <label for="occupation">Ocupación</label>
                     <input readonly type="text" class="form-control" name="occupation" value="<?php echo $client->occupation; ?>">
                  </div>
               </div>

               <div class="col-md-12">
                  <div class="form-group">
                     <label for="diagnostico">Diagnóstico</label>
                     <textarea readonly name="diagnostico" class="form-control"><?php echo $anamnesis['diagnostico'] ?></textarea>
                  </div>
               </div>

               <input type="hidden" name="tipo" value="neurologia" value="<?php echo $consulta->tipo ?>">

            <?php endif; ?>

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

      $('.img-circle').click(function () {
         $('[name=foto_perfil]').click();
      });
   });
</script>

</body>
</html>
