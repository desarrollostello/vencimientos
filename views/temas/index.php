<?php
$this->breadcrumbs = array(
	'Temass',
	Yii::t('app', 'Index'),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Create') . ' Temas', 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' Temass', 'url'=>array('admin')),
);
?>

<h1>List&nbsp;Temass</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
