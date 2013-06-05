<div class="form">

<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
	<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>

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
				<?php $this->widget('bootstrap.widgets.TbLabel', array(
				    'type'=>'info', // 'success', 'warning', 'important', 'info' or 'inverse'
					    'label'=>'User',
					)); 
				?>
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
				<div class="row">
					<div class="row"><!-- HAy que mostrar las categorías a las que pertenece pero no dejar editar -->
						<?php /*echo $form->labelEx($empresa,'categoria_id'); ?>
						<?php echo $form->dropDownListRow($empresa, 'contacto_id', $categorias, array('multiple'=>true)); ?>
						<?php echo $form->checkBoxListRow($empresa, 'contacto_id', $categorias, array('hint'=>'<strong>Note:</strong> Choose only two categories.')); ?>
						<?php echo $form->error($empresa,'contacto_id');*/ ?>
					</div>
				</div>
			<!-- Si es un NOadmin logeado, queremos ver el perfil de un NOadmin --> 
			<?php if ($esEmpresa):?> 
				<?php 
					//echo $this->renderPartial('profile/_form', array('form'=>$form,'profile'=>$profile));
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
					
					<div class="row">
						<?php echo $form->labelEx($profile,'tipocuenta'); ?>
						<?php echo $form->textField($profile,'tipocuenta',array('size'=>60,'maxlength'=>128)); ?>
						<?php echo $form->error($profile,'tipocuenta'); ?>
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
				</div>
			<?php endif;?>
		</td>
	</tr>
	
	<?php if ($esEmpresa):?>
		<tr>
			<td>
				<?php 
					echo $this->renderPartial('/empresa/_form', array('form'=>$form,'empresa'=>$empresa,'categorias'=>$categorias,'cuentas'=>$cuentas,'contacto'=>$contacto,'myValue'=>$myValue));
				?>
			</td>
		</tr>
	<?php endif;?>
</table>
<div class="row buttons">
	<?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save')); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->