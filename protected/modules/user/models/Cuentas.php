<?php

/**
 * This is the model class for table "{{cuentas}}".
 *
 * The followings are the available columns in table '{{cuentas}}':
 * @property integer $id
 * @property string $titulo
 * @property string $descripcion
 * @property string $precio
 * @property string $prom_activ
 * @property string $prom_stock
 * @property string $prom_dest
 * @property string $desc_trim
 * @property string $desc_sem
 * @property string $desc_ano
 *
 * The followings are the available model relations:
 * @property Profiles[] $profiles
 */
class Cuentas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Cuentas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{cuentas}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('titulo, descripcion, precio, prom_activ, prom_stock, prom_dest, desc_trim, desc_sem, desc_ano', 'required'),
			array('titulo, precio', 'length', 'max'=>45),
			array('descripcion', 'length', 'max'=>255),
			array('prom_activ, prom_stock, prom_dest', 'length', 'max'=>15),
			array('desc_trim, desc_sem, desc_ano', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, titulo, descripcion, precio, prom_activ, prom_stock, prom_dest, desc_trim, desc_sem, desc_ano', 'safe', 'on'=>'search'),
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
			'profiles' => array(self::HAS_MANY, 'Profiles', 'tipocuenta'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'titulo' => 'Titulo',
			'descripcion' => 'Descripcion',
			'precio' => 'Precio',
			'prom_activ' => 'Prom Activ',
			'prom_stock' => 'Prom Stock',
			'prom_dest' => 'Prom Dest',
			'desc_trim' => 'Desc Trim',
			'desc_sem' => 'Desc Sem',
			'desc_ano' => 'Desc Ano',
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
		$criteria->compare('titulo',$this->titulo,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('precio',$this->precio,true);
		$criteria->compare('prom_activ',$this->prom_activ,true);
		$criteria->compare('prom_stock',$this->prom_stock,true);
		$criteria->compare('prom_dest',$this->prom_dest,true);
		$criteria->compare('desc_trim',$this->desc_trim,true);
		$criteria->compare('desc_sem',$this->desc_sem,true);
		$criteria->compare('desc_ano',$this->desc_ano,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}