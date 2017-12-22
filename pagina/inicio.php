<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 12/22/17
 * Time: 7:33 AM
 */

include_once(dirname(__FILE__) . '/persistencia/excepciones/ExceptionPersistencia.php');
include_once(dirname(__FILE__) . '/persistencia/excepciones/ExceptionUsuario.php');
include_once(dirname(__FILE__) . '/persistencia/excepciones/ExceptionPago.php');
include_once(dirname(__FILE__) . '/logica/Fachada.php');
include_once(dirname(__FILE__) . '/logica/objetos/Usuario.php');
include_once(dirname(__FILE__) . '/logica/objetos/Rol.php');
include_once(dirname(__FILE__) . '/grafica/Controladora.php');
session_start();
$con = new Controladora();
$t = $con -> getF() -> obtenerDatosPagina();
?>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/camera.css" rel="stylesheet" type="text/css" media="all" />
<script type='text/javascript' src="js/jquery.min.js"></script>
<script type='text/javascript' src="js/jquery.easing.1.3.js"></script>
<script type='text/javascript' src="js/camera.min.js"></script>
<script>
    jQuery(function(){

        jQuery('#camera_wrap_4').camera({
            height: 'auto',
            loader: 'bar',
            pagination: false,
            thumbnails: true,
            hover: false,
            opacityOnGrid: false,
            imagePath: '../images/'
        });

    });
    function myMap() {
        var mapOptions = {
            center: new google.maps.LatLng(51.5, -0.12),
            zoom: 10,
            mapTypeId: google.maps.MapTypeId.HYBRID
        }
        var map = new google.maps.Map(document.getElementById("map"), mapOptions);
    }
</script>

<div class="content">
			    <div class="content_top">
			    	<div class="wrap">
					<div class="content_s">
						<h3><?php echo $t[0]?></h3>
					</div>
					</div>
			    </div>
			<div class="content-grids">
				<div class="wrap">
				 <div class="grid">
					<a href="#"><img src="<?php echo $t[16]?>" title="image-name"></a>
					<h3><?php echo $t[1]?></h3>
					<div class="grid_p">
					<p><?php echo $t[2]?></p>
					</div>
				</div>
				<div class="grid">
					<a href="#"><img src="<?php echo $t[17]?>" title="image-name"></a>
					<h3><?php echo $t[3]?></h3>
					<div class="grid_p">
					<p><?php echo $t[4]?></p>
					</div>
				</div>
				<div class="grid last-grid">
					<a href="#"><img src="<?php echo $t[18]?>" title="image-name"></a>
					<h3><?php echo $t[5]?></h3>
					<div class="grid_p">
					<p><?php echo $t[6]?></p>
					</div>
				</div>
				<div class="clear"> </div>
			</div>
		 </div>
			<div class="specials">
				<div class="wrap">
					<div class="specials-heading">
						<h3><?php echo $t[7]?></h3>
					</div>
					<div class="specials-grids">
						<div class="special-grid">
							<img src="<?php echo $t[19]?>" title="image-name">
							<a href="listadoActividades.php"><?php echo $t[8]?></a>
							<p><?php echo $t[9]?></p>
						</div>
						<div class="special-grid">
							<img src="<?php echo $t[20]?>" title="image-name">
							<a href="listadoActividades.php"><?php echo $t[10]?></a>
							<p><?php echo $t[11]?></p>
						</div>
						<div class="special-grid spe-grid">
							<img src="<?php echo $t[21]?>" title="image-name">
							<a href="listadoActividades.php"><?php echo $t[12]?></a>
							<p><?php echo $t[13]?></p>
						</div>
						<div class="clear"> </div>
					</div>
			    </div>
			</div>
		</div>
<div class="footer">
<div class="wrap">
	<div class="footer_main">
		<div class="footer-grid">
			<h3><?php echo $t[14]?></h3>
			<p><?php echo $t[15]?></p>
            <div class="clear"></div>
            <div id="map" style="width:100%;height:400px; margin-bottom:15px">
		</div>
		<div class="footer-nav1">
        	<ul>
        		<li id="twtr"><a href=""><img src="images/twitter.png" alt="" title="Twitter"></a></li>
            	<li id="fb"><a href=""><img src="images/fb.png" alt="" title="facebook"></a></li>
                <li id="feed"><a href=""><img src="images/feed.png" alt="" title="Feed"></a></li>
                <li id="plus"><a href=""><img src="images/plus.png" alt="" title="Plus"></a></li>
			</ul>
        </div>
	</div>
</div>
</div>
</div>
<?php
echo "<script>alert('aca1')</script>";
?>
<!--<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAS9jEtD4t6KIYnVMjrdUCb2_u7pLAjObUY&callback=myMap">