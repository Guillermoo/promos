    <div id='profile-update-modal' class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
   
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3>Update #<?php echo $model->user_id; ?></h3>
    </div>
    
    <div class="modal-body">
 
    
    
    <div class="form">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'profile-update-form',
	'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
        'method'=>'post',
        'action'=>array("profile/update"),
	'type'=>'horizontal',
	'htmlOptions'=>array(
                               'onsubmit'=>"return false;",/* Disable normal form submit */
                               'onkeypress'=>" if(event.keyCode == 13){ update(); } " /* Do ajax call when user presses enter key */
                            ),               
	
)); ?>
     	<fieldset>
		<legend>
			<p class="note">Fields with <span class="required">*</span> are required.</p>
		</legend>

	<?php echo $form->errorSummary($model,'Opps!!!', null,array('class'=>'alert alert-error span12')); ?>
        		
   <div class="control-group">		
			<div class="span4">
			
			<?php echo $form->hiddenField($model,'user_id',array()); ?>
			
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
			//'id'=>'sub2',
			'type'=>'primary',
                        'icon'=>'ok white', 
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
			'htmlOptions'=>array('onclick'=>'update();'),
		));
		
		?>
             
	</div> 
   </div><!--end modal footer-->	
</fieldset>

<?php $this->endWidget(); ?>

</div>


</div><!--end modal-->



