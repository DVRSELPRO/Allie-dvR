var fnc_registrocandidato = new function () {
    this.options = {
        arrIdsFile: new Array(),
        arrElmentsCards: new Array(),
        arrModeloxmls: new Array()
    };    
    this.closeDivAlert = function () {
        $("div.div_mensajes").fadeOut("fast");
        $("div.div_mensajes div.mensaje").html("");
    };      
    
    this.checkSaveCancelar = function (uuid, id){
        $("div."+id).remove();
        fnc_registrocandidato.deleteUploadFileByUuid(id);
    };
    this.deleteUploadFileByUuid = function (id) {
        try {
            var data = new Array;
            data = {action: "deleteUploadFileByID", "id": id}
//            data.push({name: 'action',value: 'save_frm_manager_cursos'});
            $.ajax({
                url: './uploadFiles.php',
                data: data,
                type: 'POST',
                //dataType: "jsonp",
                success: function (json) {
                    if (json) {
                        console.log(json);
                        if (json.estatus === 1) {
                            
                        } else if (json.estatus === 0) {
                            alert(json.mensaje);
                        }
                    } else {
                        console.log('Error al ejecutar los datos');
                    }
                }
            });        
        } catch (e) {
            console.log('Inconvenientes: ' + e.message);
        }
    };  
    this.btnContinuar = function (){
        $("div.divUploadFiles").hide();
        $("div.filesXML, div.divBtnFinalizar").fadeIn("slow")        
    };
    this.btnCancelar = function (){
        fnc_registrocandidato.deleteUploadFilesNoActivos();
        window.location.href = "subir-xmls.php";
    };
    this.btnFinalizarUplods = function () {
        try {
            var arr = fnc_registrocandidato.options.arrUUIDS;
            if(arr.length > 0){
                var data = new Array;
                data = {action: "btnFinalizarUplods", "uuids": arr}
    //            data.push({name: 'action',value: 'save_frm_manager_cursos'});
                $.ajax({
                    url: './uploadFiles.php',
                    data: data,
                    type: 'POST',
                    //dataType: "jsonp",
                    success: function (json) {
                        if (json) {
                            console.log(json);
                            if (json.estatus === 1) {
                                $("div.div_mensajesFiles").show();            
                                $("div.div_mensajesFiles span.mensaje").html(json.mensaje);
                                $(".btnBoxCancelar, .btnheaderCancelar, .btnheaderGuardar").fadeOut("fast")
                                $(".btnBoxSaved, .btnheaderSubirFiles").show();
                            } else if (json.estatus === 0) {
                                $("div.div_mensajesFiles").show();            
                                $("div.div_mensajesFiles span.mensaje").html(json.mensaje);
                            }
                        } else {
                            console.log('Error al ejecutar los datos');
                        }
                    }
                });   
            }else{
                alert("No hay nada en el array");
            }            
        } catch (e) {
            console.log('Inconvenientes: ' + e.message);
        }
    };  
    
    this.deleteUploadFilesNoActivos = function () {
        try {
            var data = new Array;
            data = {action: "deleteUploadFilesNoActivos"}
//            data.push({name: 'action',value: 'save_frm_manager_cursos'});
            $.ajax({
                url: './uploadFiles.php',
                data: data,
                type: 'POST',
                //dataType: "jsonp",
                success: function (json) {
                    if (json) {
                        console.log(json);
                        if (json.estatus === 1) {
                            
                        } else if (json.estatus === 0) {
                            alert(json.mensaje);
                        }
                    } else {
                        console.log('Error al ejecutar los datos');
                    }
                }
            });        
        } catch (e) {
            console.log('Inconvenientes: ' + e.message);
        }
    };      
    this.getDirByCP = function (cp) {
        try {
//            var cp = $("form#frm_candidato input.cp").val();
            $("label.lugarTrabajo-0").val("¿Prestaré mis servicios la direción dada?")
            if (cp.length == 5) {
                if (!isNaN(cp)) {
                    $.ajax({
                        url: 'registro-candidato.php',
                        data: {action: 'getDirByCP', cp: cp},
                        type: 'POST',
                        success: function (json) {
                            if (json) {
                                $("select.colonia").html("");
                                if (json.estatus == 1) {
                                    $("select.colonia").append(json.colonias);
                                    $("input.delegacion").val(json.municipio);
                                    $("input.estado").val(json.estado);
                                    $("input.ciudad").val(json.ciudad);
                                    $("label.lugarTrabajo-0").html("¿Prestaré mis servicios en "+json.estado+", "+json.ciudad+"?");
                                } else if (json.estatus == 0) {
                                    $(" input.cp").val("");
                                    $("select.colonia").html("<option value=''>Error al obtener los datos<option>");
                                }
                            } else {
                                console.log('Error al ejecutar los datos');
                            }
                        }
                    });
                } else {
                    alert("no es numerico");
                }
            } else {
                alert("El codigo p debe ser 5 digi");
            }
                   
        } catch (e) {
            console.log('Inconvenientes: ' + e.message);
        }
    };
    this.getCatEstados = function () {
        try {
            $("select.empleado_lugarTrabajo_estado").html("");
            $("select.empleado_lugarTrabajo_ciudad").html("");
            $.ajax({
                url: 'registro-candidato.php',
                data: {action: 'getCatEstados'},
                type: 'POST',
                success: function (json) {
                    if (json) {                        
                        if (json.estatus == 1) {
                            $("select.empleado_lugarTrabajo_estado").html(json.catEstados);
                            $("select.empleado_lugarTrabajo_ciudad").html("<option value='' selected=''>Seleccione un estado</option>");
                        } else if (json.estatus == 0) {                            
                            $(" input.cp").val("");
                            $("select.empleado_lugarTrabajo_estado").html("<option value='' selected=''>Error al obtener los datos</option>");
                        }
                    } else {
                        console.log('Error al ejecutar los datos');
                    }
                }
            });

                   
        } catch (e) {
            console.log('Inconvenientes: ' + e.message);
        }
    };
    this.saveRegistroCandidado = function () {
        try {
//            var data = new Array;
//            data = {action: "sendMail", idcursosporuser: id}
//            data.push({
//                name: 'action',
//                value: 'saveRegistroCandidado'
//            });
            $.ajax({
                url: 'registro-candidato.php',
                data: $("form#frm_candidato").serialize(),
                type: 'POST',
                success: function (json) {
                    if (json) {                        
                        if (json.estatus == 1) {
                            $("div.div_mensajes").addClass("alert-success");
                            $("div.div_mensajes").show("fast");
                            $("div.div_mensajes span.icon_blocked").show("fast");
                            $("div.div_mensajes div.mensaje").html(json.mensaje);                
                            $("form#frm_candidato")[0].reset();
                        } else if (json.estatus == 0) {                            
                            $("div.div_mensajes").addClass("alert-danger");
                            $("div.div_mensajes").show("fast");
                            $("div.div_mensajes span.icon_blocked").show("fast");
                            $("div.div_mensajes div.mensaje").html(json.mensaje);            
                        }
                    } else {
                        console.log('Error al ejecutar los datos');
                    }
                    $("button.btnFinalizar").html("Finalizar");
                }
            });

                   
        } catch (e) {
            console.log('Inconvenientes: ' + e.message);
        }
    };
    
    this.getCiudadByEstado = function (estado) {
        try {
            //existe elemento
            if($("form#frm_candidato select.empleado_lugarTrabajo_ciudad").length > 0){
                $("form#frm_candidato input.empleado_lugarTrabajo_ciudad").remove();
            }else{
                //crear select ciudad
                var cad = '<select class="form-control empleado_lugarTrabajo_ciudad" required="" id="empleado_lugarTrabajo_ciudad" name="empleado_lugarTrabajo_ciudad"><option value="">Seleccionar</option></select>';
                $("form#frm_candidato div.div-ciudad").append(cad);
                $("form#frm_candidato input.empleado_lugarTrabajo_ciudad").remove();
                $("form#frm_candidato").on('change', "select.empleado_lugarTrabajo_ciudad", function (e) {
                    if ($(this).val() == "-1") {
                        $(this).parent().append("<input type='text' name='empleado_lugarTrabajo_ciudad' class='form-control empleado_lugarTrabajo_ciudad' id='empleado_lugarTrabajo_ciudad' placeholder='¿Cuál es tú ciudad?'>");
                        $("form#frm_candidato select.empleado_lugarTrabajo_ciudad").remove();
                        
                    }
                });
                
            }
            $("select.empleado_lugarTrabajo_ciudad").html("<option value='' selected=''>Cargando...</option>");
            $.ajax({
                url: 'registro-candidato.php',
                data: {action: 'getCiudadByEstado', estado: estado},
                type: 'POST',
                success: function (json) {
                    if (json) {                        
                        if (json.estatus == 1) {
                            $("select.empleado_lugarTrabajo_ciudad").html(json.ciudades);                            
                        } else if (json.estatus == 0) {                            
                            $(" input.cp").val("");
                            $("select.empleado_lugarTrabajo_estado").html("<option value='' selected=''>Error al obtener los datos</option>");
                        }
                    } else {
                        console.log('Error al ejecutar los datos');
                    }
                }
            });

                   
        } catch (e) {
            console.log('Inconvenientes: ' + e.message);
        }
    };
    this.checkCP = function (cp) {
        try {
            if (!isNaN(cp)) {
                $('form#frm_candidato input.cp').val("");
            }
                   
        } catch (e) {
            console.log('Inconvenientes: ' + e.message);
        }
    };
    this.isNumber = function (evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    };
   
};

