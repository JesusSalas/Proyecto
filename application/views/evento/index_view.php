<?php if(isset($msg)) echo $msg;
if($eventos){?>
<div class="panel panel-default">
  <div class="panel-heading"><h3><b>Eventos registrados</b></h3></div>

  <table class="table" border="0" cellpadding="2" cellspacing="2">
    <tr>
      <th>Nombre</th>
      <th>Descripción</th>
      <th>Fecha</th>
      <th>Publicado?</th>
    </tr>
    <?php foreach ($eventos as $e){
      if($e['estatus'] == 1)
        $estatus = "SI";
      else
        $estatus = "NO";
      ?>
    <tr valign="middle">
      <td><?php echo anchor(site_url().'/evento/editar/'.$e['evento'],$e['nombre'],'style="text-decoration:none;"'); ?></td>
      <td><?php echo anchor(site_url().'/evento/editar/'.$e['evento'],$e['descripcion'],'style="text-decoration:none;"'); ?></td>
      <td><?php echo anchor(site_url().'/evento/editar/'.$e['evento'],$e['fecha'],'style="text-decoration:none;"'); ?></td>
      <td><?php echo anchor(site_url().'/evento/editar/'.$e['evento'],$estatus,'style="text-decoration:none;"'); ?></td>
    </tr>
    <?php }?>
    <tr>
      <td colspan="4">
        <button class="btn btn-lg btn-primary btn-block" type="submit" onclick="window.location.href='<?php echo site_url()."/evento/registro" ?>'">Registrar Nuevo</button>
      </td>
    </tr>
  </table>
</div>
<?php }else{?>
  <h2 class="form-signin-heading" align="center">No se ha registrado a ningún evento</h2><br>
  <button class="btn btn-lg btn-primary btn-block" type="submit" onclick="window.location.href='<?php echo site_url()."/evento/registro" ?>'">Registrar Nuevo</button>
<?php }?>