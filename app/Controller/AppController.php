<?php
/**
 * Application level Controller
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
App::uses('AuthComponent', 'Controller/Component');
App::uses('Sanitize', 'Utility');
App::uses('CakeTime', 'Utility');
App::uses('CakeNumber', 'Utility');
App::uses('CakeEmail', 'Network/Email');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

		public $components = array('Auth','Session','Cookie','RequestHandler','Flash');
		public $helper = array('Html','Form','Js','Session','Text','Time','Image','Flash');

		public function beforeFilter() {
            
   			parent::beforeFilter();
        header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0?"); // // HTTP/1.1
        header("Pragma: no-cache");
        header("Expires: Mon, 17 Dec 2007 00:00:00 GMT"); // Date in the past

        $this->layout = 'module';
        /*Login Is Super Admin*/
        $this->Auth->authorize = array('Controller');
        
	}

	public function isAuthorized($user = null){
        return true; // Defaults to true if a controller does not override this method
  }

}
