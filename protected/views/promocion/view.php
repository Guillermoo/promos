<div class="row-fluid print-show">
	<div class="span12">
		Alternate header for print version
	</div>
</div>

<!--<div class="row-fluid print-hide">
<div class="span3">
<img src="img/logo.png" alt="Logo">
</div>
<div class="span5">
<img src="img/banner_top.jpg" alt="No shipping">
</div>
</div>-->

<div class="row-fluid print-hide">
<div class="span12">
</div>
</div>

<div class="row-fluid">
<div class="span12">

<div class="row-fluid">	
			<div class="span3">
				<!--<button class="btn"><i class="icon-chevron-left"></i> <a href="/page2">Continue</a></button>-->
				<?php $this->widget('bootstrap.widgets.TbButton', array(
				    'label'=>'Volver',
				    'htmlOptions'   => array('class'=>'btn'),
				    'icon'=>'chevron-left',
				    'type'=>null, // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
				    'size'=>'large', // null, 'large', 'small' or 'mini'
				    'url'=>Yii::app()->user->returnUrl,
				)); ?>
			</div>	
	<div class="span9">
		<div class="social-icons pull-right">		
			<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;width&amp;layout=standard&amp;action=like&amp;show_faces=true&amp;share=true&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:30px;" allowTransparency="true"></iframe>
			<p><a href="http://twitter.com/home?status=<?php echo urlencode("¡No te pierdas esta promoción! http://www.proemocion.com/promocion/$model->titulo_slug");?>" target="_blank" class="twitter-share-button"><img src="<?php echo Yii::app()->theme->baseUrl?>/img/tweet-button.png" /></a><p/>
			<!-- Replace with something like:
			<div class="fb-like fb_edge_widget_with_comment fb_iframe_widget" data-send="false" data-layout="button_count" data-width="150" data-show-faces="false" data-font="arial">
				<span style="height: 20px; width: 107px; ">
					<iframe id="f36680bf28" name="f1bd6447bc" scrolling="no" style="border: none; overflow: hidden; height: 20px; width: 107px; " title="Like this content on Facebook." class="fb_ltr" src="http://www.facebook.com/plugins/like.php"></iframe>
				</span>
			</div>
			-->
		</div>
	</div>
</div>

<!-- ########### Sistema de votación ##################### -->
<div  id="valoracion<?=$model->id?>">
	<?php 
    if($model->votos_suma>0){ //si tiene algún voto      
        echo "Valoración: <strong>" . $model->votos_media ."</strong>";
        echo " " . $model->votos_cantidad . " votos";
    }else{
       	echo "Valoración: <strong>Todavía no ha sido valorada</strong>";           
    }
	?>
</div>
      
<div id="rating_success_<?=$model->id;?>">
<?php 
	 if($model->votos_suma>0){ //si tiene algún voto    
	 if($model->votos_suma <= 1.5)  
	 	echo "<img src='".Yii::app()->getBaseUrl()."/img/starring1.png' alt='".$model->votos_media."' />";
     else
     	if($model->votos_suma <= 2.5)
     		echo "<img src='".Yii::app()->getBaseUrl()."/img/starring2.png' />";
     	else
     		if($model->votos_suma <= 3.5)
     			echo "<img src='".Yii::app()->getBaseUrl()."/img/starring3.png' />";
     		else
     			if($model->votos_suma <= 4.5)
     				echo "<img src='".Yii::app()->getBaseUrl()."/img/starring4.png' />";
     			else
     				echo "<img src='".Yii::app()->getBaseUrl()."/img/starring5.png' title='Puntuación: ".$model->votos_media."'/>";   
    }
