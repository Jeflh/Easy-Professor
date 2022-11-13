<?php
function autenticado() : bool {
  session_start();

  if(isset($_SESSION['login'])){
    $auth = $_SESSION['login'];

    if($auth){
      return true;
    }
  }
  return false;
}

function validDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
    return $d && $d->format($format) === $date;
}

?>