<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit', array(
    'heading'=>'Congratulations!',
)); ?>
 
    <p>From now you belong to our family .</p>
    <p><?php $this->widget('bootstrap.widgets.TbButton', array(
        'type'=>'primary',
        'size'=>'large',
        'label'=>'Learn more',
    )); ?></p>
 
<?php $this->endWidget(); ?>