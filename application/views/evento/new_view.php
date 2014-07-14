<form class="form-signin" role="form" action="<?php echo base_url();?>index.php/evento/registrar" method="post" name="process"  enctype="multipart/form-data">
	<?php if(isset($evento)){
		foreach($evento as $e){?>
	<h2 class="form-signin-heading" align="center">Actualización de Datos del evento</h2>
	<input type="hidden" name="id" value="<?php echo $e['evento']; ?>">
	Nombre: <input type="text" class="form-control" placeholder="Nombre" value="<?php echo $e['nombre']; ?>" name="nombre" required autofocus><br>
	Descripción: <textarea class="form-control" rows="4" maxlength="2000" placeholder="Descripción (Lugar del evento, invitación, telefonos de información, etc.)" id="descripcion" name="descripcion" required><?php echo $e['descripcion']; ?></textarea><br>
	Fecha: <input type="text" class="form-control" id="fecha" value="<?php echo $e['fecha']; ?>" name="fecha" readonly required><br>
	Publicar ahora?: <select name="estatus" class="form-control">
	    <option value="1" selected>Si</option>
	    <option value="0">No</option>
    </select><br>
	<button class="btn btn-lg btn-primary btn-block" type="button" onclick="Ok();">Guardar</button>
	<?php }}else { ?>
	<h2 class="form-signin-heading" align="center">Registro de Nuevo Evento</h2>
	Nombre: <input type="text" class="form-control" placeholder="Nombre" name="nombre" required autofocus><br>
	Descripción: <textarea class="form-control" rows="4" maxlength="2000" placeholder="Descripción (Lugar del evento, invitación, telefonos de información, etc.)" id="descripcion" name="descripcion" required></textarea><br>
	Fecha: <input type="text" class="form-control" id="fecha" value="<?php echo date('Y-m-d');?>" name="fecha" readonly required><br>
	Publicar ahora?: <select name="estatus" class="form-control">
	    <option value="1" selected>Si</option>
	    <option value="0">No</option>
    </select><br>
	<button class="btn btn-lg btn-primary btn-block" type="button" onclick="Ok();">Guardar</button>
	<?php } ?>
</form>

<script type="text/javascript">
	function Ok(){
		nicEditors.findEditor('descripcion').saveContent();
		document.process.submit();
	}
</script>