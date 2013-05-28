<?php

/**
 * This is the model class for table "{{empresas}}".
 *
 * The followings are the available columns in table '{{empresas}}':
 * @property integer $empresa_id
 * @property integer $user_id
 
 * @property integer $categoria_id
 * @property integer $logo_id
 * @property string $cif
 * @property string $web
 * @property string $twitter
 * @property string $facebook
 * @property string $urlTienda
 * @property string $modificado
 *
 * The followings are the available model relations:
 * @property Items $logo
 * @property Profiles $usuario
 * @property Contactos $contacto
 * @property Category $categoria
 */
class Empresa extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Empresa the static model class
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
		return '{{empresas}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id', 'required'),
			array('user_id, categoria_id, logo_id', 'numerical', 'integerOnly'=>true),
			array('cif', 'length', 'max'=>9),
			array('cif', 'match', 'pattern' => '(X(-|\.)?0?\d{7}(-|\.)?[A-Z]|[A-Z](-|\.)?\d{7}(-|\.)?[0-9A-Z]|\d{8}(-|\.)?[A-Z])'),
			array('web, twitter, facebook, urlTienda', 'length', 'max'=>100),
			array('modificado', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('empresa_id, user_id, categoria_id, logo_id, cif, web, twitter, facebook, urlTienda, modificado', 'safe', 'on'=>'search'),
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
			'logo' => array(self::BELONGS_TO, 'Items', 'logo_id'),
			'usuario' => array(self::BELONGS_TO, 'Usuarios', 'user_id'),
			'contacto' => array(self::BELONGS_TO, 'Contacto', 'contacto_id'),
			'categoria' => array(self::BELONGS_TO, 'Category', 'categoria_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'empresa_id' => 'Empresa',
			'user_id' => 'Usuario',
			'contacto_id' => 'Contacto',
			'categoria_id' => 'Categoria',
			'logo_id' => 'Logo',
			'cif' => 'Cif',
			'web' => 'Web',
			'twitter' => 'Twitter',
			'facebook' => 'Facebook',
			'urlTienda' => 'Url Tienda',
			'modificado' => 'Modificado',
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

		$criteria->compare('empresa_id',$this->empresa_id);
		$criteria->compare('user_id',$this->user_id);
		//$criteria->compare('contacto_id',$this->contacto_id);
		$criteria->compare('categoria_id',$this->categoria_id);
		$criteria->compare('logo_id',$this->logo_id);
		$criteria->compare('cif',$this->cif,true);
		$criteria->compare('web',$this->web,true);
		$criteria->compare('twitter',$this->twitter,true);
		$criteria->compare('facebook',$this->facebook,true);
		$criteria->compare('urlTienda',$this->urlTienda,true);
		$criteria->compare('modificado',$this->modificado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}