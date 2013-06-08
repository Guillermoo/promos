<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
<?php echo __FILE__; ?>
    <div class="span9">
        <div id="content">
            <?php echo $content; ?>
        </div><!-- content -->
    </div>
    <div class="span3">
        <div id="sidebar">
        <?php
            //if(!Yii::app()->user->isGuest) $this->widget('UserMenu');
        ?>
        </div><!-- sidebar -->
    </div>
</div>
<?php $this->endContent(); ?>