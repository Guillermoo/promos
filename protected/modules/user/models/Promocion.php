<?php

/**
 * This is the model class for table "{{promociones}}".
 *
 * The followings are the available columns in table '{{promociones}}':
 * @property integer $id
 * @property integer $user_id
 * @property integer $estado
 * @property string $titulo
 * @property string $slug
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
 * @property integer $stock
 *
 * The followings are the available model relations:
 * @property Empresas $empresa
 */
class Promocion extends CActiveRecord
{
	
	const STATUS_ACTIVA=1;
	const STATUS_NOACTIVA=0;
	const STATUS_BORRADOR=2;
	const STATUS_BLOQUEADA=3;//Si es = a 2 es que ti
	const STATUS_VALIDACION=4;//Si es = a 2 es que ti
	
	const STATUS_DESTACADA=1;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Promociones the static model class
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
			array('user_id, titulo, titulo_slug, resumen, descripcion, descripcion_html, fecha_inicio, fecha_fin, fechaCreacion, destacado, precio, condiciones, stock', 'required'),
			array('id,user_id, estado, destacado, stock,precio', 'numerical', 'integerOnly'=>true),
			array('titulo, titulo_slug, resumen', 'length', 'max'=>100),
			array('fecha_inicio,fecha_fin', 'default', 'value' => date('Y-m-d H:i:s'), 'setOnEmpty' => true, 'on' => 'insert'),
			array('fecha_inicio,fecha_fin', 'default', 'value' => '0000-00-00 00:00:00', 'setOnEmpty' => true, 'on' => 'insert'),
			array('descripcion, descripcion_html, condiciones', 'length', 'max'=>1000),
			array('precio, rebaja', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, estado, titulo, titulo_slug, resumen, descripcion, descripcion_html, fecha_inicio, fecha_fin, fechaCreacion, destacado, precio, rebaja, condiciones, stock', 'safe', 'on'=>'search'),
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
			'empresa' => array(self::BELONGS_TO, 'Empresas', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'Empresa',
			'estado' => 'Estado',
			'titulo' => 'Titulo',
			'titulo_slug' => 'titulo_slug',
			'resumen' => 'Resumen',
			'descripcion' => 'Descripcion',
			'descripcion_html' => 'Descripcion Html',
			'fecha_inicio' => 'Fecha Inicio',
			'fecha_fin' => 'Fecha Fin',
			'fechaCreacion' => 'Fecha Creacion',
			'destacado' => 'Destacado',
			'precio' => 'Precio Actual',
			'rebaja' => 'Rebaja',
			'condiciones' => 'Condiciones',
			'stock' => 'Stock',
		);
	}
	
	public function scopes()
    {
        return array(
            /*'propias'=>array(
        		'select' => 'user_id, estado, titulo, titulo_slug, resumen, descripcion, descripcion_html',
                'condition'=>'user_id='.Yii::app()->getModule('user')->user()->empresa->user_id,
            ),*/
            'public'=>array(
            	'select' => 'user_id, titulo, resumen',
                'condition'=>'estado='.self::STATUS_ACTIVA,
            ),
            /*'notactive'=>array(
                'condition'=>'status='.self::STATUS_NOACTIVE,
            ),*/
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
		$criteria->compare('fecha_inicio',$this->fecha_inicio,true);
		$criteria->compare('fecha_fin',$this->fecha_fin,true);
		$criteria->compare('fechaCreacion',$this->fechaCreacion,true);
		$criteria->compare('destacado',$this->destacado);
		$criteria->compare('precio',$this->precio,true);
		$criteria->compare('rebaja',$this->rebaja,true);
		$criteria->compare('stock',$this->stock);
		$criteria->condition='user_id='.Yii::app()->getModule('user')->user()->empresa->user_id;
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function searchPublic()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria=new CDbCriteria;

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('estado',$this->estado);
		$criteria->compare('titulo',$this->titulo,true);
		$criteria->compare('fecha_inicio',$this->fecha_inicio,true);
		$criteria->compare('fecha_fin',$this->fecha_fin,true);
		$criteria->compare('fechaCreacion',$this->fechaCreacion,true);
		$criteria->compare('destacado',$this->destacado);
		$criteria->compare('precio',$this->precio,true);
		$criteria->compare('rebaja',$this->rebaja,true);
		$criteria->compare('stock',$this->stock);
		$criteria->condition='status='.Promocion::STATUS_ACTIVA;
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
}