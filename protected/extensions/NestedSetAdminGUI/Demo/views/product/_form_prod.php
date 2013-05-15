<div id="product_form_con" class="client-val-form">
<!--<div  id="ajaxstatus" class="hide"  ></div>-->

<?php if( $model->isNewRecord) :?>
<h3 id="create_header">Create New Product For Category 
    <span style="color:#4079C8"><?php echo $prod_cat->name;?> </span></h3>

  <?php elseif (!$model->isNewRecord): ?>
 <h3 id="update_header">Update Product <span style="color:#4079C8"><?php echo $model->title ?></span></h3>
 <?php endif; ?>

<div   id="success-product" class="notification success png_bg" style="display:none;">
				<a href="#" class="close"><img src="<?php echo Yii::app()->request->baseUrl.'/css/images/icons/cross_grey_small.png'; ?>"
                                                                title="Close this notification" alt="close" /></a>
                        


			</div>

<div  id="error-product" class="notification errorshow png_bg" style="display:none;">
				<a href="#" class="close"><img src="<?php echo Yii::app()->request->baseUrl.'/css/images/icons/cross_grey_small.png'; ?>"
                                                                title="Close this notification" alt="close" /></a>
				
			</div>
<div class="form">
<?php

$formId='product-form';
$ajaxUrl=($model->isNewRecord)?
              CController::createUrl('product/create'):
               CController::createUrl('product/update');
$val_error_msg='Error.Product was not saved.';
$val_success_message=($model->isNewRecord)?
                                       'Product was created successfuly.':
                                        'Product was updated successfuly.';


$success='function(data){ 
    var response= jQuery.parseJSON (data);
     
    if (response.success ==true)
    {
      
         $("#success-product")
        .fadeOut(1000, "linear",function(){
                                                             $(this)                                                           
                                                            .append("<div> '.$val_success_message.'</div>")
                                                            .fadeIn(2000, "linear")
                                                            }
                       );
        $("#product-form").slideToggle(1500);'.
        $updatesuccess.
    '}
         else { 
                   $("#error-product")
                   .hide()
                    .show()
                    .css({"opacity": 1 })
                   .append("<div>"+response.message+"</div>").fadeIn(2000);
           
            

                  }
                     }//function';

$js_afterValidate="js:function(form,data,hasError) {


        if (!hasError) {                         //if there is no error submit with  ajax
        jQuery.ajax({'type':'POST',
                              'url':'$ajaxUrl',
                         'cache':false,
                         'data':$(\"#$formId\").serialize(),
                         'success':$success
                           });
                         return false; //cancel submission with regular post request,ajax submission performed above.
    } //if has not error submit via ajax

else{                                                //if there is validation error don't send anything
//$(\"#ajaxstatus\").hide()
                          //.addClass(\"flash-error\")
                         // .html('$val_error_msg').fadeIn(2000);
                     //   $(\"#comment-form\").each (function(){this.reset(); });
                      //    $(\"#comment-form_es_\").hide().fadeIn(2000);
                          return false;  //cancel submission with regular post request,validation has errors.
}
}";


$form=$this->beginWidget('CActiveForm', array(
     'id'=>'product-form',
    
  // 'enableAjaxValidation'=>true,
     'enableClientValidation'=>true,
     'focus'=>array($model,'name'),
     'errorMessageCssClass' => 'input-notification-error  error-simple png_bg',
     'clientOptions'=>array('validateOnSubmit'=>true,
                                        'validateOnType'=>false,
                                     //   'validationUrl'=>
                                        'afterValidate'=>$js_afterValidate,
                                        'errorCssClass' => 'err',
                                        'successCssClass' => 'suc',
                                        'afterValidateAttribute' => 'js:function(form, attribute, data, hasError){
                                                   if(!hasError){
                                                                    $("#success-"+attribute.id).fadeIn(500);
                                                                   $("label[for=\'Product_"+attribute.name+"\']").removeClass("error");
                                                                      }else {
                                                                                  $("label[for=\'Product_"+attribute.name+"\']").addClass("error");
                                                                                   $("#success-"+attribute.id).fadeOut(500);
                                                                                   }

                                                                                                                            }'
                                                                             ),
)); ?>
    <?php echo $form->errorSummary($model, '<div style="font-weight:bold">Please correct these errors:</div>', NULL, array('class' => 'errorsum notification errorshow png_bg')); ?>
<?php //echo $form->errorSummary($model); ?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

         <div class="row" >
  <?php echo $form->labelEx($model,'title'); ?><br>
  <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>128)) ?>
       <span  id="success-Product_title"  class="hid input-notification-success  success png_bg"></span>
    <div><small><?php echo 'Product Title'; ?></small> </div>
    <?php echo $form->error($model,'title'); ?>
    </div>

	  <div class="row" >
  <?php echo $form->labelEx($model,'description'); ?>
  <?php echo $form->textArea($model,'description',array('size'=>60,'maxlength'=>128)); ?>
       <span  id="success-Product_description"  class="hid input-notification-success  success png_bg"></span>
    <div><small><?php echo 'Product Description'; ?></small> </div>
    <?php echo $form->error($model,'description'); ?>
    </div>


         <div class="row" >
  <?php echo $form->labelEx($model,'price'); ?><br>
  <?php echo $form->textField($model,'price',array('size'=>30,'maxlength'=>20,'size'=>30,'style'=>'width:20%;')); ?>
       <span  id="success-Product_price"  class="hid input-notification-success  success png_bg"></span>
    <div><small><?php echo 'Product Price'; ?></small> </div>
    <?php echo $form->error($model,'price'); ?>
    </div>

 <input type="hidden" name= "YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken ?>"  />
        <div class="row" >
  <?php echo $form->hiddenField($model,'category_id',array('value'=>$prod_cat->id)) ?>
          </div>
<?php if( !$model->isNewRecord) :?>
         <div class="row" >
  <?php echo $form->hiddenField($model,'product_id',array('value'=>$_POST['product_id'])) ?>
          </div>
 <?php endif;?>

    
	<div class="row buttons">
		<?php    
       echo  CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Save',array('class' => 'button align-right'));
                ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->

</div>


<script  type="text/javascript">
    
 //Close button:

		$(".close").click(
			function () {
				$(this).parent().fadeTo(400, 0, function () { // Links with the class "close" will close parent
					$(this).slideUp(600);
				});
				return false;
			}
		);


</script>