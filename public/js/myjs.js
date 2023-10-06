/*CAMBIA EL TIPO DEL INPUT PASS*/
function pass()
{

    var ojoab = document.getElementById("ojo1");
    var ojocer = document.getElementById("ojo2");
    if(ojoab.style.display==='none')
    {
        ojoab.style.display='block';
        ojocer.style.display='none';
        document.getElementById("password").type="password";

    }
    else
    {
        ojoab.style.display='none';        
        ojocer.style.display='block';
        document.getElementById("password").type="text";
    }
}


function openmodaladd()
{
    $('#myModaladd').modal('show');
}
//FUNCION CAMPO SOLO NUMEROS
jQuery(document).ready(function(){
    // CAPTURA LA ENTRADA DEL EVENTO
    jQuery("#item1a").on('input', function (evt) {
        // PERMITE SOLO NUMEROS.
        jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, ''));
    });
    jQuery("#item2a").on('input', function (evt) {
        // PERMITE SOLO NUMEROS.
        jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, ''));
    });
});


//DATE PICKER
$('.datepicker').datepicker({
    inline: true
  });


//Agregar Asesor
function add_asesor()
{
    document.getElementById("loaderblock").style.display = "inherit";
    var data = new Array();
    data[0] = document.getElementById("item0a").value;
    data[1] = document.getElementById("item1a").value;
    data[2] = document.getElementById("item2a").value;
    data[3] = document.getElementById("item3a").value;
    data[4] = document.getElementById("item4a").value;
    data[5] = document.getElementById("item5a").value;
    data[6] = document.getElementById("item6a").value;
    data[7] = document.getElementById("user").value;
    if (data[0] != '' && data[1] != '' && data[2] != '' && data[4] != '' && data[5] != '' && data[3] != '') {
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: "php/asesor/add.php",
            data: { data: data },
            success: function(json) {
                if (json != '') {
                    document.getElementById("loaderblock").style.display = "none";
                    document.getElementById("imagen-modal").innerHTML = "<img class='img-fluid' style='border-radius:10%;' src='images/go-img.gif'>";
                    document.getElementById("resultado").innerHTML = "Asesor Agregado!!!";
                    document.getElementById("resultado1").innerHTML = "Excelente!!!";
                    $(myModal).modal('show');
                    setTimeout('location.reload(true);', 2000);
                } else {
                    document.getElementById("loaderblock").style.display = "none";
                    document.getElementById("imagen-modal").innerHTML = "<img class='img-fluid' style='border-radius:20%;' src='images/fail-img.webp'>";
                    document.getElementById("resultado1").innerHTML = "Lo sentimos!!!";
                    document.getElementById("resultado").innerHTML = "Encontramos un error!!!";
                    $(myModal).modal('show');
                    setTimeout('$(myModal).modal("hide");', 2000);
                }
            }
        });
    } else {
        document.getElementById("loaderblock").style.display = "none";
        document.getElementById("imagen-modal").innerHTML = "<img class='img-fluid' style='border-radius:20%;' src='images/fail-img.webp'>";
        document.getElementById("resultado1").innerHTML = "Lo sentimos!!!";
        document.getElementById("resultado").innerHTML = "Hay campos vacíos!!!";
        $(myModal).modal('show');
        setTimeout('$(myModal).modal("hide");', 2000);
    }
}


//CARGAR ASESORES
function loaddata() {
    document.getElementById("loaderblock").style.display = "inherit";
    document.getElementById("listaitems").innerHTML = "";
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: "php/asesor/loaddata.php",
        success: function(json) {
            document.getElementById("loaderblock").style.display = "none";
            for (aux = 0; aux <= json.length; aux++) {
                var spliter = json[aux];
                document.getElementById("listaitems").innerHTML += '<tr><th>' + spliter[0] + '</th><th>' + spliter[1] + '</th><th>' + spliter[2] + '</th><th>' + spliter[3] + '</th><th>' + spliter[4] + '</th><th>' + spliter[5] + '</th><th>' + spliter[6] + '</th><th>' + spliter[7] + '</th><th>' + spliter[8] + '</th><th>' + spliter[9] + '</th></tr>'
            }
        }
    });
}


