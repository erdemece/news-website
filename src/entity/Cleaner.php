<?php

namespace entitiy;

class Cleaner {

  public function filterVar( $string, $type = null ) {

      if ( $type )
          $string = preg_replace('/\s+/', '', $string);

      $string = trim($string);

      if ( $type == 'email' ) {
          $string = filter_var($string, FILTER_SANITIZE_EMAIL);
      } elseif ( $type == 'url' ) {
          $string = filter_var($string, FILTER_SANITIZE_URL);
      } elseif ( $type == 'password' ) {
          $string = filter_var($string, FILTER_SANITIZE_STRING);
      } elseif ( $type == 'number' ) {
          $string = filter_var($string, FILTER_SANITIZE_NUMBER_INT);
      } else {
          $string = filter_var($string, FILTER_SANITIZE_STRING);
      }

      return $string;
  }

}

 ?>
