<?php echo __FILE__; ?>
<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Profile");
$this->breadcrumbs=array(
	UserModule::t("Profile")=>array('profile'),
	UserModule::t("Edit"),
);
/*$this->menu=array(
	((UserModule::isAdmin())
		?array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin'))
		:array()),
    array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
    array('label'=>UserModule::t('Profile'), 'url'=>array('/user/profile')),
    array('label'=>UserModule::t('Change password'), 'url'=>array('changepassword')),
    array('label'=>UserModule::t('Logout'), 'url'=>array('/user/logout')),
);*/
?><h1><?php echo UserModule::t('Edit profile'); ?></h1>

<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary(array($model)); ?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

	<?php //(G)Enterarse de que va la histoaria esta del errorSummary?>
	<?php echo $form->errorSummary(array($model)); ?>

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
		<div class="fields">
			<?php //if (isset($model->profile)):?>
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
			<?php //endif;?>
			</div>
			<div class="fields">
			<?php if (isset($model->contacto)):?>
			
				<div class="row">
					<?php echo $form->labelEx($model->contacto,'telefono'); ?>
					<?php echo $form->textField($model->contacto,'telefono',array('size'=>60,'maxlength'=>128,'integer'=>true)); ?>
					<?php echo $form->error($model->contacto,'telefono'); ?>
				</div>
				
				<div class="row">
					<?php echo $form->labelEx($model->contacto,'fax'); ?>
					<?php echo $form->textField($model->contacto,'fax',array('size'=>60,'maxlength'=>128,'integer'=>true)); ?>
					<?php echo $form->error($model->contacto,'fax'); ?>
				</div>
				
				<div class="row">
					<?php echo $form->labelEx($model->contacto,'cp'); ?>
					<?php echo $form->textField($model->contacto,'cp',array('size'=>60,'maxlength'=>128)); ?>
					<?php echo $form->error($model->contacto,'cp'); ?>
				</div>
				
				<div class="row">
					<?php echo $form->labelEx($model->contacto,'barrio'); ?>
					<?php echo $form->textField($model->contacto,'barrio',array('size'=>60,'maxlength'=>128)); ?>
					<?php echo $form->error($model->contacto,'barrio'); ?>
				</div>
				
				<div class="row">
					<?php echo $form->labelEx($model->contacto,'direccion'); ?>
					<?php echo $form->textField($model->contacto,'direccion',array('size'=>60,'maxlength'=>128)); ?>
					<?php echo $form->error($model->contacto,'direccion'); ?>
				</div>
			<?php endif;?>
		</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
