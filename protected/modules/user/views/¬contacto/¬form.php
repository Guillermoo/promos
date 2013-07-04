<?php $this->widget('bootstrap.widgets.TbLabel', array(
    'type'=>'info', // 'success', 'warning', 'important', 'info' or 'inverse'
    'label'=>'Contacto',
)); ?>
 <div class="row">
		<?php echo $form->labelEx($contacto,'telefono'); ?>
		<?php echo $form->textField($contacto,'telefono',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($contacto,'telefono'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($contacto,'fax'); ?>
		<?php echo $form->textField($contacto,'fax',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($contacto,'fax'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($contacto,'cp'); ?>
		<?php echo $form->textField($contacto,'cp',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($contacto,'cp'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($contacto,'barrio'); ?>
		<?php echo $form->textField($contacto,'barrio'); ?>
		<?php echo $form->error($contacto,'barrio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($contacto,'direccion'); ?>
		<?php echo $form->textField($contacto,'direccion',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($contacto,'direccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($contacto,'poblacion_id'); ?>
		<?php echo $form->textField($contacto,'poblacion_id'); ?>
		<?php echo $form->error($contacto,'poblacion_id'); ?>
	</div>