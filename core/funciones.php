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


function daysWeek($inicio, $fin){
    
  $start = new DateTime($inicio);
  $end = new DateTime($fin);

  //de lo contrario, se excluye la fecha de finalización (¿error?)
  $end->modify('+1 day');

  $interval = $end->diff($start);

  // total dias
  $days = $interval->days;

  // crea un período de fecha iterable (P1D equivale a 1 día)
  $period = new DatePeriod($start, new DateInterval('P1D'), $end);

  // almacenado como matriz, por lo que puede agregar más de una fecha feriada
  $holidays = array('2012-09-07');

  foreach($period as $dt) {
      $curr = $dt->format('D');

      // obtiene si es Sábado o Domingo
      if($curr == 'Sat' || $curr == 'Sun') {
          $days--;
      }elseif (in_array($dt->format('Y-m-d'), $holidays)) {
          $days--;
      }
  }

  return $days;
}

?>