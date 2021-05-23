
function mostrar(id) {
    if (id == "R") {
        $("#R").show(400);
        $("#C").hide(400);
		$("#J").hide(400);
    }

    if (id == "C") {
        $("#R").hide(400);
        $("#C").show(400);
		$("#J").hide(400);
    }
	
	if (id == "J") {
        $("#R").hide(400);
        $("#C").hide(400);
		$("#J").show(400);
    }
	
	if (id == "") {
        $("#R").hide(400);
        $("#C").hide(400);
		$("#J").hide(400);
    }
	
}
