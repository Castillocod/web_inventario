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
                <h3 style="font-size: 25px; font-weight: bold;">Tipo de Clientes Activos</h3>
            </div>

            <!--Aquí inicia la tabla -->
            
            <table style="font-size: 25px;" width='100%' cellspacing='0' cellpadding='2' border='1' bordercolor='#CCCCCC'>
                <thead>
                    <tr>
                        <th width='45px' bordercolor='#ccc' bgcolor='#f2f2f2' style='text-align:center; font-size:25px; font-weight: bold;'>ID</th>
                        <th width='45px' bordercolor='#ccc' bgcolor='#f2f2f2' style='text-align:center; font-size:25px; font-weight: bold;'>Tipo de Cliente</th>
                        <th width='45px' bordercolor='#ccc' bgcolor='#f2f2f2' style='text-align:center; font-size:25px; font-weight: bold;'>Cant. Clientes</th> 
                        <th width='45px' bordercolor='#ccc' bgcolor='#f2f2f2' style='text-align:center; font-size:25px; font-weight: bold;'>Estado</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($clientes_tiposclientes) && is_array($clientes_tiposclientes)) { ?>
                        <?php foreach($clientes_tiposclientes as $row) { ?>
                            <tr>
                                <td style="font-size: 20px; text-align: center;"><?= $row['id']?></td>
                                <td style="font-size: 20px; text-align: center;"><?= $row['tipocliente']?></td>
                                <td style="font-size: 20px; text-align: center;"><?= $row['cantclientes']?></td>
                                <td style="font-size: 20px; text-align: center;"><?= $row['estado_vtipos']?></td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        <!--Aquí termina la tabla -->
        </div>
    </body>
</html>