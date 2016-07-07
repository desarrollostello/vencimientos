<?php
$this->breadcrumbs = array(
	'Vencimientoss',
	Yii::t('app', 'Index'),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Create') . ' Vencimientos', 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' Vencimientoss', 'url'=>array('admin')),
);
?>

<h1>List&nbsp;Vencimientoss</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
