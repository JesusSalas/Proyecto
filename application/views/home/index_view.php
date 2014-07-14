<?php if(isset($msg))
  echo $msg;
$meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Septiembre','Octubre','Noviembre','Diciembre'];
if($evento){
  if($evento->fecha != date('Y-m-d') || $this->session->userdata('isadmin') != 1){
  $fecha = explode('-', $evento->fecha);
  $fecha = $fecha[2].' de '.$meses[$fecha[1]-1].' del '.$fecha[0]; ?>
<div class="panel panel-default">
  <div class="panel-heading"><h3 class="panel-title">Próximo Evento</h3></div>
  <div class="panel-body">
    <h1><?php echo $evento->nombre; ?></h1>
    <p><?php echo $evento->descripcion; ?></p>
  </div>
  <div class="panel-footer">
    Fecha: <b><?php echo $fecha; ?></b>
  </div>
</div>
<?php }}else{?>
  <h2 class="form-signin-heading" align="center">No hay evento próximo</h2><br>
  <?php if($this->session->userdata('isadmin') == 1){ ?>
    <button class="btn btn-lg btn-primary btn-block" type="button" onclick="window.location.href='<?php echo site_url()."/evento/registro" ?>'">Crear evento</button>
  <?php } ?>
<?php }

if($this->session->userdata('isadmin') == 1){
if(!isset($combates)){
  if($evento) {?>
  <div class="panel panel-default">
    <div class="panel-body">
      <?php if($evento->fecha == date('Y-m-d')){ ?>
        <h1>Crea los combates</h1>
        <p>Dá click en el botón para generar los combates automáticamente.</p>
        <button class="btn btn-lg btn-primary btn-block" type="button" onclick="window.location.href='<?php echo site_url()."/ronda/genera" ?>'">Generar combates</button>
      <?php }else{ ?>
        <h1>Más Info</h1>
        <p>información para mostrar</p>
      <?php } ?>
    </div>
  </div>
<?php }}else{ ?>
  <button class="btn btn-lg btn-primary btn-block" type="button" onclick="window.location.href='<?php echo site_url()."/ronda" ?>'">Ver combates</button>
<?php }}