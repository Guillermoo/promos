<h1><?php echo $model->username; ?></h1>
<div class="row">
	<div class="span12">
		<table class="table table-condensed">
			<tr>
				<td>Nombre</td>
				<td><?php echo $model->username." ".$model->lastname; ?></td>
			</tr>			
			<tr>
				<td>Teléfono</td>
				<td><?php echo $model->telefono; ?></td>
			</tr>
			<tr>
				<td>Direccion</td>
				<td><?php echo "C.P: ".$model->cp.", Población: ".$model->poblacion_id. ", Dirección: ".$model->direccion; ?></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><?php echo $model->username; ?></td>
			</tr>
		</table>
	</div>
</div>