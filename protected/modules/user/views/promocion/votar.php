<?php if(YII_RUTAS == true) echo __FILE__; ?>
<br>
<h2>Vota una promoción</h2>
<?php if(UserModule::isBuyer()): //debería de comprobar que el usuario ha comprado la promoción que quiere votar ?>
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'votar-form',
	'enableAjaxValidation'=>false,
	//'type'=>'horizontal',
	'action'=>'promocion/votar',
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'htmlOptions' => array('enctype'=>'multipart/form-data')
	));
?>
<fieldset>
	
		<div class="row">
			<?php echo $form->labelEx($model,'voto'); ?>
			<?php echo $form->textField($model,'voto'); ?>
			<?php echo $form->error($model,'voto'); ?>
		</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save'), array('class'=>'btn btn-success btn-large')); ?>
	</div>
 
</fieldset>

<?php $this->endWidget(); ?>	
<?php else: ?>
	<div class="alert alert-error">Solo los usuarios que han comprado la promoción, y que no sean empresas, pueden votar las promociones</div>
<?php endif; ?>