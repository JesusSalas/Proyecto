<?php
	$estados=array("Aguascalientes","Baja California","Baja California Sur","Campeche","Chiapas","Chihuahua","Coahuila","Colima","Distrito Federal","Durango","Estado de México","Guanajuato","Guerrero","Hidalgo","Jalisco","Michoacán","Morelos","Nayarit","Nuevo León","Oaxaca","Puebla","Querétaro","Quintana","San Luis Potosí","Sinaloa","Sonora","Tabasco","Tamaulipas","Tlaxcala","Veracruz","Yucatán","Zacatecas");
        $paises=array("México","Venezuela","Uruguay","Estados Unidos");
?>
<form class="form-signin" role="form" action="<?php echo base_url();?>index.php/dojo/registrar" method="post" name="process" enctype="multipart/form-data">
	<?php if(isset($dojo)){
		foreach($dojo as $d){?>
	<h2 class="form-signin-heading" align="center">Actualización de Datos del Dojo</h2>
	<input type="hidden" name="id" value="<?php echo $d['dojo']; ?>">
	Nombre: <input type="text" class="form-control" placeholder="Nombre" value="<?php echo $d['nombre']; ?>" name="nombre" required autofocus><br>
	Dirección: <input type="text" class="form-control" placeholder="Dirección (calle, número, colonia)" value="<?php echo $d['direccion']; ?>" name="direccion" ><br>
        Sensei: <input type="text" class="form-control" placeholder="Nombre Sensei" value="<?php echo $d['sensei']; ?>" name="sensei" required><br>
	Estado: <select name="estado" class="form-control">
            <option value=""></option>
		<?php for($i=0;$i<count($estados);$i++){?>
	    <option <?php if($d['estado']==$estados[$i]) echo "selected";?> value="<?php echo $estados[$i];?>"><?php echo $estados[$i]; ?></option>
	    <?php }?>
    </select><br>
        País: <select name="pais" class="form-control">
                <?php for($i=0;$i<count($paises);$i++){?>
            <option <?php if($d['pais']==$paises[$i]) echo "selected";?> value="<?php echo $paises[$i];?>"><?php echo $paises[$i]; ?></option>
            <?php }?>
    </select><br>
	Logo: <input type="file" name="file"><br>
	<?php if($d['logo']){?><img src="<?php echo base_url()."logos/".$d['logo'];?>" title="Logo" border="0"><?php }?>
	<button class="btn btn-lg btn-primary btn-block" type="submit">Guardar</button>
	<?php }}else { ?>
	<h2 class="form-signin-heading" align="center">Registro de Nuevo Dojo</h2>
	Nombre: <input type="text" class="form-control" placeholder="Nombre" name="nombre" required autofocus><br>
	Dirección: <input type="text" class="form-control" placeholder="Dirección (calle, número, colonia)" name="direccion" ><br>
        Sensei: <input type="text" class="form-control" placeholder="Nombre Sensei" name="sensei" required><br>
	Estado: <select name="estado" class="form-control">
            <option value=""></option>
		<?php for($i=0;$i<count($estados);$i++){?>
	    <option value="<?php echo $estados[$i];?>"><?php echo $estados[$i]; ?></option>
	    <?php }?>
    </select><br>
        País: <select name="pais" class="form-control">
                <?php for($i=0;$i<count($paises);$i++){?>
            <option value="<?php echo $paises[$i];?>"><?php echo $paises[$i]; ?></option>
            <?php }?>
    </select><br>
	Logo: <input type="file" name="file"><br>
	<button class="btn btn-lg btn-primary btn-block" type="submit">Guardar</button>
	<?php } ?>
</form>
