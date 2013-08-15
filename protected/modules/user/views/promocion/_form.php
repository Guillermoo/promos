<?php
/* @var $this PromocionesController */
/* @var $model Promociones */
/* @var $form CActiveForm */
?>

<!--<div class="form">-->
<? //Yii::import('ext.krichtexteditor.KRichTextEditor');?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'promociones-form',
	'enableAjaxValidation'=>true,
        //'action'=>'update/id/'.$model->id,
        'action'=>$model->isNewRecord ? 'create' : 'update/id/'.$model->id,
	'clientOptions'=>array(
            'validateOnSubmit'=>true,
	),
	'htmlOptions' => array('enctype'=>'multipart/form-data')
)); ?>

<fieldset>
    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <!-- Deberíamos controlar el SELECT para que no deje marcar el estado de la promoción si ya hemos llegado al límite. Es decir, si ya no podemos crear más promos activas, que la opción activa aparezca deshabilitada. 
    He pasado los siguientes parámetros a esta vista para poder controlar esto y otras cosas:
    $maxPromos: número máximo de promociones que permite el tipo de cuenta que tiene el usuario 

    $maxActivas: máximas promos activas que permite la cuenta

    $maxStock: máximas promos en stock que permite la cuenta
    
    $promoStock: número de promociones en stock que tiene el usuario

    $promoActivas: número de promociones activas que tiene el usuario

    Que desaparezca la opción de destacado si la promoción se marca como no-activa
     -->


    <? //if (!$model->isNewRecord):?>
        <div class="row">
                <?php //echo $form->labelEx($model,'estado'); ?>
                <?php //echo $form->textField($model,'estado'); ?>
                <?php echo $form->dropDownListRow($model, 'estado', Promocion::itemAlias("PromoStatus"),array('options'=>array(Promocion::STATUS_BORRADOR=>array('selected'=>'selected')))); ?>
                <?php echo $form->error($model,'estado'); ?>
        </div>
    <?//endif;?>

    <div class="row">
            <?php echo $form->labelEx($model,'titulo'); ?>
            <?php echo $form->textField($model,'titulo',array('size'=>60,'maxlength'=>100)); ?>
            <?php echo $form->error($model,'titulo'); ?>
    </div>

    <div class="row">
            <?php echo $form->textAreaRow($model, 'resumen', array('class'=>'span8', 'rows'=>5)); ?>
            <?php //echo $form->textField($model,'resumen',array('size'=>60,'maxlength'=>100)); ?>
            <?php echo $form->error($model,'resumen'); ?>
    </div>

    <div class="row">
        <?php //echo $form->labelEx($model,'descripcion_html'); ?>
        <?php //echo $form->textField($model,'descripcion_html',array('value'=>'Promoción descripcion <b>html</b>','size'=>60,'maxlength'=>1000)); ?>
        <?php
            /*$this->widget('KRichTextEditor', array(
                'model' => $model,
                'value' => $model->isNewRecord ? '' : $model->descripcion_html,
                'attribute' => 'descripcion_html',
                'options' => array(
                    'theme_advanced_resizing' => 'true',
                    'theme_advanced_statusbar_location' => 'bottom',
                ),
            ));*/?>
        
        <?php //echo $form->ckEditorRow($model, 'descripcion_html', array('options'=>array('fullpage'=>'js:true', 'width'=>'640', 'resize_maxWidth'=>'640','resize_minWidth'=>'320')));?>
         <?php echo $form->html5EditorRow($model, 'descripcion_html', array('class'=>'span4', 'rows'=>5, 'height'=>'200', 'options'=>array('color'=>true))); ?>
        <?php echo $form->error($model,'descripcion_html'); ?>
    </div>

    <div class="row">
            <?php //echo $form->labelEx($model,'fecha_inicio'); ?>
            <?php /*$this->widget('zii.widgets.jui.CJuiDatePicker',array(
                    'attribute'=>'fecha_inicio',
                    'model'=>$model,
                    'value'=>$model->fecha_inicio,
                    // additional javascript options for the date picker plugin
                    'options'=>array(
                        'dateFormat'=>'yy-mm-dd',
                        'showAnim'=>'fold',
                        'changeMonth'=>'true', 
                        'changeYear'=>'true',
                        //'debug'=>true,
                    ),
                ));*/?>
            <?php echo $form->datepickerRow($model, 'fecha_inicio',
                array('hint'=>'Click inside! This is a super cool date field.',
                'prepend'=>'<i class="icon-calendar"></i>')); ?>
            <?php echo $form->error($model,'fecha_inicio'); ?>
    </div>

    <div class="row">
            <?php //echo $form->labelEx($model,'fecha_fin'); ?>
            <?php /*$this->widget('zii.widgets.jui.CJuiDatePicker',array(
                'attribute'=>'fecha_fin',
                    'model'=>$model,
                    'value'=>$model->fecha_fin,
                // additional javascript options for the date picker plugin
                'options'=>array(
                    'dateFormat'=>'yy-mm-dd',
                    'showAnim'=>'fold',
                    'changeMonth'=>'true', 
                    'changeYear'=>'true',
                    //'debug'=>true,
                ),
            ));*/?>
            <?php echo $form->datepickerRow($model, 'fecha_fin',
                array('hint'=>'Click inside! This is a super cool date field.',
                'prepend'=>'<i class="icon-calendar"></i>')); ?>
            <?php echo $form->error($model,'fecha_fin'); ?>
    </div>

    <? if (UserModule::isAdmin()): ?>
        <div class="row">
                <?php echo $form->labelEx($model,'fechaCreacion'); ?>
                <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                    'attribute'=>'fechaCreacion',
                        'model'=>$model,
                        'value'=>$model->fechaCreacion,
                    // additional javascript options for the date picker plugin
                    'options'=>array(
                        'dateFormat'=>'yy-mm-dd',
                        'showAnim'=>'fold',
                        'changeMonth'=>'true', 
                        'changeYear'=>'true',
                        'debug'=>true,
                    ),
                ));?>
                <?php echo $form->error($model,'fechaCreacion'); ?>
        </div>
    <?endif;?>
    <div class="row">
            <?php echo $form->labelEx($model,'destacado'); ?>
            <?php echo $form->checkbox($model, 'destacado'); ?>
            <?php echo $form->error($model,'destacado'); ?>
    </div>

    <div class="row">
            <?php echo $form->textFieldRow($model, 'precio', array('prepend'=>'€')); ?>
            <?php echo $form->error($model,'precio'); ?>
    </div>

    <div class="row">
            <?php echo $form->labelEx($model,'rebaja'); ?>
            <?php echo $form->textField($model,'rebaja',array('size'=>45,'maxlength'=>45)); ?>
            <?php echo $form->error($model,'rebaja'); ?>
    </div>

    <div class="row">
            <?php echo $form->labelEx($model,'condiciones'); ?>
            <?php echo $form->textField($model,'condiciones',array('size'=>60,'maxlength'=>1000)); ?>
            <?php echo $form->error($model,'condiciones'); ?>
    </div>

    <div class="row">
            <?php echo $form->labelEx($model,'stock'); ?>
            <?php echo $form->textField($model,'stock'); ?>
            <?php echo $form->error($model,'stock'); ?>
    </div>    
    <div class="row buttons">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>
</fieldset>
<?php $this->endWidget(); ?>
<script>
jQuery.noConflict();
</script>
<!--</div> form -->