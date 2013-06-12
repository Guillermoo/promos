<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <div class="row">
        <?php echo $form->label($model,'empresa_id'); ?>
        <?php echo $form->textField($model,'empresa_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'nombre'); ?>
        <?php echo $form->textField($model,'nombre',array('size'=>20,'maxlength'=>20)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'cif'); ?>
        <?php echo $form->textField($model,'cif',array('size'=>60,'maxlength'=>128)); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton(UserModule::t('Search')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->