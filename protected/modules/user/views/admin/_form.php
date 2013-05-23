<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
));
?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

	<?php //(G)Enterarse de que va la histoaria esta del errorSummary?>
	<?php echo $form->errorSummary(array($model)); ?>
	
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
	<?php //endif;?>
	
	<!-- Si es un NOadmin logeado, queremos ver el perfil de un NOadmin --> 
	<?php if (isset($profile)):?> 
		<div class="fields">
			<?php //if (isset($profile)):?>
				<div class="row">
					<?php echo $form->labelEx($profile,'username'); ?>
					<?php echo $form->textField($profile,'username',array('size'=>60,'maxlength'=>128)); ?>
					<?php echo $form->error($profile,'username'); ?>
				</div>
				
				<div class="row">
					<?php echo $form->labelEx($profile,'lastname'); ?>
					<?php echo $form->textField($profile,'lastname',array('size'=>60,'maxlength'=>128)); ?>
					<?php echo $form->error($profile,'lastname'); ?>
				</div>
			
				<div class="row">
					<?php echo $form->labelEx($profile,'paypal_id'); ?>
					<?php echo $form->textField($profile,'paypal_id',array('size'=>60,'maxlength'=>128)); ?>
					<?php echo $form->error($profile,'paypal_id'); ?>
				</div>
				
				<div class="row">
					<?php echo $form->labelEx($profile,'tipocuenta'); ?>
					<?php echo $form->textField($profile,'tipocuenta',array('size'=>60,'maxlength'=>128)); ?>
					<?php echo $form->error($profile,'tipocuenta'); ?>
				</div>
				
				<div class="row">
					<?php echo $form->labelEx($profile,'fecha_activacion'); ?>
					<?php //echo $form->textField($profile,'fecha_activacion',array('size'=>60,'maxlength'=>128)); ?>
					<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
					    'attribute'=>'fecha_activacion',
						'model'=>$profile,
						'value'=>'fecha_activacion',
	  					'name' => $profile->fecha_activacion,
					    // additional javascript options for the date picker plugin
					    'options'=>array(
							'dateFormat'=>'yy-mm-dd',
					        'showAnim'=>'fold',
							'changeMonth'=>'true', 
	    					'changeYear'=>'true',
					    ),
					));?>
					<?php echo $form->error($profile,'fecha_activacion'); ?>
				</div>
				
				<div class="row">
					<?php echo $form->labelEx($profile,'fecha_fin'); ?>
					<?php echo $form->textField($profile,'fecha_fin',array('size'=>60,'maxlength'=>128)); ?>
					<?php echo $form->error($profile,'fecha_fin'); ?>
				</div>
				
				<div class="row">
					<?php echo $form->labelEx($profile,'fecha_pago'); ?>
					<?php echo $form->textField($profile,'fecha_pago',array('size'=>60,'maxlength'=>128)); ?>
					<?php echo $form->error($profile,'fecha_pago'); ?>
				</div>
			<?php //endif;?>
			</div>
			<div class="fields">
			<?php //if (isset($contacto)):?>
			
				<div class="row">
					<?php echo $form->labelEx($contacto,'telefono'); ?>
					<?php echo $form->textField($contacto,'telefono',array('size'=>60,'maxlength'=>128,'integer'=>true)); ?>
					<?php echo $form->error($contacto,'telefono'); ?>
				</div>
				
				<div class="row">
					<?php echo $form->labelEx($contacto,'fax'); ?>
					<?php echo $form->textField($contacto,'fax',array('size'=>60,'maxlength'=>128,'integer'=>true)); ?>
					<?php echo $form->error($contacto,'fax'); ?>
				</div>
				
				<div class="row">
					<?php echo $form->labelEx($contacto,'cp'); ?>
					<?php echo $form->textField($contacto,'cp',array('size'=>60,'maxlength'=>128)); ?>
					<?php echo $form->error($contacto,'cp'); ?>
				</div>
				
				<div class="row">
					<?php echo $form->labelEx($contacto,'barrio'); ?>
					<?php echo $form->textField($contacto,'barrio',array('size'=>60,'maxlength'=>128)); ?>
					<?php echo $form->error($contacto,'barrio'); ?>
				</div>
				
				<div class="row">
					<?php echo $form->labelEx($contacto,'direccion'); ?>
					<?php echo $form->textField($contacto,'direccion',array('size'=>60,'maxlength'=>128)); ?>
					<?php echo $form->error($contacto,'direccion'); ?>
				</div>
			<?php //endif;?>
			
		</div>
	
	<?php endif;?>
		
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