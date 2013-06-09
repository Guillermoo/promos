<?php echo __FILE__; ?>

<?php  //$this->debug($model)  ?>
<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>'horizontal',
)); ?>
 
 <?php //$this->debug($model->empresa->empCat[0]->categoria->attributes)?>
<?php //echo $form->radioButtonList($misCat, 'id', CHtml::listData(Category::model()->findAll(), 'id', 'name')); ?>
<?php echo $form->checkBoxList($misCat,'categoria_id',$categorias) ?>
<?php 
  // Calls getOrderDisclaimers in Order Model
  /*echo $form->checkBoxList($misCat,'orderDisclaimers',     
    CHtml::listData(Categoria::model()->findAll(), 'id', 'name'), 
    array('separator'=>'','template'=>'<tr><td>{input}</td><td>{label}</td></tr>'
  ) );*/
  ?>
    <?php /*foreach ($misCat as $miCat):?>
	<b><?php echo $miCat->name;?></b><br>
<?php endforeach;*/?>
<?php $this->endWidget(); ?>
