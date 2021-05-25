<?php
function header_log($data){
  $bt = debug_backtrace();
  $caller = array_shift($bt);
  $line = $caller['line'];
  $file = array_pop(explode('/', $caller['file']));
  header('log_'.$file.'_'.$caller['line'].': '.json_encode($data));
}
function debug($data){
    ini_set('display_errors', 'On');
    error_reporting(E_ALL);
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
}
?>