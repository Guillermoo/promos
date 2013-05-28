<?php
	$this->widget('xupload.XUpload', array(
                    //'url' => Yii::app()->createUrl("site/upload"),
                    'url' => Yii::app()->createUrl("item/upload"),
                    'model' => $model,
                    'attribute' => 'file',
                    'multiple' => false,
	));
?>