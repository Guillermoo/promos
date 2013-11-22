<?php
/* @var $this EmpresaController */
/* @var $dataProvider CActiveDataProvider */

/*$this->breadcrumbs=array(
	'Empresas',
);*/

/*$this->menu=array(
	array('label'=>'Create Empresa', 'url'=>array('create')),
	array('label'=>'Manage Empresa', 'url'=>array('admin')),
);*/
?><?php $this->debug($dataProvider); ?>
<div class="row-fluid">
		<div class="span12">
			<ul class="thumbnails product-list-inline-small">
		<?php $this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'_verresumen',
		)); ?>
			</ul>
		</div>
</div>

