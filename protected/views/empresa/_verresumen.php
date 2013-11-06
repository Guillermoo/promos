<tr>
	<td>
		<?php 
			if(empty($data->nombre))
				echo CHtml::link('Sin nombre', array('view', 'id'=>$data->nombre_slug));				
			echo CHtml::link(CHtml::encode($data->nombre), array('view', 'id'=>$data->nombre_slug)); ?>
	</td>
</tr>