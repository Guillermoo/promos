<?php if(YII_RUTAS == true) echo __FILE__; ?>
<?php if (UserModule::isAdmin()): ?>
    <?php $action = 'edit/'+$empresa->id; ?>
<?php else:?>
    <?php $action = 'empresa'; ?>
<?php endif;?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'empresa-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
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
    <?php /*if (UserModule::isCompany()): ?>
    	<?php
			$this->widget('xupload.XUpload', array(
				'url' => Yii::app()->createUrl("empresa/upload", array("parent_id" => 1)),
				'model' => $image,
				'attribute' => 'file',
				'multiple' => false,
			));
		?>

	<?php else:?>

	<?php endif;*/?>
	<?php //$this->debug($image);?>
	<div class="row">
        <?php echo $form->labelEx($image,'photos'); ?>
        <?php if (!isset($image) || (!isset($empresa->usuario->item))): ?>
        	<?php
		        $this->widget( 'xupload.XUpload', array(
		            'url' => Yii::app( )->createUrl( "user/item/upload"),
		            //our XUploadForm
		            'model' => $image,
		            //We set this for the widget to be able to target our own form
		            'htmlOptions' => array('id'=>'empresa-form'),
		            'attribute' => 'file',
		            'multiple' => false,
		            //Note that we are using a custom view for our widget
		            //Thats becase the default widget includes the 'form' 
		            //which we don't want here
		            'formView' => 'application.views.item._form',
		            )    
		        );
		        ?>
    	<?php else: ?>
    	<?php $this->debug($empresa->usuario->item); ?>
    		<?php //echo CHtml::image(Yii::app()->request->baseUrl.$empresa->usuario->item->path,"image",array("width"=>300)); ?>
    		<button class="btn btn-danger">
                    <i class="icon-trash icon-white"></i>
                    <?php //echo CHtml::ajaxLink('Delete', array('empresa/deleteItem','id'=>$empresa->usuario->item->id),
                    //array('update' => '#logo_form'))?>
            </button>
            <?php //echo CHtml::ajaxLink('Delete', array('empresa/deleteItem','id'=>$empresa->usuario->item->id),array('update' => '#logo_form'))?>
    	<?php  endif;?>
        
    </div>
    
    
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

