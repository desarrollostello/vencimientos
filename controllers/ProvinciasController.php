<?php
/**
 * @var $this ProvinciasController * @var $model Provincias * @var $_model Provincias */
class ProvinciasController extends Controller
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
            $model=new Provincias;
            $this->performAjaxValidation($model);
            if(isset($_POST['Provincias']))
            {
                $model->attributes=$_POST['Provincias'];
                $iid = Yii::app()->db->createCommand("SELECT max(id) from provincias")->queryScalar();
                $model->id = (int) $iid + 1;
                if($model->save()) {
                    Yii::app()->user->setFlash('success',"Datos grabados correctamente!");
                    $this->redirect(array('admin'));
                }
            }
            $this->render('create',array('model'=>$model,));
	}

	public function actionUpdate()
	{
            $model=$this->loadModel();
            $this->performAjaxValidation($model);
            if(isset($_POST['Provincias']))
            {
                $model->attributes=$_POST['Provincias'];
                if($model->save()) {
                    Yii::app()->user->setFlash('success',"Datos grabados correctamente!");
                    $this->redirect(array('update','id'=>$model->id));
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
            $dataProvider=new CActiveDataProvider('Provincias');
            $this->render('index',array(
                'dataProvider'=>$dataProvider,
            ));
	}

	public function actionExportarExcel()
	{

            $criteria= $_SESSION['provincias-criteria'];
            $sort=$_SESSION['provincias-sort'];
            $model=$_SESSION['provincias-clase'];
            $columnas=$_SESSION['provincias-columnas'];
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
            $criteria= $_SESSION['provincias-criteria'];
            $sort=$_SESSION['provincias-sort'];
            $model=$_SESSION['provincias-clase'];
            $columnas=$_SESSION['provincias-columnas'];
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
            $model=new Provincias('search');
            $model->unsetAttributes();
            if(isset($_GET['Provincias']))
                $model->attributes=$_GET['Provincias'];
            $columnas= array(
                array(
                    'name'=>'id',
                    'value'=>'$data->id',
                    'sortable'=>'true',
                    'header'=>'ID',
                    'htmlOptions'=>array('width'=>'20%', 'style'=>'text-align: center'),
            	),
                array(
                    'name'=>'provincia',
                    'value'=>'$data->provincia',
                    'sortable'=>'true',
                    'header'=>'PROVINCIAS',
                    'htmlOptions'=>array('width'=>'70px', 'style'=>'text-align: center'),
            	),
                
            );
            $_SESSION['provincias-columnas']=$columnas;
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
                    $this->_model=Provincias::model()->findbyPk($_GET['id']);
                if($this->_model===null)
                    throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
            }
            return $this->_model;
	}

	protected function performAjaxValidation($model)
	{
            if(isset($_POST['ajax']) && $_POST['ajax']==='provincias-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
	}
}