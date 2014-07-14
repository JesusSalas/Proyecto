<?php if(isset($msg)) echo $msg; 
if(!$participantes){ ?>
<h2 class="form-signin-heading" align="center">No hay participantes disponibles para asignar</h2><br>
<button class="btn btn-lg btn-primary btn-block" type="button" onclick="window.location.href='<?php echo site_url()."/participante/registro" ?>'">Registra nuevo participante</button>
<?php }else
if(!isset($evento->evento)){?>
<h2 class="form-signin-heading" align="center">No hay evento próximo</h2><br>
<?php if($this->session->userdata('isadmin') == 1){ ?>
	<button class="btn btn-lg btn-primary btn-block" type="button" onclick="window.location.href='<?php echo site_url()."/evento/registro" ?>'">Crear evento</button>
<?php } ?>
<?php }else { ?>
<form class="form-signin" role="form" action="<?php echo base_url();?>index.php/participante/asignar" method="post" name="process">
	<h2 class="form-signin-heading" align="center">Asignar a evento</h2>
	Participante: <select name="participante" class="form-control">
		<?php foreach ($participantes as $p) {
			foreach ($asignados as $a) {
				unset($esta);
				if($a['participante'] == $p['participante']){
					$esta = true;
					break;
				}
			}
			if(!$esta){
		?>
			<option value="<?php echo $p['participante'];?>"><?php echo $p['nombre'].' '.$p['app'].' '.$p['apm']; ?></option>
		<?php }} ?>
    </select><br>
    <input type="hidden" name="evento" value="<?php echo $evento->evento; ?>">
	Próximo evento: <label class="form-control"><?php echo $evento->nombre.' - '.$evento->fecha; ?></label>
	<button class="btn btn-lg btn-primary btn-block" type="submit">Asignar</button>
</form>
<?php }