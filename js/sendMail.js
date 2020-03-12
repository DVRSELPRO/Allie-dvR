/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 Author     : joseluismp2802@gmail.com
 */
//$.noConflict();
var fnc_sendMail = new function () {
    this.options = {
        
    };
    this.sendMail = function (frm) {        
        try {
            var data = new Array;
            //data = {action: "sendMail", idcursosporuser : id}
//            data.push({
//                name: 'action',
//                value: 'save_frm_manager_curscomp'
//            });
            $.ajax({
                url: './php/contact-form.php',
                data: $("form"+frm).serialize(),
                type: 'POST',
                //dataType: "jsonp",
                success: function (json) {
                    if (json) {                        
                        console.log(json);
                        if (json.estatus === 1) {                            
                            $(frm+" div.contactError").html(json.mensaje);
                            $(frm+" div.contactSuccess").removeClass("hidden");
//                            fnc_sendMail.notificarRH(frm);
                        } else if (json.estatus === 0) {
                            $(frm+" div.contactError").html(json.mensaje);
                            $(frm+" div.contactError").removeClass("hidden").show("slow");
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
    this.notificarRH = function (frm) {        
        $(".action").val("notificarRH");
        try {
//            var data = new Array;
//            data = {action: "sendMail", idcursosporuser : id}
//            data.push({
//                name: 'action',
//                value: 'notificarRH'
//            });
            $.ajax({
                url: './php/contact-form.php',
                data: $("form"+frm).serialize(),
                type: 'POST',
                //dataType: "jsonp",
                success: function (json) {}
            });
        } catch (e) {
            console.log('Inconvenientes: ' + e.message);
        }
    };
    
};

/*INICIO CODIGO JQUERY*/
$(function () {
    $("form#frm_generico, form#frm_candidato").submit(function (e) {        
        e.preventDefault();
        var frm = "#"+$(this).attr("id");
        var nombre = $(frm+" input.nombre");
        var tipo = $(frm+" .tipo");
        
        var email = $(frm+" input.email");
        var st = true;

        $(frm+" div.contactError, "+frm+" div.contactSuccess").addClass("hidden").hide("fast");
        var p = "";
        $(frm+" div.contactError").html(p);
        if(nombre.val().trim() == ""){
            p = "<p><strong>!Error!</strong> "+nombre.attr("data-msg-required") + "</p>";
            st = false;
        }
        if(tipo.val().trim() == ""){
            p += "<p><strong>!Error!</strong> "+tipo.attr("data-msg-required") + "</p>";
            st = false;
        }
        if(email.val().trim() == ""){
            p += "<p><strong>!Error!</strong> "+email.attr("data-msg-required") + "</p>";
            st = false;
        }
        var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        if (!testEmail.test(email.val())) {
            p += "<p><strong>!Error!</strong> "+email.attr("data-msg-email") + "</p>";
            st = false;
        }
        if(st){
            fnc_sendMail.sendMail(frm);
        }else{
            $(frm+" div.contactError").html(p);
            $(frm+" div.contactError").removeClass("hidden").show("slow");
            return false;
        }
        
    });

});
/*FIN CODIGO JQUERY*/
