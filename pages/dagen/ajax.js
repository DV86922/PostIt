$("#search").keyup(function(){
    //Lees het veld uit
    let zoek = $('#search').val();
    let naam = $('#naam').val();
    //Controleer of het veld is in gevuld
    if (zoek === "")
    {
        $("#resultaat").html("");
    }
    //Als het veld is ingevuld, verstuur de data naar de verwerkpagina
    else
    {
        $.ajax({
            type:   "POST",
            url:    "ajax.php",
            data:   {"zoek": zoek,
                    "naam": naam},
            success: function (tekst) {
                $("#resultaat").html(tekst);
            },
            error: function (request, error) {
                console.log ("FOUT:" + error);
            }
        });
    }
    //LET OP: FORMULIER MAG NIET 'VERSTUURD' WORDEN!
    return false;
});


// Kleur van dew post it's aanpassen//

let geselecteerdePostIt = null;
$("body").on("click", ".postIt", function (e) {
    geselecteerdePostIt= $(this);
    $(".postIt").removeClass("geselecteerd");
    $(this).addClass("geselecteerd");

});

$("#lichtGrijsPostIt").click(function () {
    $(geselecteerdePostIt).css("background-color", "lightcoral");
})
$("#lichtGeelMPostIt").click(function () {
    $(geselecteerdePostIt).css("background-color", "lightyellow");
})
$("#lichtBlauwPostIt").click(function () {
    $(geselecteerdePostIt).css("background-color", "lightblue");
})
$("#lichtGroenPostIt").click(function () {
    $(geselecteerdePostIt).css("background-color", "lightgreen");
})
