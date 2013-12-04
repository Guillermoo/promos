<div class="row-fluid">
		<div class="span12">
			<ul class="thumbnails product-list-inline-small">
		<?php $this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'_view',
		)); ?>
			</ul>
		</div>
</div>
