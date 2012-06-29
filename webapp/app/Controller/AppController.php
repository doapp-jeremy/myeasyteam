<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
  public $components = array(
      'Session',
      'Auth' => array(
          'authenticate' => array(
              'Form' => array(
                  'fields' => array('username' => 'email', 'password' => 'password_new')
              )
          )
      ),
      'DebugKit.Toolbar' => array('panels' => array('history'=>false,'include'=>false))
  );

  public $helpers = array(
      'Html',
      'Form',
      'Session',
      'Js',
      'AssetCompress.AssetCompress',
  );

  public function setResponseCodeHeader($responseCode=400) {
    switch ($responseCode) {
      case 400:
        $header = 'HTTP/1.0 400 Bad Request';
        break;
      case 403:
        $header = 'HTTP/1.0 403 Forbidden';
        break;
      case 500:
        $header = 'HTTP/1.0 500 Internal Server Error';
        break;
      default:
        $header = $responseCode;
        break;
    }
    header($header);
    $this->response->header(array(''=>$header));
  }
  
  /**
   *
   * Render (and exit) error JSON for an ajax submitted form.  Example return:
   *
   *
   * ```
   {
   "success": false,
   "message": "oops there was an error",
   "fieldMessages": {
   "package_id": "package id e",
   "custom_keystore_file": "custom_keystore_file e",
   "keystore_pw": "keystore_pw e",
   "alias_name": "alias_name e"
   }
   }

   * ```
   * @param string $genericErrorMessage
   * @param array $domIdMesages key is id of the element in the dom, value is the error message
   */
  public function renderJsonErrorForAjaxForm($genericErrorMessage,$domIdMesages=array()) {
    $this->autoRender = false;	//Don't even hit a view/layout
    //Configure::write('debug', 0);
    $this->setResponseCodeHeader(200);

    header('Content-type: application/json; charset=utf-8');
    $this->response->header(array('Content-type'=>'application/json'));

    echo json_encode(array('success'=>false, 'message'=>$genericErrorMessage, 'fieldMessages'=>$domIdMesages));
    exit();
  }

  /**
   * Take $this->Model->validationErrors and turn it into a dom ID => error message array.
   * The domID is created from the cake convention of ModelFieldName
   *
   * @param string $modelName (CamelCase)
   * @param unknown_type $validationErrors
   */
  static function convertErrorsToAjaxFieldDomIds($model,$validationErrors) {
    $domIdToMsg = array();
    foreach ($validationErrors as $field => $arrayOfErrors) {
      $errString = null;
      foreach ($arrayOfErrors as $err) {
        $errString .= "$err ";
      }

      $domIdToMsg[$model.Inflector::camelize($field)] = $errString;
    }

    return $domIdToMsg;
  }

  /**
   *
   * Render (and exit) success JSON for an ajax submitted form.
   *
   * Ex:
   * ```
   *
   {
   "success": true,
   "message": "Success",
   "redirectURL": false,
   "domIdValues": [

   ]
   }
   * ```
   * @param string $message
   * @param string $redirectURL
   * @param array $domIdHTMLs 'domIdOfElement'=>'theHTML to set'
   * @param array $domIdValues 'domIdOfElement'=>'theValue to set'
   */
  public function renderJsonSuccessForAjaxForm($message,$redirectURL=false,$domIdHTMLs=array(),$domIdValues=array()) {
    $this->autoRender = false;	//Don't even hit a view/layout
    Configure::write('debug', 0);
    $this->setResponseCodeHeader(200);

    header('Content-type: application/json; charset=utf-8');
    $this->response->header(array('Content-type'=>'application/json'));

    echo json_encode(array('success'=>true,'message'=>$message, 'redirectURL'=>$redirectURL, 'domIdValues'=>$domIdValues, 'domIdHTMLs'=>$domIdHTMLs));
    exit();
  }

  public function getUserId()
  {
    return $this->Session->read('Auth.User.id');
  }
  
  /**
   * Do a get of a URL
   *
   * @param unknown_type $URL
   * @param unknown_type $requestHeaders
   * @return array 'http_code'=>response Code,'response_body'=>response body,'curl_info'=>curl_info() array,'response_headers'=>raw headers
   */
  function doGet($URL,$requestHeaders = array('Connection: close')) {
    $ch = curl_init($URL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	//doesnt work in setopt_array...
    curl_setopt_array($ch,array(
        CURLOPT_HEADER => true,
        CURLOPT_HTTPHEADER => $requestHeaders,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_MAXREDIRS => 3,
        CURLOPT_CONNECTTIMEOUT => 3,	//The number of seconds to wait while trying to connect. Use 0 to wait indefinitely.
        CURLOPT_TIMEOUT => 20,			//The maximum number of seconds to allow cURL functions to execute.
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_FAILONERROR => true,
        CURLOPT_ENCODING => ""			//Accept gzip etc. a header containing all supported encoding types is sent when "" is passed
    ));
  
    $response = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
  
    $headerSize = $info['header_size'];
    $headers = substr($response, 0, $headerSize);
    $responseBody = substr($response, $headerSize);
  
    return array('http_code'=>$info['http_code'],'response_body'=>$responseBody,'curl_info'=>$info,'response_headers'=>$headers);
  }
  
}
