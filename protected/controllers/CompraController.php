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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('checkoutCompra','checkoutBono'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','create','update'),
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
	function actionCreate()
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
		$dataProvider=new CActiveDataProvider('Compra');
		$this->render('index',array(
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

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Compra the loaded model
	 * @throws CHttpException
	 */

	public function actionCheckoutCompra(){
		//Abrimos el fichero en modo de escritura 
		$DescriptorFichero = fopen("./".Yii::app()->theme->getBaseUrl()."/../../protected/runtime/fichero_ipn.txt","w"); 
		fputs($DescriptorFichero,'Comenzamos. ');

		echo "Hola<br/>";
		// read the post from PayPal system and add 'cmd'
		$req = 'cmd=_notify-validate';

		foreach ($_POST as $key => $value) {
			$value = urlencode(stripslashes($value));
			$req .= "&$key=$value";
		}

		
		/*if(!isset(Yii::app()->user->id)){
			echo "No hay sesión de usuario";
			fputs($DescriptorFichero,'No hay sesión de usuario');
			return;
		}		*/

		// post back to PayPal system to validate
		//$header = "POST /cgi-bin/webscr HTTP/1.0\r\n"; 
		$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
		$header .= "Host: www.sandbox.paypal.com\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
		//LO SIGUIENTE ESTABA CON SSL, pero haciendo pruebas con el IPN SIMULATOR, no me enviaba los datos. si lo pongo sin SSL sí
		$fp = fsockopen ('www.sandbox.paypal.com', 80, $errno, $errstr, 30);
		
		// assign posted variables to local variables	
		if(!isset($_POST['txn_id'])){
			//UserModule::sendMail(Yii::app()->params['websiteEmail'],'Paypal txt_id vacio','No se encuentra post txn_id');
			echo "No hay txn_id";
			fputs($DescriptorFichero,' txn_id no encontrado'); 
			fclose($DescriptorFichero);
			Yii::app()->end();
		}else{	
			$item_name = $_POST['item_name'];
			$item_number = $_POST['item_number'];
			$payment_status = $_POST['payment_status'];
			$payment_amount = $_POST['mc_gross'];
			$payment_currency = $_POST['mc_currency'];
			$txn_id = $_POST['txn_id'];
			$receiver_email = $_POST['receiver_email'];
			$payer_email = $_POST['payer_email'];
			$custom = $_POST['custom'];
			$precio = $_POST['amount'];

			if (!$fp) {
				// HTTP ERROR
				//UserModule::sendMail(Yii::app()->params['websiteEmail'],'Socket Pypal incorrecto','Paypal no puede crear el socket');
				fputs($DescriptorFichero,' fp no valido (no crea el socket)'); 
				fclose($DescriptorFichero);
				Yii::app()->end();
			}else{
				fputs ($fp, $header . $req);
				while (!feof($fp)) {
					$res = fgets ($fp, 1024);
					if (strcmp ($res, "VERIFIED") == 0) {
						fputs($DescriptorFichero,'VERIFICADO OK'); 
						$todook = true;
						// check the payment_status is Completed				
						//fputs($DescriptorFichero,'Estatus: '.$payment_status); 						
						if(strcmp($payment_status, "Completed")!=0){
							//pongo el valor cancelado en la tabla compras
							fputs($DescriptorFichero,' Pago NO COMPLETADO'); 
							fclose($DescriptorFichero);
							Yii::app()->end();
						}
						// Comprobar que el txn_id no se ha procesado todavía
						$compra = Compra::model()->find('referencia='.$txn_id);
						if($compra){
							fputs($DescriptorFichero,'La compra ya existe'); 
							fclose($DescriptorFichero);
							Yii::app()->end();
						}
						
						// check that payment_amount/payment_currency are correct
						
						// procesar pago
						$model = new Compra;

						//cojo el id_usuario y el id_promo del campo custom
						$ids = explode('_',$custom);
						$idUsuario = $ids[0];
						$idPromocion = $ids[1];

						if(!empty($idUsuario) && !empty($idPromocion)){

						$this->insertarCompra($idUsuario,$idPromocion,$txn_id,$precio,$custom);
						//$this->insertarCompraPrueba();
						$message = "El usuario con identificador ".$idUsuario." ha comprado la promoción con identificador ".$idPromocion.", cuyo precio es ".$precio." y la referencia es ".$referencia;

						//enviar email a proemocion para informar de la compra				
						echo "Compra ok. Envío el email.<br/>";
						Yii::app()->getModule('user')->sendMail(Yii::app()->params['websiteEmail'],'Nueva compra',$message);											
						fputs($DescriptorFichero,'Compra creada!');
						}else{
							Yii::app()->getModule('user')->sendMail($payer_email,'Compra promocion no verificada','No se ha podido recuperar todos los datos del comprador o de la promoción.');	
						}
					}else if (strcmp ($res, "INVALID") == 0) {
						fputs($DescriptorFichero,'INVALIDO');
						// log for manual investigation
						//UserModule::sendMail(Yii::app()->params['websiteEmail'],'Compra NO COMPLETADA','Paypal devuelve INVALID');
						//$this->render('nocomprado');
					}
				}
				fclose ($fp);
				fputs($DescriptorFichero,'Salgo de la funcion'); 
				//Cerramos el fichero 
				fclose($DescriptorFichero);
			}		
		} 
		echo "Adios.<br/>";	
	}

	/*public function actionCheckoutCompra2(){
		$token = trim($_GET['token']);
		$payerId = trim($_GET['PayerID']);
		
		
		
		$result = Yii::app()->Paypal->GetExpressCheckoutDetails($token);

		$result['PAYERID'] = $payerId; 
		$result['TOKEN'] = $token; 
		$result['ORDERTOTAL'] = 0.00;

		//Detect errors 
		if(!Yii::app()->Paypal->isCallSucceeded($result)){ 
			if(Yii::app()->Paypal->apiLive === true){
				//Live mode basic error message
				$error = 'We were unable to process your request. Please try again later';
			}else{
				//Sandbox output the actual error message to dive in.
				$error = $result['L_LONGMESSAGE0'];
			}
			echo $error;
			Yii::app()->end();
		}else{ 
			
			$paymentResult = Yii::app()->Paypal->DoExpressCheckoutPayment($result);
			//Detect errors  
			if(!Yii::app()->Paypal->isCallSucceeded($paymentResult)){
				if(Yii::app()->Paypal->apiLive === true){
					//Live mode basic error message
					$error = 'We were unable to process your request. Please try again later';
				}else{
					//Sandbox output the actual error message to dive in.
					$error = $paymentResult['L_LONGMESSAGE0'];
				}
				echo $error;
				Yii::app()->end();
			}else{
				//payment was completed successfully
				
				$this->render('confirm');
			}
			
		}
	}*/

	public function insertarCompra($idUsuario,$idPromocion,$referencia,$precio,$custom){			
			$model=new Compra;

			$model->id_usuario = $idUsuario;
			$model->id_promo = $idPromocion;
			$model->referencia = $referencia;
			$model->precio = $precio;
			$model->fecha_compra = date("Y-m-d H:i:s");
			$model->estado = 1;

			if($model->save()){
				//$this->render('comprado',array('compra'=>$model));
			}else{
				//$this->render('nocomprado',array('compra'=>$model));
			}
	}

	function insertarCompraPrueba(){
			$model=new Compra;

			$model->id_usuario = 7;
			$model->id_promo = 1;
			$model->referencia = "referenciaxxisu87sx";
			$model->precio = "37.50";
			$model->fecha_compra = date("Y-m-d H:i:s");
			$model->estado = 1;

			$guardado = $model->save();
			print_r($model->getErrors());
			if($guardado)
				$this->render('comprado',array('compra'=>$model));
			else
				$this->render('nocomprado',array('compra'=>$model));

	}

	public function actionCheckoutBono(){
		// Send an empty HTTP 200 OK response to acknowledge receipt of the notification 
   		header('HTTP/1.1 200 OK');


		$req = 'cmd=_notify-validate';

		foreach ($_POST as $key => $value) {
			$value = urlencode(stripslashes($value));
			$req .= "&$key=$value";
		}
		
		/*if(!isset(Yii::app()->user->id)){
			echo "No hay sesión de usuario";
			fputs($DescriptorFichero,'No hay sesión de usuario');
			return;
		}		*/

		// post back to PayPal system to validate
		//$header = "POST /cgi-bin/webscr HTTP/1.0\r\n"; 
		$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
		$header .= "Host: www.sandbox.paypal.com:443\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
		$fp = fsockopen ('ssl://www.sandbox.paypal.com', 443, $errno, $errstr, 30);
		
		// assign posted variables to local variables	
		if(!isset($_POST['txn_id'])){
			//UserModule::sendMail(Yii::app()->params['websiteEmail'],'Paypal txt_id vacio','No se encuentra post txn_id');
			echo "No hay txn_id";
			Yii::app()->end();
		}else{	
			$item_name = $_POST['item_name'];
			$item_number = $_POST['item_number'];
			$payment_status = $_POST['payment_status'];
			$payment_amount = $_POST['mc_gross'];
			$payment_currency = $_POST['mc_currency'];
			$txn_id = $_POST['txn_id'];
			$receiver_email = $_POST['receiver_email'];
			$payer_email = $_POST['payer_email'];
			$custom = $_POST['custom'];
			$precio = $_POST['amount'];

			$idUsuario = 0;
			$idBono = 0;

			$mail_From    = "proemocion@proemocion.com";
	      	$mail_To      = "hugoepila@gmail.com";
	      	$mail_Subject = "Ejecutado IPN";

			//cojo el id_usuario y el id_promo del campo custom
			$ids = explode('_',$custom);
			if($ids!=false && !empty($ids)){
				$idUsuario = $ids[0];
				$idBono = $ids[1];
			}

			//QUITAR LO SIGUIENTE PARA PRODUCCIÓN
			$idUsuario = 11;
			$idBono = 1;

			if (!$fp) {
				// HTTP ERROR
				//UserModule::sendMail(Yii::app()->params['websiteEmail'],'Socket Pypal incorrecto','Paypal no puede crear el socket');
				Yii::app()->end();
			}else{
				fputs ($fp, $header . $req);
				while (!feof($fp)) {
					$res = fgets ($fp, 1024);
					//$res = stream_get_contents($fp, 1024);
					//QUITARLO PARA PRODUCCIÓN
					//mail($mail_To, $mail_Subject, $mail_Body, $res);
					
					if (strcmp ($res, "VERIFIED") == 0) {
						$todook = true;
						
                        $mail_Subject = "VERIFIED IPN";
                        $mail_Body = $req;
 
                        foreach ($_POST as $key => $value){
                            $emailtext .= $key . " = " .$value ."\n\n";
                        }
 
                        mail($mail_To, $mail_Subject, $emailtext . "\n\n" . $mail_Body, $mail_From);

						// check the payment_status is Completed				
						//fputs($DescriptorFichero,'Estatus: '.$payment_status); 						
						if(strcmp($payment_status, "Completed")!=0){					
							
						}else{
							// Comprobar que el txn_id no se ha procesado todavía
							$compra = UsersCuentas::model()->find('referencia='.$txn_id);				
							
							// check that payment_amount/payment_currency are correct

							//Establezco la fecha de caducidad
							
							$fecha = date("Y-m-d H:i:s");
							$fecha_fin = strtotime ( '+2 month' , strtotime ( $fecha ) ) ;
							$fecha_fin= date ( 'Y-m-d H:i:s' , $fecha_fin );
							
							$ids = explode('_',$custom);
							$idUsuario = $ids[0];
							$idPromocion = $ids[1];

							if(!empty($idUsuario) && !empty($idPromocion)){

							//guardo los datos de la compra
							$this->insertarCompraBono($idUsuario,$idBono,$txn_id,$precio,$custom,$fecha_fin);

							//actualizo los datos del usuario-empresa
							
							}else{
								Yii::app()->getModule('user')->sendMail($payer_email,'Compra promocion no verificada','No se ha podido recuperar todos los datos del comprador o del Bono.');	
							}
												
						}					
					}else if (strcmp ($res, "INVALID") == 0) {
						// log for manual investigation
						//UserModule::sendMail(Yii::app()->params['websiteEmail'],'Compra NO COMPLETADA','Paypal devuelve INVALID');
						//$this->render('nocomprado');
						
						$mail_From = "From: sandbox@pptest.com";
                        $mail_To = "hugoepila@gmail.com";
                        $mail_Subject = "INVALID IPN";
                        $mail_Body = $req;
 
                        foreach ($_POST as $key => $value){
                            $emailtext .= $key . " = " .$value ."\n\n";
                        }
 
                        mail($mail_To, $mail_Subject, $emailtext . "\n\n" . $mail_Body, $mail_From);

					}
				}
				fclose ($fp);	

				//enviar email a proemocion para informar de la compra						
				//Yii::app()->getModule('user')->sendMail(Yii::app()->params['websiteEmail'],'Nuevo BONO',$message);									      		      	
			}		
		} 
	}

	public function actionCheckoutBonoNew(){
		// Send an empty HTTP 200 OK response to acknowledge receipt of the notification 
   		header('HTTP/1.1 200 OK');

   		// Build the required acknowledgement message out of the notification just received
		$req = 'cmd=_notify-validate';               // Add 'cmd=_notify-validate' to beginning of the acknowledgement

		foreach ($_POST as $key => $value) {         // Loop through the notification NV pairs
			$value = urlencode(stripslashes($value));  // Encode these values
		    $req  .= "&$key=$value";                   // Add the NV pairs to the acknowledgement
		}

		// Set up the acknowledgement request headers
	  $header  = "POST /cgi-bin/webscr HTTP/1.1\r\n";                    // HTTP POST request
	  $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
	  $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

	  // Open a socket for the acknowledgement request
	  $fp = fsockopen('www.sandbox.paypal.com', 80, $errno, $errstr, 30);

	  // Send the HTTP POST request back to PayPal for validation
	  fputs($fp, $header . $req);


	  //COMPROBAR QUE LA INFORMACIÓN RECIBIDA ESTÁ BIEN
	  while (!feof($fp)) {                     // While not EOF
	    $res = fgets($fp, 1024);               // Get the acknowledgement response
	    if (strcmp ($res, "VERIFIED") == 0) {  // Response contains VERIFIED - process notification

	      // Send an email announcing the IPN message is VERIFIED
	      $mail_From    = "IPN@example.com";
	      $mail_To      = "hugoepila@gmail.com";
	      $mail_Subject = "VERIFIED IPN";
	      $mail_Body    = $req;
	      mail($mail_To, $mail_Subject, $mail_Body, $mail_From);

	      // Authentication protocol is complete - OK to process notification contents

	      // Possible processing steps for a payment include the following:

	      // Check that the payment_status is Completed
	      // Check that txn_id has not been previously processed
	      // Check that receiver_email is your Primary PayPal email
	      // Check that payment_amount/payment_currency are correct
	      // Process payment

	    } 
	    else if (strcmp ($res, "INVALID") == 0) { 
	      //Response contains INVALID - reject notification

	      // Authentication protocol is complete - begin error handling

	      // Send an email announcing the IPN message is INVALID
	      $mail_From    = "IPN@example.com";
	      $mail_To      = "hugoepila@gmail.com";
	      $mail_Subject = "INVALID IPN";
	      $mail_Body    = $req;

	      mail($mail_To, $mail_Subject, $mail_Body, $mail_From);
	    }else{
	    	// Send an email announcing the IPN message is VERIFIED
	      $mail_From    = "IPN@example.com";
	      $mail_To      = "hugoepila@gmail.com";
	      $mail_Subject = "Ejecutado IPN";
	      $mail_Body    = "res = ".$res."  |  req = ".$req;
	      mail($mail_To, $mail_Subject, $mail_Body, $mail_From);
	    }
	  }

	   fclose($fp);  // Close the file
	    
   	}

   	public function insertarCompraBono($idUsuario,$idPromocion,$referencia,$precio,$custom,$fecha_fin){			
			$model=new UsersCuentas;

			$model->id_usuario = $idUsuario;
			$model->id_cuenta = $idPromocion;
			$model->referencia = $referencia;
			$model->cant_pagado = $precio;
			$model->fecha_inicio = date("Y-m-d H:i:s");
			$model->fecha_fin = $fecha_fin;
			$model->estado = 1;

			if($model->save()){
				//$this->render('comprado',array('compra'=>$model));
			}else{
				//$this->render('nocomprado',array('compra'=>$model));
			}
	}

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
}
