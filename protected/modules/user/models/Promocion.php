<?php

/**
 * This is the model class for table "{{promociones}}".
 *
 * The followings are the available columns in table '{{promociones}}':
 * @property integer $id
 * @property integer $user_id
 * * @property integer $nbempresa
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
	
	const IS_DESTACADA=1;
    const IS_NODESTACADA=0;

    public $nbempresa;
    public $categoria;
	
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
	public function tableName(){
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
			array('titulo, titulo_slug, resumen,  fecha_inicio, fecha_fin, destacado, precio, categorias_id', 'required'),
			array('id,user_id,categorias_id,estado, destacado, stock,precio', 'numerical', 'integerOnly'=>true),
			array('titulo, titulo_slug, resumen', 'length', 'max'=>100),
			array('fecha_inicio,fecha_fin', 'default', 'value' => date('Y-m-d H:i:s'), 'setOnEmpty' => true),//fechaCreación es un timestamp.. //, 'on' => 'insert'
			//array('fecha_inicio,fecha_fin', 'default', 'value' => '0000-00-00 00:00:00', 'setOnEmpty' => true, 'on' => 'insert'),
			array('descripcion, descripcion_html, condiciones', 'length', 'max'=>1000),
			array('precio, rebaja', 'length', 'max'=>45),
                        array('fecha_inicio,fecha_fin', 'checkFechas'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,user_id,categorias_id,nbempresa, titulo, titulo_slug, resumen, descripcion, descripcion_html, fecha_inicio, fecha_fin, fechaCreacion, destacado, precio, rebaja, condiciones, stock', 'safe', 'on'=>'search'),
		);
	}
        
        /**
     * Valida que las fechas sean correctas tipo fechaInicio > fechaFin.
     */
    public function checkFechas($attribute, $params) {
        //Aquí hay que hacer un foreach para sacar los valores.
        //$this->debug($this->$attribute);
        /*$fechaInicio = $params['fecha_inicio'];
        $fecha_fin = $params['fecha_fin'];

        if ($fechaInicio == $fecha_fin)
            $this->addError($attribute, UserModule::t("Error 1 with dates!."));*/
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'usuario' => array(self::BELONGS_TO, 'User', 'user_id'),
			'categoria' => array(self::BELONGS_TO, 'Categoria', 'categorias_id'),
			'item' => array(self::HAS_ONE, 'Item', 'foreign_id'),
			//'image' => array(self::HAS_MANY, 'Item', 'id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'Empresa ID',
            'nbempresa' => 'Empresa',
        	'categorias_id' => 'Categoria',
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
			'categorias_id' => 'Id de categoria',
			'categoria' => 'Categoria',
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
            
    protected function beforeSave(){
        if ( ($this->isNewRecord) && (!UserModule::isAdmin()) ){//Comprobamos que no sea un admin el que está editando o creando
            $this->user_id = Yii::app()->user->id;
        }
        
        if ($this->destacado == 1)//Primero ponemos todas a 0, y luego al hacer el save se quedará este como destacado
                return $this->reseteaDestacados();
        
        return parent::beforeSave();
    }
    
    /*Función que pone todas las promociones con destacado=0
     */
    private function reseteaDestacados(){
        
        return true;
        
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
            
            $criteria->with = array( 'usuario.empresa' );
            $criteria->compare('id',$this->id);
            //$criteria->compare('user_id',$this->user_id);
            //$criteria->compare('estado',$this->estado);
            $criteria->compare('titulo',$this->titulo,true);
            $criteria->compare('fecha_inicio',$this->fecha_inicio,true);
            $criteria->compare('fecha_fin',$this->fecha_fin,true);
            $criteria->compare('fechaCreacion',$this->fechaCreacion,true);
            $criteria->compare('destacado',$this->destacado);
            $criteria->compare('precio',$this->precio,true);
            $criteria->compare('rebaja',$this->rebaja,true);
            $criteria->compare('stock',$this->stock);
            //$criteria->compare( 'usuario.empresa.nombre', $this->nbempresa,true );
            
            if (UserModule::isCompany()){
                $criteria->params = array(':userid' => Yii::app()->user->id);
                $criteria->addCondition('t.user_id = :userid');
            }
            
            $sort = new CSort();
            $sort->attributes = array(
                    'nbempresa'=>array(
                        'asc'=>'empresa.nombre',
                        'desc'=>'empresa.nombre desc',
                    ),
                    '*',
            );
            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                    'sort'=>$sort,
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
        
        /*
     * Función que devuelve lo items de los desplegables. 
     * Estas listas son estáticas, las dinámicas se hacen de otra forma.
     * */
	public static function itemAlias($type,$code=NULL) {
		$_items = array(
                        /*'PromoStatus' => array(
                            array('label'=>UserModule::t('Active')),
                            array('label'=>UserModule::t('Not active')),
                            array('label'=>UserModule::t('Draft'),'id'=>self::STATUS_BORRADOR),
                            array('label'=>UserModule::t('Bloqued'),'id'=>self::STATUS_BLOQUEADA),
                            array('label'=>UserModule::t('Validation'),'id'=>self::STATUS_VALIDACION),
                        ),*/
			'PromoStatus' => array(
                                
				self::STATUS_ACTIVA => UserModule::t('Active'),
				self::STATUS_NOACTIVA => UserModule::t('Not active'),
				//self::STATUS_BORRADOR => UserModule::t('Draft'),
				//self::STATUS_BLOQUEADA => UserModule::t('Bloqued'),
				//self::STATUS_VALIDACION => UserModule::t('Valiadation'),
			),
			'Destacado' => array(/*Se cargará el combo tipos de usuarios a la hora de crear usuarios desde*/
				self::IS_DESTACADA => UserModule::t('Highlight'),
                                self::IS_NODESTACADA => UserModule::t('No Highlight'),
			),
		);
		if (isset($code))
			return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
		else
			return isset($_items[$type]) ? $_items[$type] : false;
	}
	
}