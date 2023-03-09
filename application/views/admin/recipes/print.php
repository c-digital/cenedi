
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RECIPE</title>
    <link rel="shortcut icon" id="favicon" href="https://cenedi.nisadelgado.com/uploads/company/cenedi.jpg">
<link rel="apple-touch-icon”" id="favicon-apple-touch-icon" href="https://cenedi.nisadelgado.com/uploads/company/cenedi.jpg">
<link rel="stylesheet" type="text/css" id="reset-css" href="https://cenedi.nisadelgado.com/assets/css/reset.min.css?v=1678249651">
<link rel="stylesheet" type="text/css" id="bootstrap-css" href="https://cenedi.nisadelgado.com/assets/plugins/bootstrap/css/bootstrap.min.css?v=2.9.3">
<link rel="stylesheet" type="text/css" id="roboto-css" href="https://cenedi.nisadelgado.com/assets/plugins/roboto/roboto.css?v=2.9.3">
<link rel="stylesheet" type="text/css" id="datatables-css" href="https://cenedi.nisadelgado.com/assets/plugins/datatables/datatables.min.css?v=2.9.3">
<link rel="stylesheet" type="text/css" id="fontawesome-css" href="https://cenedi.nisadelgado.com/assets/plugins/font-awesome/css/font-awesome.min.css?v=2.9.3">
<link rel="stylesheet" type="text/css" id="datetimepicker-css" href="https://cenedi.nisadelgado.com/assets/plugins/datetimepicker/jquery.datetimepicker.min.css?v=2.9.3">
<link rel="stylesheet" type="text/css" id="bootstrap-select-css" href="https://cenedi.nisadelgado.com/assets/plugins/bootstrap-select/css/bootstrap-select.min.css?v=2.9.3">
<link rel="stylesheet" type="text/css" id="lightbox-css" href="https://cenedi.nisadelgado.com/assets/plugins/lightbox/css/lightbox.min.css?v=2.9.3">
<link rel="stylesheet" type="text/css" id="colorpicker-css" href="https://cenedi.nisadelgado.com/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css?v=2.9.3">
<link rel="stylesheet" type="text/css" id="bootstrap-overrides-css" href="https://cenedi.nisadelgado.com/assets/css/bs-overides.min.css?v=1678249651">
<link rel="stylesheet" type="text/css" id="theme-css" href="https://cenedi.nisadelgado.com/assets/themes/perfex/css/style.min.css?v=1678249651">
    <script src="https://cenedi.nisadelgado.com/assets/plugins/jquery/jquery.min.js"></script>
        <script>
        if (typeof(jQuery) === 'undefined' && !window.deferAfterjQueryLoaded) {
            window.deferAfterjQueryLoaded = [];
            Object.defineProperty(window, "$", {
                set: function(value) {
                    window.setTimeout(function() {
                        $.each(window.deferAfterjQueryLoaded, function(index, fn) {
                            fn();
                        });
                    }, 0);
                    Object.defineProperty(window, "$", {
                        value: value
                    });
                },
                configurable: true
            });
        }

        var csrfData = {"formatted":{"csrf_token_name":"0ff81bf35839e080dbbf2bd42e26320c"},"token_name":"csrf_token_name","hash":"0ff81bf35839e080dbbf2bd42e26320c"};

        if (typeof(jQuery) == 'undefined') {
            window.deferAfterjQueryLoaded.push(function() {
                csrf_jquery_ajax_setup();
            });
            window.addEventListener('load', function() {
                csrf_jquery_ajax_setup();
            }, true);
        } else {
            csrf_jquery_ajax_setup();
        }

        function csrf_jquery_ajax_setup() {
            $.ajaxSetup({
                data: csrfData.formatted
            });

            $(document).ajaxError(function(event, request, settings) {
                if (request.status === 419) {
                    alert_float('warning', 'Page expired, refresh the page make an action.')
                }
            });
        }

        window.print();
    </script>
    <script>
        function custom_fields_hyperlink(){
         var cf_hyperlink = $('body').find('.cf-hyperlink');
         if(cf_hyperlink.length){
           $.each(cf_hyperlink,function(){
            var cfh_wrapper = $(this);
            if(!cfh_wrapper.hasClass('cfh-initialized')) {

                var cfh_field_to = cfh_wrapper.attr('data-fieldto');
                var cfh_field_id = cfh_wrapper.attr('data-field-id');
                var textEl = $('body').find('#custom_fields_'+cfh_field_to+'_'+cfh_field_id+'_popover');
                var hiddenField = $("#custom_fields\\\["+cfh_field_to+"\\\]\\\["+cfh_field_id+"\\\]");
                var cfh_value = cfh_wrapper.attr('data-value');
                hiddenField.val(cfh_value);

                if($(hiddenField.val()).html() != ''){
                    textEl.html($(hiddenField.val()).html());
                }
                var cfh_field_name = cfh_wrapper.attr('data-field-name');

                textEl.popover({
                    html: true,
                    trigger: "manual",
                    placement: "top",
                    title:cfh_field_name,
                    content:function(){
                        return $(cfh_popover_templates[cfh_field_id]).html();
                    }
                }).on("click", function(e){
                    var $popup = $(this);
                    $popup.popover("toggle");
                    var titleField = $("#custom_fields_"+cfh_field_to+"_"+cfh_field_id+"_title");
                    var urlField = $("#custom_fields_"+cfh_field_to+"_"+cfh_field_id+"_link");
                    var ttl = $(hiddenField.val()).html();
                    var cfUrl = $(hiddenField.val()).attr("href");
                    if(cfUrl){
                        $('#cf_hyperlink_open_'+cfh_field_id).attr('href',(cfUrl.indexOf('://') === -1 ? 'http://' + cfUrl : cfUrl));
                    }
                    titleField.val(ttl);
                    urlField.val(cfUrl);
                    $("#custom_fields_"+cfh_field_to+"_"+cfh_field_id+"_btn-save").click(function(){
                        hiddenField.val((urlField.val() != '' ? '<a href="'+urlField.val()+'" target="_blank">' + titleField.val() + '</a>' : ''));
                        textEl.html(titleField.val() == "" ? "Click aquí para agregar link" : titleField.val());
                        $popup.popover("toggle");
                    });
                    $("#custom_fields_"+cfh_field_to+"_"+cfh_field_id+"_btn-cancel").click(function(){
                        if(urlField.val() == ''){
                            hiddenField.val('');
                        }
                        $popup.popover("toggle");
                    });
                });
                cfh_wrapper.addClass('cfh-initialized')
            }
        });
       }
     }
 </script>
     <script>
                var admin_url = 'https://cenedi.nisadelgado.com/admin/';
        
        var site_url = 'https://cenedi.nisadelgado.com/',
        app = {},
        cfh_popover_templates  = {};

        app.isRTL = 'false';
        app.is_mobile = '';
        app.months_json = '["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"]';

        app.browser = "chrome";
        app.max_php_ini_upload_size_bytes = "2097152";
        app.locale = "es";

        app.options = {
            calendar_events_limit: "6",
            calendar_first_day: "1",
            tables_pagination_limit: "25",
            enable_google_picker: "1",
            google_client_id: "https://calendar.google.com/calendar/ical/sistema@criativedigital.com/public/basic.ics",
            google_api: "",
            default_view_calendar: "dayGridMonth",
            timezone: "America/La_Paz",
            allowed_files: ".png,.jpg,.pdf,.doc,.docx,.xls,.xlsx,.zip,.rar,.txt",
            date_format: "d/m/Y",
            time_format: "24",
        };

        app.lang = {
            file_exceeds_maxfile_size_in_form: "El archivo subido excede la directiva mAX_FILE_SIZE que se especificó en el formulario HTML" + ' (2 MB)',
            file_exceeds_max_filesize: "El archivo subido excede la directiva peso máximo permitido (upload_max_filesize)" + ' (2 MB)',
            validation_extension_not_allowed: "Esta extesión de archivo no es válida",
            sign_document_validation: "Por favor firme el documento.",
            dt_length_menu_all: "Todo",
            drop_files_here_to_upload: "Dejar caer archivo aqui para cargar",
            browser_not_support_drag_and_drop: "Tu navegador no soporte la opción de dejar caer archivo para cargar.",
            confirm_action_prompt: "Estás seguro de querer realizar ésta acción?",
            datatables: {"emptyTable":"No se encontraron entradas","info":"Mostrando desde _START_ hasta _END_ de _TOTAL_ entradas","infoEmpty":"Mostrando 0 al 0 de 0 entradas","infoFiltered":"(Filtrado de _MAX_ total de entradas)","lengthMenu":"_MENU_","loadingRecords":"Cargando\u2026","processing":"<div class=\"dt-loader\"><\/div>","search":"<div class=\"input-group\"><span class=\"input-group-addon\"><span class=\"fa fa-search\"><\/span><\/span>","searchPlaceholder":"Buscar:","zeroRecords":"No se encontraron coincidencias","paginate":{"first":"Primero","last":"\u00daltimo","next":"Siguiente","previous":"Anterior"},"aria":{"sortAscending":"Activar para ordenar la columna ascendente","sortDescending":"Activar para ordenar la columna descendente"}},
            discussions_lang: {"discussion_add_comment":"Agregar comentario","discussion_newest":"El m\u00e1s reciente","discussion_oldest":"El m\u00e1s antiguo","discussion_attachments":"Archivos adjuntos","discussion_send":"Enviar","discussion_reply":"Respuesta","discussion_edit":"Editar","discussion_edited":"Modificar","discussion_you":"T\u00fa","discussion_save":"Guardar","discussion_delete":"Borrar","discussion_view_all_replies":"Ense\u00f1ar todas las respuestas","discussion_hide_replies":"Ocultar respuestas","discussion_no_comments":"Ning\u00fan comentario","discussion_no_attachments":"Ning\u00fan archivo adjunto","discussion_attachments_drop":"Arrastrar y soltar para cargar el archivo"},
        };
        window.addEventListener('load',function(){
            custom_fields_hyperlink();
        });
    </script>
        <script>
        /**
         * @deprecated 2.3.2
         * Do not use any of these below as will be removed in future updates.
         */
        var isRTL = 'false';

        var calendar_events_limit = "6";
        var maximum_allowed_ticket_attachments = "4";

        var max_php_ini_upload_size_bytes  = "2097152";

        var file_exceeds_maxfile_size_in_form = "El archivo subido excede la directiva mAX_FILE_SIZE que se especificó en el formulario HTML" + ' (2 MB)';
        var file_exceeds_max_filesize = "El archivo subido excede la directiva peso máximo permitido (upload_max_filesize)" + ' (2 MB)';

        var validation_extension_not_allowed = "Esta extesión de archivo no es válida";
        var sign_document_validation = "Por favor firme el documento.";
        var dt_length_menu_all = "Todo";

        var drop_files_here_to_upload = "Dejar caer archivo aqui para cargar";
        var browser_not_support_drag_and_drop = "Tu navegador no soporte la opción de dejar caer archivo para cargar.";
        var remove_file = "Eliminar archivo";
        var tables_pagination_limit = "25";
        var enable_google_picker = "1";
        var google_client_id = "https://calendar.google.com/calendar/ical/sistema@criativedigital.com/public/basic.ics";
        var google_api = "";
        var acceptable_mimes = "image/png, image/jpeg, application/pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/x-zip, application/x-rar, text/plain";
        var date_format = "d/m/Y";
        var time_format = "24";
        var default_view_calendar = "dayGridMonth";
        var dt_lang = {"emptyTable":"No se encontraron entradas","info":"Mostrando desde _START_ hasta _END_ de _TOTAL_ entradas","infoEmpty":"Mostrando 0 al 0 de 0 entradas","infoFiltered":"(Filtrado de _MAX_ total de entradas)","lengthMenu":"_MENU_","loadingRecords":"Cargando\u2026","processing":"<div class=\"dt-loader\"><\/div>","search":"<div class=\"input-group\"><span class=\"input-group-addon\"><span class=\"fa fa-search\"><\/span><\/span>","searchPlaceholder":"Buscar:","zeroRecords":"No se encontraron coincidencias","paginate":{"first":"Primero","last":"\u00daltimo","next":"Siguiente","previous":"Anterior"},"aria":{"sortAscending":"Activar para ordenar la columna ascendente","sortDescending":"Activar para ordenar la columna descendente"}};
        var discussions_lang = {"discussion_add_comment":"Agregar comentario","discussion_newest":"El m\u00e1s reciente","discussion_oldest":"El m\u00e1s antiguo","discussion_attachments":"Archivos adjuntos","discussion_send":"Enviar","discussion_reply":"Respuesta","discussion_edit":"Editar","discussion_edited":"Modificar","discussion_you":"T\u00fa","discussion_save":"Guardar","discussion_delete":"Borrar","discussion_view_all_replies":"Ense\u00f1ar todas las respuestas","discussion_hide_replies":"Ocultar respuestas","discussion_no_comments":"Ning\u00fan comentario","discussion_no_attachments":"Ning\u00fan archivo adjunto","discussion_attachments_drop":"Arrastrar y soltar para cargar el archivo"};
        var confirm_action_prompt = "Estás seguro de querer realizar ésta acción?";
        var cf_translate_input_link_tip = "Click aquí para agregar link";

        var locale = 'es';
        var timezone = "America/La_Paz";
        var allowed_files = ".png,.jpg,.pdf,.doc,.docx,.xls,.xlsx,.zip,.rar,.txt";
        var calendar_first_day = '1';
        var months_json = '["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"]';
    </script>
        <meta name="robots" content="noindex">
