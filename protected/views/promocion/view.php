<div class="row-fluid print-show">
	<div class="span12">
		Alternate header for print version
	</div>
</div>

<div class="row-fluid print-hide">
	<div class="span4">
		<div class="header-action">
			<span class="label label-info">Free shipping on all orders over € 20,-</span>
		</div>
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
	
				<? //$this->debug($model->attributes);?>
				<? $this->debug($model->categoria);?>
					<div class="row-fluid">
						<div class="span9">
							<h2><?=$model->titulo ?></h2>
						</div>
						<div class="span3">
							<div class="social-icons pull-right">
								<?php //echo Yii::app()->request->baseUrl.'/themes/frontEnd'?>
								<a href="#"><img src="<?php echo Yii::app()->theme->baseUrl?>/img/icon-facebook-like.jpg"></a>
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

					<div class="row-fluid product-detail">

						<div class="span4">
							<?php if (isset($model->item)): ?>
								<?php $path=$model->item->path ?>
							<?php else:?>
								<?php $path=Yii::app()->params['no_image'] ?>
							<?php endif; ?>
							<a class="product-detail-lightbox colorbox hidden-phone" rel="colorbox1" href="<?php echo Yii::app()->request->baseUrl.$path ?>" title="<?=$model->titulo?>">
									<img class="product-image" alt="Product A" src="<?php echo Yii::app()->request->baseUrl.$path ?>">
							</a>
						</div>

						<!--<div class="span1">
							<ul class="thumbnails main-product">
								<li class="span12 visible-phone">
									<a rel="colorbox1" href="img/product_01.jpg" class="colorbox thumbnail">
										<img alt="Product A 2" src="img/product_01.jpg" />
									</a>
								</li>
								<li class="span12">
									<a rel="colorbox1" href="img/product_01b.jpg" class="colorbox thumbnail">
										<img alt="Product A 2" src="img/product_01b.jpg" />
									</a>
								</li>
								<li class="span12">
									<a rel="colorbox1" href="img/product_02.jpg" class="colorbox thumbnail">
										<img alt="Product B 1" src="img/product_02.jpg" />
									</a>
								</li>
								<li class="span12">
									<a rel="colorbox1" href="img/product_02b.jpg" class="colorbox thumbnail">
										<img alt="Product B 2" src="img/product_02b.jpg" />
									</a>
								</li>
							</ul>
						</div>-->

						<div class="span7 well">

							<div class="row-fluid">

								<div class="span7">
									<strong>Brand:</strong> <span>Squeezer</span><br>
									<strong>Model:</strong> <span>Duck</span><br>
									<strong>Size:</strong> <span>7</span><br>
									<strong>Color</strong> <span>Yellow</span><br>
									<strong>Quality:</strong> <span>new</span><br>
								</div>

								<div class="span5">
									<span class="label label-important price">&euro; <?=$model->precio ?></span>
								</div>

							</div>

							<div class="row-fluid">
								<div class="span12">
									<br>
									<h3>Description</h3>
									<p><?=$model->descripcion ?></p>
									<hr>
								</div>
							</div>

							<div class="row-fluid">

								<div class="span3">
									<!--<button class="btn"><i class="icon-chevron-left"></i> <a href="/page2">Continue</a></button>-->
									<?php $this->widget('bootstrap.widgets.TbButton', array(
									    'label'=>'Back',
									    'htmlOptions'   => array('class'=>'btn'),
									    'icon'=>'chevron-left',
									    'type'=>null, // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
									    'size'=>'large', // null, 'large', 'small' or 'mini'
									    'url'=>Yii::app()->user->returnUrl,
									)); ?>
								</div>

								<div class="span6">
									<form class="form-horizontal">
										<fieldset>
											<div class="control-group">
												<label class="control-label">Count</label>
												<div class="controls">
													<select class="input-mini">
														<option value="1">1</option>
														<option value="2">2</option>
														<option value="3">3</option>
														<option value="4">4</option>
														<option value="5">5</option>
													</select>
												</div>
											</div>
										</fieldset>
									</form>
								</div>

								<div class="span3">
									<div class="row-fluid">
										<button class="btn btn-primary"><i class="icon-shopping-cart icon-white"></i> Order now</button>
									</div>
								</div>
							</div>
						</div>

					</div>

					<div class="row-fluid">
						<div class="span12">

							<div class="tabbable">

								<ul class="nav nav-tabs">
									<li class="active"><a href="#tab1" data-toggle="tab">Promciones de la misma categoría</a></li>
									<li><a href="#tab2" data-toggle="tab">Promociones de la misma empresa</a></li>
								</ul>

								<div class="tab-content">

									<div class="tab-pane active" id="tab1">
										<ul class="thumbnails product-list-inline-small">
											<li class="span2">
												<div class="thumbnail">
													<a href="#"><img src="img/product_01.jpg" alt=""></a>
													<div class="caption">
														<a href="#">Product A</a>
														<p>Lorem ipsum dolor sit amet <span class="label label-info price pull-right">&euro; 123,-</span></p>
													</div>
												</div>
											</li>
										</ul>
									</div>

									<div class="tab-pane" id="tab2">
										<ul class="thumbnails product-list-inline-small">
											<li class="span3">
												<div class="thumbnail">
													<a href="#"><img src="img/product_01.jpg" alt=""></a>
													<div class="caption">
														<a href="#">Product A</a>
														<p>Lorem ipsum dolor sit amet <span class="label label-info price pull-right">&euro; 123,-</span></p>
													</div>
												</div>
											</li>
										</ul>
									</div>

								</div>
							</div>
						</div>
					</div>



				</div>
			</div>

			<div class="row-fluid">
				<div class="span12 well well-small">
						&copy; <script>document.write(new Date().getFullYear());</script> - All taxes are excluded - shipping costs depends on location - <a href="#">more info <i class="icon-chevron-right"></i></a>
				</div>
			</div>

			<!--<div class="footer">

				<div class="row-fluid print-hide">

					<div class="span2">
						<ul class="unstyled">
							<li class="footer-title"><a href="#">Category 1</a></li>
							<li><a href="#">Product item A</a></li>
							<li><a href="#">Product B</a></li>
							<li><a href="#">Large product C</a></li>
						</ul>
						<ul class="unstyled">
							<li class="footer-title"><a href="#">Category 2</a></li>
							<li><a href="#">Product item A</a></li>
							<li><a href="#">Product B</a></li>
							<li><a href="#">Large product C</a></li>
							<li><a href="#">Product D</a></li>
							<li><a href="#">Short E</a></li>
						</ul>
					</div>

					<div class="span2">
						<ul class="unstyled">
							<li class="footer-title"><a href="#">Category 3</a></li>
							<li><a href="#">Product item A</a></li>
							<li><a href="#">Product B</a></li>
							<li><a href="#">Large product C</a></li>
							<li><a href="#">Product D</a></li>
						</ul>
						<ul class="unstyled">
							<li class="footer-title"><a href="#">Category 4</a></li>
							<li><a href="#">Product item A</a></li>
							<li><a href="#">Product B</a></li>
						</ul>
					</div>

					<div class="span2">
						<ul class="unstyled">
							<li class="footer-title"><a href="#">Category 5</a></li>
							<li><a href="#">Product item A</a></li>
							<li><a href="#">Product B</a></li>
							<li><a href="#">Large product C</a></li>
						</ul>
						<ul class="unstyled">
							<li class="footer-title"><a href="#">Category 6</a></li>
							<li><a href="#">Product item A</a></li>
							<li><a href="#">Product B</a></li>
							<li><a href="#">Large product C</a></li>
							<li><a href="#">Product D</a></li>
						</ul>
					</div>

					<div class="span2">
						<ul class="unstyled">
							<li class="footer-title"><a href="#">Category 7</a></li>
							<li><a href="#">Product item A</a></li>
							<li><a href="#">Product B</a></li>
							<li><a href="#">Large product C</a></li>
							<li><a href="#">Product D</a></li>
							<li><a href="#">Short E</a></li>
						</ul>
						<ul class="unstyled">
							<li class="footer-title"><a href="#">Category 8</a></li>
							<li><a href="#">Product item A</a></li>
							<li><a href="#">Product B</a></li>
							<li><a href="#">Large product C</a></li>
							<li><a href="#">Product D</a></li>
							<li><a href="#">Short E</a></li>
						</ul>
					</div>

					<div class="span2">
						<ul class="unstyled">
							<li class="footer-title"><a href="#">Category 9</a></li>
							<li><a href="#">Product item A</a></li>
							<li><a href="#">Product B</a></li>
							<li><a href="#">Large product C</a></li>
							<li><a href="#">Product D</a></li>
							<li><a href="#">Short E</a></li>
						</ul>
						<ul class="unstyled">
							<li class="footer-title"><a href="#">Category 10</a></li>
							<li><a href="#">Product item A</a></li>
							<li><a href="#">Product B</a></li>
							<li><a href="#">Large product C</a></li>
							<li><a href="#">Product D</a></li>
						</ul>
					</div>

					<div class="span2">
						<ul class="unstyled">
							<li class="footer-title"><a href="#">Category 11</a></li>
							<li><a href="#">Product item A</a></li>
							<li><a href="#">Product B</a></li>
						</ul>
						<ul class="unstyled">
							<li class="footer-title"><a href="#">Category 12</a></li>
							<li><a href="#">Product item A</a></li>
							<li><a href="#">Product B</a></li>
							<li><a href="#">Large product C</a></li>
						</ul>
					</div>

				</div>

				<div class="row-fluid print-show">
					<div class="span12">
						Alternate footer for print version
					</div>
				</div>

			</div>-->