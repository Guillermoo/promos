<?php echo __FILE__; ?>
<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Profile");
/*$this->breadcrumbs=array(
	UserModule::t("Profile"),
);*/
?><h1><?php echo UserModule::t('Your profile'); ?></h1>

<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
	<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
	'action'=>'profile/edit',
	'htmlOptions' => array('enctype'=>'multipart/form-data')
));
?>

<!--  <table class="dataGrid"> -->

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
	
	<?php if (!Yii::app()->authManager->checkAccess('admin', Yii::app()->user->id) ):?>
		<?php echo $form->errorSummary(array($model,$profile,$contacto)); ?>
	<?php endif;?>
	
	<?php if (Yii::app()->authManager->checkAccess('admin', Yii::app()->user->id) ):?>
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
	<?php if (!UserModule::isAdmin()):?>
		<div class="fields">
			<!-- Inicio profile -->
			<div class="row">
				<?php echo $form->labelEx($model->profile,'username'); ?>
				<?php echo $form->textField($model->profile,'username',array('size'=>60,'maxlength'=>128)); ?>
				<?php echo $form->error($model->profile,'username'); ?>
			</div>
			
			<div class="row">
				<?php echo $form->labelEx($model->profile,'lastname'); ?>
				<?php echo $form->textField($model->profile,'lastname',array('size'=>60,'maxlength'=>128)); ?>
				<?php echo $form->error($model->profile,'lastname'); ?>
			</div>
			
			<div class="row">
				<?php echo $form->labelEx($model->profile,'paypal_id'); ?>
				<?php echo $form->textField($model->profile,'paypal_id',array('size'=>60,'maxlength'=>128)); ?>
				<?php echo $form->error($model->profile,'paypal_id'); ?>
			</div>
			
			<div class="row">
				<?php echo $form->labelEx($model->profile,'tipocuenta'); ?>
				<?php echo $form->textField($model->profile,'tipocuenta',array('size'=>60,'maxlength'=>128)); ?>
				<?php echo $form->error($model->profile,'tipocuenta'); ?>
			</div>
			
			<div class="row">
				<?php echo $form->labelEx($model->profile,'fecha_activacion'); ?>
				<?php echo $form->textField($model->profile,'fecha_activacion',array('size'=>60,'maxlength'=>128)); ?>
				<?php echo $form->error($model->profile,'fecha_activacion'); ?>
			</div>
			
			<div class="row">
				<?php echo $form->labelEx($model->profile,'fecha_fin'); ?>
				<?php echo $form->textField($model->profile,'fecha_fin',array('size'=>60,'maxlength'=>128)); ?>
				<?php echo $form->error($model->profile,'fecha_fin'); ?>
			</div>
			
			<div class="row">
				<?php echo $form->labelEx($model->profile,'fecha_pago'); ?>
				<?php echo $form->textField($model->profile,'fecha_pago',array('size'=>60,'maxlength'=>128)); ?>
				<?php echo $form->error($model->profile,'fecha_pago'); ?>
			</div>
			
		</div> 
		<!-- Inicio contacto -->
		<div id="row">
	    	<?php $this->renderPartial('/layouts/_contacto',array('contacto' => $model->contacto) );?>
		</div>
	
	<?php endif;?>
	<div class="row buttons">
			<?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save')); ?>
		</div>
	
	<?php $this->endWidget(); ?>	
	

