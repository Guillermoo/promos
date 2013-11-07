<tr>
	<td><?php echo $data->id; ?></td>
	<td>
		<?php 
			if(empty($data->nombre))
				echo CHtml::link('Sin nombre', array('view', 'id'=>$data->nombre_slug));				
			echo CHtml::link(CHtml::encode($data->nombre), array('verpromos', 'id'=>$data->id)); ?>
	</td>
</tr>