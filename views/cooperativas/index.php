<?php
$this->breadcrumbs = array(
	'Cooperativass',
	Yii::t('app', 'Index'),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Create') . ' Cooperativas', 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' Cooperativass', 'url'=>array('admin')),
);
?>

<h1>List&nbsp;Cooperativass</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
