<?php if(isset($msg)) echo $msg; ?>
<div class="panel panel-default">
  <div class="panel-heading"><h3><b>Usuarios registrados</b></h3></div>

  <table class="table" border="0" cellpadding="2" cellspacing="2">
    <tr>
      <th>Nombre</th>
      <th>Username</th>
      <th>Dojo</th>
      <th>Administrador?</th>
    </tr>
    <?php foreach ($usuarios as $u){
      if($u['is_admin'] == 1)
        $admin = "SI";
      else
        $admin = "NO";
      foreach ($dojos as $dojo) {
        if($dojo['dojo'] == $u['dojo']){
          $d = $dojo['nombre'];
          break;
        }
      }
      ?>
    <tr valign="middle">
      <td><?php echo anchor(site_url().'/usuario/editar/'.$u['id'],$u['nombre'].' '.$u['apellido'],'style="text-decoration:none;"'); ?></td>
      <td><?php echo anchor(site_url().'/usuario/editar/'.$u['id'],$u['username'],'style="text-decoration:none;"'); ?></td>
      <td><?php echo anchor(site_url().'/usuario/editar/'.$u['id'],$d,'style="text-decoration:none;"'); ?></td>
      <td><?php echo anchor(site_url().'/usuario/editar/'.$u['id'],$admin,'style="text-decoration:none;"'); ?></td>
    </tr>
    <?php }?>
    <tr>
      <td colspan="4">
        <button class="btn btn-lg btn-primary btn-block" type="submit" onclick="window.location.href='<?php echo site_url()."/usuario/registro" ?>'">Registrar Nuevo</button>
      </td>
    </tr>
  </table>
</div>