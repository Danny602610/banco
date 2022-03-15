<style>

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




<?php include('db_connect.php');?>

<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row mb-4 mt-4">
			<div class="col-md-12">
				
			</div>
		</div>
		<div class="row">
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<b>Lista de donantes</b>

						
						
						<span class="float:right"><a class="btn btn-primary btn-block btn-sm col-sm-2 float-right" href="javascript:void(0)" id="new_donor">
					<i class="fa fa-plus"></i> Agregar Nuevo Donante
				</a></span>
					</div>
					<div class="card-body">
						<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="">Donante</th>
									<th class="">Grupo Sanguíneo</th>
									<th class="">Información</th>
									<th class="">Donaciones Anteriores</th>
									<th class="text-center">Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$donors = $conn->query("SELECT * FROM donors order by name asc ");
								while($row=$donors->fetch_assoc()):
									$prev  = $conn->query("SELECT * FROM blood_inventory where status = 1 and donor_id = ".$row['id']." order by date(date_created) desc limit 1 ");
									$prev = $prev->num_rows > 0 ? $prev->fetch_array()['date_created'] : '';	
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="">
										 <p> <b><?php echo ucwords($row['name']) ?></b></p>
									</td>
									<td class="">
										 <p> <b><?php echo $row['blood_group'] ?></b></p>
									</td>
									<td class="">
										  <p>Email: <b><?php echo $row['email']; ?></b></p>
										 <p>Telefono #: <b><?php echo $row['contact']; ?></b></p>
										 <p>Dirección: <b><?php echo $row['address']; ?></b></p>
									</td>
									<td>
										<?php echo !empty($prev) ? date('M d, Y',strtotime($prev)) : 'Primera vez' ?>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-outline-primary edit_donor" type="button" data-id="<?php echo $row['id'] ?>" >Editar</button>
										<button class="btn btn-sm btn-outline-danger delete_donor" type="button" data-id="<?php echo $row['id'] ?>">Borrar</button>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>
<style>
	
	td{
		vertical-align: middle !important;
	}
	td p{
		margin: unset
	}
	img{
		max-width:100px;
		max-height: :150px;
	}
</style>
<script>
	$(document).ready(function(){
		$('table').dataTable({

			"language": {
    "decimal":        "",
    "emptyTable":     "No hay datos en la tabla",
    "info":           "Mostrando _START_ al _END_ de _TOTAL_ entradas",
    "infoEmpty":      "Mostrando 0 al 0 de 0 entradas",
    "infoFiltered":   "(filtrado desde _MAX_ entradas totales)",
    "infoPostFix":    "",
    "thousands":      ",",
    "lengthMenu":     "Mostra _MENU_ entradas &nbsp;",
    "loadingRecords": "Cargando...",
    "processing":     "Procesando...",
    "search":         "Buscar:",
    "zeroRecords":    "Ninguna coincidencia encontrada",
    "paginate": {
        "first":      "Primero",
        "last":       "Último",
        "next":       "Siguiente",
        "previous":   "Anterior"
    },
    "aria": {
        "sortAscending":  ": activate to sort column ascending",
        "sortDescending": ": activate to sort column descending"
			}
	},
   dom: 'lBfrtip',
   buttons: [
    'excel', 'csv', 'pdf', 'print'
   ],
   "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ]



});
	})
	





	$('#new_donor').click(function(){
		uni_modal("Nuevo Donante","manage_donor.php","mid-large")
		
	})
	$('.edit_donor').click(function(){
		uni_modal("Gestionar detalles del donante","manage_donor.php?id="+$(this).attr('data-id'),"mid-large")
		
	})
	$('.delete_donor').click(function(){
		_conf("¿Está seguro que quiere eliminar este donante?","delete_donor",[$(this).attr('data-id')])
	})
	
	function delete_donor($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_donor',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Datos eliminados correctamente!",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>