
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
						<b>Lista de peticiones</b>
						<span class="float:right"><a class="btn btn-primary btn-block btn-sm col-sm-2 float-right" href="javascript:void(0)" id="new_request">
					<i class="fa fa-plus"></i> Agregar nueva petición
				</a></span>
					</div>
					<div class="card-body">
						<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="">Fecha</th>
									<th class="">Codigo de referencia</th>
									<th class="">Nombre del paciente</th>
									<th class="">Grupo Sanguíneo</th>
									<th class="">Información</th>
									<th class="">Estado</th>
									<th class="text-center">Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$requests = $conn->query("SELECT * FROM requests order by date(date_created) desc ");
								while($row=$requests->fetch_assoc()):
									
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td>
										<?php echo date('M d, Y',strtotime($row['date_created'])) ?>
									</td>
									<td class="">
										 <p> <b><?php echo $row['ref_code'] ?></b></p>
									</td>
									<td class="">
										 <p> <b><?php echo ucwords($row['patient']) ?></b></p>
									</td>
									<td class="">
										 <p> <b><?php echo $row['blood_group'] ?></b></p>
									</td>
									<td class="">
										 <p>Volumen necesitado: <b><?php echo  ($row['volume'] / 1000).' L' ?></b></p>
										 <p>Nombre del médico: <b><?php echo ucwords($row['physician_name']) ?></b></p>
									</td>
									<td class=" text-center">
										<?php if($row['status'] == 0): ?>
											<span class="badge badge-primary">Pendiente</span>
										<?php else: ?>
											<span class="badge badge-success">Aprobado</span>
										<?php endif; ?>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-outline-primary edit_request" type="button" data-id="<?php echo $row['id'] ?>" >Editar</button>
										<button class="btn btn-sm btn-outline-danger delete_request" type="button" data-id="<?php echo $row['id'] ?>">Borrar</button>
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



	
	
	$('#new_request').click(function(){
		uni_modal("Nueva petición","manage_request.php","mid-large")
		
	})
	$('.edit_request').click(function(){
		uni_modal("Gestionar detalles de la petición","manage_request.php?id="+$(this).attr('data-id'),"mid-large")
		
	})
	$('.delete_request').click(function(){
		_conf("¿Está seguro que quiere eliminar esta petición?","delete_request",[$(this).attr('data-id')])
	})
	
	function delete_request($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_request',
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