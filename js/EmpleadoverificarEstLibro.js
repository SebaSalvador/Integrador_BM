src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js";
src="https://cdn.jsdelivr.net/npm/sweetalert2@11";
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
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Este libro esta en proceso de prestamo o en proceso de observacion, por favor intentelo mas tarde",
                })
                // No es necesario alert() aquí porque Swal.fire ya maneja la alerta.
            } else {
                location.href = "VistaEmpleadoFormPrestamo.php?id_lib="+idLib;
            }
        })
        .catch(error => {
            console.error('Error al verificar estado del libro:', error);
            
        });
}