</head>
<body class="customers chrome viewinvoice" >
    <div id="wrapper">
   <div id="content">
      <div class="container">
         <div class="row">
                     </div>
      </div>
            <div class="container">
                  <div class="row">
                        <div class="mtop15 preview-top-wrapper">
   <div class="row">
      <div class="col-md-3">
         <div class="mbot30">
            <div class="invoice-html-logo">
               <a href="https://cenedi.nisadelgado.com/" class="logo img-responsive">
        <img src="https://cenedi.nisadelgado.com/uploads/company/cenedi.jpg" class="img-responsive" alt="Cenedi Neurologia &amp; Diabetes">
        </a>            </div>
         </div>
      </div>

      <div class="col-md-6"></div>

      <div class="col-md-3" style="text-align: right">
          <h1>RECIPE</h1>
      </div>
      <div class="clearfix"></div>
   </div>
   <div class="top" data-sticky data-sticky-class="preview-sticky-header">
      <div class="container preview-sticky-container">
         <div class="row">
            <div class="col-md-12">
               <div class="pull-left">
                  <h3 class="bold no-mtop invoice-html-number no-mbot">
                     <span class="sticky-visible hide">
                        FACTURA-2022/000052                     </span>
                  </h3>
                  <h4 class="invoice-html-status mtop7">
               </div>
               <div class="visible-xs">
                  <div class="clearfix"></div>
               </div>
               <a href="#" class="btn btn-success pull-right mleft5 mtop5 action-button invoice-html-pay-now-top hide sticky-hidden
                  ">
                  Pague ahora               </a>
               <form action="https://cenedi.nisadelgado.com/invoice/52/0d406dabd154952f2ebbb99375feb2c3" method="post" accept-charset="utf-8">
