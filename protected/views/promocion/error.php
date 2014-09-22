
<?php 

// Set up several flashes
// (this should be done somewhere in controller, of course).
$user = Yii::app()->getComponent('user');
$user->setFlash(
    'error',
    '<strong>Oooppss!</strong> No se pudo encontrar la promoción seleccionada.'
);

// Render them all with single `TbAlert`
$this->widget('bootstrap.widgets.TbAlert', array(
    'block' => true,
    'fade' => true,
    'closeText' => '&times;', // false equals no close link
    'events' => array(),
    'htmlOptions' => array(),
    'userComponentId' => 'user',
    'alerts' => array( // configurations per alert type
        // success, info, warning, error or danger
        'success' => array('closeText' => '&times;'),
        'info', // you don't need to specify full config
        'warning' => array('block' => false, 'closeText' => false),
        'error' => array('block' => false, 'closeText' => 'AAARGHH!!')
    ),
));

?>