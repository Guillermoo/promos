<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Registration");
$this->breadcrumbs=array(
	UserModule::t("Registration"),
);
?>

<h1><?php echo UserModule::t("Registration Company"); ?></h1>

<?php if(Yii::app()->user->hasFlash('registration')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('registration'); ?>
</div>
<?php else: ?>

<div class="form">
<?php $form=$this->beginWidget('UActiveForm', array(
	'id'=>'registration-form',
	'enableAjaxValidation'=>true,
	'disableAjaxValidationAttributes'=>array('RegistrationForm_verifyCode'),
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
	
	<?php echo $form->errorSummary(array($model)); ?>
	
	<div class="row">
	<?php echo $form->labelEx($model,'username'); ?>
	<?php echo $form->textField($model,'username'); ?>
	<?php echo $form->error($model,'username'); ?>
	</div>
	
	<div class="row">
	<?php echo $form->labelEx($model,'password'); ?>
	<?php echo $form->passwordField($model,'password'); ?>
	<?php echo $form->error($model,'password'); ?>
	<p class="hint">
	<?php echo UserModule::t("Minimal password length 4 symbols."); ?>
	</p>
	</div>
	
	<div class="row">
	<?php echo $form->labelEx($model,'verifyPassword'); ?>
	<?php echo $form->passwordField($model,'verifyPassword'); ?>
	<?php echo $form->error($model,'verifyPassword'); ?>
	</div>
	
	<div class="row">
	<?php echo $form->labelEx($model,'email'); ?>
	<?php echo $form->textField($model,'email'); ?>
	<?php echo $form->error($model,'email'); ?>
	</div>
	
	<div class="row">
	De momento está hecho estático
	<?php echo $form->labelEx($model,'cuenta'); ?>
	<?php echo CHtml::dropDownList('region_id','', 
		  array(0=>'Trial',1=>'Lite',2=>'Basic',3=>'Deluxe'),
		  array(
		    'prompt'=>'Selecciona una categoría',
		    'ajax' => array(
		    'type'=>'POST', 
		    'url'=>CController::createUrl('loadcities'),
		    'update'=>'#city_name', 
		  	'data'=>array('region_id'=>'js:this.value'),
		  )));  ?>
	<?php echo $form->error($model,'cuenta'); ?>
	</div>

	<?php if (UserModule::doCaptcha('registration')): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'verifyCode'); ?>
		<?php echo $form->error($model,'verifyCode'); ?>
		
		<p class="hint"><?php echo UserModule::t("Please enter the letters as they are shown in the image above."); ?>
		<br/><?php echo UserModule::t("Letters are not case-sensitive."); ?></p>
	</div>
	<?php endif; ?>
	
	<div class="row submit">
		<?php echo CHtml::submitButton(UserModule::t("Register")); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
<?php endif; ?>