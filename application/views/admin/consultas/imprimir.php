<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">

<div style="margin: 30px" id="wrapper" class="customer_profile">
   <div class="content">
      <div class="row" style="background: white;">
         <?php echo form_open('/admin/consultas/modificar', ['enctype' => 'multipart/form-data', 'method' => 'POST']); ?>
            <div class="col-md-11">
               <h3>Consulta</h3>
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
               <select name="id_client" class="form-control">
                  <option value=""></option>
                  <?php foreach ($clientes as $cliente): ?>
                     <option <?php echo ($cliente->userid == $consulta->id_client) ? 'selected' : ''; ?> value="<?php echo $cliente->userid; ?>"><?php echo $cliente->company; ?></option>
                  <?php endforeach; ?>
               </select>
            </div>

            <div class="col-md-2">
               <label for="edad">Edad</label>
               <input type="text" class="form-control" name="edad" value="<?php echo $consulta->edad; ?>">
            </div>

            <div class="col-md-8" style="margin-top: 20px">
               <label for="id_cliente">Profesional</label>
               <select name="id_staff" class="form-control">
                  <option value=""></option>
                  <?php foreach ($profesionales as $profesional): ?>
                     <option <?php echo ($profesional->staffid == $consulta->id_staff) ? 'selected' : ''; ?> value="<?php echo $profesional->staffid; ?>"><?php echo $profesional->firstname; ?></option>
                  <?php endforeach; ?>
               </select>
            </div>

            <div class="col-md-2" style="margin-top: 20px">
               <label for="monto">Monto a cobrar</label>
               <input type="text" class="form-control" name="monto" value="<?php echo $consulta->monto; ?>">
            </div>

            <?php if ($consulta->tipo == 'diabetes'): ?>

               <div class="col-md-12" style="border-top: 0.5px solid silver">
                  <h4>Antecedenes familiares</h4>
               </div>

               <div class="col-md-2">
                  <label for="obesidad">Obesidad</label><br>

                  <input type="radio" name="obesidad" value="Si" <?php echo $anamnesis['obesidad'] == 'Si' ? 'checked' : '' ?>> Si
                  <input style="margin-left: 10px" type="radio" name="obesidad" value="No" <?php echo $anamnesis['obesidad'] == 'No' ? 'checked' : '' ?>> No
               </div>

               <div class="col-md-2">
                  <label for="hta">HTA</label><br>

                  <input type="radio" name="hta" value="Si" <?php echo $anamnesis['hta'] == 'Si' ? 'checked' : '' ?>> Si
                  <input style="margin-left: 10px" type="radio" name="hta" value="No" <?php echo $anamnesis['hta'] == 'No' ? 'checked' : '' ?>> No
               </div>

               <div class="col-md-2">
                  <label for="diabetes">Diabetes</label><br>

                  <input type="radio" name="diabetes" value="Si" <?php echo $anamnesis['diabetes'] == 'Si' ? 'checked' : '' ?>> Si
                  <input style="margin-left: 10px" type="radio" name="diabetes" value="No" <?php echo $anamnesis['diabetes'] == 'No' ? 'checked' : '' ?>> No
               </div>

               <div class="col-md-2">
                  <label for="iam">IAM</label><br>

                  <input type="radio" name="iam" value="Si" <?php echo $anamnesis['iam'] == 'Si' ? 'checked' : '' ?>> Si
                  <input style="margin-left: 10px" type="radio" name="iam" value="No" <?php echo $anamnesis['iam'] == 'No' ? 'checked' : '' ?>> No
               </div>

               <div class="col-md-2">
                  <label for="acv">ACV</label><br>

                  <input type="radio" name="acv" value="Si" <?php echo $anamnesis['acv'] == 'Si' ? 'checked' : '' ?>> Si
                  <input style="margin-left: 10px" type="radio" name="acv" value="No" <?php echo $anamnesis['acv'] == 'No' ? 'checked' : '' ?>> No
               </div>

               <div class="col-md-2">
                  <label for="cancer">Cancer</label><br>

                  <input type="radio" name="cancer" value="Si" <?php echo $anamnesis['cancer'] == 'Si' ? 'checked' : '' ?>> Si
                  <input style="margin-left: 10px" type="radio" name="cancer" value="No" <?php echo $anamnesis['cancer'] == 'No' ? 'checked' : '' ?>> No
               </div>

               <div class="col-md-12" style="margin-top: 20px">
                  <label for="aclaraciones">Aclaraciones</label>
                  <textarea name="aclaraciones" class="form-control"><?php echo $anamnesis['aclaraciones']; ?></textarea>
               </div>

               <div class="col-md-12" style="margin-top: 30px; border-top: 0.5px solid silver">
                  <h4>Antecedenes gineco obstetricos</h4>
               </div>

               <div class="col-md-6">
                  <label for="Alguno de sus hijos peso mas de 4kg al nacer?">Alguno de sus hijos peso mas de 4kg al nacer?</label><br>

                  <input type="radio" name="Alguno de sus hijos peso mas de 4kg al nacer?" value="Si" <?php echo $anamnesis['Alguno de sus hijos peso mas de 4kg al nacer?'] == 'Si' ? 'checked' : '' ?>> Si
                  <input style="margin-left: 10px" type="radio" name="Alguno de sus hijos peso mas de 4kg al nacer?" value="No" <?php echo $anamnesis['Alguno de sus hijos peso mas de 4kg al nacer?'] == 'No' ? 'checked' : '' ?>> No
               </div>

               <div class="col-md-6">
                  <label for="Ha tenido algun aborto, muerte, fetal, neonatal?">Ha enido algun aborto, muerte, fetal, neonatal?</label><br>

                  <input type="radio" name="Ha tenido algun aborto, muerte, fetal, neonatal?" value="Si" <?php echo $anamnesis['Ha tenido algun aborto, muerte, fetal, neonatal?'] == 'Si' ? 'checked' : '' ?>> Si
                  <input style="margin-left: 10px" type="radio" name="Ha enido algun aborto, muerte, fetal, neonatal?" value="No" <?php echo $anamnesis['Ha tenido algun aborto, muerte, fetal, neonatal?'] == 'No' ? 'checked' : '' ?>> No
               </div>

               <div class="col-md-12" style="margin-top: 30px; border-top: 0.5px solid silver">
                  <h4>Antecedenes personales</h4>
               </div>

               <div class="col-md-2">HTA</div>
               <div class="col-md-2">
                  <input type="radio" name="hta_personal" value="Si" <?php echo $anamnesis['hta_personal'] == 'Si' ? 'checked' : '' ?>> Si
                  <input style="margin-left: 10px" type="radio" name="hta_personal" value="No" <?php echo $anamnesis['hta_personal'] == 'No' ? 'checked' : '' ?>> No
               </div>

               <div class="row"></div>

               <div class="col-md-2">Obesidad</div>
               <div class="col-md-2">
                  <input type="radio" name="obesidad_personal" value="Si" <?php echo $anamnesis['obesidad_personal'] == 'Si' ? 'checked' : '' ?>> Si
                  <input style="margin-left: 10px" type="radio" name="obesidad_personal" value="No" <?php echo $anamnesis['obesidad_personal'] == 'No' ? 'checked' : '' ?>> No
               </div>

               <div class="row"></div>

               <div class="col-md-2">Diabetes</div>
               <div class="col-md-2">
                  <input type="radio" name="diabetes_personal" value="Si" <?php echo $anamnesis['diabetes_personal'] == 'Si' ? 'checked' : '' ?>> Si
                  <input style="margin-left: 10px" type="radio" name="diabetes_personal" value="No" <?php echo $anamnesis['diabetes_personal'] == 'No' ? 'checked' : '' ?>> No
               </div>

               <div class="row"></div>

               <div class="col-md-2">Fuma</div>
               <div class="col-md-2">
                  <input type="radio" name="fuma" value="Si" <?php echo $anamnesis['fuma'] == 'Si' ? 'checked' : '' ?>> Si
                  <input style="margin-left: 10px" type="radio" name="fuma" value="No" <?php echo $anamnesis['fuma'] == 'No' ? 'checked' : '' ?>> No
               </div>
               <div class="col-md-2">
                  <input type="text" class="form-control form-control-sm" name="fuma_frencuencia" placeholder="Frecuencia:" value="<?php echo $anamnesis['fuma_frecuencia'] ?>">
               </div>

               <div class="row"></div>

               <div class="col-md-2">Bebidas alcoholicas</div>
               <div class="col-md-2">
                  <input type="radio" name="bebidas alcoholicas" value="Si" <?php echo $anamnesis['bebidas alcoholicas'] == 'Si' ? 'checked' : '' ?>> Si
                  <input style="margin-left: 10px" type="radio" name="bebidas alcoholicas" value="No" <?php echo $anamnesis['bebidas alcoholicas'] == 'No' ? 'checked' : '' ?>> No
               </div>
               <div class="col-md-2">
                  <input type="text" class="form-control form-control-sm" name="bebidas_frencuencia" placeholder="Frecuencia:" value="<?php echo $anamnesis['bebidas_frecuencia'] ?>">
               </div>

               <div class="row"></div>

               <div class="col-md-2">Fondo de ojo anual</div>
               <div class="col-md-2">
                  <input type="radio" name="Fondo de ojo anual" value="Si" <?php echo $anamnesis['Fondo de ojo anual'] == 'Si' ? 'checked' : '' ?>> Si
                  <input style="margin-left: 10px" type="radio" name="Fondo de ojo anual" value="No" <?php echo $anamnesis['Fondo de ojo anual'] == 'No' ? 'checked' : '' ?>> No
               </div>

               <div class="row"></div>

               <div class="col-md-2">ECG anual</div>
               <div class="col-md-2">
                  <input type="radio" name="ECG anual" value="Si" <?php echo $anamnesis['ECG anual'] == 'Si' ? 'checked' : '' ?>> Si
                  <input style="margin-left: 10px" type="radio" name="ECG anual" value="No" <?php echo $anamnesis['ECG anual'] == 'No' ? 'checked' : '' ?>> No
               </div>

               <div class="row"></div>

               <div class="col-md-2">Educacion en diabetes</div>
               <div class="col-md-2">
                  <input type="radio" name="Educacion en diabetes" value="Si" <?php echo $anamnesis['Educaciu00f3n en diabetes'] == 'Si' ? 'checked' : '' ?>> Si
                  <input style="margin-left: 10px" type="radio" name="Educacion en diabetes" value="No" <?php echo $anamnesis['Educaciu00f3n en diabetes'] == 'No' ? 'checked' : '' ?>> No
               </div>

               <div class="row"></div>

               <div class="col-md-2">Antecedentes quirurgicos</div>
               <div class="col-md-2">
                  <input type="text" name="Antecedentes quirurgicos" class="form-control form-control-sm" value="<?php echo $anamnesis['Antecedentes quirurgicos'] ?>">
               </div>

               <div class="row"></div>

               <div class="col-md-12" style="margin-top: 30px; border-top: 0.5px solid silver">
                  <label for="motivo" style="margin-top: 10px">Motivo de la consulta</label>
                  <textarea name="motivo" class="form-control"><?php echo $anamnesis['motivo'] ?></textarea>
               </div>

               <div class="row"></div>

               <div class="col-md-12" style="margin-top: 30px; border-top: 0.5px solid silver">
                  <h4>Signos vitales y medidas antropometricas</h4>
               </div>

               <div class="row"></div>

               <div class="col-md-2">
                  <label for="pa">PA</label>
                  <input type="text" class="form-control" name="pa" value="<?php echo $anamnesis['pa']; ?>">
               </div>

               <div class="col-md-2">
                  <label for="pulso">Pulso</label>
                  <input type="text" class="form-control" name="pulso" value="<?php echo $anamnesis['pulso']; ?>">
               </div>

               <div class="col-md-2">
                  <label for="peso">Peso</label>
                  <input type="text" class="form-control" name="peso" value="<?php echo $anamnesis['peso']; ?>">
               </div>

               <div class="col-md-2">
                  <label for="talla">Talla</label>
                  <input type="text" class="form-control" name="talla" value="<?php echo $anamnesis['talla']; ?>">
               </div>

               <div class="col-md-2">
                  <label for="imc">IMC</label>
                  <input type="text" class="form-control" name="imc" value="<?php echo $anamnesis['imc']; ?>">
               </div>

               <div class="col-md-2">
                  <label for="pcintura">P/cintura</label>
                  <input type="text" class="form-control" name="pcintura" value="<?php echo $anamnesis['pcintura']; ?>">
               </div>

               <div class="row"></div>

               <div class="col-md-12" style="margin-top: 30px; border-top: 0.5px solid silver">
                  <label for="Historial de enfermedad actual" style="margin-top: 10px">Historial de enfermedad actual</label>
                  <textarea name="Historial de enfermedad actual" class="form-control"><?php echo $anamnesis['Historial de enfermedad actual']; ?></textarea>
               </div>

               <div class="row"></div>

               <div class="col-md-12" style="margin-top: 30px; border-top: 0.5px solid silver">
                  <label for="Examen fisico" style="margin-top: 10px">Examen fisico</label>
                  <textarea name="Examen fisico" class="form-control"><?php echo $anamnesis['Examen fisico']; ?></textarea>
               </div>

               <div class="row"></div>

               <div class="col-md-12" style="margin-top: 30px; border-top: 0.5px solid silver">
                  <label for="Diagnostico presuntivo" style="margin-top: 10px">Diagnostico presuntivo</label>
                  <textarea name="Diagnostico presuntivo" class="form-control"><?php echo $anamnesis['Diagnostico presuntivo']; ?></textarea>
               </div>

               <div class="row"></div>

               <div class="col-md-12" style="margin-top: 30px; border-top: 0.5px solid silver">
                  <label for="Laboratorios, estudios o examenes solicitados" style="margin-top: 10px">Laboratorios, estudios o examenes solicitados</label>
                  <textarea name="Laboratorios, estudios o examenes solicitados" class="form-control"><?php echo $anamnesis['Laboratorios, estudios o examenes solicitados']; ?></textarea>
               </div>

               <div class="row"></div>

               <div class="col-md-12" style="margin-top: 30px; border-top: 0.5px solid silver">
                  <label for="Tratamiento" style="margin-top: 10px">Tratamiento</label>
                  <textarea name="Tratamiento" class="form-control"><?php echo $anamnesis['Tratamiento']; ?></textarea>
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

               <input type="hidden" name="tipo" value="diabetes" value="<?php echo $consulta->tipo ?>">

            <?php endif; ?>




            <?php if ($consulta->tipo == 'neurologia'): ?>

               <input type="submit" style="margin: 30px" class="btn btn-primary" value="Registrar">

               <input type="hidden" name="tipo" value="neurologia" value="<?php echo $consulta->tipo ?>">

            <?php endif; ?>

            <input type="hidden" name="id" value="<?php echo $consulta->id; ?>">
         <?php echo form_close(); ?>
      </div>
   </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


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

      var element = document.getElementById('wrapper');
      html2pdf(element);
   });
</script>

</body>
</html>
