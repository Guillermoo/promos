<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'empresa-form',
	'enableAjaxValidation'=>true,
	//'type'=>'horizontal',
	//'action'=>'empresa/edit',
	'htmlOptions' => array('enctype'=>'multipart/form-data')
));
?>

<fieldset>
	<p class="note"><?php //echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->dropDownListRow($empresa->cuenta, 'id', $cuentas); ?>
	
	<?php if (Yii::app()->authManager->checkAccess('empresa', Yii::app()->user->id) ):?>
		<?php echo $form->errorSummary(array($model)); ?>
	<?php endif;?>
	<?php $this->widget('bootstrap.widgets.TbLabel', array(
	    'type'=>'info', // 'success', 'warning', 'important', 'info' or 'inverse'
	    'label'=>'Empresa',
	)); ?>
	
	<?php //$this->debug($empresa);?>
	<div class="row">
		<?php //echo $form->labelEx($empresa,'categoria_id'); ?>
		<?php echo $form->dropDownListRow($empresa, 'contacto_id', $categorias, array('multiple'=>true)); ?>
		
		<?php echo $form->checkBoxListRow($empresa, 'contacto_id', array(
	        'Option one is this and that—be sure to include why it\'s great',
	        'Option two can also be checked and included in form results',
	        'Option three can—yes, you guessed it—also be checked and included in form results',
	    ), array('hint'=>'<strong>Note:</strong> Labels surround all the options for much larger click areas.')); ?>
		<?php echo $form->error($empresa,'contacto_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($empresa,'logo_id'); ?>
		<?php //echo $form->textField($empresa,'logo_id'); ?>
		<?php $this->widget('xupload.XUpload', array(
                    'url' => Yii::app()->createUrl("site/upload"),
                    'model' => $logo,
                    'attribute' => 'file',
                    'multiple' => false,
			));
		?>
		<?php //echo $form->fileFieldRow($empresa, 'logo_id'); ?>
		<?php echo $form->error($empresa,'logo_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($empresa,'cif'); ?>
		<?php echo $form->textField($empresa,'cif',array('size'=>9,'maxlength'=>9)); ?>
		<?php echo $form->error($empresa,'cif'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($empresa,'web'); ?>
		<?php echo $form->textField($empresa,'web',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($empresa,'web'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($empresa,'twitter'); ?>
		<?php echo $form->textField($empresa,'twitter',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($empresa,'twitter'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($empresa,'facebook'); ?>
		<?php echo $form->textField($empresa,'facebook',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($empresa,'facebook'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($empresa,'urlTienda'); ?>
		<?php echo $form->textField($empresa,'urlTienda',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($empresa,'urlTienda'); ?>
	</div>
	
	<div class="row">
    	<?php //$this->renderPartial('/layouts/_contacto',array('model' => $model,'form'=>$form) );?>
	</div>
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

	<div class="row buttons">
		<?php //echo CHtml::submitButton('Save'); ?>
	</div>
</fieldset>

<?php $this->endWidget(); ?>	