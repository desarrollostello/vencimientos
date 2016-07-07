<?php

/**
 * This is the model class for table "sectores".
 */
class Sectores extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'sectores':
	 * @var integer $id
	 * @var string $sector
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return Sectores the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'sectores';
	}

	public function rules()
	{
		return array(
			array('id, sector', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('sector', 'length', 'max'=>200),
			array('id, sector', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'temases' => array(self::HAS_MANY, 'Temas', 'idSector'),
		);
	}


	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('app', 'ID'),
			'sector' => Yii::t('app', 'Sector'),
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
					'sector'=>array('asc'=>'t.sector','desc'=>'t.sector desc',),
                );
                //$sort->defaultOrder = 't.xxxxxx';

		$criteria->compare('t.id',$this->id);

		$criteria->compare('t.sector',$this->sector,true);


		$data= new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
                        'sort'=>$sort,
		));

                /*se usan para pasar a excel, ver actionExportarExcel*/
                $_SESSION['sectores-criteria']=$criteria;
                $_SESSION['sectores-sort']=$sort;
                $_SESSION['sectores-clase']=get_class($this);

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
