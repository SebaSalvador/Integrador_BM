
function logueo(){
    let bool = false;
    let object = {
        action: "autenticar",
        email: $('#user_id').val(),
        pass: $('#password').val()
    };
    //console.log(object);
    $.ajax({
        url: 'controlador/Control_ModUser.php',
        data: JSON.stringify(object),
        type: 'POST',
        success: function (response) {
            if(!response.error) {
                bool = JSON.parse(response);
                //console.log(bool);
                if (bool) {
                    let array = [];
                    let object = {
                        action: "traerUsuario",
                        email: $('#user_id').val(),
                        pass: $('#password').val()
                    };
                    //console.log(object);
                    $.ajax({
                        url: 'controlador/Control_ModUser.php',
                        data: JSON.stringify(object),
                        type: 'POST',
                        success: function (response) {
                            if(!response.error) {
                                //alert(response);
                                array = JSON.parse(response);
                
                                let dni = array.id_per;
                                let tipo = array.id_tipo;
                                //console.log("DNI: "+dni);
                                sessionStorage.setItem('id_user', dni);
                                sessionStorage.setItem('id_tipo', tipo);//problema sale null
                            }
                        }
                    });
                    
                } else {
                    console.log("Problema con bool");
                }
            }
        }
    });

    //console.log(bool);
}
