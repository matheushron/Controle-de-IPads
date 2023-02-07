<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Model {
   
    private $path;
   
    function __construct(){

        parent::__construct();
        $this->load->library('elasticsearch');
       
        $this->path = __DIR__.'/../logs/'.date("Y-m-d").'.log';
    }
   
    function appendLog(array $log){
     
      $id_usua = @$_SESSION['id_usua'];
     
      $log = [
        'date' => date('Y-m-d H:i:s'),
        'date_es' => date('Y-m-d').'T'.date('H:i:s').'Z',
        'remoteAddr' => $_SERVER['REMOTE_ADDR'],
        'id_usua' => $id_usua,
        'portal_name' => PORTAL_NAME,
        'host' => $_SERVER['HTTP_HOST'],
        'url' => $_SERVER['REQUEST_URI']
      ] + $log;
     
      //Send to Elasticsearch ---
      try {
         
          $params = [
              'index' => ($_SERVER['HTTP_HOST'] != 'localhost' ? 'sys_log' : 'sys_log_homolog'),
              'body' => $log
          ];
          $response = @$this->elasticsearch->client->index($params);
          //file_put_contents($this->path, json_encode($response).PHP_EOL, FILE_APPEND);
         
      } catch (Exception $e){
          file_put_contents($this->path, json_encode($log).PHP_EOL, FILE_APPEND);
      }
      
      return $log;
       
    }
   
}