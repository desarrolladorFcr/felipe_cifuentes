var tb_proceso = {
    INICIO: function () {
        tb_proceso.EVENTOS();
        tb_proceso.LOGICA.tabla();
        tb_proceso.LOGICA.dolarHoy();
    },
    EVENTOS: function () {

    },
    LOGICA: {
        tabla: function () {

            $.post('procesos/tabla', {}, function (parameters) {
                $respuesta = JSON.parse(parameters);
                console.log($respuesta);
                $table = tb_proceso.VISTA.tb($respuesta);
                $("#tabla_esp").html($table);
                
            });
        },
        dolarHoy:function (){
            $.post('procesos/dollarService', {}, function (parameters) {
                $res = JSON.parse(parameters);
                $("#dolarHoy").html('Precio del dolar hoy: '+$res['dolar']);
            });
        }
    },
    VISTA: {
        tb: function (dataObj) {
            $tb = "<table class='table table-bordered'>";
            $tb += "<tr class='thead-dark'>";
            $tb += "<th>ID";
            $tb += "</th>";
            $tb += "<th>Númeral";
            $tb += "</th>";
            $tb += "<th>Sede";
            $tb += "</th>";
            $tb += "<th>Descripción";
            $tb += "</th>";
            $tb += "<th>Creación";
            $tb += "</th>";
            $tb += "<th>Presupuesto en pesos";
            $tb += "</th>";
            $tb += "<th>Presupuesto en dolares";
            $tb += "</th>";
            $tb += "<th>";
            $tb += "</th>";
            $tb += "</tr>";
            $.each(dataObj, function ($ix, val) {
                $tb += "<tr>";
                $tb += "<th>";
                $tb += val.id;
                $tb += "</th>";
                $tb += "<th>";
                $tb += val.serial;
                $tb += "</th>";
                $tb += "<th>";
                
                if(val.sede){
                    $tb += val.sede.nombre;
                }
                
                $tb += "</th>";
                $tb += "<th>";
                $tb += val.descripcion;
                $tb += "</th>";
                $tb += "<th>";
                
                let date = new Date(val.creacion.timestamp*1000);
                let mes=date.getMonth()+1; 
                let dia=date.getDate(); 
                let anyo=date.getFullYear();
                
                $tb += anyo+'-'+mes+'-'+dia;
                $tb += "</th>";
                $tb += "<th>";
                
                if(val.presupuesto){
                    $tb += '$'+val.presupuesto;
                }
                
                $tb += "</th>";
                $tb += "<th>";
                
                if(val.usPresupuesto){
                    $tb += "$"+val.usPresupuesto;
                }
                $tb += "</th>";
                $tb += "<th>";
                $tb += "<a href='procesos/ver/"+val.id+"'>VER</a>";
                $tb += "</th>";
                $tb += "</tr>";
            });
            $tb += "</table>";
            return $tb;
        }
    }
}

$(document).ready(tb_proceso.INICIO());

