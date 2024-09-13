<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body style='font-family: Arial, Helvetica, sans-serif; font-size:15px; background-color:#FFFFFF;' border="1">
  
  <table width="100%">
    <tr>
        <td style="width: 10px; text-align: left;">
          <img style="text-align: left; width: 150px; height: 150px;" src="<?= base_url()?>assets/imagenes_propias/logo_systemark.jpg" alt="">
        </td>
        <td style="text-align: center;">
          <h1 style="text-align: center;">Cotización</h1>
        </td>
    </tr>
  </table>
  
  <div style="text-align: right" class="input-group">
    <span style="font-weight:bold">Folio:</span>
    <label style="font-weight:normal;" for=""></label>
  </div>

  <h5 style="text-align:center;">Atendiendo su amable solicitud estamos enviando cotización de los productos y/o servicios requeridos, para nosotros es un placer poner nuestra compañía a su servicio</h5>


  <table cellspacing='0' border='0' width='100%'>
    <tbody>
      <tr>
        <td>
          <table id="tablauno" align="left" cellspacing='0' width="60%" border='1' bordercolor='#CCCCCC'>
            <thead>
              <tr></tr>
            </thead>
            <tbody>
              <tr style="background-color: rgba(26, 120, 238, 0.4);">
                <td style="font-weight:bold; font-size: 16px">Empresa:</td>
                <td style="width: 200px; font-size: 16px"></td>
              </tr>
              <tr>
                <td style="font-weight:bold; font-size: 16px">Contacto:</td>
                <td style="width: 200px; font-size: 16px"></td>
              </tr>
              <tr style="background-color: rgba(26, 120, 238, 0.4);">
                <td style="font-weight:bold; font-size: 16px">Telefono:</td>
                <td style="width: 200px; font-size: 16px;"></td>
              </tr>
              <tr>
                <td style="font-weight:bold; font-size: 16px">Correo:</td>
                <td style="width: 200px; font-size: 16px;"></td>
              </tr>
            </tbody>
          </table>
        </td>
        <td>
          <table id="tablados" align="right" cellspacing='0' width="400" border='1' bordercolor='#CCCCCC'>
            <thead>
              <tr></tr>
            </thead>
            <tbody>
              <tr style="background-color: rgba(26, 120, 238, 0.4);">
                <td style="font-weight:bold; font-size: 16px">Fecha:</td>
                <td style="width: 200px; font-size: 16px;"></td>
              </tr>
              <tr>
                <td style="font-weight:bold; font-size: 16px; width: 120px">Ejec. de Vta:</td>
                <td style="width: 200px; font-size: 16px;"></td>
              </tr>
              <tr style="background-color: rgba(26, 120, 238, 0.4);">
                <td style="font-weight:bold; font-size: 16px">Telefonos:</td>
                <td style="width: 200px; font-size: 16px;"></td>
              </tr>
              <tr>
                <td style="font-weight:bold; font-size: 16px">Correo:</td>
                <td style="width: 200px; font-size: 16px;"></td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
    </tbody>
  </table><br><br>

  <div style="text-align: right" class="input-group">
    <span style="font-weight:bold">Tipo de Cambio:</span>
    <label style="font-weight:normal;" for=""></label>
  </div>
  <table width="100%" cellspacing="0" border="1" bordercolor="#CCCCCC">
    <thead>
      <tr style="background-color: rgba(26, 120, 238, 0.4);">
        <th>Cantidad</th>
        <th>Unidad</th>
        <th>Productos</th>
        <th>Precio MXN</th>
        <th>Precio USD</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($datos_tabla as $fila): ?>
        <tr>
            <td><?php echo $fila['cantidad']; ?></td>
            <!-- <td><?php echo $fila['unidad']; ?></td> -->
            <td><?php echo $fila['producto']; ?></td>
            <td><?php echo $fila['precio_mxn']; ?></td>
            <td><?php echo $fila['precio_usd']; ?></td>
        </tr>
    <?php endforeach; ?>
      <tr>
        <td style="border-bottom: none;" colspan="2"></td>
        <td style="font-weight: bold">SUBTOTAL:</td>
        <td id="tdsubtotalmxn"></td>
        <td id="tdsubtotalusd"></td>
      </tr>
      <tr>
        <td style="border-bottom: none; border-top: none;" colspan="2"></td>
        <td style="font-weight: bold">IVA:</td>
        <td colspan="2" id="tdiva"></td>
      </tr>
      <tr>
        <td style="border-top: none;" colspan="2"></td>
        <td style="font-weight: bold">TOTAL:</td>
        <td id="tdtotalmxn"></td>
        <td id="tdtotalusd"></td>
      </tr>
      <tr style="background-color: rgba(26, 120, 238, 0.4);">
        <td colspan="4" id="tdletrasmxn"></td>
        <td></td>
      </tr>
      <tr style="background-color: rgba(26, 120, 238, 0.4);">
        <td colspan="4" id="tdletrasusd"></td>
        <td></td>
      </tr>
    </tbody>
  </table>

  <h4 style="font-family: Arial, Helvetica, sans-serif;">Terminos y Condiciones</h4>
  <p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 1.5; text-align: justify;">Tiempo de entrega de entrega: 2 día habiles despues de la colocacion del pedido. <br>
  Forma de pago: 100% de contado. <br>
  Nuestros precios son en dólares convertidos a pesos de acuerdo al tipo de cambio de DOF del día de la cotización. <br>
  En caso de que no se liquide en la fecha acordada se hará un cargo mensual de 7% en la cantidad de adeudo. <br>
  La vigencia de esta Cotización es de 10 días naturales a partir de la fecha de expedición. <br>
  El período de garantía es de 1 año.
  </p>

  <h4 style="font-family:Arial, Helvetica, sans-serif;">Información Bancaria</h4>

  <span style="font-weight:bold">Banco:</span>
  <span></span><br>

  <span style="font-weight:bold">Cuenta:</span>
  <span></span><br>

  <span style="font-weight:bold">CLABE:</span>
  <span></span>

  <p style="font-family:Arial, Helvetica, sans-serif; font-size: 15px; line-height: 1.5; text-align: center">La presente cotización constituye una orden de compra, favor de regresar el documento firmado a su proveedor de 
  servicios, para proceder a la facturación y ejecución de servicio.
  </p><br>

  <table width="100%">
    <tr>
        <td style="font-family:Arial, Helvetica, sans-serif; text-align: center;">
            <p>_________________________<br><br>
            Ejecutivo de Venta</p>
        </td>
        <td style="font-family:Arial, Helvetica, sans-serif; text-align: center;">
            <p>_________________________<br><br>
            Cliente/Persona Autorizada</p>
        </td>
    </tr>
  </table>

</body>
</html>