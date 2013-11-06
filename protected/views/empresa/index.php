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
?>
<h3> Puedes ver todas las promociones de una empresa.</h3>
<div class="row-fluid">
	<div class="span12">

		<table class="table table-striped">
		<tr>
			<th>Empresa</th>
		</tr>
		<?php $this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'_verresumen',
		)); ?>
		</table>
	</div>
</div>

