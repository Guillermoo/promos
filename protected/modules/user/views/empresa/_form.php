<?php echo __FILE__; ?>
<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Profile");?>
<h1><?php echo UserModule::t('Your company'); ?></h1>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'empresa-form',
	'enableAjaxValidation'=>true,
	//'type'=>'horizontal',
	'action'=>'empresa/edit',
	'htmlOptions' => array('enctype'=>'multipart/form-data')
));
?>
		
<fieldset>

	<div class="row"><!-- Tipo de cuenta -->
		<?php //echo $form->labelEx($empresa,'logo_id'); ?>
	</div>
	<?php //echo $form->dropDownListRow($empresa->cuenta, 'id', $cuentas); ?>
	
	<?php if (Yii::app()->authManager->checkAccess('empresa', Yii::app()->user->id) ):?>
		<?php echo $form->errorSummary(array($model->empresa)); ?>
	<?php endif;?>
	<?php $this->widget('bootstrap.widgets.TbLabel', array(
	    'type'=>'info', // 'success', 'warning', 'important', 'info' or 'inverse'
	    'label'=>'Empresa',
	)); ?>
	
	<div class="row"><!-- HAy que mostrar las categorías a las que pertenece pero no dejar editar -->
		<!-- (G)De moment lo dejo así, ya se me ocurrirá algo mejor -->
		<?php echo $form->labelEx($model->empresa,'categoria_id'); ?>
		<?php echo "Categorías a las que pertenece: "?><br>
		<?php foreach ($model->empresa->categoria as $miCat):?>
			<b><?php echo $miCat->name;?></b><br>
		<?php endforeach;?>
		<?php //echo $form->dropDownListRow($empresa, 'contacto_id', $categorias, array('multiple'=>true)); ?>
		<?php //echo $form->checkBoxListRow($listCat, 'id', array($categorias), array('hint'=>'<strong>Note:</strong> Labels surround all the options for much larger click areas.')); ?>
		<?php //echo $form->error($empresa,'contacto_id'); ?>
	</div>
	<?php //$this->debug($model); ?>
	<div class="row">
		<?php if (isset($model->item)):?>
			<?php 
				$imghtml=CHtml::image(Yii::app( )->getBaseUrl( ).$model->item->path);
				echo CHtml::link($imghtml);?>
		<?php else:?>
            <?php
				$this->widget('xupload.XUpload', array(
                    'url' => Yii::app()->createUrl("/item/upload"),
                    'model' => $image,
                    'attribute' => 'file',
                    'htmlOptions' => array('id'=>'empresa-form'),
                    'multiple' => false,
					/*'url' => Yii::app( )->createUrl( "/item/upload"),
	                //our XUploadForm
	                'model' => $image,
	                //We set this for the widget to be able to target our own form
	                'htmlOptions' => array('id'=>'empresa-form'),
	                'attribute' => 'file',
	                'multiple' => false,*/
	                //Note that we are using a custom view for our widget
	                //Thats becase the default widget includes the 'form' 
	                //which we don't want here
	                //'formView' => 'application.views.somemodel._form',
				));
			?>
			<?php endif;?>
		<?php //echo $form->error($empresa,'logo_id'); ?>
	</div>

	<?php $empresa = $model->empresa;?>
	
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
    	<?php $this->renderPartial('/layouts/_contacto',array('form'=>$form,'contacto'=>$model->contacto) );?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Save'); ?>
	</div>
</fieldset>

<?php $this->endWidget(); ?>

