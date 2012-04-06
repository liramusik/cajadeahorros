<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Caja de Ahorrro</title>
		<link href="css/style.css" rel="stylesheet" type="text/css" />
		<link href="js/jquery.ui/css/ui-lightness/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css" />
		<script language="javascript" src="js/jquery.ui/js/jquery-1.7.1.min.js"></script>
		<script language="javascript" src="js/jquery.ui/js/jquery-ui-1.8.18.custom.min.js"></script>
		<script language="javascript" src="js/jquery.dataTables.js"></script>
		<script language="javascript" src="js/jquery.validate.js"></script>
		<script language="javascript" src="js/jquery.form.js"></script>
		<script language="javascript" src="js/formularios.js"></script>
		<script type="text/javascript">
			$(function() {
				$("#ui-accordion")
					.accordion({
						header: "> div > h3"
					})
					.sortable({
						axis: "y",
						handle: "h3",
						stop: function(event, ui) {
							ui.item.children( "h3" ).triggerHandler( "focusout" );
						}
					});
			});
			$(function() {
				$("#fecha_ingreso").datepicker({
					dateFormat: 'dd/mm/yy'
				});
				$("#fecha_egreso").datepicker({
					dateFormat: 'dd/mm/yy'
				});
				$("#fecha").datepicker({
					dateFormat: 'dd/mm/yy'
				});
			});
		</script>
                <script type="text/javascript"> 
                        $(document).ready(function() { 
                                var opciones = {
                                        success: mostrarRespuesta,
                                };
                                $('.form').ajaxForm(opciones);
                                function mostrarRespuesta(responseText) {
                                        alert("Mensaje: " + responseText);
                                        $('.form').resetForm();
                                }; 
                        }); 
                </script> 
	</head>
	<body>
