<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
));
?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary(array($model,$profile,$contacto)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'superuser'); ?>
		<?php echo $form->dropDownList($model,'superuser',User::itemAlias('AdminStatus')); ?>
		<?php echo $form->error($model,'superuser'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',User::itemAlias('UserStatus')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>
	
	<div class="fields">
	
	<div class="row">
		<?php echo $form->labelEx($model->profile,'username'); ?>
		<?php echo $form->textField($model->profile,'username',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model->profile,'username'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model->profile,'lastname'); ?>
		<?php echo $form->textField($model->profile,'lastname',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model->profile,'lastname'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model->profile,'contacto_id'); ?>
		<?php echo $form->textField($model->profile,'contacto_id',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model->profile,'contacto_id'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model->profile,'paypal_id'); ?>
		<?php echo $form->textField($model->profile,'paypal_id',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model->profile,'paypal_id'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model->profile,'tipocuenta'); ?>
		<?php echo $form->textField($model->profile,'tipocuenta',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model->profile,'tipocuenta'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model->profile,'fecha_creacion'); ?>
		<?php echo $form->textField($model->profile,'fecha_creacion',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model->profile,'fecha_creacion'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model->profile,'fecha_fin'); ?>
		<?php echo $form->textField($model->profile,'fecha_fin',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model->profile,'fecha_fin'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model->profile,'fecha_pago'); ?>
		<?php echo $form->textField($model->profile,'fecha_pago',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model->profile,'fecha_pago'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model->contacto,'telefono'); ?>
		<?php echo $form->textField($model->contacto,'telefono',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model->contacto,'telefono'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model->contacto,'fax'); ?>
		<?php echo $form->textField($model->contacto,'fax',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model->contacto,'fax'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model->contacto,'cp'); ?>
		<?php echo $form->textField($model->contacto,'cp',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model->contacto,'cp'); ?>
	</div>
	
	
	</div>
		
	<?php
		/* Miramos el tipo de usuario que queremos crear*/
		/*Dinámicamente se van a crear los campos asignados para el usuario*/ 
		//$profileFields=User::getFields();
		//if ($profileFields) { ?>
	<div class="fields">
			<?php //foreach($profileFields as $field) {
			?>
		<div class="row">
			<?php //echo $form->labelEx($profile,$field->varname); ?>
			<?php 
			/*if ($widgetEdit = $field->widgetEdit($profile)) {
				echo $widgetEdit;
			} elseif ($field->range) {
				echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
			} elseif ($field->field_type=="TEXT") {
				echo CHtml::activeTextArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
			} else {
				echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
			}*/
			 ?>
			 
			<?php //echo $form->error($profile,$field->varname); ?>
		</div>
			<?php
			//}?>
	</div>
		<?php //}?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->