<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Caja de Ahorrro</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/jquery-1.7.1.min.js"></script>
<script language="javascript" src="js/jquery-ui-1.8.18.custom.min.js"></script>
<script language="javascript" src="js/jquery.validate.min.js"></script>
<script language="javascript" src="js/headers.js"></script>
<script language="javascript" src="js/jquery.dataTables.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("ul.subnavegador").not('.selected').hide();
		$("a.desplegable").click(function(e) {
			var desplegable = $(this).parent().find("ul.subnavegador");
			$('.desplegable').parent().find("ul.subnavegador").not(desplegable).slideUp('slow');
			desplegable.slideToggle('slow');
			e.preventDefault();
		});
	});
</script>
</head>
<body>
