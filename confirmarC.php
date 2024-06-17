<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff ;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            text-align: center;
        }
        button {
            padding: 10px 20px;
            border: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Confirmación Cliente</h1>
        <p>¿Estás seguro de que deseas realizar esta acción?</p>
        <button onclick="confirmAction()">Confirmar</button>
    </div>

    <script>
        function confirmAction() {
            let confirmation = confirm("¿Estás seguro de que deseas realizar esta acción?");
            if (confirmation) {
                // Código para ejecutar si el usuario confirma la acción
                alert("Acción confirmada.");
            } else {
                // Código para ejecutar si el usuario cancela la acción
                alert("Acción cancelada.");
            }
        }
    </script>
</body>
</html>
