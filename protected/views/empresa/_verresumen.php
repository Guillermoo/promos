<li class="span3">
	<div class="thumbnail">
		<?php 
			if(empty($data->nombre))
				echo CHtml::link('NO name', array('verpromos', 'id'=>$data->id));				
			echo CHtml::link(CHtml::encode($data->nombre), array('verpromos', 'id'=>$data->id)); ?>
	</div>
</li>