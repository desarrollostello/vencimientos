<?php

/**
 * This is the model class for table "temas".
 */
class Temas extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'temas':
	 * @var integer $id
	 * @var string $tema
	 * @var integer $idSector
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return Temas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'temas';
	}

	public function rules()
	{
            return array(
                array('id, tema, idSector', 'required'),
                array('id, idSector', 'numerical', 'integerOnly'=>true),
                array('tema', 'length', 'max'=>150),
                array('id, tema, idSector', 'safe', 'on'=>'search'),
            );
	}

	public function relations()
	{
            return array(
                'sector' => array(self::BELONGS_TO, 'Sectores', 'idSector'),
                'vencimiento' => array(self::HAS_MANY, 'Vencimientos', 'idTema'),
            );
	}


	public function attributeLabels()
	{
            return array(
                'id' => Yii::t('app', 'ID'),
                'tema' => Yii::t('app', 'Tema'),
                'idSector' => Yii::t('app', 'Sector'),
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
                $criteria->with=array('sector');
                $sort->attributes = array(
                    'id'=>array('asc'=>'t.id','desc'=>'t.id desc',),
                    'tema'=>array('asc'=>'t.tema','desc'=>'t.tema desc',),
                    'idSector'=>array('asc'=>'t.idSector','desc'=>'t.idSector desc',),
                );
                //$sort->defaultOrder = 't.xxxxxx';
		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.tema',$this->tema,true);
		$criteria->compare('t.idSector',$this->idSector);

		$data= new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
                        'sort'=>$sort,
		));
                /*se usan para pasar a excel, ver actionExportarExcel*/
                $_SESSION['temas-criteria']=$criteria;
                $_SESSION['temas-sort']=$sort;
                $_SESSION['temas-clase']=get_class($this);
                return $data;
	}

public function afterFind(){

    parent::afterFind();
    //$this->fecha = Varios::dateconvert($this->fecha,2);
	}

public function beforeSave() {

    //$this->fecha = Varios::dateconvert($this->fecha,1);
    //$this->descripcion=strtoupper($this->descripcion);
    // no sacar return , lo usa CActiveRecord.update
    return parent::beforeSave();

}

}
