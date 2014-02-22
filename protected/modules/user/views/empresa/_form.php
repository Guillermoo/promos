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
    
        <p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>
        <p>&nbsp;</p>
	<?php //Sólo la compañía tiene reglas de validación ?>
	<?php if (!UserModule::isCompany(Yii::app()->user->id) ):?>
		<?php echo $form->errorSummary(array($empresa)); ?>
	<?php endif;?>

	<div class="row">
        <?php echo $form->labelEx($image,'Imagen corporativa'); ?>
        <div id="logo_form">
        <?php if (!isset($image) || $image->name==null /*|| (!isset($empresa->usuario->item))*/): ?>
        	<?php
        		 Yii::app()->user->setState('model', 'empresa');
        		 Yii::app()->user->setState('foreign_id',$empresa->id);
        		//$image['foreign_id'] = Yii::app()->user->id;
		        $this->widget( 'xupload.XUpload', array(
		            'url' => Yii::app( )->createUrl( "user/item/upload"),
		            //our XUploadForm
		            'model' => $image,
		            //We set this for the widget to be able to target our own form
		            'htmlOptions' => array('id'=>'logo_form'),
		            'attribute' => 'file',
		            'multiple' => false,
		            //Note that we are using a custom view for our widget
		            //Thats becase the default widget includes the 'form' 
		            //which we don't want here
		            //'formView' => 'application.views.item._form',
		            'formView' => 'user.views.item._form',
		            )    
		        );
		        ?>
    	<?php else: ?>
    		<?php echo CHtml::image(Yii::app()->getBaseUrl().$image->path,"image",array("width"=>350)); ?>
            <button class="btn btn-danger">
                    <i class="icon-trash icon-white"></i>
                    <?php echo CHtml::ajaxLink('Eliminar', array(Yii::app()->getBaseUrl().'/user/item/delete','id'=>$image->id),
                    array('update' => '#logo_form'))?>
            </button>            
	    	<?php  endif;?>
        </div>
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
		<?php echo $form->labelEx($empresa,'Página web'); ?>
		<?php echo $form->textField($empresa,'web',array('size'=>60,'maxlength'=>100,'placeholder'=>'www.paginademiempresa.com')); ?>
		<?php echo $form->error($empresa,'web'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($empresa,'Twitter'); ?>
		<?php echo $form->textField($empresa,'twitter',array('size'=>60,'maxlength'=>100,'placeholder'=>'http://www.twitter.com/twitterdemiempresa')); ?>
		<?php echo $form->error($empresa,'twitter'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($empresa,'Facebook'); ?>
		<?php echo $form->textField($empresa,'facebook',array('size'=>60,'maxlength'=>100,'placeholder'=>'http://www.facebook.com/facebookdemiempresa')); ?>
		<?php echo $form->error($empresa,'facebook'); ?>
	</div>	
	<?php if(UserModule::isAdmin()): ?>
		<div class="clearfix">&nbsp;</div>
		<div class="row well">
			<p>Si los datos de la empresa son correctos y se verifica que es una empresa real hay que marcar la casilla de verificado, para que pueda publicar las promociones</p>
			<?php echo $form->labelEx($empresa,'verificado'); ?>
			<?php echo $form->checkBox($empresa,'verificado'); ?>
			<?php echo $form->error($empresa,'facebook'); ?>
		</div>
	<?php endif; ?>
	<div class="clearfix">&nbsp;</div>
	<div class="row">
		<?php echo CHtml::submitButton('Guardar cambios',array('class'=>'btn btn-success btn-large')); ?>
		<?php //Se poddría desabilitar el botón por ajax si las validaciones no se cumplen
		//poniendo algo como ,array('disabled'=>true) en el submitButton?>
	</div>
</fieldset>

<?php $this->endWidget(); ?>

