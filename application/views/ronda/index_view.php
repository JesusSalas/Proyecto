<?php if(isset($msg)) echo $msg;
if($combates){?>
<div class="panel panel-default">
  <div class="panel-heading"><h3><b>Combates</b></h3></div>
<form class="form-signin" role="form" action="<?php echo base_url();?>index.php/ronda/moreInfo" method="post" name="process">
  <table class="table" border="0" cellpadding="2" cellspacing="2">
    <tr>
      <th>Tipo de Combate</th>
    </tr>
    <tr><td>
      <select name="combate" onchange="activate();">
      <option selected disabled>--Selecciona un tipo de combate--</option>
      <?php foreach ($combates as $c){?>
        <option value="<?php echo $c['combate']; ?>"><?php echo $c['tipo_combate'].'>>'; ?></option>
      <?php }?>
      </select>
    </td>
    <td><button class="btn btn-lg btn-primary btn-block" type="submit">Consultar</button></td>
    <td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td>
    <td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td>
    </tr>
  </table>
  <div class="panel-content content"></div>
</div>
<?php } ?>