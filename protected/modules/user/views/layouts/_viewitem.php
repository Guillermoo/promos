<?php 
	echo CHtml::link($imghtml);	?>
	<?php if ($muestraBorrar):?>
		<td class="delete">
           <!-- <button class="btn btn-danger" data-type="POST" data-url=/promos/item/delete?id=<?=$idimage ?> >
                <i class="icon-trash icon-white"></i>
                <span>Delete</span>
            </button>-->
            <!--<button class="btn btn-danger" data-type="POST" data-url=empresa/deleteItem?id=<?=$idimage ?> >
                <i class="icon-trash icon-white"></i>
                <span>Delete</span>
            </button>-->
            <button class="btn btn-danger">
                    <i class="icon-trash icon-white"></i>
                    <?php echo CHtml::ajaxLink('Delete', array('empresa/deleteItem','id'=>$idimage),
                    array('update' => '#logo_form'))?>
            </button>
            <?php //echo CHtml::ajaxLink('Delete', array('empresa/deleteItem','id'=>$idimage),
			//array('update' => '#logo_form','class' => "btn btn-danger"))?>
        </td>
    <?php else: ?>
    <td>    
        No debe mostrar el borrar
    </td>
	<?php endif;?>