?>
</div> <!-- the div in which the confirmation message is shown-->
<!-- #################################3 -->
<div class="row-fluid product-detail">

	<div class="span4">
		<?php if (isset($model->item) && strcmp($model->item->model,'promo') == 0): ?>
			<?php $path=$model->item->path ?>
		<?php else:?>
			<?php $path=Yii::app()->params['no_image_big'] ?>
		<?php endif; ?>
		<a class="product-detail-lightbox colorbox hidden-phone" rel="colorbox1" href="<?php echo Yii::app()->request->baseUrl.$path ?>" title="<?=$model->titulo?>">
				<img class="product-image" alt="Product A" src="<?php echo Yii::app()->request->baseUrl.$path ?>">
		</a>
	</div>

	<div class="span8 well">

		<div class="row-fluid">

			<div class="span7">
				<h3><?=$model->titulo ?></h3>
			</div>

			<div class="span5">
				<span class="label label-important price">&euro; <?=$model->precio ?></span>
			</div>

		</div>

		<div class="row-fluid">
			<div class="span7">
				<?php if(isset($model->fecha_fin)):
						$segundos=strtotime($model->fecha_fin) - strtotime('now');
						$dias=intval($segundos/60/60/24);
					?>
					<p><span class="label label-warning">¡A esta promoción le quedan <?php echo $dias ?> días!</p>
				<?php endif; ?>
			</div>
		</div>

		<div class="row-fluid">
			<div class="span7">
				<?php if(isset($model->resumen)):?>
					<p><?=$model->resumen ?></p>
				<?php endif; ?>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span12">
				<br>
				<h4>Descripción</h4>
				<?php if(isset($model->descripcion) && !empty($model->Descripción)):?>
					<p><?=$model->descripcion ?></p>
				<?php endif; ?>
				<?php if(isset($model->descripcion_html) && !empty($model->descripcion_html)): ?>
					<p><?=$model->descripcion_html ?></p>
				<?php endif; ?>
				<hr>
			</div>
		</div>

		<div clas="row-fluid">
			<?php if(isset($model->rebaja) && !empty($model->rebaja)): ?>
				<div class="span12">
					<div class="alert alert-success"><center><h4>¡<?php echo $model->rebaja ?> DE DESCUENTO!</h4></center></div>
				</div>
			<?php endif; ?>
		</div>

		<div clas="row-fluid">
			<?php if(isset($model->condiciones) && !empty($model->condiciones)): ?>
				<div class="span12">
					<div>Condiciones: <?php echo $model->condiciones ?></div>
				</div>
			<?php endif; ?>
		</div>

		<div class="row-fluid">
			<div class="span12" align="right">
				<?php
				//Comprobar que es usuario registrado. Sino, no se muestra el botón de comprar
				if(UserModule::isBuyer()):
				 ?>
					<?php if($model->tipo == 0): ?>
						<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
							<input type="hidden" name="cmd" value="_xclick">
							<intput type="hidden" name="notify_url" value="http://wwww.proemocion.com/compra/checkoutCompra">
							<input type="hidden" name="quantity" value="1">
							<input type="hidden" name="return" value="http://www.proemocion.com/site/pagoCorrecto" >
							<!--<input type="hidden" name="hosted_button_id" value="6GXW9XDULHFUG"> -->
							<input type="hidden" name="business" value="<?php echo $datos->paypal_id; ?>">
							<input type="hidden" name="item_name" value="<?=$model->titulo ?>">
							<input type="hidden" name="amount" value="<?=$model->precio ?>">
							<input type="hidden" name="custom" value="<?= Yii::app()->user->id ?>_<?=$model->id ?>">
							<input type="image" src="https://www.sandbox.paypal.com/es_ES/ES/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal. La forma rápida y segura de pagar en Internet.">
							<img alt="" border="0" src="https://www.sandbox.paypal.com/es_ES/i/scr/pixel.gif" width="1" height="1">
						</form>
					<?php else: ?>
						<div class="alert alert-info"><strong>Para disfrutar de esta oferta debes presentar el cupón. Descarga el cupón pinchando en el botón de abajo y preséntalo en el establecimiento.</strong> (Exclusivo para usuarios registrados en Proemoción)</div>
							<?php $this->widget('bootstrap.widgets.TbButton', array(
    						'label'=>'¡Descarga el cupón!',
    						'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    						'size'=>'large', // null, 'large', 'small' or 'mini'
    						'icon'=>'download-alt white',
    						'url'=>array('user/compra/comprado/idPromo/'.$model->id),
    						'toggle'=>true,
							)); ?>
					<?php endif; ?>					
				<?php else: ?>
						<div class="alert alert-info"><h4>Para poder comprar una promoción debes estar registrado como usuario.</h4></div>
						<div>
						<p><?php echo CHtml::link('Regístrate', Yii::app()->getModule('user')->registrationUrl); ?> si todavía no eres usuario o <?php echo CHtml::link('accede', Yii::app()->getModule('user')->profileUrl); ?> si ya eres usuario registrado</p></div>
				<?php endif; ?>			
				</div>
			</div>
		</div>
	</div>	

