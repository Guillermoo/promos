<?php /*$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'nombre',
		'web',
		'twitter',
		'facebook',
		'urlTienda',
		'modificado',
	),
)); */
//Yii::app()->theme = "Frontend";
?>
<div class="row-fluid">
	<div class="span12">
		<center><?php $this->widget('bootstrap.widgets.TbButton', array(
    		'label'=>'Listado empresas',
    		'type'=>'', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    		'size'=>'large', // null, 'large', 'small' or 'mini'
    		'icon'=>' icon-arrow-left',
    		'url'=>array('/empresas')
			)); 
		?></center>
	</div>
</div>
<div class="row-fluid">
	<div class="span10"><h2> <?php echo $model->nombre; ?></h2></div>
	<div class="social span1"><?php echo CHtml::link(CHtml::image(Yii::app()->theme->baseurl.'/img/icon-facebook-big.png', $alt='facebook'),'http://www.facebook.com/'.$model->facebook,array('target'=>'_blank')) ?></div>
		<div class="social span1"><?php echo CHtml::link(CHtml::image(Yii::app()->theme->baseurl.'/img/icon-twitter-big.png', $alt='twitter'),'http://www.twitter.com/'.$model->twitter,array('target'=>'_blank')) ?></div>
		<div class="span12">			
			<?php if(isset($image)){ ?>
			<div class="thumbnail"> 
				<?php
						echo CHtml::image(Yii::app()->getBaseUrl().$image->path, $alt='logo');
					?>
			</div>
			<?php } ?>
		<span class="label label-info">Web:</span>
		<div class="well clearfix"> <?php echo "<a href='".$model->web."' target='_blank'>".$model->web."</a>" ?>
		</div>
		<span class="label label-info">Dirección:</span>
		<div class="well clearfix"> <?php echo $model->usuario->profile->direccion;

		//$this->debug($model) ?>
		</div>
	</div>
</div>
	
<h3> Proemociones de <?php echo $model->nombre; ?>:</h3>
<?php /*$this->widget('zii.widgets.CDetailView', array(
	'data'=>$promos,
	'attributes'=>array(
		'titulo',
		'resumen',
	),
)); 
/* CAMBIAR EL MÉTODO DE MOSTRAR LAS PROMOS, A VER SI NO ME LAS MUESTRA POR ESTO. MOSTRARLAS CON UN FOR */
?>
<div class="row-fluid">
		<div class="span12">
			<ul class="thumbnails product-list-inline-large">
<?php
if(!isset($model->usuario->promocion) || empty($model->usuario->promocion)):
?>
	<div class="alert alert-info">Esta empresa no tiene ninguna promoción activada</div>
<?php
else:
	foreach ($model->usuario->promocion as $key => $promo) {
		if($promo->fecha_fin>date("Y-m-d") && $promo->estado == 1){
?>
<li class="span3">
	<div class="thumbnail light">
		<a href="/promocion/<?=$promo->titulo_slug ?>">
			<span class="label label-info price">&euro; <? echo $promo->precio ?></span>									
			<?php if (isset($promo->item)): ?>
				<center><img data-hover="<?php echo Yii::app()->request->baseUrl.$promo->item->path ?>" src="<?php echo Yii::app()->getBaseUrl().$promo->item->path ?>" alt=""></center>
			<?php else: ?>
				<img src="<?php echo Yii::app()->getBaseUrl().Yii::app()->params['no_image'] ?>"  alt="">
			<?php endif; ?>
		</a>
		<div class="caption">
			<a href="/promocion/<?=$promo->titulo_slug ?>"><?php echo $promo->titulo ?></a>
		</div>
	</div>			
	<a href="/promocion/<?=$promo->titulo_slug ?>" class="btn btn-block">Ver promoción</a>
</li>
<?php
		}
	}
endif;
?>
</ul>
</div>
</div>