
<style>
	.collapse a{
		text-indent:10px;
	}
	nav#sidebar{
		/*background: url(assets/uploads/<?php echo $_SESSION['system']['cover_img'] ?>) !important*/
	}


	body {
    margin: 0;
    font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
    font-size: 0.8rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    text-align: left;
    background-color: #fff;
}


</style>



<nav id="sidebar" class='mx-lt-5 bg-danger' >
	



      
			
 
		<div class="sidebar-list">
		

				<a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-home text-danger"></i></span> Inicio</a>
				<a href="index.php?page=donors" class="nav-item nav-donors"><span class='icon-field'><i class="fa fa-user-friends text-danger"></i></span> Donantes</a>
				<a href="index.php?page=donations" class="nav-item nav-donations"><span class='icon-field'><i class="fa fa-tint text-danger"></i></span> Donaciones de Sangre</a>
				<a href="index.php?page=requests" class="nav-item nav-requests"><span class='icon-field'><i class="fa fa-th-list text-danger"></i></span> Peticiones</a>
				<a href="index.php?page=handedovers" class="nav-item nav-handedovers"><span class='icon-field'><i class="fa fa-toolbox text-danger"></i></span> Entregados</a>

				<a href="ajax.php?action=logout" class="nav-item "><span class='icon-field'><i class="fa fa-power-off text-danger"></i></span> Cerrar sesión</a>
				<?php if($_SESSION['login_type'] == 1): ?>
				<!-- <a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users text-danger"></i></span> Usuarios</a>-->
				
				<!-- <a href="index.php?page=site_settings" class="nav-item nav-site_settings"><span class='icon-field'><i class="fa fa-cogs text-danger"></i></span> System Settings</a> -->
			<?php endif; ?>
		</div>

		



</nav>
<script>
	$('.nav_collapse').click(function(){
		console.log($(this).attr('href'))
		$($(this).attr('href')).collapse()
	})
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>
