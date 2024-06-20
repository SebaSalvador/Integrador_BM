src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js";

function verificarPrestamo(idLib, idPer) {
    var getUrl = window.location;
    var base_url = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
    fetch(base_url + "/controlador/Control_verificarPrestamo.php?idPer=" + idPer)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al verificar posibilidad de prestamo');
            }
            return response.json();
        })
        .then(data => {
            if (data != null) {
                alert("No puede realizar otro prestamo, porque ya tiene uno en estado "+data);
            } else {
                location.href = "VistaClienteFormPrestamo.php?id_lib="+idLib;
            }
        })
        .catch(error => {
            console.error('Error al verificar posibilidad de prestamo:', error);
            
        });
}