<form class="form-signin" role="form" action="<?php echo base_url();?>index.php/participante/registrar" method="post" name="process" enctype="multipart/form-data">
	<?php if(isset($participante)){ 
		foreach($participante as $p){?>
	<h2 class="form-signin-heading" align="center">Actualización de Datos del Participante</h2>
	<input type="hidden" name="id" value="<?php echo $p['participante']; ?>">
	Nombre: <input type="text" class="form-control" placeholder="Nombre" value="<?php echo $p['nombre']; ?>" name="nombre" maxlength="100" required autofocus><br>
	Primer Apellido: <input type="text" class="form-control" placeholder="Primer Apellido" value="<?php echo $p['app']; ?>" name="app" maxlength="100" required><br>
	Segundo Apellido<input type="text" class="form-control" placeholder="Segundo Apellido" value="<?php echo $p['apm']; ?>" name="apm" maxlength="100"><br>
	Fecha de Nacimiento: <input type="text" class="form-control" placeholder="AAAA-MM-DD"value="<?php echo $p['fecha_nac']; ?>" name="fecha_nac" id="fecha" required><br>
	Cinta: <select name="categoria" class="form-control">
		<?php foreach($categorias as $c){?>
	    <option <?php if($p['categoria']==$c['categoria']) echo "selected"; ?> value="<?php echo $c['categoria'];?>"><?php echo $c['nombre']; ?></option>
	    <?php }?>
    </select><br>
	Sexo: <select name="sexo" class="form-control">
	    <option <?php if($p['sexo']==0) echo "selected"; ?> value="0">Hombre</option>
	    <option <?php if($p['sexo']==1) echo "selected"; ?> value="1">Mujer</option>
    </select><br>
	Estatura: <input type="text" class="form-control" placeholder="Estatura en metros (1.50)" value="<?php echo $p['estatura']; ?>" name="estatura" maxlength="5" maxlength="5" required><br>
        Correo: <input type="email" class="form-control" placeholder="Correo electrónico" value="<?php echo $p['correo']; ?>" name="correo" maxlength="100" ><br>
        Asiste a clínica? <select class="form-control" name="isclinica">
        <option value="1">Si</option>
        <option value="0" selected>No</option>
	Foto: <input type="file" name="file"><br>
	<?php if($p['foto']){?><img src="<?php echo base_url()."fotos/".$p['foto'];?>" title="Foto" border="0"><?php }?><br><br>
	<button class="btn btn-lg btn-primary btn-block" type="submit">Guardar</button>
	<?php }}else { ?>
	<h2 class="form-signin-heading" align="center">Registro de Nuevo Participante</h2>
	Nombre: <input type="text" class="form-control" placeholder="Nombre" name="nombre" maxlength="100" required autofocus><br>
	Primer Apellido: <input type="text" class="form-control" placeholder="Primer Apellido" name="app" maxlength="100" required><br>
	Segundo Apellido: <input type="text" class="form-control" placeholder="Segundo Apellido" name="apm" maxlength="100"><br>
	Fecha de Nacimiento: <input type="text" class="form-control" placeholder="AAAA-MM-DD" value="" name="fecha_nac" id="fecha" required><br>
	Cinta: <select name="categoria" class="form-control">
		<?php foreach($categorias as $c){?>
	    <option value="<?php echo $c['categoria'];?>"><?php echo $c['nombre']; ?></option>
	    <?php }?>
    </select><br>
    <?php if($this->session->userdata('isadmin') == 1){ ?>
    Dojo: <select name="dojo" class="form-control">
		<?php foreach($dojos as $dojo){?>
	    <option value="<?php echo $dojo['dojo'];?>"><?php echo $dojo['nombre']; ?></option>
		<?php }?>
    </select><br>
	<?php }else{ ?>
	<input type="hidden" name="dojo" value="<?php echo $this->session->userdata('dojo'); ?>">
	<?php } ?>
	 Sexo: <select name="sexo" class="form-control">
	    <option value="0">Hombre</option>
	    <option value="1">Mujer</option>
    </select><br>

	Estatura: <input type="text" class="form-control" placeholder="Estatura metros (1.50)" name="estatura" maxlength="5" maxlength="5" required><br>
	Es de capacidades diferentes? <select name="diferente" class="form-control">
	    <option value="0" selected>No</option>
	    <option value="1">Si</option>
    </select><br>
        Correo: <input type="email" class="form-control" placeholder="Correo electrónico" name="correo" maxlength="100"><br>
        Asiste a clínica? <select class="form-control" name="isclinica">
        <option value="1">Si</option>
        <option value="0" selected>No</option>
    </select><br>
	Foto: <input type="file" name="file"><br>
	<button class="btn btn-lg btn-primary btn-block" type="submit">Guardar</button>
	<?php } ?>
</form>
