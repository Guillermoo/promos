<?php echo __FILE__; ?>
<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Promotion"); ?>

<?php if(Yii::app()->user->hasFlash('promocionMessage')): ?>
<div class="success">
	<?php echo Yii::app()->user->getFlash('promocionMessage'); ?>
</div>
<?php endif; ?>

	<?php if(UserModule::isCompany()):?>
		<?php $this->renderPartial('_form', array('model'=>$model));?>
		<?php /*$this->widget('bootstrap.widgets.TbTabs', array(
		    'tabs'=>$this->getTabularFormTabs($model,$categorias,$cuentas),
		));*/ ?>
 	<?php endif;?>
 	