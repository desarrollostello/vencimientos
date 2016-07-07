<?php

/**
 * This is the model class for table "vencimientos".
 */
class Vencimientos extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'vencimientos':
	 * @var integer $id
	 * @var string $fecha
	 * @var integer $idCoope
	 * @var string $tema
	 * @var integer $plazo
	 * @var integer $habil
	 * @var string $fechaLimite
         * @var integer $cumplido
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return Vencimientos the static model class
	 */
	public static function model($className=__CLASS__)
	{
            return parent::model($className);
	}

	public function tableName()
	{
            return 'vencimientos';
	}

	public function rules()
	{
            return array(
                array('fecha, idCoope, plazo, usuario', 'required'),
                array('idCoope, plazo, idTema, habil, cumplido, usuario', 'numerical', 'integerOnly'=>true),
                array('fecha, fechaLimite', 'length', 'max'=>10),
                array('id, fecha, cumplido, idCoope, idTema, observaciones, plazo, habil, fechaLimite, usuario', 'safe', 'on'=>'search'),
            );
	}

	public function relations()
	{
            return array(
                'coope' => array(self::BELONGS_TO, 'Cooperativas', 'idCoope'),
                'tema' => array(self::BELONGS_TO, 'Temas', 'idTema'),
            );
	}
        
	public function attributeLabels()
	{
            return array(
                'id' => Yii::t('app', 'ID'),
                'fecha' => Yii::t('app', 'Fecha'),
                'idCoope' => Yii::t('app', 'Coope'),
                'idTema' => Yii::t('app', 'Tema'),
                'tema' => Yii::t('app', 'Tema'),
                'plazo' => Yii::t('app', 'Plazo'),
                'habil' => Yii::t('app', 'Habil'),
                'fechaLimite' => Yii::t('app', 'Fecha Limite'),
                'cumplido' => Yii::t('app', 'Cumplido'),
                'usuario' => Yii::t('app', 'Usuario'),
                'observaciones' => Yii::t('app', 'Observaciones'),
            );
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
        public function diferenciaFechas(){
            $start = strtotime($this->fecha);
            $end = strtotime($this->fechaLimite);
            $diferencia = $end - $start;
            $dif_dias = round($diferencia / 86400); // En días
            $dif_horas = round($diferencia / 3600); // En horas
            echo "Diferencia: ". $dif_dias;
        }
	public function search()
	{
            $criteria=new CDbCriteria;
            $sort = new CSort();
            $sort->attributes = array(
                'id'=>array('asc'=>'t.id','desc'=>'t.id desc',),
                'fecha'=>array('asc'=>'t.fecha','desc'=>'t.fecha desc',),
                'idCoope'=>array('asc'=>'t.idCoope','desc'=>'t.idCoope desc',),
                'idTema'=>array('asc'=>'t.idTema','desc'=>'t.idTema desc',),
                'plazo'=>array('asc'=>'t.plazo','desc'=>'t.plazo desc',),
                'habil'=>array('asc'=>'t.habil','desc'=>'t.habil desc',),
                'fechaLimite'=>array('asc'=>'t.fechaLimite','desc'=>'t.fechaLimite desc',),
                'cumplido'=>array('asc'=>'t.cumplido','desc'=>'t.cumplido desc',),
                'usuario'=>array('asc'=>'t.usuario','desc'=>'t.usuario desc',),
            );
            
            // $sort->defaultOrder = 't.fechaLimite';
             $criteria->with=array('coope','tema');
            $criteria->compare('t.id',$this->id);
            $criteria->compare('date_FORMAT( t.fecha,\'%d/%m/%Y\' )',$this->fecha,true);
            $criteria->compare('coope.cooperativa',$this->idCoope, true);
            $criteria->compare('t.idTema',$this->idTema);
            $criteria->compare('t.plazo',$this->plazo);
            $criteria->compare('t.habil',$this->habil);
            $criteria->compare('t.observaciones',$this->observaciones,true);
//            if ($this->fechaLimite <> NULL)
//                $criteria->compare('date_FORMAT( t.fechaLimite,\'%d/%m/%Y\' )',$this->fechaLimite,true);
            $criteria->compare('t.cumplido',$this->cumplido);
            
            if(!Yii::app()->user->checkAccess('administradores')){
                $criteria->compare('t.usuario',Yii::app()->user->id);
            }
            $data= new CActiveDataProvider(get_class($this), array(
                'criteria'=>$criteria,
                'sort'=>$sort,
            ));
            /*se usan para pasar a excel, ver actionExportarExcel*/
            $_SESSION['vencimientos-criteria']=$criteria;
            $_SESSION['vencimientos-sort']=$sort;
            $_SESSION['vencimientos-clase']=get_class($this);
            return $data;
	}

public function afterFind(){
    parent::afterFind();
//    $this->fecha = Varios::dateconvert($this->fecha,2);
//    $this->fechaLimite = Varios::dateconvert($this->fechaLimite,2);
    $this->fecha = Yii::app()->dateformatter->format("dd-MM-yyyy",$this->fecha);
    $this->fechaLimite = Yii::app()->dateformatter->format("dd-MM-yyyy",$this->fechaLimite);
    
}

public function beforeSave() {
//    $this->fecha = Varios::dateconvert($this->fecha,1);
//    $this->fechaLimite = Varios::dateconvert($this->fechaLimite,1);
    //$this->descripcion=strtoupper($this->descripcion);
    $this->fecha = Yii::app()->dateformatter->format("yyyy-MM-dd",$this->fecha);
    $this->fechaLimite = Yii::app()->dateformatter->format("yyyy-MM-dd",$this->fechaLimite);
    // no sacar return , lo usa CActiveRecord.update
    return parent::beforeSave();
}

}
