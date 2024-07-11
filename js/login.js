
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
                                //console.log(response);
                                array = JSON.parse(response);
                                let dni = array.id_per;
                                console.log("DNI: "+dni);
                                sessionStorage.setItem('id_user', dni);
                                //let tipo = array.id_tipo;
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
