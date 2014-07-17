<?php if(isset($msg)) echo $msg;
if($evento)
if(isset($participantes)){?>
<form class="form-signin" role="form" action="<?php echo base_url();?>index.php/evento/autorizar" method="post" name="process">
	<h2 class="form-signin-heading" align="center">Autorizar asistencia y Registro de combate</h2>
	Participante: <select name="participante" class="form-control">
		<?php foreach ($participantes as $p) {
			foreach ($completos as $c) {
				unset($esta);
				if($p['participante'] == $c['participante']){
					$esta = true;
					break;
				}
			}
			if(!$esta){?>
			<option value="<?php echo $p['participante'];?>"><?php echo $p['nombre'].' '.$p['app'].' '.$p['apm']; ?></option>
		<?php }} ?>
    </select><br>
    <input type="hidden" name="evento" value="<?php echo $evento->evento; ?>">
	<button class="btn btn-lg btn-primary btn-block" type="submit">Autorizar</button>
</form>
<?php }else{ ?>
<h2 class="form-signin-heading" align="center">No hay participantes por autorizar</h2>
<?php }
else{ ?>
	<h2 class="form-signin-heading" align="center">No se ha registrado a ningún evento</h2><br>
	<button class="btn btn-lg btn-primary btn-block" type="submit" onclick="window.location.href='<?php echo site_url()."/evento/registro" ?>'">Registrar Nuevo</button>
<?php }