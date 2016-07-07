<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idCoope')); ?>:</b>
	<?php echo CHtml::encode($data->idCoope); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idTema')); ?>:</b>
	<?php echo CHtml::encode($data->tema); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plazo')); ?>:</b>
	<?php echo CHtml::encode($data->plazo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('habil')); ?>:</b>
	<?php echo CHtml::encode($data->habil); ?>
	<br />
        <b><?php echo CHtml::encode($data->getAttributeLabel('observaciones')); ?>:</b>
	<?php echo CHtml::encode($data->observaciones); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fechaLimite')); ?>:</b>
	<?php echo CHtml::encode($data->fechaLimite); ?>
	<br />

	*/ ?>

</div>
