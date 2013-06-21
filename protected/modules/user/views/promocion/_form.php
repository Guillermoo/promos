<?php
/* @var $this PromocionesController */
/* @var $model Promociones */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'promociones-form',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
			'validateOnSubmit'=>true,
	),
	'htmlOptions' => array('enctype'=>'multipart/form-data')
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	

	<div class="row">
		<?php echo $form->labelEx($model,'estado'); ?>
		<?php //echo $form->textField($model,'estado'); ?>
		<?php //echo $form->textFieldRow($model, 'estado', array('disabled'=>false,'value'=>1)); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
		    'buttonType'=>'button',
		    'type'=>'primary',
		    'label'=>'Click me',
		    'loadingText'=>'loading...',
		    'htmlOptions'=>array('id'=>'buttonStateful'),
		)); ?>
		<?php echo $form->error($model,'estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'titulo'); ?>
		<?php echo $form->textField($model,'titulo',array('value'=>'Promoción titulo','size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'titulo'); ?>
	</div>

	<div class="row">
		<?php echo $form->textAreaRow($model, 'resumen', array('value'=>'Promoción resume','class'=>'span8', 'rows'=>5)); ?>
		<?php //echo $form->textField($model,'resumen',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'resumen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('value'=>'Promoción descripcion','size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'descripcion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'descripcion_html'); ?>
		<?php echo $form->textField($model,'descripcion_html',array('value'=>'Promoción descripcion <b>html</b>','size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'descripcion_html'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'fecha_inicio'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
				    'attribute'=>'fecha_inicio',
					'model'=>$model,
					'value'=>$model->fecha_inicio,
				    // additional javascript options for the date picker plugin
				    'options'=>array(
						'dateFormat'=>'yy-mm-dd',
				        'showAnim'=>'fold',
						'changeMonth'=>'true', 
    					'changeYear'=>'true',
				    	'debug'=>true,
				    ),
				));?>
		<?php echo $form->error($model,'fecha_inicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_fin'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
				    'attribute'=>'fecha_fin',
					'model'=>$model,
					'value'=>$model->fecha_fin,
				    // additional javascript options for the date picker plugin
				    'options'=>array(
						'dateFormat'=>'yy-mm-dd',
				        'showAnim'=>'fold',
						'changeMonth'=>'true', 
    					'changeYear'=>'true',
				    	'debug'=>true,
				    ),
				));?>
		<?php echo $form->error($model,'fecha_fin'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'destacado'); ?>
		<?php echo $form->checkbox($model, 'destacado',array('checked'=>1)); ?>
		<?php echo $form->error($model,'destacado'); ?>
	</div>

	<div class="row">
		<?php echo $form->textFieldRow($model, 'precio', array('value'=>100,'prepend'=>'€')); ?>
		<?php echo $form->error($model,'precio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rebaja'); ?>
		<?php echo $form->textField($model,'rebaja',array('value'=>10,'size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'rebaja'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'condiciones'); ?>
		<?php echo $form->textField($model,'condiciones',array('value'=>'Promoción condiciones','size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'condiciones'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'stock'); ?>
		<?php echo $form->textField($model,'stock',array('value'=>10)); ?>
		<?php echo $form->error($model,'stock'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->