<table>
    <thead>
    <tr>
        <th>idProducto</th>
        <th colspan="2">Clave del Producto</th>
        <th colspan="3">Categoria del Producto</th>
        <th colspan="3">Nombre del Producto</th>
        <th colspan="2">Precio del producto</th>
    </tr>
    </thead>
    <tbody>
    @foreach($productos as $producto)
        <tr>
            <td>{{ $producto->idProducto }}</td>
            <td colspan="2">{{ $producto->clave }}</td>
            <td colspan="3">{{ $producto->categoria }}</td>
            <td colspan="3">{{ $producto->producto }}</td>
            <td colspan="2">$ {{ number_format($producto->precio, 2, '.', ',');}}</td>
        </tr>
    @endforeach
    </tbody>
</table>