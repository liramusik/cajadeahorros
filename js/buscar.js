$(document).ready(function() {
	$("#buscar").keyup(function() {
		if($(this).val() != "") {
			$("#listado tbody>tr").hide();
			$("#listado td:contains-ci('" + $(this).val() + "')").parent("tr").show();
		} else {
			$("#listado tbody>tr").show();
		}
	});
});
$.extend($.expr[":"], {
	"contains-ci": function(elem, i, match, array) {
		return (elem.textContent || elem.innerText || $(elem).text() || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
	}
});
