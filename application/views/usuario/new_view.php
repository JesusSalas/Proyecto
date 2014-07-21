<form class="form-signin" role="form" action="<?php echo base_url();?>index.php/usuario/registrar" method="post" name="process"  enctype="multipart/form-data">
	<?php if(isset($usuario)){
		foreach($usuario as $u){?>
	<h2 class="form-signin-heading" align="center">Actualización de Datos del Usuario</h2>
	<input type="hidden" name="id" value="<?php echo $u['id']; ?>">
	Nombre: <input type="text" class="form-control" placeholder="Nombre" value="<?php echo $u['nombre']; ?>" name="nombre" required autofocus><br>
	Apellido (s): <input type="text" class="form-control" placeholder="Apellido(s)" value="<?php echo $u['apellido']; ?>" name="apellido" required><br>
	Usuario: <input type="text" class="form-control" placeholder="UserName" value="<?php echo $u['username']; ?>" name="username" required><br>
        Contraseña: <input type="password" class="form-control" placeholder="Password" value="<?php echo $u['password']; ?>" name="password" required><br>
	Dojo: <select class="form-control" name="dojo"><br>
            <option value=""></option>
		<?php foreach($dojos as $dojo){?>
	    <option <?php if($dojo['dojo'] == $u['dojo']) echo "selected"; ?> value="<?php echo $dojo['dojo'];?>"><?php echo $dojo['nombre']; ?></option>
	    <?php }?>
	</select><br>
	<?php }}else { ?>
	<h2 class="form-signin-heading" align="center">Registro de Nuevo Usuario</h2>
	Nombre: <input type="text" class="form-control" placeholder="Nombre" name="nombre" required autofocus><br>
	Apellido (s): <input type="text" class="form-control" placeholder="Apellido(s)" name="apellido" required><br>
	Usuario: <input type="text" class="form-control" placeholder="UserName" name="username"><br>
        Contraseña: <input type="password" class="form-control" placeholder="Contraseña" name="password"><br>
	Dojo: <select name="dojo" class="form-control">
            <option value=""></option>
		<?php foreach($dojos as $dojo){?>
	    <option value="<?php echo $dojo['dojo'];?>"><?php echo $dojo['nombre']; ?></option>
	    <?php }?>
    </select><br>
    Es administrador? <select class="form-control" name="isadmin">
    	<option value="1">Si</option>
    	<option value="0" selected>No</option>
    </select>
	<?php } ?>
	<button class="btn btn-lg btn-primary btn-block" type="submit">Guardar</button>
</form>
