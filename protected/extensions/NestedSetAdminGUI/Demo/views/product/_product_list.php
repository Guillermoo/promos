<div style="margin:12px">
<h1>Products In <span style="color:#4079C8"><?php echo  $cat->name; ?></span> (ID:<?php echo  $cat->id; ?>) </h1>
<?php
$this->widget('zii.widgets.CListView', array(
           'id'=>'product-listview',
	'dataProvider'=>$productDP,
       'itemView'=>'_product_view',
     'summaryText'=>Yii::t('admin','Displaying {start}-{end} of total {count} results.'),
     'pager'=>array(  'nextPageLabel' => Yii::t('pager','Next'),
                            'prevPageLabel' => Yii::t('pager','Previous'),
                            'firstPageLabel' =>Yii::t('pager', 'First'),
                            'lastPageLabel' => Yii::t('pager','Last'),
       ),
     //afterAjaxUpdate is needed for the buttons to work after a paging request from CListView
       'afterAjaxUpdate'=>'js:function(id,data){

//UPDATE BINDING
       $("a.update_product").bind("click", function() {
                $.ajax({
                    type: "POST",
                    url: "'.Yii::app()->baseUrl.'/product/returnProductForm/",
                    data:{"product_id": $(this).attr("id"),
                              "update":true,
                              "YII_CSRF_TOKEN":"'. Yii::app()->request->csrfToken.'"
                                                                        },
                     beforeSend : function(){
                                               $("#'.Categorydemo::ADMIN_TREE_CONTAINER_ID.'").addClass("ajax-sending");
                                                               },
                                complete : function(){
                                              $("#'.Categorydemo::ADMIN_TREE_CONTAINER_ID.'").removeClass("ajax-sending");
                                                             },


                    success: function(data){

                        $.fancybox(data,
                        {    "transitionIn"	:	"elastic",
                            "transitionOut"    :      "elastic",
                             "speedIn"		:	600,
                            "speedOut"		:	200,
                            "overlayShow"	:	false,
                            "hideOnContentClick": false,
                              "width": 480,
                              "height":600,
                              "autoDimensions":true
                             // "margin":0,
                              //"padding":0
                        }
                    );
                        //  console.log(data);
                    } //success
                });//ajax
                return false;
            });//bind

//VIEW PROPERTIES  BINDING
       $("a.product_properties").bind("click", function() {
                $.ajax({
                    type: "POST",
                    url: "'.Yii::app()->baseUrl.'/product/returnProductProperties/",
                    data:{"id": $(this).attr("id"),
                              "YII_CSRF_TOKEN":"'.Yii::app()->request->csrfToken.'"
                                                                        },
                     beforeSend : function(){
                                               $("#'. Categorydemo::ADMIN_TREE_CONTAINER_ID.'").addClass("ajax-sending");
                                                               },
                                complete : function(){
                                              $("#'.Categorydemo::ADMIN_TREE_CONTAINER_ID.'").removeClass("ajax-sending");
                                                             },


                    success: function(data){

                        $.fancybox(data,
                        {    "transitionIn"	:	"elastic",
                            "transitionOut"    :      "elastic",
                             "speedIn"		:	600,
                            "speedOut"		:	200,
                            "overlayShow"	:	false,
                            "hideOnContentClick": false,
                              "width": 480,
                              "height":600,
                              "autoDimensions":true
                             // "margin":0,
                              //"padding":0
                        }
                    );
                        //  console.log(data);
                    } //success
                });//ajax
                return false;
            });//bind



//DELETE BINDING
 $("a.delete_product").bind("click", function() {
 //$.fancybox.close();
 product_id=$(this).attr("id");
 product_title=$(this).attr("rel");
$("<div title=\'Delete Confirmation\'>\n\
                     <span class=\'ui-icon ui-icon-alert\' style=\'float:left; margin:0 7px 20px 0;\'></span>\n\
                     Product <span style=\'color:#FF73B4;font-weight:bold;\'>"+ product_title+"  (ID:  "+ product_id +"  )</span> will be deleted.Are you sure?</div>")
                       .dialog({
			resizable: false,
			height:170,
			modal: true,
                        zIndex:3000,
			buttons: {
				"Delete": function() {
                                     $.ajax({
                    type: "POST",
                    url: "'.Yii::app()->baseUrl.'/product/remove/",
                    data:{
                                "product_id":  product_id,
                                "YII_CSRF_TOKEN":"'.Yii::app()->request->csrfToken.'"
                                                                          },
                        beforeSend : function(){
                                               $("#'.Categorydemo::ADMIN_TREE_CONTAINER_ID.'").addClass("ajax-sending");
                                                               },
                                complete : function(){
                                              $("#'.Categorydemo::ADMIN_TREE_CONTAINER_ID.'").removeClass("ajax-sending");
                                                             },
                    success: function(res){
                             response=$.parseJSON(res);
                             if (response.success==true) {
                                 $.fancybox.close();
                             }


                    } //success
                });//ajax
               // return false;

					$( this ).dialog( "close" );
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
  });//bind
}
'
)); ?>

</div>
<script  type="text/javascript">
$(document).ready(function() {

//UPDATE BINDING
       $('a.update_product').bind('click', function() {
                $.ajax({
                    type: "POST",
                    url: "<?php echo Yii::app()->baseUrl; ?>/product/returnProductForm/",
                    data:{'product_id': $(this).attr('id'),
                              'update':true,
                              "YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken ?>"
                                                                        },
                     beforeSend : function(){
                                               $("#<?php echo Categorydemo::ADMIN_TREE_CONTAINER_ID;  ?>").addClass("ajax-sending");
                                                               },
                                complete : function(){
                                              $("#<?php echo Categorydemo::ADMIN_TREE_CONTAINER_ID;  ?>").removeClass("ajax-sending");
                                                             },		


                    success: function(data){

                        $.fancybox(data,
                        {    "transitionIn"	:	"elastic",
                            "transitionOut"    :      "elastic",
                             "speedIn"		:	600,
                            "speedOut"		:	200,
                            "overlayShow"	:	false,
                            "hideOnContentClick": false,
                              "width": 480,
                              "height":600,
                              "autoDimensions":true
                             // "margin":0,
                              //"padding":0
                        }
                    );
                        //  console.log(data);
                    } //success
                });//ajax
                return false;
            });//bind
	

//VIEW PROPERTIES  BINDING
       $('a.product_properties').bind('click', function() {
                $.ajax({
                    type: "POST",
                   // url: "<?php// echo Yii::app()->baseUrl; ?>/yms/comment/update/id/"+$id,
                    url: "<?php echo Yii::app()->baseUrl; ?>/product/returnProductProperties/",
                    data:{'id': $(this).attr('id'),
                              "YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken ?>"
                                                                        },
                     beforeSend : function(){
                                               $("#<?php echo Categorydemo::ADMIN_TREE_CONTAINER_ID;  ?>").addClass("ajax-sending");
                                                               },
                                complete : function(){
                                              $("#<?php echo Categorydemo::ADMIN_TREE_CONTAINER_ID;  ?>").removeClass("ajax-sending");
                                                             },


                    success: function(data){

                        $.fancybox(data,
                        {    "transitionIn"	:	"elastic",
                            "transitionOut"    :      "elastic",
                             "speedIn"		:	600,
                            "speedOut"		:	200,
                            "overlayShow"	:	false,
                            "hideOnContentClick": false,
                              "width": 480,
                              "height":600,
                              "autoDimensions":true
                             // "margin":0,
                              //"padding":0
                        }
                    );
                        //  console.log(data);
                    } //success
                });//ajax
                return false;
            });//bind



//DELETE BINDING
 $('a.delete_product').bind('click', function() {
 //$.fancybox.close();
 product_id=$(this).attr('id');
 product_title=$(this).attr('rel');
$('<div title="Delete Confirmation">\n\
                     <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>\n\
                     Product <span style="color:#FF73B4;font-weight:bold;">'+ product_title+'  (ID:  '+ product_id +'  )</span> will be deleted.Are you sure?</div>')
                       .dialog({
			resizable: false,
			height:170,
			modal: true,
                        zIndex:3000,
			buttons: {
				"Delete": function() {
                                     $.ajax({
                    type: "POST",
                    url: "<?php echo Yii::app()->baseUrl; ?>/product/remove/",
                    data:{
                                'product_id':  product_id,
                                "YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken ?>"
                                                                          },
                        beforeSend : function(){
                                               $("#<?php echo Categorydemo::ADMIN_TREE_CONTAINER_ID;  ?>").addClass("ajax-sending");
                                                               },
                                complete : function(){
                                              $("#<?php echo Categorydemo::ADMIN_TREE_CONTAINER_ID;  ?>").removeClass("ajax-sending");
                                                             },		
                    success: function(res){
                             response=$.parseJSON(res);
                             if (response.success==true) {
                                 $.fancybox.close();//alert('OK,Deleted.');
                             }

                    
                    } //success
                });//ajax
               // return false;
                            
					$( this ).dialog( "close" );
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
  });//bind

	});


</script>