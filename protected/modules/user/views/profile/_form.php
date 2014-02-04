<?php if(YII_RUTAS == true) echo __FILE__; ?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'profile-form',
	'enableAjaxValidation'=>false,
	//'type'=>'horizontal',
	'action'=>$model->isNewRecord ? 'profile/create' : 'profile/update',
	//'action'=>'profile/update',
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'htmlOptions' => array('enctype'=>'multipart/form-data')
));
?>
<fieldset>
	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
	<?php echo $form->errorSummary($model); ?>
	<?php //echo $form->errorSummary(array($model,$model->profile)); ?>
	
	<?php if (UserModule::isSuperAdmin() || UserModule::isAdmin() ):?>
		<?php //Estos campos sólo se muestran al admin ya que son de uso interno. ?>
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
	<?php $profile = $model->profile; ?>			
		<div class="fields">
			<!-- Inicio profile -->
			<div class="row"><!-- Tipo de cuenta -->
				<?php //echo $form->labelEx($profile,'tipocuenta'); ?>
				<?php //echo $form->textField($profile->cuenta,'titulo'); ?>
				<?php /*$this->widget('bootstrap.widgets.TbButtonGroup', array(
			        'type'=>'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
			        'buttons'=>array(
			            array('label'=>$profile->cuenta->titulo, 'url'=>'#'),
			            array('items'=>array(
			                array('label'=>'Actualizar cuenta', 'url'=>'#'),
			            )),
			        ),
			    )); */?>
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
				<?php /*$this->widget('zii.widgets.jui.CJuiDatePicker',array(
					'name' => $profile->fecha_activacion,
				    'attribute'=>'fecha_activacion',
					'model'=>$profile,
					'value'=>$profile->fecha_activacion,
				    // additional javascript options for the date picker plugin
				    'options'=>array(
						'dateFormat'=>'yy-mm-dd',
						'altFormat' =>'yy-mm-dd',
				        'showAnim'=>'fold',
						'changeMonth'=>'true', 
    					'changeYear'=>'true',
				    	'debug'=>YII_DEBUG,
				    ),
				));*/?>
                <?php /*echo $form->datepickerRow($profile, 'fecha_activacion',
                        array('hint'=>'Haz click para seleccionar la fecha',
                           'prepend'=>'<i class="icon-calendar"></i>')); ?>
				<?php echo $form->error($profile,'fecha_activacion'); */?>
			</div>
			<div class="row">
				<?php /*echo $form->labelEx($profile,'fecha_fin'); ?>
				<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
					'name' => 'fecha_fin',
				    'attribute'=>'fecha_fin',
					'model'=>$profile,
					'value'=>$profile->fecha_fin,
				    // additional javascript options for the date picker plugin
				    'options'=>array(
						'dateFormat'=>'yy-mm-dd',
						'altFormat' =>'yy-mm-dd',
				        'showAnim'=>'fold',
						'changeMonth'=>'true', 
    					'changeYear'=>'true',
				    	'debug'=>YII_DEBUG,
				    ),
				));*/?>
                <?php /*echo $form->datepickerRow($profile, 'fecha_fin',
                                    array('hint'=>'Haz click para seleccionar la fecha',
                                    'prepend'=>'<i class="icon-calendar"></i>')); ?>
				<?php echo $form->error($profile,'fecha_fin'); */?>
			</div>
			
			<div class="row">
				<?php //echo $form->textField($model->profile,'fecha_pago'); ?>
				<?php /*$this->widget('zii.widgets.jui.CJuiDatePicker',array(
				    'name' => 'fecha_pago',
					'attribute'=>'fecha_pago',
					'model'=>$profile,
					'value'=>$profile->fecha_pago,
				    // additional javascript options for the date picker plugin
				    'options'=>array(
						'dateFormat'=>'yy-mm-dd',
						'altFormat' =>'yy-mm-dd',
				        'showAnim'=>'fold',
						'changeMonth'=>'true', 
    					'changeYear'=>'true',
				    	'debug'=>YII_DEBUG,
				    ),
				));*/?>
                <?php /*echo $form->datepickerRow($profile, 'fecha_pago',
                                    array('hint'=>'Haz click para selecioar la fecha',
                                    'prepend'=>'<i class="icon-calendar"></i>')); ?>
				<?php echo $form->error($profile,'fecha_pago'); */?>
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
			
			
			<!-- <div class="row">
				<?php /*echo $form->labelEx($profile,'barrio'); 
				echo $form->textField($profile,'barrio');
				echo $form->error($profile,'barrio'); */?>
			</div> -->
			
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
	

	<?php else:?>
		<?php $profile = $model->profile; ?>
		<div class="fields">
			<!-- Inicio profile comprador-->		
				
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
				<?php echo $form->labelEx($profile,'telefono'); ?>
				<?php echo $form->textField($profile,'telefono',array('size'=>50,'maxlength'=>50)); ?>
				<?php echo $form->error($profile,'telefono'); ?>
			</div>						
			
			<div class="row">
				<?php echo $form->labelEx($profile,'cp'); ?>
				<?php echo $form->textField($profile,'cp',array('size'=>11,'maxlength'=>11)); ?>
				<?php echo $form->error($profile,'cp'); ?>
			</div>
			
			<!-- <div class="row">
				<?php /*echo $form->labelEx($profile,'barrio'); 
				echo $form->textField($profile,'barrio');
				echo $form->error($profile,'barrio'); */?>
			</div> -->
			
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
		<?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save'), array('class'=>'btn btn-success btn-large')); ?>
	</div>
 
</fieldset>

<?php $this->endWidget(); ?>	