<?php
$this->breadcrumbs = array(
	'Sectoress',
	Yii::t('app', 'Index'),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Create') . ' Sectores', 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' Sectoress', 'url'=>array('admin')),
);
?>

<h1>List&nbsp;Sectoress</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
