src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js";

function verificarEstado(idLib) {
    var getUrl = window.location;
    var base_url = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
    fetch(base_url + "/controlador/Control_VerificarEstado.php?idLib=" + idLib)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al verificar estado del libro');
            }
            return response.json();
        })
        .then(data => {
            if (data != 1) {
                alert("Este libro esta en proceso de prestamo, por favor intentelo mas tarde");
            } else {
                location.href = "VistaEmpleadoFormPrestamo.php?id_lib="+idLib;
            }
        })
        .catch(error => {
            console.error('Error al verificar estado del libro:', error);
            
        });
}