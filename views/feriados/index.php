<?php
$this->breadcrumbs = array(
	'Feriadoss',
	Yii::t('app', 'Index'),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Create') . ' Feriados', 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' Feriadoss', 'url'=>array('admin')),
);
?>

<h1>List&nbsp;Feriadoss</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
