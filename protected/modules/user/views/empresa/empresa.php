<?php echo __FILE__; ?>
<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Profile");
/*$this->breadcrumbs=array(
	UserModule::t("Profile"),
);*/
?><h1><?php echo UserModule::t('Your company'); ?></h1>

<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
	<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'empresa-form',
	'enableAjaxValidation'=>true,
	'action'=>'empresa/edit',
	'htmlOptions' => array('enctype'=>'multipart/form-data')
));
?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
	
	<?php if (Yii::app()->authManager->checkAccess('empresa', Yii::app()->user->id) ):?>
		<?php //echo $form->errorSummary(array($model,$empresa,$contacto)); ?>
	<?php endif;?>
	<?php $this->widget('bootstrap.widgets.TbLabel', array(
	    'type'=>'info', // 'success', 'warning', 'important', 'info' or 'inverse'
	    'label'=>'Empresa',
	)); ?>
	<div class="row">
		<?php echo $form->labelEx($empresa,'categoria_id'); ?>
		<?php echo $form->textField($empresa,'categoria_id'); ?>
		<?php echo $form->error($empresa,'categoria_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($empresa,'logo_id'); ?>
		<?php echo $form->textField($empresa,'logo_id'); ?>
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
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
	
	<?php $this->endWidget(); ?>	
