<?php if(isset($msg)) echo $msg; ?>

<table class="table" border="0" cellpadding="2" cellspacing="2">
  <tr>
    <th colspan="20">Categoría</th>
  </tr>
  <tr><td>
    <select name="combate">
    <?php foreach ($combates as $c){?>
      <option value="<?php echo $c->tipo; ?>"><?php echo $c->nombre.'>>'; ?></option>
    <?php }?>
    </select>
  </td>
	<td><button class="btn btn-lg btn-primary btn-block" type="submit">Ver</button></td>
	<td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td>
  </tr>
  <tr>
  	<td colspan="20"><button class="btn btn-lg btn-primary btn-block" onclick="location.href='<?php echo site_url(); ?>/ronda'" type="button">Regresar</button></td>
  </tr>
</table>