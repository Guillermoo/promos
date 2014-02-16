<?php if(YII_RUTAS == true) echo __FILE__; ?>
<br>
<h2>Valoración de la promoción</h2>
<?php if(UserModule::isBuyer()): //debería de comprobar que el usuario ha comprado la promoción que quiere votar ?>
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'votar-form',
	'enableAjaxValidation'=>false,
	//'type'=>'horizontal',
	'action'=>'votar/id/'.$model->id,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'htmlOptions' => array('enctype'=>'multipart/form-data')
	));
?>
<div class="clearfix"><p>La valoración de la promoción es muy útil para otros usuarios. Por favor, valore honestamente la promoción en general. </p><p>&nbsp;</p></div>
<fieldset>
	
		<div class="row-fluid">
			<?php if(Yii::app()->user->hasFlash('notification')):?>
    			<div class="alert alert-info">
        			<?php echo Yii::app()->user->getFlash('notification'); ?>
    			</div>
			<?php endif; ?>
			<?php if(isset($compra) && $compra->votado!=0): ?>
				<div class="alert alert-success">Ya has valorado esta promoción. Tu valoración: <strong><?php echo CHtml::encode($compra->votado); ?></strong></div>
			<?php else: ?>
				<label>Valoración (del 1 al 5): </label><?php //echo CHtml::textField('voto','',array('id'=>'voto', 'class'=>'span1','maxlength'=>2)); 
					echo CHtml::dropDownList('voto', 4, 
              			array(1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5'));
				?>					
				<?php echo CHtml::submitButton('Valorar', array('class'=>'btn btn-success')); ?>	
			<?php endif; ?>
		</div>

	<div class="row buttons">
		
	</div>
 
</fieldset>

<?php $this->endWidget(); ?>	
<?php else: ?>
	<div class="alert alert-error">Solo los usuarios que han comprado la promoción, y que no sean empresas, pueden votar las promociones</div>
<?php endif; ?>