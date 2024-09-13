<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Clientes Activos</title>
</head>

<body style='font-family:Franklin Gothic Medium, Arial Narrow, Arial, sans-serif; font-size:12px; color: #333333; background-color:#FFFFFF;'>
    <div class="container">
        <div style="text-align: center">
            <h3 style="font-size: 25px; font-weight: bold;">Clientes Activos</h3>
        </div>

        <table style="font-size: 25px;" width='100%' cellspacing='0' cellpadding='2' border='1' bordercolor='#CCCCCC'>
            <thead>
                <tr>
                    <th width='45px' bordercolor='#ccc' bgcolor='#f2f2f2' style='text-align:center; font-size:25px; font-weight: bold;'>ID</th>
                    <th width='45px' bordercolor='#ccc' bgcolor='#f2f2f2' style='text-align:center; font-size:25px; font-weight: bold;'>Nombre</th>
                    <th width='45px' bordercolor='#ccc' bgcolor='#f2f2f2' style='text-align:center; font-size:25px; font-weight: bold;'>Tipo de Cliente</th>
                    <th width='45px' bordercolor='#ccc' bgcolor='#f2f2f2' style='text-align:center; font-size:25px; font-weight: bold;'>Ciudad</th>
                    <th width='45px' bordercolor='#ccc' bgcolor='#f2f2f2' style='text-align:center; font-size:25px; font-weight: bold;'>Estado</th>
                    <th width='45px' bordercolor='#ccc' bgcolor='#f2f2f2' style='text-align:center; font-size:25px; font-weight: bold;'>País</th>
                    <th width='45px' bordercolor='#ccc' bgcolor='#f2f2f2' style='text-align:center; font-size:25px; font-weight: bold;'>Dirección</th>
                    <th width='45px' bordercolor='#ccc' bgcolor='#f2f2f2' style='text-align:center; font-size:25px; font-weight: bold;'>Correo</th>
                    <th width='45px' bordercolor='#ccc' bgcolor='#f2f2f2' style='text-align:center; font-size:25px; font-weight: bold;'>Telefono</th>
                    <th width='45px' bordercolor='#ccc' bgcolor='#f2f2f2' style='text-align:center; font-size:25px; font-weight: bold;'>Empresa</th>
                    <th width='45px' bordercolor='#ccc' bgcolor='#f2f2f2' style='text-align:center; font-size:25px; font-weight: bold;'>RFC</th>
                    <th width='45px' bordercolor='#ccc' bgcolor='#f2f2f2' style='text-align:center; font-size:25px; font-weight: bold;'>Fecha de Registro</th>
                    <th width='45px' bordercolor='#ccc' bgcolor='#f2f2f2' style='text-align:center; font-size:25px; font-weight: bold;'>Disponible</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($clientes_totalclientes) && is_array($clientes_totalclientes)) { ?>
                    <?php foreach ($clientes_totalclientes as $row) { ?>
                        <tr>
                            <td style="font-size: 20px; text-align: center;"><?= $row->id ?></td>
                            <td style="font-size: 20px; text-align: center;"><?= $row->nombre ?></td>
                            <td style="font-size: 20px; text-align: center;"><?= $row->tipocliente ?></td>
                            <td style="font-size: 20px; text-align: center;"><?= $row->ciudad ?></td>
                            <td style="font-size: 20px; text-align: center;"><?= $row->estado_vtotal ?></td>
                            <td style="font-size: 20px; text-align: center;"><?= $row->pais ?></td>
                            <td style="font-size: 20px; text-align: center;"><?= $row->direccion ?></td>
                            <td style="font-size: 20px; text-align: center;"><?= $row->correo ?></td>
                            <td style="font-size: 20px; text-align: center;"><?= $row->telefono ?></td>
                            <td style="font-size: 20px; text-align: center;"><?= $row->empresa ?></td>
                            <td style="font-size: 20px; text-align: center;"><?= $row->rfc ?></td>
                            <td style="font-size: 20px; text-align: center;"><?= $row->fecha_vtotal ?></td>
                            <td style="font-size: 20px; text-align: center;"><?= $row->disponible_vtotal ?></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>