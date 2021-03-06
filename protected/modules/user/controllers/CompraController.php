<?php

class CompraController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('comprado','historialCompras','view','index','comprobarCompra','creaPdf'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','create','update',),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Compra;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Compra']))
		{
			$model->attributes=$_POST['Compra'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionComprado($idPromo)
	{
		$model=new Compra;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($idPromo) && !empty($idPromo))
		{
			//comprobar que el id de la promo existe
			$model->id_usuario = Yii::app()->user->id;
			$model->id_promo = $idPromo;

			//miro si esa compra ya existe
			$compra = Compra::model()->find('id_usuario=:id_usuario AND id_promo=:id_promo',array(':id_usuario'=>Yii::app()->user->id,':id_promo'=>$idPromo));					
			//si no existe la creo y la guardo en la BD
			if(!$compra || !isset($compra->id)){		
				//cojo los datos de la promocion para almacenarlos en compra
				$promocion = Promocion::model()->find('id=:id',array(':id'=>$idPromo));
				$model->precio = $promocion->precio;
				$model->estado = 1;

				//GENERAR UN CÓDIGO ALEATORIO
				$model->referencia = UserModule::encrypting(microtime().$model->id_usuario);	
				echo $model->referencia;			

				if($model->save()){		
					$empresa = User::model()->find('user.id=:id',array(':id'=>$promocion->user_id));				
					if($promocion->tipo == 0){ //si la promocion se tiene que pagar por internet
						$usuario = User::model()->find('user.id=:id',array(':id'=>Yii::app()->user->id));
						//envío el email al comprador
						Yii::app()->getModule('user')->sendMail($usuario->email,'Proemoción','Ha comprado una promoción en www.proemocion.com. Gracias por su confianza. Puede consultar los datos de sus compras accediendo al panel de usuario accediendo a www.proemocion.com , logueándose como usuario y pinchando en la opción Mis Compras del menú.');
					}

					//envio un email al comprador
					Yii::app()->getModule('user')->sendMail($empresa->email,'Proemoción','Enhorabuena, alguien ha comprado una de sus promociones. Para más informacion acceda a su panel de usuario en www.proemocion.com, donde podrá ver todas las ventas realizadas.');

					//envío email a proemocion para avisar 
					//Yii::app()->getModule('user')->sendMail(Yii::app()->params['websiteEmail'],'Han comprado una promoción','El usuario: '.$model->id_usuario.' ha comprado la promoción: '.$model->id_promo);
					//$this->redirect(array('view','id'=>$model->id));				
				}	

		}else{
			$model = $compra;
		}
		//genero el código y el pdf
		
		$this->creaPdf($model->id);		
		}else{
			$this->render('error');
		}
	}

	public function actionHistorialCompras()
	{
		$dataProvider=new CActiveDataProvider('Compra',array(
                    'criteria'=>array(
                    'condition'=>'id_usuario ='.Yii::app()->user->id
		)));

		//$this->debug($dataProvider);

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Compra']))
		{
			$model->attributes=$_POST['Compra'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$id = Yii::app()->user->id;		
		$dataProvider=new CActiveDataProvider('Compra',
			array(
    			'criteria'=>array(
        		'condition'=>'id_promo IN (select id from tbl_promociones WHERE user_id = '.Yii::app()->user->id.')',       		
    			)
    		)
		);
		$data=$dataProvider->getData();		
		$this->render('listaCompras',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Compra('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Compra']))
			$model->attributes=$_GET['Compra'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function creaPdf($id){
		//$model = new Compra;
		$model = Compra::model()->find('id=:id',array(':id'=>$id));		
		if(Yii::app()->user->id == $model->id_usuario){
		$comprador = User::model()->find('user.id=:userId',array(':userId'=>$model->id_usuario));
		$promo = Promocion::model()->find('t.id=:promoId',array(':promoId'=>$model->id_promo));	
		$empresa = User::model()->find('user.id =:empresaId',array(':empresaId'=>$promo->user_id));	
		# mPDF
		$mPDF1 = Yii::app()->ePdf->mpdf();

		# You can easily override default constructor's params
		$mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
		
		$mPDF1->SetCreator('Proemocion');
		$title = 'Proemoción';

		# Load a stylesheet
		$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.themes')."/frontEnd/bootstrap/css/bootstrap.css");
		$mPDF1->WriteHTML($stylesheet, 1);

		# Renders image
		$mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.img').'/logo.png' ));

		# render (full page)
		$mPDF1->WriteHTML($this->renderPartial('pdf', array('model'=>$model,'comprador'=>$comprador,'promo'=>$promo,'empresa'=>$empresa),true));		
		
		//ALMACENAR EL CÓDIGO EN LA BD PARA RELACIONARLO CON EL USUARIO QUE COMPRA LA PROMOCIÓN
		//$model->referencia = $clave;
		//$model->save();
		# Outputs ready PDF
		$mPDF1->Output();		
		//$this->render('enviadopdf',array('model'=>$mPDF1));
		//$this->redirect(Yii::app()->request->urlReferrer);
	}else{
		$this->redirect(Yii::app()->getModule('user')->homeUrl);
	}

	}

	public function actionCreaPdf($id){
		$model = new Compra;
		$model = Compra::model()->find('id=:id',array(':id'=>$id));		
		if($model && Yii::app()->user->id == $model->id_usuario){
		$comprador = User::model()->find('user.id=:userId',array(':userId'=>$model->id_usuario));
		$promo = Promocion::model()->find('t.id=:promoId',array(':promoId'=>$model->id_promo));	
		$empresa = User::model()->find('user.id =:empresaId',array(':empresaId'=>$promo->user_id));	
		# mPDF
		$mPDF1 = Yii::app()->ePdf->mpdf();

		# You can easily override default constructor's params
		$mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
		
		$mPDF1->SetCreator('Proemocion');
		$title = 'Proemoción';

		# Load a stylesheet
		$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.themes')."/frontEnd/bootstrap/css/bootstrap.css");
		$mPDF1->WriteHTML($stylesheet, 1);

		# Renders image
		$mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.img').'/logo.png' ));

		# render (full page)
		$mPDF1->WriteHTML($this->renderPartial('pdf', array('model'=>$model,'comprador'=>$comprador,'promo'=>$promo,'empresa'=>$empresa),true));		
		
		//ALMACENAR EL CÓDIGO EN LA BD PARA RELACIONARLO CON EL USUARIO QUE COMPRA LA PROMOCIÓN
		//$model->referencia = $clave;
		//$model->save();
		# Outputs ready PDF
		$mPDF1->Output();		
		//$this->render('enviadopdf',array('model'=>$mPDF1));
		//$this->redirect(Yii::app()->request->urlReferrer);
	}else{
		$this->redirect(Yii::app()->getModule('user')->homeUrl);
	}

	}


	public function actionComprobarCompra($id){
		$model = new Compra;
		$model = Compra::model()->find('id=:id',array(':id'=>$id));
		$comprador = User::model()->find('user.id=:userId',array(':userId'=>$model->id_usuario));
		$promo = Promocion::model()->find('t.id=:promoId',array(':promoId'=>$model->id_promo));
		//$user = User::model()->find('id=:id',array(':id'=>$model->id_usuario));				
		$this->render('pdf', array('model'=>$model,'comprador'=>$comprador,'promo'=>$promo,'clave'=>$clave));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Compra the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Compra::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Compra $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='compra-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
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
