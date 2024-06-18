document.getElementById('productoForm').addEventListener('submit', function(event) {
    let valid = true;

    const producto = {
        nombre: document.getElementById('nombre').value,
        precio: document.getElementById('precio').value,
        cantidad: document.getElementById('cantidad').value
    };

    const errores = {
        nombre: document.getElementById('nombreError'),
        precio: document.getElementById('precioError'),
        cantidad: document.getElementById('cantidadError')
    };

    if (!validarNombre(producto.nombre)) {
        mostrarError(errores.nombre, 'El nombre es obligatorio.');
        valid = false;
    } else {
        ocultarError(errores.nombre);
    }

    if (!validarPrecio(producto.precio)) {
        mostrarError(errores.precio, 'El precio debe ser un número positivo.');
        valid = false;
    } else {
        ocultarError(errores.precio);
    }

    if (!validarCantidad(producto.cantidad)) {
        mostrarError(errores.cantidad, 'La cantidad debe ser un número entero positivo.');
        valid = false;
    } else {
        ocultarError(errores.cantidad);
    }

    if (!valid) {
        event.preventDefault();
    } else {
        producto.precio = parseFloat(producto.precio);
        producto.cantidad = parseInt(producto.cantidad, 10);
        agregarProducto(producto);
    }
});
function validarNombre(nombre) {
    return nombre.trim() !== '';
}

function validarPrecio(precio) {
    return !isNaN(precio) && precio > 0;
}

function validarCantidad(cantidad) {
    return !isNaN(cantidad) && cantidad >= 0;
}

function mostrarError(elemento, mensaje) {
    elemento.classList.remove('hidden');
    elemento.textContent = mensaje;
}

function ocultarError(elemento) {
    elemento.classList.add('hidden');
}

function agregarProducto(producto) {
    const productosTabla = document.getElementById('productosTabla');
    const nuevaFila = productosTabla.insertRow();
    const valorTotal = producto.precio * producto.cantidad;
    const estado = producto.cantidad > 0 ? "En stock" : "Agotado";

    nuevaFila.innerHTML = `
        <td class="border px-4 py-2">${producto.nombre}</td>
        <td class="border px-4 py-2">${producto.precio.toFixed(2)}</td>
        <td class="border px-4 py-2">${producto.cantidad}</td>
        <td class="border px-4 py-2">${valorTotal.toFixed(2)}</td>
        <td class="border px-4 py-2">${estado}</td>
    `;
}
