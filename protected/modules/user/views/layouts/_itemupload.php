<?php
	/*$this->widget('xupload.XUpload', array(
	'url' => Yii::app()->createUrl("/item/upload"),
	'model' => $image,
	'attribute' => 'file',
	'htmlOptions' => array('id'=>$idform),
	'multiple' => false,
	/*'url' => Yii::app( )->createUrl( "/item/upload"),
	//our XUploadForm
	'model' => $image,
	//We set this for the widget to be able to target our own form
	'htmlOptions' => array('id'=>'empresa-form'),
	'attribute' => 'file',
	'multiple' => false,*/
	//Note that we are using a custom view for our widget
	//Thats becase the default widget includes the 'form' 
	//which we don't want here
	//'formView' => 'application.views.somemodel._form',
	//));
?>

<?php 
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
);?>