<?php if(isset($msg)) echo $msg;
foreach ($participante as $p) {
	$nombre_p = $p['nombre'].' '.$p['app'];
	$id = $p['participante'];
	$cinta = $p['categoria'];
}
if(!$competidor)
	$competidor="";
?>
<form onsubmit="return validar_form();" class="form-signin validar_form" role="form" action="<?php echo base_url();?>index.php/evento/asigna" method="post" name="process">
	<h2 class="form-signin-heading" align="center">Asignar combate a <?php echo $nombre_p; ?></h2>
	<input type="hidden" value="<?php echo $id; ?>" name="participante">
	<input type="hidden" value="<?php echo $evento->evento; ?>" name="evento">
	Combate: <select name="combate" class="form-control">
		<?php foreach ($combates as $c) {
			unset($esta);
			foreach ($asignados as $a) {
				if($a['combate'] == $c['combate']){
					$esta = true;
					break;
				}
			}
			if(!isset($esta))
				if(!($cinta < 5 && ($c['tipo_combate'] == 'Equipo-KATA' || $c['tipo_combate'] == 'Equipo-KUMITE'))){
				?>
			<option value="<?php echo $c['combate'];?>"><?php echo $c['tipo_combate']; ?></option>
			<?php } ?>
		<?php } ?>
    </select><br>
	Evento: <label class="form-control"><?php echo $evento->nombre.' - '.$evento->fecha; ?></label><br>
	# de Competidor: <input <?php if($competidor != "") echo "readonly"; ?> type="text" name="competidor" class="form-control" value="<?php echo $competidor; ?>" required><br>
	<button class="btn btn-lg btn-primary btn-block" type="submit">Asignar</button>
</form><br>
<button class="btn btn-lg btn-primary btn-block" type="button" onclick="window.location.href='<?php echo site_url()."/evento/autoriza" ?>'">Finalizar</button>
<script type="text/javascript">
	function validar_form(){
		var select = $("select option:selected").val();
		if(select == ""){
			alert("Error");
			return false;
		}
		else{
			return true;
		}
	});
</script>