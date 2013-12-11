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
            <?php echo $form->dropDownListRow($model, 'estado', Promocion::itemAlias("PromoStatus"),array('options'=>array(Promocion::STATUS_ACTIVA=>array('selected'=>'selected')))); ?>
            <?php echo $form->error($model,'estado'); ?>
        </div>
    <?//endif;?>

    <div class="row">
            <?php echo $form->labelEx($model,'titulo'); ?>
            <?php echo $form->textField($model,'titulo',array('size'=>60,'maxlength'=>100)); ?>
            <?php echo $form->error($model,'titulo'); ?>
    </div>

    <? if (UserModule::isCompany()):?>
      <?/* <!-- <div class="row">
                <div id="logo_form">
                    <?php /*echo $form->labelEx($model,'logo'); ?>

                    <?php if (isset($item)):?><?//Si tiene una imagen cargada ?>
                        <?php $imghtml=CHtml::image(Yii::app( )->getBaseUrl( ).$item->path);?>
                        <?php echo CHtml::link($imghtml);?>
                        <?php //$this->renderPartial('../layouts/_viewitem', array(
                                //'imghtml' => $imghtml,'idimage'=>$model->usuario->item->id,'muestraBorrar'=>UserModule::isCompany(Yii::app()->user->id)));?><?php //El admin no puede borrar la imagen, o si??>
                        <button class="btn btn-danger" data-type="POST" data-url=promocion/deleteItem?id=<?=$item->id ?> >
                            <i class="icon-trash icon-white"></i>
                            <span>Delete</span>
                        </button>
                    <?php else:?><?//Si no la tiene se muestra el form para cargar imágenes?>
                        <?php $item = new Item();?>
                        <?php echo $form->fileFieldRow($item, 'filename'); ?>
                    <?php endif;?>
                     
                </div>
        </div>*/?>
        <div class="row">
            <?php //(G)Cargamos el cargador de imágenes ?>
            <?php if (!isset($image) || (!isset($model->item)) || (isset($item->path))): ?>
                <?php //dsfh;?>
                <?php echo $form->labelEx($item,'Fotos'); ?>
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
                <?php echo CHtml::image(Yii::app()->request->baseUrl.$model->item->path,"image",array("width"=>350)); ?>
                <button class="btn btn-danger">
                        <i class="icon-trash icon-white"></i>
                        <?php echo CHtml::ajaxLink('Delete', array(Yii::app()->request->baseUrl.'/user/item/delete','id'=>$model->item->id),
                        array('update' => '#logo_form'))?>
                </button>
                <?php echo CHtml::ajaxLink('Delete', array(
                    'empresa/deleteItem',
                    'id'=>$model->item->id),
                    array('update' => '#logo_form'))?>
                
            <?php  endif;?>
            </div>
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
                array('hint'=>'Pincha para seleccionar la fecha',
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
                        //'debug'=>true,
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
    <div class="row">
        <?php echo $form->labelEx($model,'categorias_id'); ?>

          <?php //echo $form->dropDownListRow($categorias, 'categorias_id', Categoria::itemAlias("PromoStatus"),array('options'=>array(Promocion::STATUS_BORRADOR=>array('selected'=>'selected')))); 
         echo $form->dropDownList($model,'categorias_id',CHtml::listData(Categoria::model()->findAll(), 'id', 'nombre'));
          ?>

         <?php echo $form->error($model,'categorias_id'); ?>
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