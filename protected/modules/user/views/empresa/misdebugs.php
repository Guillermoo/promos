<?php echo __FILE__; ?>

<?php  //$this->debug($model)  ?>
<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>'horizontal',
)); ?>
 
 <?php //$this->debug($listCat)?>
 <?php //$this->debug($categorias)?>
 <?php $this->debug($misCat[0]->attributes)?>
<?php //echo $form->checkBoxListInlineRow($misCat, 'id', $categorias); ?>
<?php //echo $form->checkBoxListRow($misCat, 'id', $categorias, array('hint'=>'<strong>Note:</strong> Labels surround all the options for much larger click areas.')); ?>
<?php foreach ($misCat as $miCat):?>
	<b><?php echo $miCat->name;?></b><br>
<?php endforeach;?>
<?php $this->endWidget(); ?>
