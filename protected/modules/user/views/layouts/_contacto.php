<div class="row">
	<?php echo $form->labelEx($model->contacto,'telefono'); ?>
	<?php echo $form->textField($model->contacto,'telefono',array('size'=>50,'maxlength'=>50)); ?>
	<?php echo $form->error($model->contacto,'telefono'); ?>
</div>

<div class="row">
	<?php echo $form->labelEx($model->contacto,'fax'); ?>
	<?php echo $form->textField($model->contacto,'fax',array('size'=>50,'maxlength'=>50)); ?>
	<?php echo $form->error($model->contacto,'fax'); ?>
</div>

<div class="row">
	<?php echo $form->labelEx($model->contacto,'cp'); ?>
	<?php echo $form->textField($model->contacto,'cp',array('size'=>11,'maxlength'=>11)); ?>
	<?php echo $form->error($model->contacto,'cp'); ?>
</div>

<div class="row">
	<?php echo $form->labelEx($model->contacto,'barrio'); ?>
	<?php echo $form->textField($model->contacto,'barrio'); ?>
	<?php echo $form->error($model->contacto,'barrio'); ?>
</div>

<div class="row">
	<?php echo $form->labelEx($model->contacto,'direccion'); ?>
	<?php echo $form->textField($model->contacto,'direccion',array('size'=>60,'maxlength'=>120)); ?>
	<?php echo $form->error($model->contacto,'direccion'); ?>
</div>

<div class="row">
	<?php echo $form->labelEx($model->contacto,'poblacion_id'); ?>
	<?php echo $form->textField($model->contacto,'poblacion_id'); ?>
	<?php echo $form->error($model->contacto,'poblacion_id'); ?>
</div>