<?php

/**
 * This is the model class for table "{{items}}".
 *
 * The followings are the available columns in table '{{items}}':
 * @property integer $id
 * @property string $tipo
 * @property string $titulo
 * @property string $descripcion
 * @property integer $thumb
 * @property string $archivo
 * @property string $url
 * @property string $foreign_id
 * @property string $model
 * @property string $created
 * @property string $modified
 *
 * The followings are the available model relations:
 * @property Empresas[] $empresases
 */
class Item extends CActiveRecord
{

	public $file;
	
		/**
         * @var boolean dictates whether to use sha1 to hash the file names
         * along with time and the user id to make it much harder for malicious users
         * to attempt to delete another user's file
        */
        public $secureFileNames = false;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Item the static model class
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
		return '{{items}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name,tipo,filename,size, thumb, path,attribute, foreign_id, model', 'required'),
			array('thumb', 'numerical', 'integerOnly'=>true),
			array('tipo', 'length', 'max'=>12),
			array('name, filename, path', 'length', 'max'=>255),
			array('foreign_id', 'length', 'max'=>11),
			array('model', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, tipo,size , name, thumb, filename, path, foreign_id, model,attribute, created, modified', 'safe', 'on'=>'search'),
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
			//'empresas' => array(self::HAS_MANY, 'Empresas', 'logo_id'),
			'usuario' => array(self::BELONGS_TO, 'Usuarios', 'foreign_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'tipo' => 'Tipo',
			'thumb' => 'Thumb',
			'filename' => 'Filename',
			'size'=>'Size',
			'path' => 'Path',
			'foreign_id' => 'Foreign',
			'model' => 'Model',
			'created' => 'Created',
			'modified' => 'Modified',
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
		$criteria->compare('Size',$this->size,true);
		$criteria->compare('tipo',$this->tipo,true);
		$criteria->compare('thumb',$this->thumb,true);
		$criteria->compare('filename',$this->filename);
		$criteria->compare('path',$this->path,true);
		$criteria->compare('foreign_id',$this->foreign_id,true);
		$criteria->compare('model',$this->model,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	/*public function afterSave( ) {
	    $this->addImages( );
	    parent::afterSave( );
	}*/
	 
		/**
         * Change our filename to match our own naming convention
        * @return bool
        */
        public function beforeValidate() {

            //(optional) Generate a random name for our file to work on preventing
            // malicious users from determining / deleting other users' files
            if($this->secureFileNames)
            {
                $this->filename = sha1( Yii::app( )->user->id.microtime( ).$this->name);
                $this->filename .= ".".$this->file->getExtensionName( );
            }

            return parent::beforeValidate();
        }
	
	
	private function saveItem($item,$path,$filename){
			
		if (isset($item) && isset($path) && isset($filename)){
			
			$model = new Item;
			
			$model->path = $path.$filename;	
            $model->thumb = 1;
            $model->filename = $filename;
            $model->model = 'empresa';
			$model->size = $item->file->getSize( );
			$model->foreign_id = Yii::app()->user->id;
			$model->tipo = $item->mime_type;
            $model->name = $item->name;
            
            $model->save();
            $this->debug($model->attributes);
			
		}else{
			throw new CHttpException( 500, "Could not save the file" );
		}
		}
}