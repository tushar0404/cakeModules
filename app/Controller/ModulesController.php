<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('AppController', 'Controller');
include(APP.'Vendor/php_excel/PHPExcel.php');
include(APP.'Vendor/stripe/init.php');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class ModulesController extends AppController {

/**
 * This controller does not use a model
 * @var array
*/
	//public $uses = array();
/**
 * Displays a view
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	public function beforeFilter() {
        parent::beforeFilter();

        $this->Auth->allow('list_of_customers','index','download_reports','download_excel','download_csv','stripe_payment','create_customer','activate_account',
            'logout','forget_password','reset_password','linkedinlogin','linkedinlogin','gmail_login','send_simple_message','sendgrid_message','subscribe_email','dashboard','add_subscriber','generate_referral_code');

    }

    public function index(){
        $this->set('title_for_layout','Customized Module');
    }

    public function download_reports(){
        $this->set('title_for_layout','Customized Module');
    }

    public function download_excel(){

        $user_info = Configure::read('user_info');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("Tushar")
                             ->setLastModifiedBy("Tushar")
                             ->setTitle("User Info")
                             ->setSubject("List Of Users")
                             ->setDescription("")
                             ->setKeywords("")
                             ->setCategory("");

        $objPHPExcel->setActiveSheetIndex(0);

        // create style
        $default_border = array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb'=>'1006A3')
        );
        
        $style_header = array(
            'borders' => array(
                'bottom' => $default_border,
                'left' => $default_border,
                'top' => $default_border,
                'right' => $default_border,
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb'=>'E1E0F7'),
            ),
            'font' => array(
                'bold' => true,
                'size' => 14,
            )
        );

        $style_header_text = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb'=>'FFFFFF'),
            ),
            'font' => array(
                'bold' => true,
                'size' => 14,
            )
        );
        
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        
        $objPHPExcel->getActiveSheet()->mergeCells('A1:D1');
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', "User Information");
        $objPHPExcel->getActiveSheet()->getStyle('A1:D1')->applyFromArray( $style_header_text ); // give style to header


        $objPHPExcel->getActiveSheet()->SetCellValue('A3', 'S.No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('B3', 'Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C3', 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('D3', 'Contact');
        
        $objPHPExcel->getActiveSheet()->getStyle('A3:D3')->applyFromArray( $style_header ); // give style to header
        
        $rowCount = 4;
        $counter = 1;
        foreach ($user_info as $key => $result) {
            
            //$job_id_new = $result['job_id'];
            $name = ucwords($result['name']);
            $email = $result['email'];
            $contact = $result['contact'];

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount,$counter++);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount,$name); 
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount,$email); 
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount,$contact); 
            
            $rowCount++; 

        } 
        
        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('User Report');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        // Redirect output to a client’s web browser (Excel5)

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="user_info.xlsx"');
        header('Cache-Control: max-age=0');
         
        $objWriter->save('php://output');
        ob_end_clean();
        
        exit;
    }

    public function download_csv(){

        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=user_info.csv");
        $data = Configure::read('user_info');
        $output = fopen("php://output", "w");
          foreach ($data as $row){
            fputcsv($output, $row); // here you can change delimiter/enclosure
        }
        fclose($output);

        exit;
    }

    public function create_plan($amount = 0,$id = NULL){

        \Stripe\Stripe::setApiKey("stripe secret key");
        try {
            $plan = \Stripe\Plan::create(array(
                      "name" => "Recurring Payment From Tushar's Account For Amount $".$amount,
                      "id" => $id,
                      "interval" => "month",
                      "currency" => "usd",
                      "amount" => $amount*100,
                    ));
            $plan = $plan->__toArray(true);
            return $plan['id'];
            // Use Stripe's library to make requests...
        } catch(\Stripe\Error\Card $e) {
          // Since it's a decline, \Stripe\Error\Card will be caught
          $body = $e->getJsonBody();
        } catch (\Stripe\Error\RateLimit $e) {
          // Too many requests made to the API too quickly
          $body = $e->getJsonBody();  
        } catch (\Stripe\Error\InvalidRequest $e) {
          // Invalid parameters were supplied to Stripe's API
            $body = $e->getJsonBody();
        } catch (\Stripe\Error\Authentication $e) {
          // Authentication with Stripe's API failed
            $body = $e->getJsonBody();
          // (maybe you changed API keys recently)
        } catch (\Stripe\Error\ApiConnection $e) {
          // Network communication with Stripe failed
            $body = $e->getJsonBody();
        } catch (\Stripe\Error\Base $e) {
          // Display a very generic error to the user, and maybe send
          // yourself an email
            $body = $e->getJsonBody();
        } catch (Exception $e) {
          // Something else happened, completely unrelated to Stripe
            $body = $e->getJsonBody();
        }
        if(isset($body)){
            $err  = $body['error']['message'];
            $this->Flash->error($err);
            $this->redirect(array('controller'=>'modules','action'=>'stripe_payment'));
        }
    }

    public function create_customer($email = NULL){

        \Stripe\Stripe::setApiKey("your stripe secret key");
        /*$list_of_customers = \Stripe\Customer::all();
        $list_of_customers = $list_of_customers->__toArray(true);
        */
        try {
        
            $customer = \Stripe\Customer::create(array(
              "email" => $email,
            ));
            $customer = $customer->__toArray(true);
            return $customer['id'];
            // Use Stripe's library to make requests...
        } catch(\Stripe\Error\Card $e) {
          // Since it's a decline, \Stripe\Error\Card will be caught
          $body = $e->getJsonBody();
        } catch (\Stripe\Error\RateLimit $e) {
          // Too many requests made to the API too quickly
          $body = $e->getJsonBody();  
        } catch (\Stripe\Error\InvalidRequest $e) {
          // Invalid parameters were supplied to Stripe's API
            $body = $e->getJsonBody();
        } catch (\Stripe\Error\Authentication $e) {
          // Authentication with Stripe's API failed
            $body = $e->getJsonBody();
          // (maybe you changed API keys recently)
        } catch (\Stripe\Error\ApiConnection $e) {
          // Network communication with Stripe failed
            $body = $e->getJsonBody();
        } catch (\Stripe\Error\Base $e) {
          // Display a very generic error to the user, and maybe send
          // yourself an email
            $body = $e->getJsonBody();
        } catch (Exception $e) {
          // Something else happened, completely unrelated to Stripe
            $body = $e->getJsonBody();
        }
        if(isset($body)){
            $err  = $body['error']['message'];
            $this->Flash->error($err);
            $this->redirect(array('controller'=>'modules','action'=>'stripe_payment'));
        }
    }

    public function stripe_payment(){
        
        $this->set('title_for_layout','Stripe Payment');    
        $this->set('charge',array());
        if($this->request->data){

            $post_data = $this->request->data['StripePayments'];
            \Stripe\Stripe::setApiKey("your stripe secret key");
            $token = $post_data['stripe_token'];
            $recurring_pay = $post_data['recurring_pay'];

            if(empty($token)){
                $this->Flash->error(__('Invalid token detected.'));
                return;
            }

            if($recurring_pay == 1){

                //Create Plan
                $plan_id =time().rand(999,999999);
                $plan     = $this->create_plan($post_data['stripe_amount'],$plan_id);
                $customer_id = $this->create_customer("tushar.purohit.55@gmail.com");

                try {
                        // Charge the user's card:
                        $subscription = \Stripe\Subscription::create(array(
                                      "customer" => $customer_id,
                                      "plan" => $plan_id,
                                      "source" => $token
                                    ));

                        $this->set('charge',$subscription->__toArray(true));
                 // Use Stripe's library to make requests...
                } catch(\Stripe\Error\Card $e) {
                  // Since it's a decline, \Stripe\Error\Card will be caught
                  $body = $e->getJsonBody();
                } catch (\Stripe\Error\RateLimit $e) {
                  // Too many requests made to the API too quickly
                  $body = $e->getJsonBody();  
                } catch (\Stripe\Error\InvalidRequest $e) {
                  // Invalid parameters were supplied to Stripe's API
                    $body = $e->getJsonBody();
                } catch (\Stripe\Error\Authentication $e) {
                  // Authentication with Stripe's API failed
                    $body = $e->getJsonBody();
                  // (maybe you changed API keys recently)
                } catch (\Stripe\Error\ApiConnection $e) {
                  // Network communication with Stripe failed
                    $body = $e->getJsonBody();
                } catch (\Stripe\Error\Base $e) {
                  // Display a very generic error to the user, and maybe send
                  // yourself an email
                    $body = $e->getJsonBody();
                } catch (Exception $e) {
                  // Something else happened, completely unrelated to Stripe
                    $body = $e->getJsonBody();
                }
                if(isset($body)){
                    $err  = $body['error']['message'];
                    $this->Flash->error($err);
                    return;
                }
            }else{
                    
                try {
                        // Charge the user's card:
                        $charge = \Stripe\Charge::create(array(
                          "amount" => $post_data['stripe_amount'] * 100,
                          "currency" => "usd",
                          "description" => "Test Payment From Tushar's Profile",
                          "source" => $token,
                        ));
                        $this->set('charge',$charge->__toArray(true));
                 // Use Stripe's library to make requests...
                } catch(\Stripe\Error\Card $e) {
                  // Since it's a decline, \Stripe\Error\Card will be caught
                  $body = $e->getJsonBody();
                } catch (\Stripe\Error\RateLimit $e) {
                  // Too many requests made to the API too quickly
                  $body = $e->getJsonBody();  
                } catch (\Stripe\Error\InvalidRequest $e) {
                  // Invalid parameters were supplied to Stripe's API
                    $body = $e->getJsonBody();
                } catch (\Stripe\Error\Authentication $e) {
                  // Authentication with Stripe's API failed
                    $body = $e->getJsonBody();
                  // (maybe you changed API keys recently)
                } catch (\Stripe\Error\ApiConnection $e) {
                  // Network communication with Stripe failed
                    $body = $e->getJsonBody();
                } catch (\Stripe\Error\Base $e) {
                  // Display a very generic error to the user, and maybe send
                  // yourself an email
                    $body = $e->getJsonBody();
                } catch (Exception $e) {
                  // Something else happened, completely unrelated to Stripe
                    $body = $e->getJsonBody();
                }
                if(isset($body)){
                    $err  = $body['error']['message'];
                    $this->Flash->error($err);
                    return;
                }
            }
        }
    }


}
