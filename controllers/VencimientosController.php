<?php
/**
 * @var $this VencimientosController * @var $model Vencimientos * @var $_model Vencimientos */
class VencimientosController extends Controller
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
        public function actionSendMail()
        {   
            $message = new YiiMailMessage;        
        
            $message->subject = 'My Subject';
            $message->view ='miVista';//nombre de la vista q conformara el mail
            $message->setBody('','text/html');//codificar el html de la vista
            $message->from =('micorreo@miempresa.com'); // alias del q envia
            $message->setTo('maurotello73@gmail.com'); // a quien se le envia

            Yii::app()->mail->send($message);
            
            
//            
//            $message            = new YiiMailMessage;
//               //this points to the file test.php inside the view path
//            $message->view = "test";
//            $sid                 = 1;
//            //$criteria            = new CDbCriteria();
//            //$criteria->condition = "studentID=".$sid."";            
//            //$studModel1          = Student::model()->findByPk($sid);        
//            //$params              = array('myMail'=>$studModel1);
//            $message->subject    = 'My TestSubject';
//            //$message->setBody($params, 'text/html');   
//            $message->setBody('text/html');   
//            $message->addTo('maurotello73@gmail.com');
//            $message->from = 'admin@domain.com';   
//            Yii::app()->mail->send($message);       
        }
	public function actionView()
	{
            $this->render('view',array(
                'model'=>$this->loadModel(),
            ));
	}

	public function actionCreate()
	{
            $model=new Vencimientos;
            $this->performAjaxValidation($model);
            $model->fecha = date('Y-M-d');
            if(isset($_POST['Vencimientos']))
            {
                $model->attributes=$_POST['Vencimientos'];
               
                if($model->fecha=='') {
                    $model->fecha=NULL;
                }
                if($model->fechaLimite=='') {
                    $model->fechaLimite=NULL;
                }
                
                $cantDias = (int) $model->plazo;
                $saldos=(int) $cantDias;
                $fechaDesde=$model->fecha;
                //$fechaHasta=new DateTime(Varios::dateconvert($model->fechaHasta,1));
               $fechaDesde1 = strtotime($fechaDesde);
                $contador=$saldos;
                $fechaDesde2 = date("Y-m-d",$fechaDesde1);
                $fechaDesde2=new DateTime($fechaDesde2);
                $habil = (int) $model->habil;
                while ($contador>0) {
                    if ($habil === 1){
                        $nroDia=$fechaDesde2->format('w');
                         if ($nroDia==0 or $nroDia==6){
                            $contador = $contador;
                         }else{
                            $fechaDesde3 = $fechaDesde2->format('Y-m-d');
                            $coope = (int) $model->idCoope;
                            $feriado = Feriados::model()->findByAttributes(array('fecha'=>$fechaDesde3, 'idCoope'=>$coope));
                            if ($feriado != null){
                                $contador = $contador;
                            }else{
                                $contador--;
                            }
                        }
                          // if ((Hs_extrasModule::feriado($fechaDesde2->format('Y-m-d'),$model->idCoope)) <> 1)
                    }else{
                        $contador--;
                    }
                    $fechaDesde2->add(new DateInterval('P1D'));
                }
               // $nuevafecha = $fechaDesde2;
               
                // $nuevafecha = strtotime ( '+'.$cantDias.' day' , strtotime ( $model->fecha ) ) ;
                $limite = $fechaDesde2->format('Y-m-d');
                $model->fechaLimite = $limite;
                $iid = Yii::app()->db->createCommand("SELECT max(id) from vencimientos")->queryScalar();
                $model->id = (int) $iid + 1;
                $model->usuario = Yii::app()->user->id;
                
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
            if(isset($_POST['Vencimientos']))
            {
                $model->attributes=$_POST['Vencimientos'];
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
            $dataProvider=new CActiveDataProvider('Vencimientos');
            $this->render('index',array(
                'dataProvider'=>$dataProvider,
            ));
	}

	public function actionExportarExcel()
	{
            $criteria= $_SESSION['vencimientos-criteria'];
            $sort=$_SESSION['vencimientos-sort'];
            $model=$_SESSION['vencimientos-clase'];
            $columnas=$_SESSION['vencimientos-columnas'];

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

            $criteria= $_SESSION['vencimientos-criteria'];
            $sort=$_SESSION['vencimientos-sort'];
            $model=$_SESSION['vencimientos-clase'];
            $columnas=$_SESSION['vencimientos-columnas'];
            $this->widget('application.extensions.EExcelView.EExcelView',
                array(
                    'dataProvider'=> new CActiveDataProvider($model,array('pagination'=>false,'criteria'=>$criteria,'sort'=>$sort,)),
                    'columns'=> $columnas,
                    'exportType'=>'PDF',
                )
            );
         Yii::app()->end();
	}
//        public function diferenciaFechas($fecha1,$fecha2){
//            $start = strtotime($_GET[$fecha1]);
//            $end = strtotime($_GET[$fecha2]);
//            $diferencia = $end - $start;
//            $dif_dias = round($diferencia / 86400); // En días
//            $dif_horas = round($diferencia / 3600); // En horas
//        }
	public function actionAdmin()
	{
            $model=new Vencimientos('search');
            $model->unsetAttributes();
            $xvencer=Vencimientos::model()->findAll();
            $mensaje = "";
           
//            foreach ($xvencer as $x){
//                $hoy = date("Y-m-d"); 
//                $fechaLimite=new DateTime(Varios::dateconvert($x->fechaLimite,1));
//                $segundos=strtotime($fechaLimite->format('Y-m-d')) - strtotime($hoy);
//                $diferencia_dias=intval($segundos/60/60/24);
//                $contador = 0; 
//                while($diferencia_dias >= 0) {
//                    $esferiado = Hs_extrasModule::feriado($fechaLimite->format('Y-m-d'));
//                    if ($esferiado === 1){
////                        echo "Es Feriado<br />";
//                    }else{
//                        $diferencia_dias--;
////                        echo "No es feriado<br />";
//                    }
//                    $nuevafecha = day(strtotime ( '-1 day' , strtotime ($fechaLimite->format('Y-m-d'))));
//                    //$nuevafecha = date("Y-m-d", strtotime("$fechaLimite->format('Y-m-d') -1 day")); 
//                    $fechaLimite = new DateTime ($nuevafecha);
//                    // $fechaLimite->add(new DateInterval('P1D'));
//                    
//                    // $contador = $contador + 1;
//                }
//              
//                if($diferencia_dias <= 10)
//                    $mensaje = $mensaje . "Próximo vencimiento en ". $diferencia_dias . " dias. Vencimiento: ".  $fechaLimite->format('d-m-Y') . " sobre " .$x->tema . "<br />";
//                
//                 Yii::app()->user->setFlash('notice',$mensaje); 
//            }
           
            
            if(isset($_GET['Vencimientos']))
                $model->attributes=$_GET['Vencimientos'];

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
                    'htmlOptions'=>array('width'=>'10%', 'style'=>'text-align: center'),
                ),
              
                array(
                    'name'=>'idTema',
                    'value'=>'$data->tema->tema',
                    'sortable'=>'true',
                    'header'=>'TEMA',
                    'filter'=>CHtml::listData(Temas::model()->findAll(array('order'=>'tema')),'id','tema'),
                    'htmlOptions'=>array('width'=>'15%', 'style'=>'text-align: center'),
                ),
                array(
                    'name'=>'fechaLimite',
                    'value'=>'$data->fechaLimite',
                    'sortable'=>'true',
                    'header'=>'FECHA LIMITE',
                    'htmlOptions'=>array('width'=>'10%', 'style'=>'text-align: center'),
                ),
                array(
                    'name'=>'plazo',
                    'value'=>'$data->plazo',
                    'sortable'=>'true',
                    'header'=>'PLAZO',
                    'htmlOptions'=>array('width'=>'8%', 'style'=>'text-align: center'),
                ),

                /*
                'habil',
                'fechaLimite',
                */
            );

            $_SESSION['vencimientos-columnas']=$columnas;
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
                    $this->_model=Vencimientos::model()->findbyPk($_GET['id']);
                if($this->_model===null)
                    throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
            }
            return $this->_model;
	}

	protected function performAjaxValidation($model)
	{
            if(isset($_POST['ajax']) && $_POST['ajax']==='vencimientos-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
	}
}