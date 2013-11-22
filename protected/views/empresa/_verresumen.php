<li class="span3">
	<div class="thumbnail">
		<?php 
			if(isset($data->item)): ?>
				<a href="#" ><img src="<?php echo Yii::app()->request->baseUrl.$data->item->path; ?>" /></a>
			<?php else: ?>
				<a href="#" ><img src="<?php echo Yii::app()->request->baseUrl.Yii::app()->params['no_image'] ?>" />
				</a>
			<?php endif; ?>
			<?php
			if(empty($data->nombre))
				echo CHtml::link('NO name', array('verpromos', 'id'=>$data->id));				
			echo CHtml::link(CHtml::encode($data->nombre), array('verpromos', 'id'=>$data->id)); 

			//$this->debug($datos);
			?>
			<?php if(isset($data->twitter) && !empty($data->twitter)){ ?>
			<a href="<?php echo $data->twitter ?>" target="_blank"><img src="<?php echo Yii::app()->theme->baseUrl?>/img/icon-twitter.png"/></a>
			<?php } ?>

			<?php if(isset($data->facebook) && !empty($data->facebook)){ ?>
			<a href="<?php echo $data->twitter ?>" target="_blank"><img src="<?php echo Yii::app()->theme->baseUrl?>/img/icon-facebook.png"/></a>
			<?php } ?>
	</div>
</li>