<?php if(YII_RUTAS == true) echo __FILE__; ?>
<?php if (UserModule::isAdmin()): ?>
    <?php $action = 'edit/'+$empresa->id; ?>
<?php else:?>
    <?php $action = 'empresa'; ?>
<?php endif;?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'empresa-form',
	'enableAjaxValidation'=>true,
	//'type'=>'horizontal',
        'action'=>$action,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'htmlOptions' => array('enctype'=>'multipart/form-data')
));
?>

<fieldset>
    
        <p class="note">Fields with <span class="required">*</span> are required.</p>
        
	<?php //Sólo la compañía tiene reglas de validación ?>
	<?php if (!UserModule::isCompany(Yii::app()->user->id) ):?>
		<?php echo $form->errorSummary(array($empresa)); ?>
	<?php endif;?>
	
	<?php $this->widget('bootstrap.widgets.TbLabel', array(
	    'type'=>'info', // 'success', 'warning', 'important', 'info' or 'inverse'
	    'label'=>'Empresa',
	)); ?>
	
	<!-- <div class="row"><!-- HAy que mostrar las categorías a las que pertenece pero no dejar editar -->
		<!-- (G)De moment lo dejo así, ya se me ocurrirá algo mejor 
		<?php /*echo $form->labelEx($model->empresa->categoria,'categoria_id'); ?>
		<?php echo "Belonged categories: "?><br>
		<?php foreach ($model->empresa->categoria as $miCat):?>
			<b><?php echo $miCat->name;?></b><br>
		<?php endforeach;*/?>
		<?php //echo $form->dropDownListRow($empresa, 'contacto_id', $categorias, array('multiple'=>true)); ?>
		<?php //echo $form->checkBoxListRow($listCat, 'id', array($categorias), array('hint'=>'<strong>Note:</strong> Labels surround all the options for much larger click areas.')); ?>
		<?php //echo $form->error($empresa,'contacto_id'); ?>
	</div> -->
    <? if (UserModule::isCompany()):?>
        <div class="row">
                <div id="logo_form">
                    <?php echo $form->labelEx($empresa,'logo'); ?>
                    <? $item = $empresa->usuario->item  ?>
                    <?php if (isset($item)):?><?//Si tiene una imagen cargada ?>
                        <?php $imghtml=CHtml::image(Yii::app( )->getBaseUrl( ).$item->path);?>
                        <?php $this->renderPartial('../layouts/_viewitem', array(
                                'imghtml' => $imghtml,'idimage'=>$empresa->usuario->item->id,'muestraBorrar'=>UserModule::isCompany(Yii::app()->user->id)));?><?php //El admin no puede borrar la imagen, o si??>
                    <?php else:?>
                        <?php $this->renderPartial('../layouts/_itemupload', array(
                                'image' => $image,'idform'=>'empresa-form'));?>
                        <?php endif;?>
                </div>
        </div>
    <?php endif; ?>
    
	<div class="row">
		<?php echo $form->labelEx($empresa,'nombre'); ?>
		<?php echo $form->textField($empresa,'nombre',array('size'=>128,'maxlength'=>128)); ?>
		<?php echo $form->error($empresa,'nombre'); ?>
	</div>
	
	<!-- (G)El slug se hará automático o lo podrá elegir la empresa? -->
	<!-- <div class="row">
		<?php /*echo $form->labelEx($empresa,'nombre_slug'); ?>
		<?php echo $form->textField($empresa,'nombre_slug',array('size'=>128,'maxlength'=>128)); ?>
		<?php echo $form->error($empresa,'nombre_slug');*/ ?>
	</div> -->
	
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
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Save'); ?>
		<?php //Se poddría desabilitar el botón por ajax si las validaciones no se cumplen
		//poniendo algo como ,array('disabled'=>true) en el submitButton?>
	</div>
</fieldset>

<?php $this->endWidget(); ?>

