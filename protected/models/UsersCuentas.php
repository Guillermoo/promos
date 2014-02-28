<?php

/**
 * This is the model class for table "{{users_cuentas}}".
 *
 * The followings are the available columns in table '{{users_cuentas}}':
 * @property integer $id
 * @property integer $id_usuario
 * @property integer $id_cuenta
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property double $cant_pagado
 * @property integer $estado
 *
 * The followings are the available model relations:
 * @property Users $idUsuario
 * @property Cuentas $idCuenta
 */
class UsersCuentas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UsersCuentas the static model class
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
		return '{{users_cuentas}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_usuario, id_cuenta', 'required'),
			array('id, id_usuario, id_cuenta, estado', 'numerical', 'integerOnly'=>true),
			array('cant_pagado', 'numerical'),
			array('fecha_fin', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_usuario, id_cuenta, fecha_inicio, fecha_fin, cant_pagado, estado, referencia', 'safe', 'on'=>'search'),
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
			'idUsuario' => array(self::BELONGS_TO, 'Users', 'id_usuario'),
			'idCuenta' => array(self::BELONGS_TO, 'Cuentas', 'id_cuenta'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_usuario' => 'Id Usuario',
			'id_cuenta' => 'Id Cuenta',
			'fecha_inicio' => 'Fecha Inicio',
			'fecha_fin' => 'Fecha Fin',
			'cant_pagado' => 'Cant Pagado',
			'estado' => 'Estado',
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
		$criteria->compare('id_usuario',$this->id_usuario);
		$criteria->compare('id_cuenta',$this->id_cuenta);
		$criteria->compare('fecha_inicio',$this->fecha_inicio,true);
		$criteria->compare('fecha_fin',$this->fecha_fin,true);
		$criteria->compare('cant_pagado',$this->cant_pagado);
		$criteria->compare('estado',$this->estado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}