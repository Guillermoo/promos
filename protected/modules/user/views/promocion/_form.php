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
    <p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>

    <?php echo $form->errorSummary($model); ?>

    <!--    
    $maxPromos: número máximo de promociones que permite el tipo de cuenta que tiene el usuario 
    
    $maxActivas: máximas promos activas que permite la cuenta
    
    $maxStock: máximas promos en stock que permite la cuenta
    
    $promoStock: número de promociones en stock que tiene el usuario
    
    $promoActivas: número de promociones activas que tiene el usuario
     -->


    <? if ($model->isNewRecord):?>
    <div class="row">      
        <?php if($promoActivas == $maxActivas): ?>    
            <?php echo $form->dropDownListRow($model, 'estado', Promocion::itemAlias("PromoStatus"),array('options'=>array(Promocion::STATUS_ACTIVA=>array('disabled'=>'disabled')))); ?>            
        <?php else: ?>
            <?php echo $form->dropDownListRow($model, 'estado', Promocion::itemAlias("PromoStatus"),array('options'=>array(Promocion::STATUS_ACTIVA=>array('selected'=>'selected')))); ?>
        <?php endif; ?>
        <?php echo $form->error($model,'estado'); ?>
    </div>
    <?php else: ?>
    <div class="row">      
        <?php if($promoActivas == $maxActivas && $model->estado == 0): ?> 
            <div class="alert alert-warning">Has alcanzado el límite de promociones ACTIVAS</div>   
            <?php echo $form->dropDownListRow($model, 'estado', Promocion::itemAlias("PromoStatus"),array('options'=>array(Promocion::STATUS_ACTIVA=>array('disabled'=>'disabled')))); ?>            
        <?php else: ?>
            <?php echo $form->dropDownListRow($model, 'estado', Promocion::itemAlias("PromoStatus"),array('options'=>array(Promocion::STATUS_ACTIVA=>array('selected'=>'selected')))); ?>
        <?php endif; ?>
        <?php echo $form->error($model,'estado'); ?>
    </div>
    <?php endif; ?>
    <div class="row">
        <?php echo $form->labelEx($model,'destacada'); ?>
        <?php if($promosDest >= $maxDest):
                echo $form->checkbox($model, 'destacado',array('disabled'=>'disabled')); 
            else:
                echo $form->checkbox($model,'destacado');
            endif;
            ?>
        <?php echo $form->error($model,'destacado'); ?>
    </div>
    <?//endif;?>

     <div class="row">
           <br/><br/>
    </div>

    <div class="row well"><p><strong>Selecciona el tipo de promoción que quieres crear:</strong>
    <p>Una promoción de <strong>Pago por internet</strong> se ha de pagar antes de disfrutarla, por el método de pago que ofrece Proemoción.</p>
    <p>Una promoción de tipo <strong>Cupón</strong> permite que los usuarios registrados puedan descargarse un cupón, el cual deberán presentar en tu establecimiento para poder disfrutar de la promoción.</p>
     <div >             
        <?php echo $form->dropDownListRow($model, 'tipo', Promocion::itemAlias("Tipo")); ?>
        <?php echo $form->error($model,'tipo'); ?>
    </div>   
    </div>

    <div class="row">
            <?php echo $form->labelEx($model,'titulo'); ?>
            <?php echo $form->textField($model,'titulo',array('size'=>60,'maxlength'=>100)); ?>
            <?php echo $form->error($model,'titulo'); ?>
    </div>

    <? if (UserModule::isCompany()): ?>
      
        <div class="row">
            <?php if(!$model->isNewRecord): ?>
                <?php //(G)Cargamos el cargador de imágenes ?>

                <?php if (!isset($image) || $image->name==null): ?>
                    <p>Elige una imagen para la promoción:</p>
                    <div id="logo_form">
                        <?php
                            Yii::app()->user->setState('model', 'promo');
                            Yii::app()->user->setState('foreign_id',$model->id );
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
                    <?php echo CHtml::ajaxLink('Delete', array(
                        'empresa/deleteItem',
                        'id'=>$image->id),
                        array('update' => '#logo_form'))?>
                    
                <?php  endif;?>
                    </div>
            <?php else: ?>
                <div class="alert alert-info">Podrás poner una <strong>imagen para la promoción</strong> cuando ya tengas la promoción creada. Para ello, después de rellenar los datos y guardar la promoción, pincha en el botón de editar la promoción (icono de lápiz: &nbsp;<span class="icon icon-pencil">&nbsp;</span>) en el administrador de promociones</div>
            <?php  endif;?>
        </div>
    <?php endif; ?>

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
         <?php echo $form->html5EditorRow($model, 'descripcion_html', array('class'=>'span4', 'rows'=>5, 'height'=>'200', 'options'=>array('color'=>true,'image'=>false,'link'=>false))); ?>
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
                array('hint'=>'Haz click para seleccionar la fecha.',
                    'prepend'=>'<i class="icon-calendar"></i>',
                    'options'=>array('format'=>'yyyy-mm-dd'))); ?>
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
            <?php if($model->isNewRecord): ?>
            <?php echo $form->datepickerRow($model, 'fecha_fin',
                 array('hint'=>'Haz click para seleccionar la fecha.',
                    'prepend'=>'<i class="icon-calendar"></i>',
                    'options'=>array('format'=>'yyyy-mm-dd'))); ?>
            <?php else: ?>
            
                <?php echo $form->labelEx($model,'fecha_fin'); ?>
                <?php echo $form->textField($model,'fecha_fin',array('disabled' => true)); ?>
            <?php endif; ?>
            <?php echo $form->error($model,'fecha_fin'); ?>
    </div>

    <? if(UserModule::isAdmin()): ?>
        <div class="row">
                <?php echo $form->labelEx($model,'fechaCreacion'); ?>
                <?php echo $form->datepickerRow($model, 'fechaCreacion',
                array('hint'=>'Haz click para seleccionar la fecha.','prepend'=>'<i class="icon-calendar"></i>','options'=>array('format'=>'yyyy-mm-dd'))); ?>
                <?php echo $form->error($model,'fechaCreacion'); ?>
        </div>
    <?endif;?>

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
    <div class="row">
        <?php echo $form->labelEx($model,'categoria'); ?>

          <?php 
          //echo $form->dropDownListRow($categorias, 'categorias_id', Categoria::itemAlias("PromoStatus"),array('options'=>array(Promocion::STATUS_BORRADOR=>array('selected'=>'selected')))); 
         echo $form->dropDownList($model,'categorias_id',CHtml::listData(Categoria::model()->findAll(), 'id', 'nombre'));
          ?>

         <?php echo $form->error($model,'categorias_id'); ?>
    </div>
    <div class="row buttons">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar',array('class'=>'btn btn-success btn-large')); ?>
    </div>
</fieldset>
<?php $this->endWidget(); ?>
<script>
jQuery.noConflict();
</script>
<!--</div> form -->