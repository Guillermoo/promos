<?php
/* @var $this SiteController */
$this->layout = 'column2';
$this->pageTitle=Yii::app()->name;
?>
<?php //$this->debug()?>
<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p>P�gina principal del theme donde acceden los NO logeados.</p>

<p>You may change the content of this page by modifying the following two files:</p>
<ul>
	<li>View file: <code><?php echo __FILE__; ?></code></li>
	<li>Layout file: <code><?php echo $this->getLayoutFile('main'); ?></code></li>
</ul>
<?php $this->beginContent('//decorators/quote', array('author' => 'Edward A. Murphy'))?>
	If anything bad can happen, it probably will
	(G)Esto es un decorator. Mirar //views/decorators/quote. 
<?php $this->endContent()?>

<p>For more details on how to further develop this application, please read
the <a href="http://www.yiiframework.com/doc/">documentation</a>.
Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
should you have any questions.</p>
