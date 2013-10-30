<?php

class ItemController extends CController
{

	/*public function actionIndex() {
		Yii::app()->theme = 'admin';
        Yii::import("xupload.models.XUploadForm");
        $model = new XUploadForm;
        $this -> render('index', array('model' => $model ));
    }*/
        

	public function actionUpload( ) {
	    Yii::import( "xupload.models.XUploadForm" );
	    
	    //Here we define the paths where the files will be stored temporarily
	    //$path = realpath( Yii::app( )->getBasePath( )."/../images/uploads/tmp/" )."/";
	    //$publicPath = Yii::app( )->getBaseUrl( )."user/images/uploads/tmp/";
	    $path = realpath( Yii::app( )->getBasePath( )."/../uploads/images/tmp/" )."/";
	    $publicPath = Yii::app( )->getBaseUrl( )."/uploads/images/tmp/";
	 
	    //This is for IE which doens't handle 'Content-type: application/json' correctly
	    header( 'Vary: Accept' );
	    if( isset( $_SERVER['HTTP_ACCEPT'] ) 
	        && (strpos( $_SERVER['HTTP_ACCEPT'], 'application/json' ) !== false) ) {
	        header( 'Content-type: application/json' );
	    } else {
	        header( 'Content-type: text/plain' );
	    }
	 
	    //Here we check if we are deleting and uploaded file
	    if( isset( $_GET["_method"] ) ) {
	        if( $_GET["_method"] == "delete" ) {
	            if( $_GET["file"][0] !== '.' ) {
	                $file = $path.$_GET["file"];
	                $file_thumb = $path."/thumbs/".$_GET["file"];
	                if( is_file( $file ) ) {
	                    unlink( $file );
	                }
	                if( is_file( $file_thumb ) ) {
	                    unlink( $file_thumb );
	                }
	            }
	            echo json_encode( true );
	        }
	    } else {
	        $model = new XUploadForm;
	        $model->file = CUploadedFile::getInstance( $model, 'file' );
	        //We check that the file was successfully uploaded
	        if( $model->file !== null ) {
	            //Grab some data
	            $model->mime_type = $model->file->getType( );
	            $model->size = $model->file->getSize( );
	            $model->name = $model->file->getName( );
	            //(optional) Generate a random name for our file
	            $filename = md5( Yii::app( )->user->id.microtime( ).$model->name);
	            $filename .= ".".$model->file->getExtensionName( );
	            if( $model->validate( ) ) {
	                //Move our file to our temporary dir
	                $model->file->saveAs( $path.$filename );
	                chmod( $path.$filename, 0777 );
	                //here you can also generate the image versions you need 
	                //using something like PHPThumb
	 				$thumb=Yii::app()->phpThumb->create($path."/".$filename);
					$thumb->resize(100,100);
					$thumb->save($path."/thumbs/$filename");
	 
	                //Now we need to save this path to the user's session
	                if( Yii::app( )->user->hasState( 'images' ) ) {
	                    $userImages = Yii::app( )->user->getState( 'images' );
	                } else {
	                    $userImages = array();
	                }
	                 $userImages[] = array(
	                    "path" => $path.$filename,
	                    //the same file or a thumb version that you generated
	                    "thumb" => $path.$filename,
	                    "filename" => $filename,
	                    'size' => $model->size,
	                    'mime' => $model->mime_type,
	                    'name' => $model->name,
	                );
	                Yii::app( )->user->setState( 'images', $userImages );

	                $this->addImages();
	 
	                //Now we need to tell our widget that the upload was succesfull
	                //We do so, using the json structure defined in
	                // https://github.com/blueimp/jQuery-File-Upload/wiki/Setup
	                echo json_encode( array( array(
	                        "name" => $model->name,
	                        "type" => $model->mime_type,
	                        "size" => $model->size,
	                        "url" => $publicPath.$filename,
	                        "thumbnail_url" => $publicPath."thumbs/$filename",
	                        "delete_url" => $this->createUrl( "upload", array(
	                            "_method" => "delete",
	                            "file" => $filename
	                        ) ),
	                        "delete_type" => "POST"
	                    ) ) );
	            } else {
	                //If the upload failed for some reason we log some data and let the widget know
	                echo json_encode( array( 
	                    array( "error" => $model->getErrors( 'file' ),
	                ) ) );
	                Yii::log( "XUploadAction: ".CVarDumper::dumpAsString( $model->getErrors( ) ),
	                    CLogger::LEVEL_ERROR, "xupload.actions.XUploadAction" 
	                );
	            }
	        } else {
	            throw new CHttpException( 500, "Could not upload file" );
	        }
	    }
	}
	
	private function addImages( ) {
	    //If we have pending images
	    if( Yii::app( )->user->hasState( 'images' ) ) {
	        $userImages = Yii::app( )->user->getState( 'images' );
	        //Resolve the final path for our images
	        $path = Yii::app( )->getBasePath( )."/../uploads/images/";
	        //Create the folder and give permissions if it doesnt exists
	        if( !is_dir( $path ) ) {
	            mkdir( $path );
	            chmod( $path, 0777 );
	        }
	        $image = $userImages[0];
	        
	        //Now lets create the corresponding models and move the files
	        /*foreach( $userImages as $image ) {*/
	            if( is_file( $image["path"] ) ) {
	                if( rename( $image["path"], $path.$image["filename"] ) ) {
	                    chmod( $path.$image["filename"], 0777 );
	                    $img = new Item( );
	                    $img->name = $image["name"];
	                    $img->tipo = $image["mime"];
	                    $img->thumb = 1;
	                    $img->filename = $image["filename"];
	                    $img->size = $image["size"];
	                    $img->path = "/uploads/images/".$image["filename"];
	                    //$img->path = "/uploads/images/{$this->id}/".$image["filename"];
	                   // $img->foreign_id = $image["foreign_id"];
	                    $img->model = $image["model"];
	                    $img->attribute = 'file';
	                    //$objDateTime = new DateTime('NOW');
	                    //$img->created = $objDateTime;
	                    //$img->modified = $objDateTime;
	                    
	                    if( !$img->save( false) ) {
	                        //Its always good to log something
	                        Yii::log( "Could not save Image:\n".CVarDumper::dumpAsString( 
	                            $img->getErrors( ) ), CLogger::LEVEL_ERROR,"" );
                            Yii::trace(CVarDumper::dumpAsString($img->getErrors( )),'vardump');
	                            
	                        //this exception will rollback the transaction
	                        throw new Exception( 'Could not save Image');
	                    }else{
	                    	//echo "Imagen guardada";
	                    }
	                }
	            } else {
	                //You can also throw an execption here to rollback the transaction
	                Yii::log( $image["path"]." is not a file", CLogger::LEVEL_WARNING );
	            }
	        //}
	        //Clear the user's session
	        Yii::app( )->user->setState( 'images', null );
	    }
	}
	
	public function actionDelete($id){
		//Here we check if we are deleting and uploaded file
		//$id = $_POST["id"];
	    //$this->debug($id);
	    aaegh;
        if( isset( $id )) {
        	//if (Item::puedeBorrar($id) ){
        		Item::deleteItemFromDisk($id);
				Item::deteleItemFromDB($id);
				/*echo json_encode( array( 
	                    array( "error" => "Borradooo",
	                ) ) );*/
				//$this->render
        	/*}else{
        		echo json_encode( array( 
	                    array( "error" => "No está permitido borrar!!!!",
                )) );
        	}*/
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
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}