$("#search").keyup(function () {
    //Lees het veld uit
    let zoek = $('#search').val();
    let naamID = $('#naamID').val();
    let dagID = $('#dagID').val();
    let naam = $('#naam').val();
    //Controleer of het veld is in gevuld
    if (zoek !== "") {
        // Alleen degene die de value heeft van zoek tonen
        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: {
                "zoek": zoek,
                "naamID": naamID,
                "dagID": dagID,
                "naam": naam
            },
            success: function (tekst) {
                $("#result").html(tekst);
            },
            error: function (request, error) {
                console.log("FOUT:" + error);
            }
        });
    }
    //Als er niks is ingevuld toon de hele lijst
    else {
        $.ajax({
            type: "POST",
            url: "allePostIt.php",
            data: {
                "zoek": zoek,
                "naamID": naamID,
                "dagID": dagID,
                "naam": naam
            },
            success: function (tekst) {
                $("#result").html(tekst);
            },
            error: function (request, error) {
                console.log("FOUT:" + error);
            }
        });
    }
    //LET OP: FORMULIER MAG NIET 'VERSTUURD' WORDEN!
    return false;
});


$("#lichtRoodPostIt").click(function () {
    $('.postIt').css("background-color", "lightcoral");
})
$("#lichtGeelPostIt").click(function () {
    $('.postIt').css("background-color", "lightyellow");
})
$("#lichtBlauwPostIt").click(function () {
    $('.postIt').css("background-color", "lightblue");
})
$("#lichtGroenPostIt").click(function () {
    $('.postIt').css("background-color", "lightgreen");
})


