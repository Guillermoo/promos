<?php
class XUploadForm extends CFormModel
{
        public $file;
        public $mime_type;
        public $size;
        public $name;
        public $filename;

        /**
         * @var boolean dictates whether to use sha1 to hash the file names
         * along with time and the user id to make it much harder for malicious users
         * to attempt to delete another user's file
        */
        public $secureFileNames = false;

        /**
         * Declares the validation rules.
         * The rules state that username and password are required,
         * and password needs to be authenticated.
         */
        public function rules()
        {
                return array(
                        array('file', 'file'),
                );
        }

        /**
         * Declares attribute labels.
         */
        public function attributeLabels()
        {
                return array(
                        'file'=>'Asignar imagen',
                );
        }

        public function getReadableFileSize($retstring = null) {
                // adapted from code at http://aidanlister.com/repos/v/function.size_readable.php
                $sizes = array('bytes', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');

                if ($retstring === null) { $retstring = '%01.2f %s'; }

                $lastsizestring = end($sizes);

                foreach ($sizes as $sizestring) {
                        if ($this->size < 1024) { 
                            break; 
                        }
                        if ($sizestring != $lastsizestring) { $this->size /= 1024; }
                }
                if ($sizestring == $sizes[0]) { $retstring = '%01d %s'; } // Bytes aren't normally fractional
                return sprintf($retstring, $this->size, $sizestring);
        }

        /**
         * A stub to allow overrides of thumbnails returned
         * @since 0.5
         * @author acorncom
         * @return string thumbnail name (if blank, thumbnail won't display)
         */
        public function getThumbnailUrl($publicPath) {
            return $publicPath.$this->filename;
        }

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

        public function afterSave( ) {
            $this->addImages( );
            parent::afterSave( );
        }
         
        public function addImages( ) {
            //If we have pending images
            if( Yii::app( )->user->hasState( 'images' ) ) {                
                $userImages = Yii::app( )->user->getState( 'images' );
                //Resolve the final path for our images
                $path = Yii::app( )->getBasePath( )."/../images/uploads/{$this->id}/";
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
                            $img->source = "/images/uploads/{$this->id}/".$image["filename"];
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
