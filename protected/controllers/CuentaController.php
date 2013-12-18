<?php

class CuentaController extends Controller
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','checkoutCompra'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
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
		$model=new Cuenta;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Cuenta']))
		{
			$model->attributes=$_POST['Cuenta'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
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

		if(isset($_POST['Cuenta']))
		{
			$model->attributes=$_POST['Cuenta'];
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
		$dataProvider=new CActiveDataProvider('Cuenta');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Cuenta('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Cuenta']))
			$model->attributes=$_GET['Cuenta'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function actionCheckoutCompra(){
		// read the post from PayPal system and add 'cmd'
		$req = 'cmd=_notify-validate';

		foreach ($_POST as $key => $value) {
			$value = urlencode(stripslashes($value));
			$req .= "&$key=$value";
		}

		// post back to PayPal system to validate
		$header = "POST /cgi-bin/webscr HTTP/1.0\r\n"; //estaba así: $header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
		$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);

		// assign posted variables to local variables
		$item_name = $_POST['item_name'];
		$item_number = $_POST['item_number'];
		$payment_status = $_POST['payment_status'];
		$payment_amount = $_POST['mc_gross'];
		$payment_currency = $_POST['mc_currency'];
		$txn_id = $_POST['txn_id'];
		$receiver_email = $_POST['receiver_email'];
		$payer_email = $_POST['payer_email'];
		$custom = $_POST['custom']; 

		if (!$fp) {
			// HTTP ERROR
			Yii::app()->end();
		}else{
			fputs ($fp, $header . $req);
			while (!feof($fp)) {
				$res = fgets ($fp, 1024);		
				if (strcmp ($res, "VERIFIED") == 0) {
					$todook = true;
					// check the payment_status is Completed										
					if(!strcmp($payment_status, "Completed"))
						Yii::app()->end();
					// Comprobar que el txn_id no se ha procesado todavía
					$compra = Compra::model()->find('referencia='.$txn_id);
					if($compra)
						Yii::app()->end();
					// Chequear que el receptor de la compra coincide con el email de paypal de la empresa
					/*if(!stcmp($emailempresa, $receiver_email))
						return false; */
					// check that payment_amount/payment_currency are correct
					
					// procesar pago
					$model = new Cuenta;

					//cojo el id_usuario y el id_promo del campo custom
					$ids = explode('_', $custom);
					$idUsuario = $ids[0];
					$idCuenta = $ids[1];

					$this->insertarCuenta($idUsuario,$idCuenta,$txn_id,$payment_amount);
					//$this->insertarCompraPrueba();

				}else if (strcmp ($res, "INVALID") == 0) {
					// log for manual investigation
					echo "Operación no permitida";
					//$this->render('nocomprado');
				}
			}
			fclose ($fp);
		}
	}


	function insertarCuenta($idUsuario,$idCuenta,$referencia,$precio){			
			$model=new Compra;

			$model->id_usuario = $idUsuario;
			$model->id_promo = $idCuenta;
			$model->referencia = $referencia;
			$model->precio = $precio;
			$model->fecha_compra = date("Y-m-d H:i:s");
			$model->estado = 1;

			//actualizar el tipo de cuenta en el profile del usuario:
			$cuenta = Cuenta::model()->findByPk($idCuenta);
			$condicion = 'user_id = '.$idUsuario;
			
			//Guardo los resultados en la BD
			$model->save();
			Profile::model()->updateAll(array('tipocuenta'=>$cuenta->id),$condicion);
				
	}

	function insertarCuentaPrueba($idUsuario,$idCuenta,$referencia,$precio){			
			$model=new Compra;

			$model->id_usuario = $idUsuario;
			$model->id_promo = $idCuenta;
			$model->referencia = $referencia;
			$model->precio = $precio;
			$model->fecha_compra = date("Y-m-d H:i:s");
			$model->estado = 1;

			//actualizar el tipo de cuenta en el profile del usuario:
			$cuenta = Cuenta::model()->findByPk($idCuenta);
			$condicion = 'user_id = '.$idUsuario;
			if($model->save() && Profile::model()->updateAll(array('tipocuenta'=>$cuenta->id),$condicion)){
				//solo para pruebas. Luego comentar la siguiente línea:
				$this->render('comprado',array('compra'=>$model));
			}else{
				//solo para pruebas. Luego comentar la siguiente línea:
				$this->render('nocomprado',array('compra'=>$model));
			}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Cuenta the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Cuenta::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Cuenta $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='cuenta-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}	
}
