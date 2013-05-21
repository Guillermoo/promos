<?php

/**
 * This is the model base class for the table "{{empresas}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Empresa".
 *
 * Columns in table "{{empresas}}" available as properties of the model,
 * followed by relations of table "{{empresas}}" available as properties of the model.
 *
 * @property integer $empresa_id
 * @property integer $usuario_id
 * @property integer $contacto_id
 * @property integer $categoria_id
 * @property integer $logo_id
 * @property string $cif
 * @property string $web
 * @property string $twitter
 * @property string $facebook
 * @property string $urlTienda
 * @property string $creado
 * @property string $modificado
 *
 * @property Items $logo
 * @property Profiles $usuario
 * @property Contactos $contacto
 * @property Category $categoria
 */
abstract class BaseEmpresa extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{empresas}}';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Empresa|Empresas', $n);
	}

	public static function representingColumn() {
		return 'cif';
	}

	public function rules() {
		return array(
			array('usuario_id', 'required'),
			array('usuario_id, contacto_id, categoria_id, logo_id', 'numerical', 'integerOnly'=>true),
			array('cif', 'length', 'max'=>15),
			array('web, twitter, facebook, urlTienda', 'length', 'max'=>100),
			array('creado, modificado', 'safe'),
			array('contacto_id, categoria_id, logo_id, cif, web, twitter, facebook, urlTienda, creado, modificado', 'default', 'setOnEmpty' => true, 'value' => null),
			array('empresa_id, usuario_id, contacto_id, categoria_id, logo_id, cif, web, twitter, facebook, urlTienda, creado, modificado', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'logo' => array(self::BELONGS_TO, 'Items', 'logo_id'),
			'usuario' => array(self::BELONGS_TO, 'Profiles', 'usuario_id'),
			'contacto' => array(self::BELONGS_TO, 'Contactos', 'contacto_id'),
			'categoria' => array(self::BELONGS_TO, 'Category', 'categoria_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'empresa_id' => Yii::t('app', 'Empresa'),
			'usuario_id' => null,
			'contacto_id' => null,
			'categoria_id' => null,
			'logo_id' => null,
			'cif' => Yii::t('app', 'Cif'),
			'web' => Yii::t('app', 'Web'),
			'twitter' => Yii::t('app', 'Twitter'),
			'facebook' => Yii::t('app', 'Facebook'),
			'urlTienda' => Yii::t('app', 'Url Tienda'),
			'creado' => Yii::t('app', 'Creado'),
			'modificado' => Yii::t('app', 'Modificado'),
			'logo' => null,
			'usuario' => null,
			'contacto' => null,
			'categoria' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('empresa_id', $this->empresa_id);
		$criteria->compare('usuario_id', $this->usuario_id);
		$criteria->compare('contacto_id', $this->contacto_id);
		$criteria->compare('categoria_id', $this->categoria_id);
		$criteria->compare('logo_id', $this->logo_id);
		$criteria->compare('cif', $this->cif, true);
		$criteria->compare('web', $this->web, true);
		$criteria->compare('twitter', $this->twitter, true);
		$criteria->compare('facebook', $this->facebook, true);
		$criteria->compare('urlTienda', $this->urlTienda, true);
		$criteria->compare('creado', $this->creado, true);
		$criteria->compare('modificado', $this->modificado, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}