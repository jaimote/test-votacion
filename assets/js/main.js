$(document).ready(function() {
    $("#region").change(() => {
        var region = $("#region").val();
        var comuna = $("#comuna");
        
        comuna.empty();
        comuna.append($('<option>', {
            value: '',
            text: '(seleccionar)'
        }));

        if(region.length == 0) return false;
        
        var data = {
            region: region 
        };

        var req = $.ajax({
            url: "../componentes/get_comunas.php",
            type: "GET",
            data: data,
            dataType: "json",
            cache: false,
            success: function(data){
                $.each(data, (i, item) => {
                    comuna.append($('<option>', {
                        value: item.id,
                        text: item.nombre
                    }))
                })

            }
        });

    });
});

function formVotacion(){
    var nombre = $("#nombre");
    var alias = $("#alias");
    var rut = $("#rut").val().split("-");
    digito = dgv(rut[0]);
    console.log(digito);
    return false;
    if (digito.toLowerCase() != rut[1].toLowerCase()){
        alert("Error de rut");
        $("#rut").val('');
    }
    var nombre = $("#nombre");

    return false;
}

function dgv(T) 
{
    var M = 0, S = 1;
    for (; T; T = Math.floor(T / 10))
        S = (S + T % 10 * (9 - M++ % 6)) % 11;
    //return S?S-1:'k';

    return (S ? S - 1 : 'k');
}