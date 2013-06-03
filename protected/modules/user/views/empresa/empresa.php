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

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'empresa-form',
	'enableAjaxValidation'=>true,
	//'type'=>'horizontal',
	'action'=>'empresa/edit',
	'htmlOptions' => array('enctype'=>'multipart/form-data')
));
?>

<fieldset>
	<p class="note"><?php //echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

	<div class="row"><!-- Tipo de cuenta -->
		<?php //echo $form->labelEx($empresa,'logo_id'); ?>
	</div>
	<?php //echo $form->dropDownListRow($empresa->cuenta, 'id', $cuentas); ?>
	
	<?php if (Yii::app()->authManager->checkAccess('empresa', Yii::app()->user->id) ):?>
		<?php echo $form->errorSummary(array($model)); ?>
	<?php endif;?>
	<?php $this->widget('bootstrap.widgets.TbLabel', array(
	    'type'=>'info', // 'success', 'warning', 'important', 'info' or 'inverse'
	    'label'=>'Empresa',
	)); ?>
	
	<div class="row"><!-- HAy que mostrar las categorías a las que pertenece pero no dejar editar -->
		<?php //echo $form->labelEx($empresa,'categoria_id'); ?>
		<?php /*echo $form->dropDownListRow($empresa, 'contacto_id', $categorias, array('multiple'=>true)); ?>
		<?php echo $form->checkBoxListRow($empresa, 'contacto_id', $categorias, array('hint'=>'<strong>Note:</strong> Choose only two categories.')); ?>
		<?php echo $form->error($empresa,'contacto_id');*/ ?>
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
    	<?php $this->renderPartial('/layouts/_contacto',array('form'=>$form,'contacto'=>$contacto) );?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Save'); ?>
	</div>
</fieldset>

<?php $this->endWidget(); ?>