//CARGA MODIFICAR ASESOR
function load_mod_asesor(id)
{
    document.getElementById("loaderblock").style.display = "inherit";
    document.getElementById("iditem").value = id;
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: "php/asesor/loadmoddata.php",
        data: { id: id},
        success: function(json) {
            document.getElementById("loaderblock").style.display = "none";
            document.getElementById("item0m").value = json[0];
            document.getElementById("item1m").value = json[1];
            document.getElementById("item2m").value = json[2];
            document.getElementById("item3m").value = json[3];
            document.getElementById("item4m").value = json[4];
            document.getElementById("item5m").value = json[5];
            document.getElementById("item6m").value = json[6];
            $(myModalmod).modal('show');
        }
    });
}
function mod_asesor()
{
    document.getElementById("loaderblock").style.display = "inherit";
    var id = document.getElementById("iditem").value;
    var data = new Array();
    data[0] = document.getElementById("item0m").value;
    data[1] = document.getElementById("item1m").value;
    data[2] = document.getElementById("item2m").value;
    data[3] = document.getElementById("item3m").value;
    data[4] = document.getElementById("item4m").value;
    data[5] = document.getElementById("item5m").value;
    data[6] = document.getElementById("item6m").value;
    data[7] = document.getElementById("user").value;
    if (data[0] != '' && data[1] != '' && data[2] != '' && data[4] != '' && data[5] != '' && data[3] != '') {
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: "php/asesor/moddata.php",
            data: { data: data, id:id },
            success: function(json) {
                if (json != '') {
                    document.getElementById("loaderblock").style.display = "none";
                    document.getElementById("imagen-modal").innerHTML = "<img class='img-fluid' style='border-radius:10%;' src='images/go-img.gif'>";
                    document.getElementById("resultado").innerHTML = "Asesor Modificado!!!";
                    document.getElementById("resultado1").innerHTML = "Excelente!!!";
                    $(myModal).modal('show');
                    setTimeout('location.reload(true);', 2000);
                } else {
                    document.getElementById("loaderblock").style.display = "none";
                    document.getElementById("imagen-modal").innerHTML = "<img class='img-fluid' style='border-radius:20%;' src='images/fail-img.webp'>";
                    document.getElementById("resultado1").innerHTML = "Lo sentimos!!!";
                    document.getElementById("resultado").innerHTML = "Encontramos un error!!!";
                    $(myModal).modal('show');
                    setTimeout('$(myModal).modal("hide");', 2000);
                }
            }
        });
    } else {
        document.getElementById("loaderblock").style.display = "none";
        document.getElementById("imagen-modal").innerHTML = "<img class='img-fluid' style='border-radius:20%;' src='images/fail-img.webp'>";
        document.getElementById("resultado1").innerHTML = "Lo sentimos!!!";
        document.getElementById("resultado").innerHTML = "Hay campos vacíos!!!";
        $(myModal).modal('show');
        setTimeout('$(myModal).modal("hide");', 2000);
    }
}


//Eliminar Asesor
function del_open(id){
    document.getElementById("loaderblock").style.display = "inherit";
    document.getElementById("iditem").value = id;
    $(myModaldel).modal('show');
    document.getElementById("loaderblock").style.display = "none";
}
function del_asesor()
{
    document.getElementById("loaderblock").style.display = "inherit";
    var id = document.getElementById("iditem").value;
    var user = document.getElementById("user").value;
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: "php/asesor/deldata.php",
        data: { user: user, id:id },
        success: function(json) {
            if (json != '') {
                document.getElementById("loaderblock").style.display = "none";
                document.getElementById("imagen-modal").innerHTML = "<img class='img-fluid' style='border-radius:10%;' src='images/go-img.gif'>";
                document.getElementById("resultado").innerHTML = "Asesor Eliminado!!!";
                document.getElementById("resultado1").innerHTML = "Excelente!!!";
                $(myModal).modal('show');
                setTimeout('location.reload(true);', 2000);
            } else {
                document.getElementById("loaderblock").style.display = "none";
                document.getElementById("imagen-modal").innerHTML = "<img class='img-fluid' style='border-radius:20%;' src='images/fail-img.webp'>";
                document.getElementById("resultado1").innerHTML = "Lo sentimos!!!";
                document.getElementById("resultado").innerHTML = "Encontramos un error!!!";
                $(myModal).modal('show');
                setTimeout('$(myModal).modal("hide");', 2000);
            }
        }
    });

}

