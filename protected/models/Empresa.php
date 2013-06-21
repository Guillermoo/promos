<?php

/**
 * This is the model class for table "{{empresas}}".
 *
 * The followings are the available columns in table '{{empresas}}':
 * @property integer $id
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
			array('cif', 'length', 'max'=>9,'message' => UserModule::t("9 size."), 'except' => 'admin'),
			array('nombre,cif','required','message' => UserModule::t("{attribute} name is required."), 'except' => 'admin'),
			array('cif', 'match', 'pattern' => '(X(-|\.)?0?\d{7}(-|\.)?[A-Z]|[A-Z](-|\.)?\d{7}(-|\.)?[0-9A-Z]|\d{8}(-|\.)?[A-Z])','message' => UserModule::t("The cif must be valid."), 'except' => 'admin'),
			array('nombre,nombre_slug,web, twitter, facebook, urlTienda', 'length', 'max'=>100),
			array('modificado', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('nombre,nombre_slug, user_id, cif, web, twitter, facebook, urlTienda, modificado', 'safe', 'on'=>'search'),
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
			'usuario' => array(self::BELONGS_TO, 'Usuarios', 'user_id'),
			//'cuenta' => array(self::HAS_ONE, 'Cuenta', 'id'),
			'categoria' => array(self::MANY_MANY, 'Category', 'tbl_emp_cat(empresa_id,categoria_id)'),
			//(G)O la de arriba o la de abajo, no las dos
			'empCat' => array(self::HAS_MANY, 'EmpCat', 'empresa_id'),
			//'promociones' => array(self::HAS_MANY,'Promocion','empresa_id'),
		);
	}
	
	/*public function defaultScope()
    {
        return CMap::mergeArray(Yii::app()->getModule('user')->defaultScope,array(
            'alias'=>'empresa',
            'select' => 'empresa.id,empresa.user_id, empresa.nombre, empresa.nombre_slug, empresa.cif, empresa.modificado',
        ));
    }*/

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Empresa',
			'user_id' => 'User name',
			'nombre' => 'Name',
			'nombre_slug' => 'Friendly name',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('nombre_slug',$this->nombre_slug,true);
		$criteria->compare('cif',$this->cif,true);
		/*$criteria->compare('web',$this->web,true);
		$criteria->compare('twitter',$this->twitter,true);
		$criteria->compare('facebook',$this->facebook,true);
		$criteria->compare('urlTienda',$this->urlTienda,true);*/
		$criteria->compare('modificado',$this->modificado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	//Comprobamos que siendo un usuario válido no haga cambios raros.
	/*
	 * Por ejemplo: Que haya dejado nulos los campos mínimos para cobrarle.
	 * */
	protected function afterSave(){
        	if (!$this->isNewRecord){
	        	/*$model = User::model()->findByPk($this->user_id);
	        	if ($model->status=3){
	        		//Hay que descomentar esta parte!!!!!
	        		if(User::tieneCamposMinimosRellenos($model) != true){
						$model->status=2;
						$model->save();
					}
					$model->save();
	        	}*/
        	}
			parent::afterSave();
	}
        
	/*
	 * Comprobamos si es una cuenta con todo correcto pero por si lo que fuera
	 * hay que cambiar el estado
	 * También se guarda el nombre de la empresa con su slug
	 * */
	/*protected function beforeSave(){
		/*if (!$this->isNewRecord){
			$model = User::model()->findByPk($this->user_id);
        	if ($this->nombre != "")
				$this->nombre_slug = UserModule::getSlug($this->nombre);
			
			//$this->modificado = time();
		}
		parent::beforeSave();
	}*/
	
	public static function getEmpCategories()
	{
	    //$ids=array();
	    $list = new CList();
	    foreach($this->categoria as $c)
	        //$ids[]=$c->id;
	        $list.add($c->id);
	    $this->debug($list);
	    return $list;
	}
	
	public static function setEmpCategories($values)
	{
	    // 1. delete all related rows in item_category (use a AR for this table)
	
	    // 2. create new links:
	    foreach($values as $id)
	    {
	        $r=new ItemCategory;
	        $r->category_id=$id;
	        $r->item_id=$this->id;
	    }
	}
	
/* Used to debug variables*/
    protected function Debug($var){
        $bt = debug_backtrace();
        $dump = new CVarDumper();
        $debug = '<div style="display:block;background-color:gold;border-radius:10px;border:solid 1px brown;padding:10px;z-index:10000;"><pre>';
        $debug .= '<h4>function: '.$bt[1]['function'].'() line('.$bt[0]['line'].')'.'</h4>';
        $debug .=  $dump->dumpAsString($var);
        $debug .= "</pre></div>\n";
        Yii::app()->params['debugContent'] .=$debug;
    }
}