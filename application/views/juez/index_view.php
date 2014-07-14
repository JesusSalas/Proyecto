<?php if(isset($msg)) echo $msg;
if($jueces){?>
<div class="panel panel-default">
  <div class="panel-heading"><h3><b>Jueces registrados</b></h3></div>

  <table class="table" border="0" cellpadding="2" cellspacing="2">
    <tr>
      <th>Nombre</th>
      <th>Dojo</th>
    </tr>
    <?php foreach ($jueces as $j){?>
    <tr valign="middle">
      <td><?php echo anchor(site_url().'/juez/editar/'.$j['juez'],$j['nombre'].' '.$j['app'].' '.$j['apm'],'style="text-decoration:none;"'); ?></td>
      <td><?php echo anchor(site_url().'/juez/editar/'.$j['juez'],$dojo,'style="text-decoration:none;"'); ?></td>
    </tr>
    <?php }?>
    <tr>
      <td colspan="4">
        <button class="btn btn-lg btn-primary btn-block" type="submit" onclick="window.location.href='<?php echo site_url()."/juez/registro" ?>'">Registrar Nuevo</button>
      </td>
    </tr>
  </table>
</div>
<?php }else{?>
  <h2 class="form-signin-heading" align="center">No se ha registrado a ningún juez</h2><br>
  <button class="btn btn-lg btn-primary btn-block" type="submit" onclick="window.location.href='<?php echo site_url()."/juez/registro" ?>'">Registrar Nuevo</button>
<?php }?>