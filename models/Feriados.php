<?php

/**
 * This is the model class for table "feriados".
 */
class Feriados extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'feriados':
	 * @var integer $id
	 * @var integer $anio
	 * @var string $fecha
	 * @var integer $repite
	 * @var string $pasaAfecha
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return Feriados the static model class
	 */
	public static function model($className=__CLASS__)
	{
            return parent::model($className);
	}

	public function tableName()
	{
            return 'feriados';
	}

	public function rules()
	{
            return array(
                array('fecha, idCoope', 'required'),
                array('idCoope', 'numerical', 'integerOnly'=>true),
                array('fecha', 'length', 'max'=>10),
                array('id, fecha, idCoope', 'safe', 'on'=>'search'),
            );
	}

	public function relations()
	{
            return array(
                'coope' => array(self::BELONGS_TO, 'Cooperativas', 'idCoope'),
            );
	}


	public function attributeLabels()
	{
            return array(
                'id' => Yii::t('app', 'ID'),
                'fecha' => Yii::t('app', 'Fecha'),
                'cooperativa' => Yii::t('app', 'Cooperativa'),
            );
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
            $criteria=new CDbCriteria;
            $sort = new CSort();
            $sort->attributes = array(
                'id'=>array('asc'=>'t.id','desc'=>'t.id desc',),
                'fecha'=>array('asc'=>'t.fecha','desc'=>'t.fecha desc',),
                'idCoope'=>array('asc'=>'t.idCoope','desc'=>'t.idCoope desc',),
            );
            //$sort->defaultOrder = 't.xxxxxx';
            $criteria->with=array('coope');
            $criteria->compare('t.id',$this->id);
            $criteria->compare('date_FORMAT( t.fecha,\'%d/%m/%Y\' )',$this->fecha,true);
            $criteria->compare('t.idCoope',$this->idCoope);
        
            $data= new CActiveDataProvider(get_class($this), array(
                'criteria'=>$criteria,
                'sort'=>$sort,
            ));
            /*se usan para pasar a excel, ver actionExportarExcel*/
            $_SESSION['feriados-criteria']=$criteria;
            $_SESSION['feriados-sort']=$sort;
            $_SESSION['feriados-clase']=get_class($this);

            return $data;
	}

public function afterFind(){
    parent::afterFind();
//    $this->fecha = Varios::dateconvert($this->fecha,2);
//    $this->fecha = Varios::dateconvert($this->paseAfecha,2);
    $this->fecha = Yii::app()->dateformatter->format("dd-MM-yyyy",$this->fecha);
}

public function beforeSave() {
    $this->fecha = Yii::app()->dateformatter->format("yyyy-MM-dd",$this->fecha);
//    $this->fecha = Varios::dateconvert($this->fecha,1);
//    $this->fecha = Varios::dateconvert($this->paseAfecha,1);
    //$this->descripcion=strtoupper($this->descripcion);
    // no sacar return , lo usa CActiveRecord.update
    return parent::beforeSave();
}

}
