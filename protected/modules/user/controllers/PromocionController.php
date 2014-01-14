<?php

class PromocionController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='column2';
	
	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','delete','promosActivas','promosStock','promosDestacadas'),
				//'users'=>array(Yii::app()->getModule('user')->user()->username),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
				'users'=>UserModule::getAdmins(),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Manages all models.
	 */
    /**
     * Manages all models.
     */
    public function actionIndex()
    {
        $this->_model=new Promocion('search');
        
        $this->_model->unsetAttributes();  // clear any default values
        if(isset($_GET['Promocion']))
            $this->_model->attributes=$_GET['Promocion'];

        $this->render('admin',array(
            'model'=>$this->_model,
        ));
    }
    
    public function actionAdmin()
    {
            $this->_model=new Promocion('search');
            
            $this->_model->unsetAttributes();  // clear any default values
            if(isset($_GET['Promocion']))
                    $this->_model->attributes=$_GET['Promocion'];

            $this->render('admin',array(
                    'model'=>$this->_model,
            ));
    }
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		//$dataProvider=new CActiveDataProvider('Promocion');
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate(){
        //(H)comprobar que el usuario puede crear una nueva promoción
        //(H)si el status == 3 es que ya ha pagado y, por tanto, habrá que comprobar qué tipo de cuenta tiene y cuántas promos en stock, activas y destacadas tiene, luego comprobar qué tipo de promoción es esta que quiere insertar y ver si puede hacerlo
        //(H)si el status == 2 es que ha seleccionado un tipo de cuenta de pago pero todavía no ha pagado, por lo que no debe poder crear una nueva promoción
     
        $usuario = User::model()->findByPk(Yii::app()->user->id);
            
        if($usuario->status == 2){                
            $this->render('_hadtopay');
            return;
        }
         
        //compruebo que puede crear una nueva promo de el tipo seleccionado
        $datosCuenta = Cuenta::model()->find('id=:id',
            array(
                ':id'=>$usuario->profile->tipocuenta
                ));
        $maxPromos = $datosCuenta->prom_activ + $datosCuenta->prom_stock;
        $numPromos = Promocion::model()->countByAttributes(array(
            'user_id'=> Yii::app()->user->id
                ));

        if($numPromos == $maxPromos){
            echo $this->renderPartial('_denied');
        }

        $numPromosActivas = Promocion::model()->countByAttributes(array(
            'user_id'=> Yii::app()->user->id, 'estado'=>1
        ));
        $numPromosStock = Promocion::model()->countByAttributes(array(
            'user_id'=> Yii::app()->user->id, 'estado'=>0
        ));          
        $numPromosDest = Promocion::model()->countByAttributes(array(
            'user_id'=> Yii::app()->user->id, 'destacado'=>1
        ));                
               

        $model=new Promocion;
        $model->scenario = "insert";

        $this->performAjaxValidation(array($model));

        /***  COMPROBACIÓN DE QUE SE PUEDE ****/        
        if(isset($_POST['Promocion'])){
            $model->attributes=$_POST['Promocion'];

            if($datosCuenta->prom_activ <= $numPromosActivas && $model->estado == '1'){
                Yii::app()->user->setFlash('error',UserModule::t("No puedes crear más promociones <b>ACTIVAS</b>"));
                $this->redirect('create',array(
                'model'=>$model,
                ));
        }
        if($datosCuenta->prom_stock <= $numPromosStock && $model->estado == '0'){
            Yii::app()->user->setFlash('error',UserModule::t("No puedes crear más promociones en <b>STOCK</b>"));
            $this->redirect('create',array(
                'model'=>$model,
                ));
        }

        if($datosCuenta->prom_dest <= $numPromosDest){
            $model->destacado = 0;
            Yii::app()->user->setFlash('error',UserModule::t("No se ha marcado como destacada porque ha alcanzado el límite de destacadas."));
        }
    /**********************************/
            $this->setCamposSecundarios($model);

            if($model->save()){
                Yii::app()->user->setFlash('success',UserModule::t("Promotion created."));
                //$this->redirect(array('mispromociones'));
                $this->redirect(Yii::app()->getModule('user')->promocionesUrl);
            }
            else{
                Yii::app()->user->setFlash('error',UserModule::t("Error creating the promotion."));
            }
        }

        //Esto se ejecuta si no se ha rellenado el formulario para crear la promocion

        Yii::import("xupload.models.XUploadForm");
        $image = new XUploadForm;
        
        $item = new Item;
        
        //Leer los tipos de categoría a los que puede pertenecer la promoción
        $categorias=new CActiveDataProvider('Categoria');

        $this->render('create',array(
                'model'=>$model,'item'=>$item,'image'=>$image,'cuenta'=>$usuario->profile->tipocuenta, 'categorias'=>$categorias
        ));	
    }
	