</div>
<div class="clearfix"><h2>Datos de la empresa</h2></div>
	<div class="span12">
	<div class="well">
		<div class="row-fluid">				
			<h3><?php echo CHtml::link(CHtml::encode($empresa->empresa->nombre),array('empresa/verpromos', 'id'=>$empresa->empresa->id),array('target'=>'_blank')) ?></h3>
		</div>
		<div class="row-fluid span4">
			<h4>Dirección</h4>
			<div><?php echo CHtml::encode($empresa->profile->direccion) ?></div>
		</div>
		<div class="row-fluid span3">
			<h4>Teléfono</h4>
			<div><?php echo CHtml::encode($empresa->profile->telefono) ?></div>
		</div>
		<div class="row-fluid span4">
			<h4>Página web</h4>
			<div><?php echo CHtml::encode($empresa->empresa->web) ?></div>
		</div>
		<div class="clearfix">&nbsp;</div>		
	</div>
</div>

<div class="row-fluid">
	<div class="span12">

		<div class="tabbable">

			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab1" data-toggle="tab">Otras promociones</a></li>
			</ul>

			<div class="tab-content">

				<div class="tab-pane active" id="tab1">
					<ul class="thumbnails product-list-inline-small">
						<?php $cont=0; ?>
						<?php foreach ($promos as $key => $promo):
							$cont++;
							if (isset($promo->item) && strcmp($promo->item->model,'promo') == 0): 
								$path=$promo->item->path; 
						 	else:
								$path=Yii::app()->params['no_image'];
							endif; ?>
							<li class="span2">
								<div class="thumbnail light">
								<a href="<?=$promo->titulo_slug ?>">
								<span class="label label-info price">&euro; <?php echo $promo->precio ?></span>
								<!--<span class="label label-important price price-over">&euro; 1,<sup>99</sup></span>-->
								<?php if (isset($promo->item)): ?>
									<center><img class="divpromothumb" data-hover="<?php echo Yii::app()->getBaseUrl().$path ?>" src="<?php echo Yii::app()->getBaseUrl().$path ?>" alt="<?php echo $promo->titulo ?>" ?></center>
								<?php else: ?>
									<center><img class="divpromothumb" data-hover="<?php echo Yii::app()->request->baseUrl.$path ?>"  alt="<?php echo $promo->titulo ?>" src="<?php echo Yii::app()->request->baseUrl.$path ?>"></center>
								<?php endif; ?>
								</a>
									<div class="caption">
									<a href="<?php echo $promo->titulo_slug ?>"><?php echo $promo->titulo ?><a href="<?=$promo->titulo_slug ?>" class="btn btn-block">Más información</a>
									</div>
								</div>
							</li>							
				<?php endforeach; ?>
				</ul>
				<?php if($cont==0): ?>
					<div class="alert alert-info">No hay más promociones disponibles en este momento</div>
				<?php endif;?>
				</div>

			</div>
		</div>
	</div>
</div>



</div>
</div>