<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Préstamo</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <form>
        <div class="form-group">
            <label for="dni">DNI</label>
            <div class="input-group">
                <input type="number" class="form-control" id="dni" name="dni">
                <button type="button" class="btn btn-secondary" id="buscar_lector">Buscar Lector</button>
            </div>
        </div>
        <div class="form-group">
            <label for="nombres">Nombres</label>
            <input type="text" class="form-control" id="nombres" name="nombres" readonly>
        </div>
    </form>

    <script>
    $(document).ready(function(){
        $('#buscar_lector').on('click', function(){
            var dni = $('#dni').val();
            if(dni) {
                $.ajax({
                    url: 'buscarLector.php',
                    type: 'POST',
                    data: {dni: dni},
                    success: function(response){
                        var data = JSON.parse(response);
                        if(data.success) {
                            echo data.nombre;
                            $('#nombres').val(data.nombre);
                        } else {
                            alert(data.message || 'Lector no encontrado');
                        }
                    }
                });
            } else {
                alert('Por favor ingrese un DNI');
            }
        });
    });
    </script>
</body>
</html>
