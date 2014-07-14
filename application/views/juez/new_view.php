<?php if($dojos){ ?>
<form class="form-signin" role="form" action="<?php echo base_url();?>index.php/juez/registrar" method="post" name="process"  enctype="multipart/form-data">
	<?php if(isset($juez)){
		foreach($juez as $j){?>
	<h2 class="form-signin-heading" align="center">Actualización de Datos del Juez</h2>
	<input type="hidden" name="id" value="<?php echo $j['juez']; ?>">
	Nombre: <input type="text" class="form-control" placeholder="Nombre" value="<?php echo $j['nombre']; ?>" name="nombre" required autofocus><br>
	Primer Apellido: <input type="text" class="form-control" placeholder="Primer Apellido" value="<?php echo $j['app']; ?>" name="app" required><br>
	Segundo Apellido: <input type="text" class="form-control" placeholder="Segundo Apellido" value="<?php echo $j['apm']; ?>" name="apm"><br>
	Dojo: <select class="form-control" name="dojo"><br>
		<?php foreach($dojos as $dojo){?>
	    <option <?php if($dojo['dojo'] == $j['dojo']) echo "selected"; ?> value="<?php echo $dojo['dojo'];?>"><?php echo $dojo['nombre']; ?></option>
	    <?php }?>
	</select><br>
	<?php }}else { ?>
	<h2 class="form-signin-heading" align="center">Registro de Nuevo Juez</h2>
	Nombre: <input type="text" class="form-control" placeholder="Nombre" name="nombre" required autofocus><br>
	Primer Apellido: <input type="text" class="form-control" placeholder="Primer Apellido" name="app" required><br>
	Segundo Apellido: <input type="text" class="form-control" placeholder="Segundo Apellido" name="apm"><br>
	Dojo: <select name="dojo" class="form-control">
		<?php foreach($dojos as $dojo){?>
	    <option value="<?php echo $dojo['dojo'];?>"><?php echo $dojo['nombre']; ?></option>
	    <?php }?>
    </select><br>
	<?php } ?>
	<button class="btn btn-lg btn-primary btn-block" type="submit">Guardar</button>
</form>
<?php }else{?>
  <h2 class="form-signin-heading" align="center">Primero debes registrar un dojo para asignar al juez</h2><br>
  <button class="btn btn-lg btn-primary btn-block" type="submit" onclick="window.location.href='<?php echo site_url()."/dojo/registro" ?>'">Registrar Nuevo</button>
<?php }?>