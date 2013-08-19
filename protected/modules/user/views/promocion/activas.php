<?php 
/*$dataProvider=new CActiveDataProvider('Promocion', array(
    'criteria'=>array(
        'condition'=>'estado=1',       
    )
));*/

$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 

/*$dataProvider=new CActiveDataProvider('Promocion', array(
    'criteria'=>array(
        'condition'=>'estado=1',       
    )
));
$dataProvider->getData(); //will return a list of Post objects*/

?>