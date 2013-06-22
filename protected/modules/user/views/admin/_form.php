<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
	//'action'=>'admin/update',
	'htmlOptions' => array('enctype'=>'multipart/form-data')
));
?>

<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

<?php echo $form->errorSummary(array($model)); ?>
	<table>
		<tr>
			<td>	
				<div class="row">
					<?php $this->widget('bootstrap.widgets.TbLabel', array(
					    'type'=>'info', // 'success', 'warning', 'important', 'info' or 'inverse'
						    'label'=>'User',
						)); 
					?>
				</div>
				<div class="row">
					<?php echo $form->labelEx($model,'email'); ?>
					<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
					<?php echo $form->error($model,'email'); ?>
				</div>
			
				<div class="row">
					<?php echo $form->labelEx($model,'password'); ?>
					<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128)); ?>
					<?php echo $form->error($model,'password'); ?>
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
			<!-- Si es un NOadmin logeado, queremos ver el perfil de un NOadmin --> 
			<?php $esEmpresa = UserModule::isCompany($model->id);?>
			<?php if ($esEmpresa):?> 
				<?php 
					$profile = $model->profile;
				?>
					<?php $this->widget('bootstrap.widgets.TbLabel', array(
					    'type'=>'info', // 'success', 'warning', 'important', 'info' or 'inverse'
					    'label'=>'Profile',
					)); ?>
				<div class="fields">
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
					scenario!!!
					<div class="row">
						<?php echo $form->labelEx($profile,'tipocuenta'); ?>
						<?php //echo $form->textField($profile,'tipocuenta',array('size'=>60,'maxlength'=>128)); ?>
						<?php echo $form->dropDownList($profile,
							'tipocuenta', Cuenta::model()->getCuentas()); ?>
						<?php echo $form->error($profile,'tipocuenta'); ?>
					</div>
					
					<div class="row">
						<?php echo $form->labelEx($profile,'meses'); ?>
						<?php //echo $form->textField($profile,'tipocuenta',array('size'=>60,'maxlength'=>128)); ?>
						<?php echo $form->textField($profile,'meses',array('size'=>60,'maxlength'=>128)); ?>
						<?php echo $form->error($profile,'meses'); ?>
					</div>
					
					<div class="row">
						<?php echo $form->labelEx($profile,'fecha_activacion'); ?>
						<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
							'attribute'=>'fecha_activacion',
							'model'=>$profile,
							'value'=>'fecha_activacion',
		  					'name' => $profile->fecha_activacion,
						    // additional javascript options for the date picker plugin
						    'options'=>array(
								'dateFormat'=>'yy-mm-dd',
								'altFormat' =>'yy-mm-dd',
						        'showAnim'=>'fold',
								'changeMonth'=>'true', 
		    					'changeYear'=>'true',
						    	'debug'=>YII_DEBUG,
						    ),
						));?>
						<?php echo $form->error($profile,'fecha_activacion'); ?>
					</div>
					
					<div class="row">
						<?php echo $form->labelEx($profile,'fecha_fin'); ?>
						<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
							'attribute'=>'fecha_fin',
							'model'=>$profile,
							'value'=>'fecha_fin',
		  					'name' => $profile->fecha_fin,
						    // additional javascript options for the date picker plugin
						    'options'=>array(
								'dateFormat'=>'yy-mm-dd',
								'altFormat' =>'yy-mm-dd',
						        'showAnim'=>'fold',
								'changeMonth'=>'true', 
		    					'changeYear'=>'true',
						    	'debug'=>YII_DEBUG,
						    ),
						));?>
						<?php echo $form->error($profile,'fecha_fin'); ?>
					</div>
					
					<div class="row">
						<?php echo $form->labelEx($profile,'fecha_pago'); ?>
						<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
							'attribute'=>'fecha_pago',
							'model'=>$profile,
							'value'=>'fecha_pago',
		  					'name' => $profile->fecha_pago,
						    // additional javascript options for the date picker plugin
						    'options'=>array(
								'dateFormat'=>'yy-mm-dd',
								'altFormat' =>'yy-mm-dd',
						        'showAnim'=>'fold',
								'changeMonth'=>'true', 
		    					'changeYear'=>'true',
						    	'debug'=>YII_DEBUG,
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
					<?php 
						echo $this->renderPartial('../empresa/_form', array('form'=>$form,'model'=>$model,'image'=>$image));
					?>
				</div>
			<?php endif;?>
		</td>
	</tr>
	
	<?php if ($esEmpresa):?>
		<tr>
			<td>
				
			</td>
		</tr>
	</table>
	<?php else:?>
	</table>
	<div class="row buttons">
				<?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save')); ?>
			</div>
	<?php endif;?>
<?php $this->endWidget(); ?>

</div><!-- form -->