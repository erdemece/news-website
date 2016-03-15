<?php

namespace admin;
use PDO;

class Settings {

  public $errors;
  protected $pdo = null;

  public function __construct( $container ) {
    $this->pdo = $container->get('pdo');
    if ( !$this->pdo instanceof PDO ) {
      throw new \RuntimeException (
        sprintf(
          '%s requires a PDO instance, app did not contain "PDO" key',
          __CLASS__
        )
      );
    }
  }

  public function addLogo( $imagePath ) {

    $sql = "SELECT * FROM site_settings WHERE setting = :setting";
    $stmt = $this->pdo->prepare( $sql );
    $stmt->execute( array( 'setting' => 'site_logo' ) );

    if ( $stmt->rowCount() > 0) {
      $sql = "UPDATE site_settings SET value = :value WHERE setting = 'site_logo'";
    } else {
      $sql = "INSERT INTO site_settings (setting, value ) VALUES ( 'site_logo', :value )";
    }

    try {
      $stmt = $this->pdo->prepare( $sql );

      if ( $stmt->execute( array( 'value' => $imagePath ) ) ) {
        return true;
      } else {
        return $this->errors = $stmt->errorInfo()[2];
      }
    } catch ( PDOEception $pe ) {
      $this->errors = $pe->getMesaage();
      return false;
    }

  }

}
