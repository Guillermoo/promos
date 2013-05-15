/**
* Nested Set Admin GUI
*
*
* @author Spiros Kabasakalis <kabasakalis@gmail.com>,myspace.com/spiroskabasakalis
* @copyright Copyright &copy; 2011 Spiros Kabasakalis
* @since 1.0
* @license The MIT License
*/
   OVERVIEW 
  This extension includes
   1.
    Gii Model and Crud templates   that generate  a graphical user interface (tree) for nested set model administration.
    With the  help of jstree and fancybox plugins,all CRUD operations on a nested set model  are reduced to context menu selections.
	Available operations appear in a context menu which opens when a node in the tree is right clicked.Nodes can be moved around in the tree with simple drag and drop actions.The overall  feel approximates  a desktop experience.
	 
	 2.
	 A Demo.The  demo illustrates a  Category HAS MANY Product relation.The context menu for the Category nested set model has two extra options,Add Product and List Products.Right clicking on a node and selecting Add Product opens a  Product form in a fancybox window to  create a related product for the category that the clicked node represents.List Products will show in a fancybox window all products of a category in a CListView.Update,Delete and Property view  icon-buttons are available in the CListView items ,so  CRUD is  possible for the Products as well. 
	 
	 	DEMO ONLINE
	 http://libkal.gr/yii_lab/categorydemo
	 
	 
	 INSTALLATION
	 1.Hide index.php from your requests,if you have'nt done so yet.You can find detailed instructions on how to do this here.(Paragraph 6)
	     http://www.yiiframework.com/doc/guide/1.1/en/topics.url
	   Also,in urlManager configuration in config/main.php file set

	 'urlFormat'=>'path',
     'showScriptName'=>false,
	 2.   Unzip the downloaded file.
	       Copy the gii folder to your application's protected folder.
	       Copy the js_plugins folder  to the root folder of your application,(same level as protected).
		   Copy the client_val_form.css file and images folder to  your application's css folder.
			Copy the nestedBehavior folder to your application's  extensions folder .
	3.In config/main.php file,in gii configuration, add the path of  your gii folder like so:
	
	'modules'=>array(
	  ......
	      'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'1',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
                    	'generatorPaths' => array(
                        'application.gii'  //nested set  Model and Crud templates
		     ),
		),
		
		.......
	)
	
	
	DEMO INSTALLATION(optional)
	 Open the Demo Folder.
	 Import product_table.sql and  categorydemo_table.sql in your database.
	 Copy the models,controllers,and view files found in the Demo folder to the corresponding folders of your application.
	 Navigate to [application root]/categorydemo] and you should see the administration page.
	
	
	 USAGE
	 1. Prepare your Nested Set Model   table structure.
	      Use the contents of nestedSetAdminGUI.sql file as a basis.All columns stated in  this file are required for the extension to work-you can add your own columns.You can change the name of the table,it will become the model class name in the generated files.
		 IMPORTANT:Use a simple name for the table,all lowercase and no  underscores,hyphens and the like.	
	 2.Import the table in your database.
	 3.Navigate to gii page ([application root]/gii).
	       Click Model Generator.
	      Type the table name in the Table Name field .
	      Click on the Code Template and select nested.Preview if you want,and then Generate.
		  Your nested set Model class has been generated.
		  IMPORTANT:Open the newly generated  model class file and remove ALL rules associated with  Nested Set Behavior columns:
		  rgt,lft,root,level,id.No rules should appear for these columns.
	4.Click Crud Generator
		     In the Model Class field type the name of the class that was generated in the previous step.
			 Again,click Code template and select nested,if it's not already selected.
			 Preview if you want,and then Generate.
    5.  This is it.Navigate to the controller URL .For example if you used the default table  name	category,go to [application root]/category.
		    You should see the administration page and you are ready to create roots and nodes.
			 
	 
	 
	RESOURCES
	
	Nested Set Behavior Yii Extension
	http://www.yiiframework.com/extension/nestedsetbehavior
	
	Nested Set Model
	http://en.wikipedia.org/wiki/Nested_set_model
	
	jsTree
	http://www.jstree.com/
	
	Fancybox
	http://fancybox.net/
	
	jQuery UI
	http://jqueryui.com/
	
Spiros "DrumAddict" Kabasakalis,September 5th 2011.
	 
	 