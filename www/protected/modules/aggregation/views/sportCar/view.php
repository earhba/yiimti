<?php
$this->breadcrumbs=array(
	'Sport Cars'=>array('index'),
    $model->id,
);

$this->menu=array(
	array('label'=>'List SportCar', 'url'=>array('index')),
	array('label'=>'Create SportCar', 'url'=>array('create')),
	array('label'=>'Update SportCar', 'url'=>array('update', 'id'=>$model->id)),
    array('label'=>'Delete SportCar', 'url'=>'#', 'linkOptions'=>array(
        'submit'=>array('delete','id'=>$model->id),
        'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SportCar', 'url'=>array('admin')),
);
?>

<h1>View SportCar#<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
        'name',
		'data.power',
	),
)); ?>