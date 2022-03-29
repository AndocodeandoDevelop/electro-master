<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Productos</title>
    <style>
        .centrar{
            text-align: center;
        }
    </style>
</head>
<body>
<h1 class="centrar">Productos Registrados</h1>
    <table border='1' cellpadding='5' style='border: 1px black solid; border-collapse: collapse; width: 100%'>
        <tr style="background-color: #cdcdcd" class="centrar">
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Precio Compra</th>
            <th>Precio Venta</th>
            <th>Precio Oferta</th>
            <th>Categoria</th>
            <th>Cantidad</th>
        </tr>
        @foreach($productos as $producto)
            <tr>
                <td>{{$producto->nombre}}</td>
                <td>{{$producto->descripcion}}</td>
                <td class="centrar">{{$producto->precio_compra}}</td>
                <td class="centrar">{{$producto->precio_venta}}</td>
                <td class="centrar">{{$producto->precio_oferta}}</td>
                <td class="centrar">{{$producto->categoria->nombre}}</td>
                <td class="centrar">{{$producto->cantidad}}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>
