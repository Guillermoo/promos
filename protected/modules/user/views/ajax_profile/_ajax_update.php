<div id="profile-update-modal-container" >

</div>

<script type="text/javascript">
function update()
 {
  
   var data=$("#profile-update-form").serialize();

  $.ajax({
   type: 'POST',
    url: '<?php echo Yii::app()->createAbsoluteUrl("profile/update"); ?>',
   data:data,
success:function(data){
                if(data!="false")
                 {
                  $('#profile-update-modal').modal('hide');
                  renderView(data);
                  $.fn.yiiGridView.update('profile-grid', {
                     
                         });
                 }
                 
              },
   error: function(data) { // if error occured
          alert(JSON.stringify(data)); 

    },

  dataType:'html'
  });

}

function renderUpdateForm(id)
{
 
   $('#profile-view-modal').modal('hide');
 var data="id="+id;

  $.ajax({
   type: 'POST',
    url: '<?php echo Yii::app()->createAbsoluteUrl("profile/update"); ?>',
   data:data,
success:function(data){
                 // alert("succes:"+data); 
                 $('#profile-update-modal-container').html(data); 
                 $('#profile-update-modal').modal('show');
              },
   error: function(data) { // if error occured
           alert(JSON.stringify(data)); 
         alert("Error occured.please try again");
    },

  dataType:'html'
  });

}
</script>