<input type="hidden" name="csrf_token_name" value="0ff81bf35839e080dbbf2bd42e26320c" />                                                    
               
               </form>                              <div class="clearfix"></div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="clearfix"></div>
<div class="panel_s mtop20">
   <div class="panel-body">
      <div class="col-md-10 col-md-offset-1">
         <div class="row mtop20">
            <div class="col-md-6 col-sm-6 transaction-html-info-col-left">
               <h4 class="bold invoice-html-number">Paciente</h4>

               <?php echo 'Nombre: ' . $paciente->company; ?><br>
               <?php echo 'Teléfono: ' . $paciente->phonenumber; ?><br>
               <?php echo 'Dirección: ' . $paciente->address; ?><br>

            </div>
            <div class="col-md-6 col-sm-6 transaction-html-info-col-right">
               <h4 class="bold invoice-html-number">Doctor</h4>

               <?php echo 'Nombre: ' . $doctor->firstname . ' ' . $doctor->lastname; ?><br>
               <?php echo 'Teléfono: ' . $doctor->phonenumber; ?><br>
               <?php echo 'Email: ' . $doctor->email; ?><br>

            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
               <div class="table-responsive">
                  <table class="table items items-preview invoice-items-preview" data-type="invoice">
                    <thead>
                        <tr>
                            <th align="center">Descripción</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td><?php echo $recipe->description; ?></td>
                        </tr>
                    </tbody>
                </table>               </div>
            </div>
            <div class="col-md-6 col-md-offset-6">
               
            </div>
                                                            <div class="col-md-12">
               
            </div>
      </div>
   </div>
