$(document).ready(function() {
    var debug = getQueryVariable("debug") ? getQueryVariable("debug"): false;
    
    if(debug){
        $('#nombre').val('jaime');
        $('#alias').val('jaime');
        $('#rut').val('14017011-9');
        $('#email').val('jaime.salasg@gmail.com');
        $("#region").val('1');
        setTimeout(() => {
            $("#region option:selected").change(); 
        }, 1000);
        setTimeout(() => {
            $('#comuna').val('1');
        }, 2000);
        $('#candidato').val('2');
        $('#web').prop('checked', true);
        $('#tv').prop('checked', true);
    }

    $("#region").on('change', () => {
        var region = $("#region").val();
        var comuna = $("#comuna");
        
        comuna.empty();
        comuna.append($('<option>', {
            value: '',
            text: '(seleccionar)'
        }));

        if(region.length == 0) return false;
        var data = { region: region };
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

var errorStatus;

function formVotacion(){
    errorStatus = true;
    /* Validar el nombre */
    var nombre = $("#nombre");
    setError(nombre, '');
    if(nombre.val().trim().length < 1){
        setError(nombre, 'Debe de ingresar un nombre');
    }
    /* Validar el alias */
    var alias = $("#alias");
    setError(alias, '');
    if (alias.val().length < 5){
        setError(alias, 'El alias debe de ser mayor a 5 caracteres');
        // ^(?=[A-Za-z]+[0-9]|[0-9]+[A-Za-z])[A-Za-z0-9]{5,12}$
    }
    /* Validar RUT */
    var rut = $("#rut");
    setError(rut, '');
    if (!Fn.validaRut(rut.val())) {
        setError(rut, 'El RUT ingresado no es válido');
    }
    /* Validar Email */
    var email = $("#email");
    setError(email, '');
    if (!Fn.validateEmail(email.val())) {
        if(email.val().trim().length == 0){
            setError(email, 'Debes de ingresar un Email válido');
        }else{
            setError(email, 'El Email ingresado no es válido');
        }
    }
    /* Validar nosotros */
    var nosotros = $("[name=nosotros]:checked");
    setError(nosotros, '');
    if (nosotros.length < 2) {
        setError($("[name=nosotros]"), 'Debe seleccionar un mínimo de 2 opciones');
    }
    /* Validar Región */
    var region = $("#region");
    setError(region, '');
    if (region.val().length == 0) {
        setError(region, 'Debes seleccionar una región');
    }
    /* Validar Comuna */
    var comuna = $("#comuna");
    setError(comuna, '');
    if (comuna.val().length == 0) {
        setError(comuna, 'Debes seleccionar una comuna');
    }
    /* Validar Candidato */
    var candidato = $("#candidato");
    setError(candidato, '');
    if (candidato.val().length == 0) {
        setError(candidato, 'Debes seleccionar un candidato');
    }
    /* Valida los errores */
    if(!errorStatus){
        return false;
    }
    saveVotacion();
    return false;
}

function saveVotacion(){
    
    var form_data = new FormData();
    form_data.append('nombre', $("#nombre").val());
    form_data.append('alias', $("#alias").val());
    form_data.append('rut', $("#rut").val());
    form_data.append('email', $("#email").val());
    form_data.append('region', $("#region").val());
    form_data.append('comuna', $("#comuna").val());
    form_data.append('candidato', $("#candidato").val());
    var nosotros = [];
    var data = $("[name=nosotros]:checked");
    $.each(data, function() {
        nosotros.push($(this).val());
    });
    form_data.append('nosotros', nosotros);

    var req = $.ajax({
        url: "../../app/save_votacion.php",
        type: "POST",
        data: form_data,
        processData: false,
        cache: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            alert(data.mensaje);
            if(data.error){

            }
        }
    });
}

function setError(objeto, mensaje){
    objeto.closest("td").find(".error").html(mensaje);
    errorStatus = false;
    if(mensaje.length == 0){
        errorStatus = true;
    }
}

var Fn = {
    /* Valida el rut con su cadena completa "XXXXXXXX-X" */
    validaRut: function (rutCompleto) {
        if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test(rutCompleto))
            return false;
        var tmp = rutCompleto.split('-');
        var digv = tmp[1];
        var rut = tmp[0];
        if (digv == 'K') digv = 'k';
        return (Fn.dv(rut) == digv);
    },
    /* Obtener el Digito Verificador */
    dv: function (T) {
        var M = 0, S = 1;
        for (; T; T = Math.floor(T / 10))
            S = (S + T % 10 * (9 - M++ % 6)) % 11;
        return S ? S - 1 : 'k';
    },
    /* Valida que la dirección email es correcta usuario@dominio.extension */
    validateEmail: (objeto) => {
        var validEmail = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
        if (validEmail.test(objeto)) {
            return true;
        } else {
            return false;
        }
    }
}

function getQueryVariable(variable) {
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i = 0; i < vars.length; i++) {
        var pair = vars[i].split("=");
        if (pair[0] == variable) {
            return pair[1];
        }
    }
    return false;
}