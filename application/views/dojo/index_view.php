<?php if(isset($msg)) echo $msg;
if($dojos){?>
<div class="panel panel-default">
  <div class="panel-heading"><h3><b>Dojos registrados</b></h3></div>

  <table class="table" border="0" cellpadding="2" cellspacing="2">
    <tr>
      <th>&nbsp</th>
      <th>Nombre</th>
      <th>Sensei</th>
      <th>Estado</th>
      <th>Pais</th>
    </tr>
    <?php foreach ($dojos as $d){?>
    <tr valign="middle">
      <td><?php echo anchor(site_url().'/dojo/editar/','<img src="'.base_url().'logos/'.$d['logo'].'" border="0" height="60px">','style="text-decoration:none;"'); ?></td>
      <td><?php echo anchor(site_url().'/dojo/editar/'.$d['dojo'],$d['nombre'],'style="text-decoration:none;"'); ?></td>
      <td><?php echo anchor(site_url().'/dojo/editar/'.$d['dojo'],$d['sensei'],'style="text-decoration:none;"'); ?></td>
      <td><?php echo anchor(site_url().'/dojo/editar/'.$d['dojo'],$d['estado'],'style="text-decoration:none;"'); ?></td>
      <td><?php echo anchor(site_url().'/dojo/editar/'.$d['dojo'],$d['pais'],'style="text-decoration:none;"'); ?></td>
    </tr>
    <?php }?>
    <tr>
      <td colspan="4">
        <button class="btn btn-lg btn-primary btn-block" type="submit" onclick="window.location.href='<?php echo site_url()."/dojo/registro" ?>'">Registrar Nuevo</button>
      </td>
    </tr>
  </table>
</div>
<?php }else{?>
  <h2 class="form-signin-heading" align="center">No se ha registrado a ningún dojo</h2><br>
  <button class="btn btn-lg btn-primary btn-block" type="submit" onclick="window.location.href='<?php echo site_url()."/dojo/registro" ?>'">Registrar Nuevo</button>
<?php }?>