</div>
<script>
   $(function() {
      new Sticky('[data-sticky]');
      var $payNowTop = $('.pay-now-top');
      if ($payNowTop.length && !$('#pay_now').isInViewport()) {
         $payNowTop.removeClass('hide');
         $('.pay-now-top').on('click', function(e) {
            e.preventDefault();
            $('html,body').animate({
                  scrollTop: $("#online_payment_form").offset().top
               },
               'slow');
         });
      }

      $('#online_payment_form').appFormValidator();

      var online_payments = $('.online-payment-radio');
      if (online_payments.length == 1) {
         online_payments.find('input').prop('checked', true);
      }
   });
</script>
         </div>
      </div>
   </div>
</div>
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <span class="copyright-footer">2023 Derechos de autor de Cenedi Neurologia & Diabetes</span>
                                            </div>
        </div>
    </div>
</footer>
<script type="text/javascript" id="bootstrap-js" src="https://cenedi.nisadelgado.com/assets/plugins/bootstrap/js/bootstrap.min.js?v=2.9.3"></script>
<script type="text/javascript" id="datatables-js" src="https://cenedi.nisadelgado.com/assets/plugins/datatables/datatables.min.js?v=2.9.3"></script>
<script type="text/javascript" id="jquery-validation-js" src="https://cenedi.nisadelgado.com/assets/plugins/jquery-validation/jquery.validate.min.js?v=2.9.3"></script>
<script type="text/javascript" id="jquery-validation-lang-js" src="https://cenedi.nisadelgado.com/assets/plugins/jquery-validation/localization/messages_es.min.js?v=2.9.3"></script>
<script type="text/javascript" id="bootstrap-select-js" src="https://cenedi.nisadelgado.com/assets/builds/bootstrap-select.min.js?v=2.9.3"></script>
<script type="text/javascript" id="bootstrap-select-lang-js" src="https://cenedi.nisadelgado.com/assets/plugins/bootstrap-select/js/i18n/defaults-es_ES.min.js?v=2.9.3"></script>
<script type="text/javascript" id="datetimepicker-js" src="https://cenedi.nisadelgado.com/assets/plugins/datetimepicker/jquery.datetimepicker.full.min.js?v=2.9.3"></script>
<script type="text/javascript" id="chart-js" src="https://cenedi.nisadelgado.com/assets/plugins/Chart.js/Chart.min.js?v=2.9.3"></script>
<script type="text/javascript" id="colorpicker-js" src="https://cenedi.nisadelgado.com/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js?v=2.9.3"></script>
<script type="text/javascript" id="lightbox-js" src="https://cenedi.nisadelgado.com/assets/plugins/lightbox/js/lightbox.min.js?v=2.9.3"></script>
<script type="text/javascript" id="common-js" src="https://cenedi.nisadelgado.com/assets/builds/common.js?v=2.9.3"></script>
<script type="text/javascript" id="theme-global-js" src="https://cenedi.nisadelgado.com/assets/themes/perfex/js/global.min.js?v=1678249651"></script>
<script type="text/javascript" id="sticky-js" src="https://cenedi.nisadelgado.com/assets/plugins/sticky/sticky.js?v=2.9.3"></script>
</body>
</html>
