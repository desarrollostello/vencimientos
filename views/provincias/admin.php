<?php
$this->breadcrumbs=array(
	'Provincias'=>array(Yii::t('app', 'admin')),
	Yii::t('app', 'Listado'),
);

$this->menu=array(		
    array('label'=>Yii::t('app', 'Nueva').'  Provincia', 'url'=>array('create')),
//    array('label'=>'Exportar a Excel','url'=>array('exportarExcel')),
//    array('label'=>'Exportar a PDF','url'=>array('exportarPDF')),
);

foreach(Yii::app()->user->getFlashes() as $key => $message) { 
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}
?>
<h3> Listado de &nbsp;Provincias
<?php
?>
<div class="btn-group">
  <a class="btn btn-primary" href="#"><i class="icon-user icon-white"></i>Opciones</a>
  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
  <ul class="dropdown-menu">
    <li>
        <?php echo CHtml::link('Nuevo',array('Provincias/create')); ?>
    </li>
<!--    <li><a href="#"><i class="icon-trash"></i> Delete</a></li>
    <li><a href="#"><i class="icon-ban-circle"></i> Ban</a></li>
    <li class="divider"></li>
    <li><a href="#"><i class="i"></i> Make admin</a></li>-->
  </ul>
</div>
</h3>
<?php
/*
 * las columnas se definen en el controlador
 * porque se usan las mismas para pasar a excel
 * agrego los botones */
$columnas[]=array('class'=>'CButtonColumn','header' => 'Acciones',);

$this->widget('zii.widgets.grid.CGridView', array(
'id'=>'provincias-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=> $columnas,
)); ?>
