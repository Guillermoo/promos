<?php

/**
 * This is the model class for table "{{promociones}}".
 *
 * The followings are the available columns in table '{{promociones}}':
 * @property integer $id
 * @property integer $user_id
 * @property integer $estado
 * @property string $titulo
 * @property string $titulo_slug
 * @property string $resumen
 * @property string $descripcion
 * @property string $descripcion_html
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property string $fechaCreacion
 * @property integer $destacado
 * @property string $precio
 * @property string $rebaja
 * @property string $condiciones
 * @property string $stock
 * @property integer $categorias_id
 *
 * The followings are the available model relations:
 * @property Compras[] $comprases
 * @property Users $user
 * @property Categorias $categorias
 */
class Promocion extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Promocion the static model class
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
		return '{{promociones}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, estado, titulo, titulo_slug, resumen, descripcion, descripcion_html, fecha_inicio, fecha_fin, fechaCreacion, destacado, precio, rebaja, condiciones, stock', 'required'),
			array('user_id, estado, destacado, categorias_id', 'numerical', 'integerOnly'=>true),
			array('titulo, titulo_slug, resumen', 'length', 'max'=>100),
			array('descripcion, descripcion_html, condiciones', 'length', 'max'=>1000),
			array('precio, rebaja', 'length', 'max'=>45),
			array('stock', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, estado, titulo, titulo_slug, resumen, descripcion, descripcion_html, fecha_inicio, fecha_fin, fechaCreacion, destacado, precio, rebaja, condiciones, stock, categorias_id', 'safe', 'on'=>'search'),
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
			'comprases' => array(self::HAS_MANY, 'Compras', 'id_promo'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'categorias' => array(self::BELONGS_TO, 'Categorias', 'categorias_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'estado' => 'Estado',
			'titulo' => 'Titulo',
			'titulo_slug' => 'Titulo Slug',
			'resumen' => 'Resumen',
			'descripcion' => 'Descripcion',
			'descripcion_html' => 'Descripcion Html',
			'fecha_inicio' => 'Fecha Inicio',
			'fecha_fin' => 'Fecha Fin',
			'fechaCreacion' => 'Fecha Creacion',
			'destacado' => 'Destacado',
			'precio' => 'Precio',
			'rebaja' => 'Rebaja',
			'condiciones' => 'Condiciones',
			'stock' => 'Stock',
			'categorias_id' => 'Categorias',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('estado',$this->estado);
		$criteria->compare('titulo',$this->titulo,true);
		$criteria->compare('titulo_slug',$this->titulo_slug,true);
		$criteria->compare('resumen',$this->resumen,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('descripcion_html',$this->descripcion_html,true);
		$criteria->compare('fecha_inicio',$this->fecha_inicio,true);
		$criteria->compare('fecha_fin',$this->fecha_fin,true);
		$criteria->compare('fechaCreacion',$this->fechaCreacion,true);
		$criteria->compare('destacado',$this->destacado);
		$criteria->compare('precio',$this->precio,true);
		$criteria->compare('rebaja',$this->rebaja,true);
		$criteria->compare('condiciones',$this->condiciones,true);
		$criteria->compare('stock',$this->stock,true);
		$criteria->compare('categorias_id',$this->categorias_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}