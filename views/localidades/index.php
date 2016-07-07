<?php
$this->breadcrumbs = array(
	'Localidadess',
	Yii::t('app', 'Index'),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Create') . ' Localidades', 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' Localidadess', 'url'=>array('admin')),
);
?>

<h1>List&nbsp;Localidadess</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
