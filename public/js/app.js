var BASE = 'http://skripsi.local/';
$("#search-button").click(function() {
   var id = $("#search-input").val();
   location.assign(BASE+"peserta/detail/"+id);
});
$("#program_1").change(function() {
	var minat = $("#group_1");
	$("#program_1 option:selected").each(function() {
		if ($( this ).val() == "Reguler") {
			minat.removeAttr("disabled");
		}
		else
		{
			minat.attr("disabled", "disabled");
		}
	});
});
$("#program_2").change(function() {
	var minat = $("#group_2");
	$("#program_2 option:selected").each(function() {
		if ($( this ).val() == "Reguler") {
			minat.removeAttr("disabled");
		}
		else
		{
			minat.attr("disabled", "disabled");
		}
	});
});