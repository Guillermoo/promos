<h1>Product <span style="color:#7473E1"> <?php echo $model->title; ?></span></h1><br>
          <h2>  in <span style="color:#7473E1"> <?php echo $cat->name; ?></span> </h2>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
           
		'id',
		'category_id',
		'title',
		'description',
		'price',
	),
)); ?>
