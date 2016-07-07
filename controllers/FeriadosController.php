<?php
/**
 * @var $this FeriadosController * @var $model Feriados * @var $_model Feriados */
class FeriadosController extends Controller
{
	public $layout='column2';
	private $_model;

	public function filters()
	{
		return array(array('CrugeAccessControlFilter'));
	}
        public function accessRules()
	{
		return array(
			
		);
	}

	public function actionView()
	{
            $this->render('view',array(
                'model'=>$this->loadModel(),
            ));
	}

	public function actionCreate()
	{
            $model=new Feriados;
            $this->performAjaxValidation($model);
            if(isset($_POST['Feriados']))
            {
                $model->attributes=$_POST['Feriados'];
                $iid = Yii::app()->db->createCommand("SELECT max(id) from feriados")->queryScalar();
                $model->id = (int) $iid + 1;
                if($model->save()) {
                    Yii::app()->user->setFlash('success',"Datos grabados correctamente!");
                    $this->redirect(array('update','id'=>$model->id));
                }
            }
            $this->render('create',array(
                'model'=>$model,
            ));
	}

	public function actionUpdate()
	{
            $model=$this->loadModel();
            $this->performAjaxValidation($model);
            if(isset($_POST['Feriados']))
            {
                $model->attributes=$_POST['Feriados'];
                if($model->save()) {
                    Yii::app()->user->setFlash('success',"Datos grabados correctamente!");
                    $this->redirect(array('admin'));
                }
            }

            $this->render('update',array(
                    'model'=>$model,
            ));
	}

	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			$this->loadModel()->delete();

			if(!isset($_GET['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,
					Yii::t('app', 'Invalid request. Please do not repeat this request again.'));
	}

	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Feriados');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}



	public function actionExportarExcel()
	{

            $criteria= $_SESSION['feriados-criteria'];
            $sort=$_SESSION['feriados-sort'];
            $model=$_SESSION['feriados-clase'];
            $columnas=$_SESSION['feriados-columnas'];


         $this->widget('application.extensions.EExcelView.EExcelView',
                        array(
                        'dataProvider'=> new CActiveDataProvider($model,array('pagination'=>false,'criteria'=>$criteria,'sort'=>$sort,)),
                        'columns'=> $columnas
                        )
                    );
         Yii::app()->end();
	}
	public function actionExportarPDF()
	{

            $criteria= $_SESSION['feriados-criteria'];
            $sort=$_SESSION['feriados-sort'];
            $model=$_SESSION['feriados-clase'];
            $columnas=$_SESSION['feriados-columnas'];


         $this->widget('application.extensions.EExcelView.EExcelView',
                        array(
                        'dataProvider'=> new CActiveDataProvider($model,array('pagination'=>false,'criteria'=>$criteria,'sort'=>$sort,)),
                        'columns'=> $columnas,
                        'exportType'=>'PDF',
                        )
                    );
         Yii::app()->end();
	}


	public function actionAdmin()
	{
		$model=new Feriados('search');
                $model->unsetAttributes();
		if(isset($_GET['Feriados']))
			$model->attributes=$_GET['Feriados'];

                $columnas= array(
                    array(
                        'name'=>'id',
                        'value'=>'$data->id',
                        'sortable'=>'true',
                        'header'=>'ID',
                        'htmlOptions'=>array('width'=>'5%', 'style'=>'text-align: center'),
                    ),
                    array(
                        'name'=>'fecha',
                        'value'=>'$data->fecha',
                        'sortable'=>'true',
                        'header'=>'FECHA',
                        'htmlOptions'=>array('width'=>'40%', 'style'=>'text-align: center'),
                    ),
                     array(
                        'name'=>'idCoope',
                        'value'=>'$data->coope->cooperativa',
                        'sortable'=>'true',
                        'header'=>'COOPERATIVA',
                        'filter'=>CHtml::listData(Cooperativas::model()->findAll(array('order'=>'cooperativa')),'id','cooperativa'),
                        'htmlOptions'=>array('width'=>'40%', 'style'=>'text-align: center'),
                    ),
                );

                $_SESSION['feriados-columnas']=$columnas;

		$this->render('admin',array(
			'model'=>$model,
                        'columnas'=>$columnas,
		));
	}

	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=Feriados::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		return $this->_model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='feriados-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
