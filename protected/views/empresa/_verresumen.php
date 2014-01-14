<li class="span3">
	<div class="thumbnail">
		<?php 
			//así lo pone en el formulario del perfil de la empresa:
			//echo CHtml::image(Yii::app()->request->baseUrl.$empresa->usuario->item->path,"image",array("width"=>350));			
			//$usuario = User::model()->findByPk($data->user_id);
			$image = Item::model()->find('foreign_id='.$data->id.' AND model="empresa"');
			//$this->debug($usuario);
			if(isset($image)): ?>
				<a href="empresa/verpromos/<?php echo $data->id ?>" ><center><img src="<?php echo Yii::app()->getBaseUrl().$image->path; ?>" /></center></a>
			<?php else: ?>
				<a href="empresa/verpromos/<?php echo $data->id ?>" ><img src="<?php echo Yii::app()->request->baseUrl.Yii::app()->params['no_image'] ?>" />
				</a>
			<?php endif; ?>
			<?php
			if(empty($data->nombre)):
				echo "<h4>".CHtml::link('Sin nombre', array('verpromos', 'id'=>$data->id))."</h4";				
			else:
				echo "<h4>".CHtml::link(CHtml::encode($data->nombre), array('verpromos', 'id'=>$data->id))."</h4>"; 
			endif;
			//$this->debug($datos);
			?>
			<?php if(isset($data->twitter) && !empty($data->twitter)): ?>
			<a href="<?php echo $data->twitter ?>" target="_blank"><img src="<?php echo Yii::app()->theme->baseUrl?>/img/icon-twitter.png"/></a>
			<?php endif; ?>

			<?php if(isset($data->facebook) && !empty($data->facebook)): ?>
			<a href="<?php echo $data->facebook ?>" target="_blank"><img src="<?php echo Yii::app()->theme->baseUrl?>/img/icon-facebook.png"/></a>
			<?php endif; ?>
	</div>
</li>