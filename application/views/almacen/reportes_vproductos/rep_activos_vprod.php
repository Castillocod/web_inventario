<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Activos</title>
</head>
<body style='font-family:Franklin Gothic Medium, Arial Narrow, Arial, sans-serif; font-size:12px; color: #333333; background-color:#FFFFFF;'>
<div class="container">
    <div style="text-align: center">
        <h3 style="font-size: 25px; font-weight: bold;">Productos Activos</h3>
    </div>

    <!--Aquí inicia la tabla -->
    
    <table style="font-size: 25px;" width='100%' cellspacing='0' cellpadding='2' border='1' bordercolor='#CCCCCC'>
        <thead>
            <tr>
                <th width='45px' bordercolor='#ccc' bgcolor='#f2f2f2' style='text-align:center; font-size:25px; font-weight: bold;'>ID</th>
                <th width='45px' bordercolor='#ccc' bgcolor='#f2f2f2' style='text-align:center; font-size:25px; font-weight: bold;'>Modelo</th>
                <th width='45px' bordercolor='#ccc' bgcolor='#f2f2f2' style='text-align:center; font-size:25px; font-weight: bold;'>Marca</th>
                <th width='45px' bordercolor='#ccc' bgcolor='#f2f2f2' style='text-align:center; font-size:25px; font-weight: bold;'>Categoria</th>
                <th width='45px' bordercolor='#ccc' bgcolor='#f2f2f2' style='text-align:center; font-size:25px; font-weight: bold;'>Titulo</th>
                <th width='45px' bordercolor='#ccc' bgcolor='#f2f2f2' style='text-align:center; font-size:25px; font-weight: bold;'>Stock</th> <!-- Aquí se indicará la cantidad de productos que hay y si hay menos de 10 mostrara un mensaje "Por agotarse", cuando haya cero "Agotado" -->
                <th width='45px' bordercolor='#ccc' bgcolor='#f2f2f2' style='text-align:center; font-size:25px; font-weight: bold;'>Precio Lista</th>
                <th width='45px' bordercolor='#ccc' bgcolor='#f2f2f2' style='text-align:center; font-size:25px; font-weight: bold;'>Precio especial</th>
                <th width='45px' bordercolor='#ccc' bgcolor='#f2f2f2' style='text-align:center; font-size:25px; font-weight: bold;'>Precio Original</th>
                <th width='45px' bordercolor='#ccc' bgcolor='#f2f2f2' style='text-align:center; font-size:25px; font-weight: bold;'>Precio Integrado</th>
                <th width='45px' bordercolor='#ccc' bgcolor='#f2f2f2' style='text-align:center; font-size:25px; font-weight: bold;'>Precio Tienda</th>
                <th width='45px' bordercolor='#ccc' bgcolor='#f2f2f2' style='text-align:center; font-size:25px; font-weight: bold;'>Código Fiscal</th>
                <th width='45px' bordercolor='#ccc' bgcolor='#f2f2f2' style='text-align:center; font-size:25px; font-weight: bold;'>Estado</th> <!-- Aquí indicara si estara activo o no -->
            </tr>
        </thead>
        <tbody>
            <?php foreach($almacen_productos as $row) { ?>
            <tr>
                <td style="font-size: 20px; text-align: center;"><?= $row->id?></td>
                <td style="font-size: 20px; text-align: center;"><?= $row->modelo?></td>
                <td style="font-size: 20px; text-align: center;"><?= $row->marca?></td>
                <td style="font-size: 20px; text-align: center;"><?= $row->categoria?></td>
                <td style="font-size: 20px; text-align: center;"><?= $row->titulo?></td>
                <td style="font-size: 20px; text-align: center;"><?= $row->stock?></td>
                <td style="font-size: 20px; text-align: center;"><?= $row->preciolista?></td>
                <td style="font-size: 20px; text-align: center;"><?= $row->precioespecial?></td>
                <td style="font-size: 20px; text-align: center;"><?= $row->preciooriginal?></td>
                <td style="font-size: 20px; text-align: center;"><?= $row->preciointegrado?></td>
                <td style="font-size: 20px; text-align: center;"><?= $row->preciotienda?></td>
                <td style="font-size: 20px; text-align: center;"><?= $row->codigofiscal?></td>
                <td style="font-size: 20px; text-align: center;"><?= $row->estado_prod?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
<!--Aquí termina la tabla -->
</div>
</body>
</html>