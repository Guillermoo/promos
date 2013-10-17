<?php 
	echo CHtml::link($imghtml);	?>
	<?php if ($muestraBorrar):?>
		<td class="delete">
            <button class="btn btn-danger" data-type="POST" data-url=/promos/item/delete?id=<?=$idimage ?> >
                <i class="icon-trash icon-white"></i>
                <span>Delete</span>
            </button>
            <?php echo CHtml::ajaxLink('Delete', array('empresa/deleteItem','id'=>$idimage),
			array('update' => '#logo_form'))?>
        </td>
    <?php else: ?>
    <td>    
        No debe mostrar el borrar
    </td>
	<?php endif;?>