if (mostrar == "si") { 
    $(document).ready(function () {
        $(".modal").show(0);
        $(".modal").css({
            "transition": "all 0.5s",
            "position": "fixed",
            "display": "flex",
            "flex-wrap": "wrap",
            "background": "rgba(0,0,0,0.8)",
            "top": "0",
            "left": "0",
            "width": "100%",
            "height": "100%"
        })
    });    
}

if (error == "si") { 
    $(document).ready(function () {
        $(".error").show(0);
        $(".datos").css({
            "height": "200px"
        })
    });    
}