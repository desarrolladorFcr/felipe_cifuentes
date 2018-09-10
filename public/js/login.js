var login_form={
    INICIO:function (){
        login_form.EVENTS();
    },
    EVENTS:function () {
        $("#login_form").on("submit", login_form.LOGIC.enviar);
    },
    LOGIC:{
        enviar:function (e){
            e.preventDefault()
            url = $(this).attr('action');
            data = $(this).serialize();
            destino = $(this).data('redirect');
            $.post(url, data, function (res){
                $obj = JSON.parse(res);
                
                if($obj.res == true){
                    window.location = destino;
                }else{
                    $("#msj").html($obj.data);
                }
            });
        }
    }
}

$(document).ready(login_form.INICIO());

