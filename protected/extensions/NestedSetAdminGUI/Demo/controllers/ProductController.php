<?php

class ProductController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */


         public function actionReturnProductForm(){

               //don't reload these scripts or they will mess up the page
                //yiiactiveform.js still needs to be loaded that's why we don't use
                // Yii::app()->clientScript->scriptMap['*.js'] = false;
                $cs=Yii::app()->clientScript;
                $cs->scriptMap=array(
                 'jquery.min.js'=>false,
                'jquery.js'=>false,
                'jquery.fancybox-1.3.4.js'=>false,

        );

          //if we are creating a new product
          if($_POST['update']!='true') {
         $cat_id=$_POST['id'];
         $prod_cat=Categorydemo::model()->findByPk($cat_id);
          $model=new Product;
           //else load the model to update
          }else{
              $model=$this->loadModel($_POST['product_id']);
          }
        $this->renderPartial('_form_prod', array('model'=>$model,
                                                                      'prod_cat'=>$prod_cat,
                                                                                   ),
                                                                  false, true);
      }

	/**
	 * Creates a new model.
	 */
	public function actionCreate()
	{
		

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
 
		if(isset($_POST['Product']))
		{
                        $model=new Product;
			$model->attributes=$_POST['Product'];
			if($model->save('false')){
                                echo json_encode(array('success'=>true,
                                                              'id'=>$model->primaryKey)
                                                              );
                                exit;
                        } else
                        {
                            echo json_encode(array('success'=>false,
                                                                  'message'=>'Error.Product was not created.'
                                                                  )
                                                        );
                            exit;
                        }
				
		}

	}

	/**
	 * Updates a particular model.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel($_POST['Product']['product_id']);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Product']))
		{
			$model->attributes=$_POST['Product'];
			if($model->save()){
                                echo json_encode(array('success'=>true)
                                                              );
                                exit;
                        } else
                        {
                            echo json_encode(array('success'=>false,
                                                                  'message'=>'Error.Product was not updated.'
                                                                  )
                                                        );
                            exit;
                        }
				
		}
	}

	public function actionProductList(){

       $cs=Yii::app()->clientScript;
                $cs->scriptMap=array(
                 'jquery.min.js'=>false,
                'jquery.js'=>false,
              'jquery.fancybox-1.3.4.js'=>false,

        );

   //the GET is used for CListView Paging
   $cat_id=(Yii::app()->request->isPostRequest)?$_POST['id']:$_GET['category_id'];

   $cat=Categorydemo::model()->with('products')->findByPk($cat_id);

    $productDP=new CActiveDataProvider('Product',
                         array(
                             'criteria'=>array(
                                                     'condition'=>'category_id=:category_id',
                                                     'params'=> array(':category_id'=>$cat_id),
                                                 //    'limit'=>10,
                                                     ),
                        'pagination'=>array(
                                                        'pageSize'=>5,
                                                       'params'=>array('category_id'=>$cat_id)
                                                               ),
                            ));


   $this->renderPartial('_product_list', array('productDP'=> $productDP,
                                                                  'cat'=> $cat
                                                                   ),
                                                                  false, true);

}

        /**
	 * Deletes a particular model.
	 */
	public function actionRemove()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			if($this->loadModel($_POST['product_id'])->delete()){
                                echo json_encode(array('success'=>true)
                                                              );
                                exit;
                        } else
                        {
                            echo json_encode(array('success'=>false,
                                                                  'message'=>'Error.Product was not deleted.'
                                                                  )
                                                        );
                            exit;
                        }
			
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
        
public function actionReturnProductProperties(){

               //don't reload these scripts or they will mess up the page
                //yiiactiveform.js still needs to be loaded that's why we don't use
                // Yii::app()->clientScript->scriptMap['*.js'] = false;
                $cs=Yii::app()->clientScript;
                $cs->scriptMap=array(
                 'jquery.min.js'=>false,
                'jquery.js'=>false,
                'jquery.fancybox-1.3.4.js'=>false,

        );

        $model=$this->loadModel($_POST['id']);
        $cat=  Categorydemo::model()->findByPk($model->category_id);
        $this->renderPartial('_product_properties', array('model'=>$model,
                                                                                  'cat'=>$cat
                                                                   ),
                                                                  false, true);

      }


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Product::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='product-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
