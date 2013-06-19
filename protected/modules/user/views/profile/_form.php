<?php if(YII_RUTAS == true) echo __FILE__; ?>
<h1>sdgsg111</h1>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'profile-form',
	'enableAjaxValidation'=>true,
	//'type'=>'horizontal',
	'action'=>'profile/update',
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'htmlOptions' => array('enctype'=>'multipart/form-data')
));
?>
<h1>sdgsg</h1>
<fieldset>
	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
	
	<?php echo $form->errorSummary(array($model,$model->profile)); ?>
	
	<?php if (UserModule::isSuperAdmin() || UserModule::isAdmin() ):?>
		<?php //Estos campos sólo se muestran al admin ya que son de uso interno. ?>
		swgsg;
		<div class="row">
			<?php echo $form->labelEx($model,'username'); ?>
			<?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20)); ?>
			<?php echo $form->error($model,'username'); ?>
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
	<?php endif; ?>
	<?php if (UserModule::isCompany() ):?>
		<?php $profile = $model->profile;?>
		<div class="fields">
		
			<?php $this->widget('bootstrap.widgets.TbLabel', array(
			    'type'=>'info', // 'success', 'warning', 'important', 'info' or 'inverse'
			    'label'=>'Profile',
			)); ?>
			<!-- Inicio profile -->
			<div class="row"><!-- Tipo de cuenta -->
				<?php echo $form->labelEx($profile,'tipocuenta'); ?>
				<?php echo $form->textField($profile->cuenta,'titulo'); ?>
			</div>
				
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
				<?php echo $form->textField($profile,'tipocuenta'); ?>
				<?php echo $form->error($profile,'tipocuenta'); ?>
			</div>
			
			<div class="row">
				<?php echo $form->labelEx($profile,'fecha_activacion'); ?>
				<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
				    'attribute'=>'fecha_activacion',
					'model'=>$profile,
					'value'=>$profile->fecha_activacion,
				    // additional javascript options for the date picker plugin
				    'options'=>array(
						'dateFormat'=>'yy-mm-dd',
				        'showAnim'=>'fold',
						'changeMonth'=>'true', 
    					'changeYear'=>'true',
				    	'debug'=>true,
				    ),
				));?>
				<?php echo $form->error($profile,'fecha_activacion'); ?>
			</div>
			<div class="row">
				<?php echo $form->labelEx($profile,'fecha_fin'); ?>
				<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
				    'attribute'=>'fecha_fin',
					'model'=>$profile,
					'value'=>$profile->fecha_fin,
				    // additional javascript options for the date picker plugin
				    'options'=>array(
						'dateFormat'=>'yy-mm-dd',
				        'showAnim'=>'fold',
						'changeMonth'=>'true', 
    					'changeYear'=>'true',
					    'debug'=>true,
				    ),
				));?>
				<?php echo $form->error($profile,'fecha_fin'); ?>
			</div>
			
			<div class="row">
				<?php echo $form->labelEx($profile,'fecha_pago'); ?>
				<?php //echo $form->textField($model->profile,'fecha_pago'); ?>
				<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
				    'attribute'=>'fecha_pago',
					'model'=>$profile,
					'value'=>$profile->fecha_pago,
				    // additional javascript options for the date picker plugin
				    'options'=>array(
						'dateFormat'=>'yy-mm-dd',
				        'showAnim'=>'fold',
						'changeMonth'=>'true', 
    					'changeYear'=>'true',
				    ),
				));?>
				<?php echo $form->error($profile,'fecha_pago'); ?>
			</div>
			<div class="row">
				<?php echo $form->labelEx($profile,'telefono'); ?>
				<?php echo $form->textField($profile,'telefono',array('size'=>50,'maxlength'=>50)); ?>
				<?php echo $form->error($profile,'telefono'); ?>
			</div>
			
			<div class="row">
				<?php echo $form->labelEx($profile,'fax'); ?>
				<?php echo $form->textField($profile,'fax',array('size'=>50,'maxlength'=>50)); ?>
				<?php echo $form->error($profile,'fax'); ?>
			</div>
			
			<div class="row">
				<?php echo $form->labelEx($profile,'cp'); ?>
				<?php echo $form->textField($profile,'cp',array('size'=>11,'maxlength'=>11)); ?>
				<?php echo $form->error($profile,'cp'); ?>
			</div>
			
			<div class="row">
				<?php echo $form->labelEx($profile,'barrio'); ?>
				<?php echo $form->textField($profile,'barrio'); ?>
				<?php echo $form->error($profile,'barrio'); ?>
			</div>
			
			<div class="row">
				<?php echo $form->labelEx($profile,'direccion'); ?>
				<?php echo $form->textField($profile,'direccion',array('size'=>60,'maxlength'=>120)); ?>
				<?php echo $form->error($profile,'direccion'); ?>
			</div>
			
			<div class="row">
				<?php echo $form->labelEx($profile,'poblacion_id'); ?>
				<?php echo $form->textField($profile,'poblacion_id'); ?>
				<?php echo $form->error($profile,'poblacion_id'); ?>
			</div>
		</div> 
	<?php endif;?>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save')); ?>
	</div>
 
</fieldset>

<?php $this->endWidget(); ?>	