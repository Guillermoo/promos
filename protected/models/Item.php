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
 * @property string $orden
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
			array('titulo, descripcion, thumb, archivo, url, orden, foreign_id, model, created, modified', 'required'),
			array('thumb', 'numerical', 'integerOnly'=>true),
			array('tipo', 'length', 'max'=>10),
			array('titulo, archivo, url', 'length', 'max'=>255),
			array('orden, foreign_id', 'length', 'max'=>11),
			array('model', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, tipo, titulo, descripcion, thumb, archivo, url, orden, foreign_id, model, created, modified', 'safe', 'on'=>'search'),
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
			'empresases' => array(self::HAS_MANY, 'Empresas', 'logo_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'tipo' => 'Tipo',
			'titulo' => 'Titulo',
			'descripcion' => 'Descripcion',
			'thumb' => 'Thumb',
			'archivo' => 'Archivo',
			'url' => 'Url',
			'orden' => 'Orden',
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
		$criteria->compare('tipo',$this->tipo,true);
		$criteria->compare('titulo',$this->titulo,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('thumb',$this->thumb);
		$criteria->compare('archivo',$this->archivo,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('orden',$this->orden,true);
		$criteria->compare('foreign_id',$this->foreign_id,true);
		$criteria->compare('model',$this->model,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	public function afterSave( ) {
	    $this->addImages( );
	    parent::afterSave( );
	}
	 
	public function addImages( ) {
	    //If we have pending images
	    if( Yii::app( )->user->hasState( 'images' ) ) {
	        $userImages = Yii::app( )->user->getState( 'images' );
	        //Resolve the final path for our images
	        $path = Yii::app( )->getBasePath( )."/../uploads/images/{$this->id}/";
	        //Create the folder and give permissions if it doesnt exists
	        if( !is_dir( $path ) ) {
	            mkdir( $path );
	            chmod( $path, 0777 );
	        }
	 
	        //Now lets create the corresponding models and move the files
	        foreach( $userImages as $image ) {
	            if( is_file( $image["path"] ) ) {
	                if( rename( $image["path"], $path.$image["filename"] ) ) {
	                    chmod( $path.$image["filename"], 0777 );
	                    $img = new Item( );
	                    $img->size = $image["size"];
	                    $img->mime = $image["mime"];
	                    $img->name = $image["name"];
	                    $img->source = "/uploads/images/{$this->id}/".$image["filename"];
	                    $img->somemodel_id = $this->id;
	                    if( !$img->save( ) ) {
	                        //Its always good to log something
	                        Yii::log( "Could not save Image:\n".CVarDumper::dumpAsString( 
	                            $img->getErrors( ) ), CLogger::LEVEL_ERROR );
	                        //this exception will rollback the transaction
	                        throw new Exception( 'Could not save Image');
	                    }
	                }
	            } else {
	                //You can also throw an execption here to rollback the transaction
	                Yii::log( $image["path"]." is not a file", CLogger::LEVEL_WARNING );
	            }
	        }
	        //Clear the user's session
	        Yii::app( )->user->setState( 'images', null );
	    }
	}
}