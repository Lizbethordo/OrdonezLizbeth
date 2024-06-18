<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Productos</title>
    <link rel="stylesheet" href="./css/tailwind.css">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">Ingresar Producto</h2>
        <form id="productoForm" action="index.php" method="post">
            <div class="mb-4">
                <label for="nombre" class="block text-gray-700 font-semibold mb-2">Nombre del Producto:</label>
                <input type="text" id="nombre" name="nombre" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <p id="nombreError" class="text-red-500 text-xs italic mt-2 hidden">El nombre es obligatorio.</p>
            </div>
            <div class="mb-4">
                <label for="precio" class="block text-gray-700 font-semibold mb-2">Precio por Unidad:</label>
                <input type="number" id="precio" name="precio" step="0.01" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <p id="precioError" class="text-red-500 text-xs italic mt-2 hidden">El precio debe ser un número positivo.</p>
            </div>
            <div class="mb-4">
                <label for="cantidad" class="block text-gray-700 font-semibold mb-2">Cantidad de Inventario:</label>
                <input type="number" id="cantidad" name="cantidad" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <p id="cantidadError" class="text-red-500 text-xs italic mt-2 hidden">La cantidad debe ser un número entero positivo.</p>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">Enviar</button>
            </div>
        </form>

        <?php
        
        $productos = array();
        function agregarProducto(&$productos, $nombre, $precio, $cantidad) {
            if (!empty($nombre) && $precio > 0 && $cantidad >= 0) {
                $productos[] = array(
                    "nombre" => $nombre,
                    "precio" => $precio,
                    "cantidad" => $cantidad
                );
            }
        }
        function mostrarProductos($productos) {
            if (!empty($productos)) {
                echo "<table class='mt-6 w-full bg-white shadow-md rounded-lg'>";
                echo "<thead><tr class='bg-gray-200'><th class='px-4 py-2'>Nombre</th><th class='px-4 py-2'>Precio por Unidad</th><th class='px-4 py-2'>Cantidad</th><th class='px-4 py-2'>Valor Total</th><th class='px-4 py-2'>Estado</th></tr></thead>";
                echo "<tbody>";

                foreach ($productos as $producto) {
                    $valorTotal = $producto['precio'] * $producto['cantidad'];
                    $estado = $producto['cantidad'] > 0 ? "En stock" : "Agotado";
                    echo "<tr><td class='border px-4 py-4'>{$producto['nombre']}</td><td class='border px-4 py-2'>{$producto['precio']}</td><td class='border px-4 py-2'>{$producto['cantidad']}</td><td class='border px-4 py-2'>{$valorTotal}</td><td class='border px-4 py-2'>{$estado}</td></tr>";
                }

                echo "</tbody></table>";
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = htmlspecialchars($_POST["nombre"]);
            $precio = floatval($_POST["precio"]);
            $cantidad = intval($_POST["cantidad"]);

            agregarProducto($productos, $nombre, $precio, $cantidad);
        }

        mostrarProductos($productos);
        ?>
</html>
    </div>
    <script src="./js/producto.js"></script>
</body>
</html>
