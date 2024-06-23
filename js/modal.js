src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js";

function openDetailBook(idLib, idPer) {
    fetch(base_url + "/controlador/Control_DetailBook.php?action=get_data&libro_id=" + idLib)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al obtener los datos del libro.');
            }
            return response.json();
        })
        .then(data => {
            // Actualizamos los elementos del modal con los datos recibidos
            document.getElementById('bookModalLabel').innerText = data.titulo;
            document.getElementById('CategoriaLibro').innerText = data.categoria;
            document.getElementById('AutorLibro').innerText = data.autor;
            document.getElementById('DescripcionLibro').innerText = data.descripcion;
            let boton_id = data.id_lib;
            let idEst = data.id_est;
            let colorBoton = "";
            switch (idEst) {
                case 1: colorBoton = "btn-success"; break;
                default: colorBoton = "btn-secondary"; break;
            }
            html_boton = `<a class="btn ${colorBoton} mt-3" onclick = "verificarPrestamo(${idLib}, ${idPer})">Realizar Préstamo</a> `;

            document.getElementById('boton').innerHTML = html_boton;

            html_imagen = `<img src="galeria/${boton_id}.jpg" alt="Imagen de ${boton_id}" width="200px" height="300px">`;

            document.getElementById('PortadaLibro').innerHTML = html_imagen;


            // Mostramos el modal y oscurecemos el fondo
            const modal = document.getElementById('ModalBookDetails');
            modal.classList.add('show');
            modal.style.display = 'block';  // Asegurar que el modal esté visible

            // Oscurecer el fondo
            document.body.classList.add('modal-open');
            const backdrop = document.createElement('div');
            backdrop.classList.add('modal-backdrop', 'fade', 'show');
            document.body.appendChild(backdrop);

            // Event listener para cerrar el modal
            const closeModalBtn = document.getElementById('closeModalBtn');
            closeModalBtn.addEventListener('click', () => {
                modal.classList.remove('show');
                modal.style.display = 'none';  // Ocultar el modal

                // Quitar el fondo oscurecido
                document.body.classList.remove('modal-open');
                backdrop.remove();
            });

            window.addEventListener('click', (event) => {
                if (event.target === modal) {
                    modal.classList.remove('show');
                    modal.style.display = 'none';  // Ocultar el modal

                    // Quitar el fondo oscurecido
                    document.body.classList.remove('modal-open');
                    backdrop.remove();
                }
            });
        })
        .catch(error => {
            console.error('Error al obtener datos del libro:', error);
            // Aquí puedes mostrar algún mensaje de error al usuario si es necesario
        });
}



