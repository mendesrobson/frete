$( "#codcliente" ).change(function() {

    $.ajax({
        url : "https://sonasystem.com.br/apis/v1/clientes/buscarcodigo/codigo="+ $( "#codcliente" ).val(),
        type : 'get',
        beforeSend : function(){
            $("#loading").show();
             console.log("ENVIANDO...")
        }
   })
   .done(function(msg){
        if(msg.status == 200){
            $("#Cliente").val(msg.dados[0].NomeFantasia);
        }
        $("#loading").hide();
   })
   .fail(function(jqXHR, textStatus, msg){
        alert(msg);
   });

    // $("#Cliente").val($( "#codcliente" ).val());
});