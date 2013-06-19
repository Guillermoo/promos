
    <div id='profile-create-modal' class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3>Create Ajaxtest</h3>
    </div>
    
    <div class="modal-body">
    
    <div class="form">

   <?php
   
         $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'profile-create-form',
	'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
        'method'=>'post',
        'action'=>array("profile/create"),
	'type'=>'horizontal',
	'htmlOptions'=>array(
	                        'onsubmit'=>"return false;",/* Disable normal form submit */
                            ),
          'clientOptions'=>array(
                    'validateOnType'=>true,
                    'validateOnSubmit'=>true,
                    'afterValidate'=>'js:function(form, data, hasError) {
                                     if (!hasError)
                                        {    
                                          create();
                                        }
                                     }'
                                    

            ),                  
  
)); ?>
     	<fieldset>
		<legend>
			<p class="note">Fields with <span class="required">*</span> are required.</p>
		</legend>

	<?php echo $form->errorSummary($model,'Opps!!!', null,array('class'=>'alert alert-error span12')); ?>
        		
   <div class="control-group">		
			<div class="span4">
			
							  <div class="row">
					  <?php echo $form->labelEx($model,'username'); ?>
					  <?php echo $form->textField($model,'username',array('size'=>50,'maxlength'=>50)); ?>
					  <?php echo $form->error($model,'username'); ?>
				  </div>

			  				  <div class="row">
					  <?php echo $form->labelEx($model,'lastname'); ?>
					  <?php echo $form->textField($model,'lastname',array('size'=>50,'maxlength'=>50)); ?>
					  <?php echo $form->error($model,'lastname'); ?>
				  </div>

			  				  <div class="row">
					  <?php echo $form->labelEx($model,'contacto_id'); ?>
					  <?php echo $form->textField($model,'contacto_id'); ?>
					  <?php echo $form->error($model,'contacto_id'); ?>
				  </div>

			  				  <div class="row">
					  <?php echo $form->labelEx($model,'paypal_id'); ?>
					  <?php echo $form->textField($model,'paypal_id',array('size'=>40,'maxlength'=>40)); ?>
					  <?php echo $form->error($model,'paypal_id'); ?>
				  </div>

			  				  <div class="row">
					  <?php echo $form->labelEx($model,'tipocuenta'); ?>
					  <?php echo $form->textField($model,'tipocuenta',array('size'=>11,'maxlength'=>11)); ?>
					  <?php echo $form->error($model,'tipocuenta'); ?>
				  </div>

			  				  <div class="row">
					  <?php echo $form->labelEx($model,'fecha_creacion'); ?>
					  <?php echo $form->textField($model,'fecha_creacion'); ?>
					  <?php echo $form->error($model,'fecha_creacion'); ?>
				  </div>

			  				  <div class="row">
					  <?php echo $form->labelEx($model,'fecha_fin'); ?>
					  <?php echo $form->textField($model,'fecha_fin'); ?>
					  <?php echo $form->error($model,'fecha_fin'); ?>
				  </div>

			  				  <div class="row">
					  <?php echo $form->labelEx($model,'fecha_pago'); ?>
					  <?php echo $form->textField($model,'fecha_pago'); ?>
					  <?php echo $form->error($model,'fecha_pago'); ?>
				  </div>

			  
                        </div>   
  </div>

  </div><!--end modal body-->
  
  <div class="modal-footer">
	<div class="form-actions">

		<?php
		
		 $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
                        'icon'=>'ok white', 
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
			)
			
		);
		
		?>
              <?php
 $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'reset',
                        'icon'=>'remove',  
			'label'=>'Reset',
		)); ?>
	</div> 
   </div><!--end modal footer-->	
</fieldset>

<?php
 $this->endWidget(); ?>

</div>

</div><!--end modal-->

<script type="text/javascript">
function create()
 {
 
   var data=$("#profile-create-form").serialize();
     


  $.ajax({
   type: 'POST',
    url: '<?php
 echo Yii::app()->createAbsoluteUrl("profile/create"); ?>',
   data:data,
success:function(data){
                //alert("succes:"+data); 
                if(data!="false")
                 {
                  $('#profile-create-modal').modal('hide');
                  renderView(data);
                    $.fn.yiiGridView.update('profile-grid', {
                     
                         });
                   
                 }
                 
              },
   error: function(data) { // if error occured
         alert("Error occured.please try again");
         alert(data);
    },

  dataType:'html'
  });

}

function renderCreateForm()
{
  $('#profile-create-form').each (function(){
  this.reset();
   });

  
  $('#profile-view-modal').modal('hide');
  
  $('#profile-create-modal').modal({
   show:true,
   
  });
}

</script>
