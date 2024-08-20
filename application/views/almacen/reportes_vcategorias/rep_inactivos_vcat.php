<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Inactivos</title>
</head>
<body style='font-family:Franklin Gothic Medium, Arial Narrow, Arial, sans-serif; font-size:12px; color: #333333; background-color:#FFFFFF;'>
<div class="container">
    <div style="text-align: center">
        <h3 style="font-size: 25px; font-weight: bold;">Categorias Inactivas</h3>
    </div>

    <!--Aquí inicia la tabla -->
    
    <table style="font-size: 25px;" width='100%' cellspacing='0' cellpadding='2' border='1' bordercolor='#CCCCCC'>
        <thead>
            <tr>
                <th width='45px' bordercolor='#ccc' bgcolor='#f2f2f2' style='text-align:center; font-size:25px; font-weight: bold;'>ID</th>
                <th width='45px' bordercolor='#ccc' bgcolor='#f2f2f2' style='text-align:center; font-size:25px; font-weight: bold;'>Categoría</th>
                <th width='45px' bordercolor='#ccc' bgcolor='#f2f2f2' style='text-align:center; font-size:25px; font-weight: bold;'>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($almacen_categorias) && is_array($almacen_categorias)) { ?>
                <?php foreach($almacen_categorias as $row) { ?>
                    <tr>
                        <td style="font-size: 20px; text-align: center;"><?= $row['id']?></td>
                        <td style="font-size: 20px; text-align: center;"><?= $row['categoria']?></td>
                        <td style="font-size: 20px; text-align: center;"><?= $row['estado_vcat']?></td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>
<!--Aquí termina la tabla -->
</div>
</body>
</html>