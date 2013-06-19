<?php if ($model !== null):?>
<table border="1">

	<tr>
		<th width="80px">
		      user_id		</th>
 		<th width="80px">
		      username		</th>
 		<th width="80px">
		      lastname		</th>
 		<th width="80px">
		      contacto_id		</th>
 		<th width="80px">
		      paypal_id		</th>
 		<th width="80px">
		      tipocuenta		</th>
 		<th width="80px">
		      fecha_creacion		</th>
 		<th width="80px">
		      fecha_fin		</th>
 		<th width="80px">
		      fecha_pago		</th>
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        		<td>
			<?php echo $row->user_id; ?>
		</td>
       		<td>
			<?php echo $row->username; ?>
		</td>
       		<td>
			<?php echo $row->lastname; ?>
		</td>
       		<td>
			<?php echo $row->contacto_id; ?>
		</td>
       		<td>
			<?php echo $row->paypal_id; ?>
		</td>
       		<td>
			<?php echo $row->tipocuenta; ?>
		</td>
       		<td>
			<?php echo $row->fecha_creacion; ?>
		</td>
       		<td>
			<?php echo $row->fecha_fin; ?>
		</td>
       		<td>
			<?php echo $row->fecha_pago; ?>
		</td>
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>
