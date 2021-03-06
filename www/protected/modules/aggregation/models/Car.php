<?php

/**
* This is the model class for table "car".
*
* The followings are the available columns in table 'car':
* @property integer $id
* @property string $name
* @property string $type
*/
class Car extends CActiveRecord
{
    /**
    * Returns the static model of the specified AR class.
    * @return Car the static model class
    */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

/**
    * We're overriding this method to fill findAll() and similar method result
    * with proper models.
    *
    * @param array $attributes
    * @return Car
    */
    protected function instantiate($attributes){
        $class = $attributes['type'];
        $model=new $class(null);
        return $model;
    }

    public function beforeSave() {
        if ($this->isNewRecord) {
            $this->type = get_class($this);
        }
        return parent::beforeSave();
    }

    /**
    * @return string the associated database table name
    */
    public function tableName()
    {
        return 'car';
    }

    /**
    * @return array validation rules for model attributes.
    */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name', 'length', 'max'=>45),
            array('type', 'length', 'max'=>9),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, type', 'safe', 'on'=>'search'),
        );
    }

    /**
    * @return array relational rules.
    */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'familyData' => array(self::HAS_ONE, 'FamilyCarData', 'car_id'),
            'sportData' => array(self::HAS_ONE, 'SportCarData', 'car_id'),
        );
    }

    /**
    * @return array customized attribute labels (name=>label)
    */
    public function attributeLabels()
    {
        return array(
            'id' => 'Id',
            'name' => 'Name',
            'type' => 'Type',
        );
    }

    /**
    * Retrieves a list of models based on the current search/filter conditions.
    * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
    */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);

        $criteria->compare('name',$this->name,true);

        $criteria->compare('type',$this->type,true);

        $criteria->with = array('familyData', 'sportData');
        $criteria->together = true;

        return new CActiveDataProvider('Car', array(
            'criteria'=>$criteria,
        ));
    }
}
