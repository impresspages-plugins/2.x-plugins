<?php
/**
 * @package   ImpressPages
 * @copyright Copyright (C) 2009 JSC Apro media.
 * @license   GNU/GPL, see ip_license.html
 */
namespace Modules\download\counter;

if (!defined('CMS')) exit;

require_once(__DIR__.'/db.php');

class Actions{

  public function makeActions(){
    global $site;
    $site->requireconfig('download/counter/config.php');
    
    if(isset($_REQUEST['file'])){
      $allowedExtensions = Config::getAllowedExtensions();
      $allowedPaths = Config::getAllowedPaths();
      $restrictedExtensions = Config::getRestrictedExtensions();
      $file = realpath($_REQUEST['file']); //expands all symbolic links and resolves references to '/./', '/../' and extra '/' characters in the input path  and return the canonicalized absolute pathname.
      if(file_exists($file)){
        $fileName = basename($file); // Get real file name.
        $filePath = substr($file, 0,-strlen($fileName));
        $info = pathinfo($fileName);
        $fileExtension = strtolower($info['extension']);
  
        $error = null;
        
        if(sizeof($allowedExtensions)){
          $allowed = false;
          foreach($allowedExtensions as $key => $extension){
            if($extension == $fileExtension){
              $allowed = true;              
            }
          }
          if(!$allowed){
            $error = 'File extension '.$fileExtension.' is not in the list of allowed.';
          }
        }
        { //check extension in restricted array
          $restricted = false;
          foreach($restrictedExtensions as $key => $extension){
            if($extension == $fileExtension){
              $restricted = true;              
            }
          }
          if($restricted){
            $error = 'File extension '.$fileExtension.' is in the list of restricted extensions.';
          }      
        }
        
        $allowedPath = false;

        foreach ($allowedPaths as $key => $path){
          if(strpos($filePath, realpath($path)) === 0){
            $allowedPath = true;
          }
        }
        if(!$allowedPath){
          $error = 'File is not in allowed path '.$_REQUEST['file'];
        }
        if($error == null){
          if(isset($_REQUEST['required_name'])){
            $this->supplyFile($filePath, $fileName, $_REQUEST['required_name']);
          }else{
            $this->supplyFile($filePath, $fileName);
          } 
          
          
              
          if(strpos($_REQUEST['file'], BASE_DIR) === 0){
            $relativePath = str_replace(BASE_DIR, '', $_REQUEST['file']);
          } else {
            $relativePath = $_REQUEST['file'];
          }
          
          if(isset($_REQUEST['group_id'])){
            Db::logDownload($relativePath, $_REQUEST['group_id']);
          } else {
            Db::logDownload($relativePath);
          }          
          
          \Db::disconnect();
          exit;                
        } else {
          global $log;
          $log->log('download/count', 'error', $error.' '.$_SERVER['REMOTE_ADDR']);
          //echo($error);
          //\Db::disconnect();
          //exit;          
        }

      } else {
        $site->error404();        
      }

    }
  }
  
  private function supplyFile($filePath, $fileName, $requiredName = null){
    // get mime type
    $mtype = "application/force-download";

    $fsize = filesize($filePath.$fileName); 
    
    // Browser will try to save file with this filename, regardless original filename.
    if($requiredName !== null){
      $asfname = $requiredName;
    }else{
      $asfname = $fileName;
    }

    // set headers
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header("Content-Type: $mtype");
    header("Content-Disposition: attachment; filename=\"$asfname\"");
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: ".$fsize);
    
    // download
    // @readfile($file_path);
    $file = @fopen($filePath.$fileName,"rb");
    if ($file) {
      while(!feof($file)) {
        print(fread($file, 1024*8));
        flush();
        if (connection_status()!=0) {
          @fclose($file);
          die();
        }
      }
      @fclose($file);
    }
    

    
  }
}