<?php
$this->breadcrumbs = array(
	'Provinciass',
	Yii::t('app', 'Index'),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Create') . ' Provincias', 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' Provinciass', 'url'=>array('admin')),
);
?>

<h1>List&nbsp;Provinciass</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
