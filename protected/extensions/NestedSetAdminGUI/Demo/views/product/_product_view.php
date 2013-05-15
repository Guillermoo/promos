<div class="view">

    <div >
    <h2><?php echo CHtml::encode($data->title); ?></h2>	
	

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('/product/view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />

</div>
        <div style="float:right;width: 60px;">
            <?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl.'/css/images/icons/properties.png','Update'),
                                        array('/category/returnProductProperties'), array('id'=>$data->id,'class'=>'product_properties') ); ?>

	<?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl.'/css/images/icons/pencil.png','Update'),
                                        array('/category/returnProductForm'), array('id'=>$data->id,'class'=>'update_product') ); ?>
	

	<?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl.'/css/images/icons/cross.png','Delete'), '#',
                                             array('id'=>$data->id,'class'=>'delete_product','rel'=>$data->title) ); ?>
	<br />
        </div>

    <div class="clearfix"></div>
</div>