/*INICIO CODIGO JQUERY*/
$(function () {
//    setInterval(function(){
//        var arr = fnc_registrocandidato.options.arrUUIDS;
//        if(arr.length > 0){
//            $("div button.btnAceptar").show();
//        }else{
//            $("div button.btnAceptar").hide();
//        }
//    },1000);
    
    $("form#frm_candidato select.empleado_lugarTrabajo_ciudad").change(function(){
        $("form#frm_candidato input.empleado_lugarTrabajo_ciudad").remove();
        if($(this).val() == "-1"){                        
            $(this).parent().append("<input type='text' name='empleado_lugarTrabajo_ciudad' class='form-control empleado_lugarTrabajo_ciudad' id='empleado_lugarTrabajo_ciudad' placeholder='¿Cuál es tú ciudad?'>");
            $("form#frm_candidato select.empleado_lugarTrabajo_ciudad").remove();
        }
        
    });
    
    $("form#frm_candidato input.lugarTrabajo").change(function(){        
        if($(this).val() == "Si"){
            $estado = $("input.estado").val();
            $ciudad = $("input.ciudad").val();
            $("div.div-lugarTrabajo").hide("fast");
            $("select.empleado_lugarTrabajo_estado").html("<option value='"+$estado+"' selected=''>"+$estado+"</option>");
            $("select.empleado_lugarTrabajo_ciudad").html("<option value='"+$ciudad+"' selected=''>"+$ciudad+"</option>");
        }else{            
            $("div.div-lugarTrabajo").show("fade");   
            //mostrar catalogo de estados
            fnc_registrocandidato.getCatEstados();
            $("select.empleado_lugarTrabajo_estado").html("<option value='' selected=''>Cargando...</option>");
            $("select.empleado_lugarTrabajo_ciudad").html("<option value='' selected=''>Cargando...</option>");
        }
    });
    $("form#frm_candidato input.tieneNSS").change(function(){        
//        if($(this).val().is(':checked')) {
        if($(this).val() == "Si"){
            $("div.div-nss").show("fade");   
        }else{
            $("div.div-nss").hide("fast");
            $("input.nss").val("");
        }
    });

    $("form#frm_candidato").submit(function (e) {        
        e.preventDefault();        
        var frm = "#"+$(this).attr("id");
        var nombreempleado = $(frm+" input.nombreempleado");
        var apellidopaterno = $(frm+" input.apellidopaterno");
        var apellidomaterno = $(frm+" input.apellidomaterno");
        //fecha de nacimiento
        var fechaNacimiento_dia = $(frm+" select.fechaNacimiento_dia");
        var fechaNacimiento_mes = $(frm+" select.fechaNacimiento_mes");
        var fechaNacimiento_year = $(frm+" select.fechaNacimiento_year");
        var tienesnss = $(frm+" input.tieneNSS");
        var nss = $(frm+" input.nss");
        var curp = $(frm+" input.curp");
        var rfc = $(frm+" input.rfc");
        var estadoCivil = $(frm+" select.estadoCivil");
        var calle = $(frm+" input.calle");
        var numeroInterior = $(frm+" input.numeroInterior");
        var numeroExterior = $(frm+" input.numeroExterior");
        var cp = $(frm+" input.cp");
        var colonia = $(frm+" select.colonia");
        var ciudad = $(frm+" input.ciudad");
        var email = $(frm+" input.email");
        var telefonoCelular = $(frm+" input.telefonoCelular");
        var nivelEstudio = $(frm+" select.nivelEstudio");
        var dependientesEconomico = $(frm+" input.dependientesEconomico");
        var experienciaLaboral_estatus = $(frm+" input.experienciaLaboral_estatus");
        var experienciaLaboral_puesto = $(frm+" select.experienciaLaboral_puesto");
        var lugarTrabajo = $(frm+" input.lugarTrabajo");
        var empleado_lugarTrabajo_estado = $(frm+" select.empleado_lugarTrabajo_estado");
        var empleado_lugarTrabajo_ciudad = $(frm+" .empleado_lugarTrabajo_ciudad");
        var nombreArchivo = $(frm+" input.nombreArchivo");
        
        var st = true;
        $("div.div_mensajes").removeClass("alert-danger");
        $("div.div_mensajes").removeClass("alert-success");
        $("div.div_mensajes").hide("fast");
        $("div.div_mensajes span.icon_blocked, div.div_mensajes span.icon_like").hide("fast");
        $("div.div_mensajes div.mensaje").html("");        
        //loading ->btnFinalizar
        $("button.btnFinalizar").show("fast").html("Cargando...");
        var p = "";
        if(nombreempleado.val().trim() == ""){
            p += "<p>El nombre es obligatorio.</p>";
            st = false;
        }
        if(apellidopaterno.val().trim() == ""){
            p += "<p>El apellido paterno es obligatorio.</p>";
            st = false;
        }
        if(apellidomaterno.val().trim() == ""){
            p += "<p>El apellido materno es obligatorio.</p>";
            st = false;
        }
        if(fechaNacimiento_dia.val().trim() == "" || fechaNacimiento_mes.val().trim() == "" || fechaNacimiento_year.val().trim() == ""){
            p += "<p>La fecha de nacimiento es obligatorio. Debe seleccionar el día, mes y año.</p>";
            st = false;
        }
        if(tienesnss.val().trim() == ""){
            p += "<p>¿Cuentas con Número de Seguridad Social?</p>";
            st = false;
        }
        if(tienesnss.val().trim() != ""){
            if($("input.tieneNSS:checked").val() == "Si") {
                if(nss.val().trim() == ""){
                    p += "<p>El número de seguridad social es obligatorio.</p>";
                    st = false;
                }                
            }
        }
        if(curp.val().trim() == ""){
            p += "<p>El CURP es obligatorio.</p>";
            st = false;
        }
        if(curp.val().trim() != ""){
            if (curp.val().length != 18) {
                p += "<p>El CURP debe tener 18 caracteres.</p>";
                st = false;
            }         
        }
        if(rfc.val().trim() == ""){
            p += "<p>El RFC es obligatorio.</p>";
            st = false;
        }
        if(rfc.val().trim() != ""){
            if (rfc.val().length != 13) {
                p += "<p>El RFC debe tener 13 caracteres.</p>";
                st = false;
            }         
        }
        if(estadoCivil.val().trim() == ""){
            p += "<p>El estado civil es obligatorio.</p>";
            st = false;
        }
        if(calle.val().trim() == ""){
            p += "<p>Debe teclear la calle donde vive.</p>";
            st = false;
        }
        if(numeroExterior.val().trim() == ""){
            p += "<p>El número exterior es obligatorio.</p>";
            st = false;
        }
        if(cp.val().trim() == ""){
            p += "<p>Código Postal es obligatorio.</p>";
            st = false;
        }
        if(colonia.val().trim() == ""){
            p += "<p>Debe seleccionar una colonia de la lista.</p>";
            st = false;
        }
        if(ciudad.val().trim() == ""){
            p += "<p>Debe teclear la ciudad.</p>";
            st = false;
        }
        if(email.val().trim() == ""){
            p += "<p>Debe teclear un correo electrónico.</p>";
            st = false;
        }
        if(email.val().trim() != ""){
            var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
            if (!testEmail.test(email.val())) {                
                p += "<p>El correo electrónico es inválido.</p>";
                st = false;
            }
        }
        if(telefonoCelular.val().trim() == ""){
            p += "<p>El teléfono celular es obligatorio.</p>";
            st = false;
        }
        if(nivelEstudio.val().trim() == ""){
            p += "<p>Debe seleccionar un nivel de estudio de la lista.</p>";
            st = false;
        }
        if(dependientesEconomico.val().trim() == ""){
            p += "<p>Favor de indicar sí tiene dependientes económicos.</p>";
            st = false;
        }
        if(experienciaLaboral_estatus.val().trim() == ""){
            p += "<p>Favor de indicar sí se encuentra laborando actualmente.</p>";
            st = false;
        }
        if(experienciaLaboral_puesto.val().trim() == ""){
            p += "<p>Favor de indicar el último puesto.</p>";
            st = false;
        }
        if(lugarTrabajo.val().trim() == ""){
            p += "<p>Favor de indicar dónde prestará sus servicios.</p>";
            st = false;
        }
        if(lugarTrabajo.val() == "Si"){
            if (empleado_lugarTrabajo_estado.val() == "") {
                p += "<p>Favor de seleccionar el estado.</p>";
                st = false;
            }
            if (empleado_lugarTrabajo_ciudad.val() == "") {
                p += "<p>Favor de seleccionar la ciudad.</p>";
                st = false;
            }
        }        
       
        //div_mensajes -> alert-success alert alert-danger
        if(st){
            fnc_registrocandidato.saveRegistroCandidado();
        }else{
            $("div.div_mensajes").addClass("alert-danger");
            $("div.div_mensajes").show("fast");
            $("div.div_mensajes span.icon_blocked").show("fast");
            $("div.div_mensajes div.mensaje").html(p);            
            $("button.btnFinalizar").html("Finalizar");
            return false;
        }
        
    });
    
});
/*FIN CODIGO JQUERY*/



