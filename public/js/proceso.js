var proceso_fun ={
    INICIO:function () {
        proceso_fun.EVETOS();
        proceso_fun.LOGICA.traersedes();
    },
    EVETOS:function () {
        $("#form_proceso").on("submit", proceso_fun.LOGICA.enviar);
    },
    LOGICA:{
        traersedes:function() {
           urlsedes = $("#urlsedes").val();
           $.post(urlsedes, {}, function (res) {
                $select = proceso_fun.VISTA.select(JSON.parse(res));
                $("#sedes").html($select);
            });
        },
        enviar:function (e){
            e.preventDefault();
            $btn = $("#btn_env");
            $url = $(this).attr("action");
            destino = $(this).data('destino');
            $data = $(this).serialize();
            $btn.prop('disabled', true);
            $.post($url, $data, function (respuesta){
                res = JSON.parse(respuesta);
                
                if(res.res == true){
                    window.location = destino;
                }else{
                   $("#msj").html(res.msj);
                   $btn.prop('disabled', false);  
                }  
            });
        }
    },
    VISTA:{
        select:function (dataObj){
            $select = "<option>Seleccione</option>";
            $.each(dataObj, function (ix, val){
               $select += "<option value='"+val.id+"'>"+ val.nombre+"</option>"; 
            });
            $select += "</select>";
            return $select;
        }
    }
}

$(document).ready(proceso_fun.INICIO);