/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id=null){
            
        //adsgh;
        $this->_model=$this->loadModel($id);
        
        //$image = new Item();
       /* $image=Item::model()->find(
              array(
              'condition'=>'foreign_id='.$id.' AND model="promo"',
         )); */

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation(array($this->_model));

        if(isset($_POST['Promocion']))
        {
            $this->_model->attributes=$_POST['Promocion'];

            if($this->_model->save())
                Yii::app()->user->setFlash('success',UserModule::t("Promotion updated."));
            else
                Yii::app()->user->setFlash('error',UserModule::t("Error updating the promotion."));
            
            $this->redirect(array('update','id'=>$this->_model->id));
        }
        //$this->debug($this->_model->id);
        $image = Item::model()->find('foreign_id='.$this->_model->id);
    
        if($image==null){       
            $image = $this->obtenImageForm($this->_model->usuario->item);    
        }


        /*if (isset($this->_model->item)){
            $imageForm = $this->obtenImageForm($this->_model->item);    
        }else{
            Yii::import("xupload.models.XUploadForm");
            $imageForm = new Item;
        }*/
        //$this->debug($this->_model->item);
        $this->render('update',array('model'=>$this->_model,
            'image'=>$image,
        ));

	}

    private function obtenImageForm($item=null){
    Yii::import("xupload.models.XUploadForm");
    $imageForm = new XUploadForm;

    if (isset($item)){
        $imageForm->name = $item->filename;
        //$imageForm->file = $item->path;
        $imageForm->file = CUploadedFile::getInstance( $item, 'file' );
        $imageForm->mime_type = $item->tipo;
        $imageForm->size = $item->size;
        $imageForm->filename = $item->filename;
        $path =  Yii::app( )->getBaseUrl( );

        echo json_encode( array( array(
            "name" => $imageForm->name,
            "type" => $imageForm->mime_type,
            "size" => $imageForm->size,
            "url" =>  $path.$item->path,
            "thumbnail_url" => $path."thumbs/".$item->filename,
            "delete_url" => $this->createUrl( "upload", array(
                "_method" => "delete",
                "file" => $item->filename
            ) ),
            "delete_type" => "POST"
        ) ) );
    }
    
    //Para cargar/gestionar el logo
    return $imageForm ;

}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id){
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
        

    private function setCamposSecundarios($model=null){
        if(isset($model)){
            //$this->_model->user_id = Yii::app()->user->id;
            //$model->estado = 1; //(H) esto por qué??
            $model->titulo_slug = UserModule::to_slug($model->titulo) ;
        }
    }

    public function actionPromosActivas(){
        if(Yii::app()->user->id){            

            //Una forma de recoger los datos
            /*$this->_model = Promocion::model()->findAllByAttributes(array(
                    'user_id'=> Yii::app()->user->id), 'estado =:estado',
                    array(':estado'=>1)
                );*/

            //Otra forma de recoger los datos
            $dataProvider=new CActiveDataProvider('Promocion', array(
                    'criteria'=>array(
                    'condition'=>'(estado=1 OR estado=2) AND user_id ='.Yii::app()->user->id

                    )
            ));
        }else{
            throw new CHttpException(404,'Error al procesar la petición. Por favor, inténtelo de nuevo más tarde. Si el problema persiste contacte con el administrador.');
        }

        $this->render('activas',array('dataProvider'=>$dataProvider));

    }

    public function actionPromosStock(){
        if(Yii::app()->user->id){            

            //Una forma de recoger los datos
            /*$this->_model = Promocion::model()->findAllByAttributes(array(
                    'user_id'=> Yii::app()->user->id), 'estado =:estado',
                    array(':estado'=>1)
                );*/

            //Otra forma de recoger los datos
            $dataProvider=new CActiveDataProvider('Promocion', array(
                    'criteria'=>array(
                    'condition'=>'estado=0 AND user_id ='.Yii::app()->user->id

                    )
            ));
        }else{
            throw new CHttpException(404,'Sorry, we cannot process your request. Try again
                            later.');
        }

        $this->render('stock',array('dataProvider'=>$dataProvider));

    }

     public function actionPromosDestacadas(){
        if(Yii::app()->user->id){            

            //Una forma de recoger los datos
            /*$this->_model = Promocion::model()->findAllByAttributes(array(
                    'user_id'=> Yii::app()->user->id), 'estado =:estado',
                    array(':estado'=>1)
                );*/

            //Otra forma de recoger los datos
            $dataProvider=new CActiveDataProvider('Promocion', array(
                    'criteria'=>array(
                    'condition'=>'destacado=1 AND user_id ='.Yii::app()->user->id

                    )
            ));
        }else{
            throw new CHttpException(404,'Sorry, we cannot process your request. Try again
                            later.');
        }

        $this->render('destacadas',array('dataProvider'=>$dataProvider));

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

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Promocion the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
            //$user_id = Yii::app()->user->id;
            //$this->_model=Promocion::model()->findByPk(array($id,$user_id));
            $this->_model=Promocion::model()->findByPk($id);
            if($this->_model===null)
                    throw new CHttpException(404,'The requested page does not exist.');
            return $this->_model;
    }

    public function loadUser()
    {
            if(Yii::app()->user->id)
                    $user=Yii::app()->controller->module->user();
            else
                    throw new CHttpException(404,'Sorry, we cannot process your request. Try again
                            later.');

            return $user;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($validate)
    {
            // ajax validator
            if(isset($_POST['ajax']) && $_POST['ajax']==='promociones-form')
            {
                echo UActiveForm::validate($validate);
                Yii::app()->end();
            }
    }

    /**
     * Register Script
     * Esta función es para gestionar el jquery de las vistas para que se muestren los cmapos según
     * el valor seleccionado en el combo SuperUser(tipo de usuario). Está copiado y pegado de profileFields.
     */
    public function registerScript() {
            $basePath=Yii::getPathOfAlias('application.modules.user.views.asset');
            $baseUrl=Yii::app()->getAssetManager()->publish($basePath);
            $cs = Yii::app()->getClientScript();
            $cs->registerCoreScript('jquery');
            $cs->registerCssFile($baseUrl.'/css/redmond/jquery-ui.css');
            $cs->registerCssFile($baseUrl.'/css/style.css');
            $cs->registerScriptFile($baseUrl.'/js/jquery-ui.min.js');
            $cs->registerScriptFile($baseUrl.'/js/form.js');
            $cs->registerScriptFile($baseUrl.'/js/jquery.json.js');

            $widgets = self::getWidgets();

            $js = "
                    $('#buttonStateful').click(function() {
                        var btn = $(this);
                        btn.button('loading'); // call the loading function
                        setTimeout(function() {
                            btn.button('reset'); // call the reset function
                }, 3000);

                function loading() {
                    }

                    "
        ;
    }

	
	
}
