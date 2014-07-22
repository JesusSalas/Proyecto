<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>css/bootstrap-theme.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>css/datepicker.css" rel="stylesheet">
	<link href="<?php echo base_url();?>css/carousel.css" rel="stylesheet">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>js/bootstrap-datepicker.js"></script>
	<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
	<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>

	<script>
	  function activate(){
	    var combate = $('select#combate').val();

	    $.ajax({
	      type: 'POST',
	      url: <?php echo base_url()?>+'index.php/ronda/moreInfo',
	      data: 'combate='+combate,
	      success: function(data){
	        $('#content').html(data);
	      }
	    });
	  }
	</script>

	<title>Untitled</title>

	<script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                
                $('#fecha').datepicker({
                    format: "yyyy-mm-dd"
                }).on('changeDate',function(ev){
                	$(this).datepicker('hide');
                });

            });
        </script>
</head>
<body role="document">
	<!-- header -->
	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    	<div class="container">
        	<div class="navbar-header">
          		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		            <span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
          		</button>
          		<a class="navbar-brand" href="<?php echo base_url();?>"><img src="<?php echo base_url(); ?>logos/skif.gif" width="30px"></a>
        	</div>
        	<div class="navbar-collapse collapse">
          		<ul class="nav navbar-nav">
            		<li><a href="<?php echo base_url();?>">Inicio</a></li>
		            <?php if($this->session->userdata('userid')){?>
		            <li class="dropdown">
		              	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Participantes <span class="caret"></span></a>
		              	<ul class="dropdown-menu" role="menu">
			                <li><?php echo anchor(site_url().'/participante/registro','Registrar nuevo'); ?></li>
			                <li><?php echo anchor(site_url().'/participante','Ver todos'); ?></li>
			                <li><?php echo anchor(site_url().'/participante/evento','Asignar a evento'); ?></li>
              			</ul>
            		</li>
		            <?php if($this->session->userdata('isadmin') == 1){?>
		            <li class="dropdown">
		              	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Eventos <span class="caret"></span></a>
		              	<ul class="dropdown-menu" role="menu">
			                <li><?php echo anchor(site_url().'/evento/registro','Agregar'); ?></li>
			                <li><?php echo anchor(site_url().'/evento','Ver todos'); ?></li>
			                <li><?php echo anchor(site_url().'/evento/autoriza','Autorizar asistencia'); ?></li>
              			</ul>
            		</li>
            		<!--<li class="dropdown">
		              	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Jueces <span class="caret"></span></a>
		              	<ul class="dropdown-menu" role="menu">
			                <li><?php echo anchor(site_url().'/juez/registro','Agregar'); ?></li>
			                <li><?php echo anchor(site_url().'/juez','Ver todos'); ?></li>
              			</ul>
            		</li>-->
            		<li class="dropdown">
		              	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dojos <span class="caret"></span></a>
		              	<ul class="dropdown-menu" role="menu">
			                <li><?php echo anchor(site_url().'/dojo/registro','Agregar'); ?></li>
			                <li><?php echo anchor(site_url().'/dojo','Ver todos'); ?></li>
              			</ul>
            		</li>
            		<li class="dropdown">
		              	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuarios <span class="caret"></span></a>
		              	<ul class="dropdown-menu" role="menu">
			                <li><?php echo anchor(site_url().'/usuario/registro','Agregar'); ?></li>
			                <li><?php echo anchor(site_url().'/usuario','Ver todos'); ?></li>
              			</ul>
            		</li>
            		<?php }
            		if($this->session->userdata('isadmin') == 0) {
            		?>
			        <li><?php echo anchor(site_url().'/contacto','Contacto'); ?></li>
              		<?php }
              		}?>
          		</ul>
          		<u1 class="nav navbar-nav navbar-right">
          			<?php if($this->session->userdata('userid')){?>
            		<li class="navbar-text">(<?php echo $this->session->userdata('nombre')." ".$this->session->userdata('apellido')?>)</li>
            		<li><?php echo anchor(site_url().'/home/do_logout','Salir'); ?></li>
            		<?php }?>
          		</u1>
        	</div>
      	</div>
    </div>
    <!-- end header -->
    <br><br><br><br>
	<div class="container theme-showcase" role="main">
		<div class="jumbotron">
			<?php echo $content_for_layout ?>
		</div>
	</div>
</body>
</html>
