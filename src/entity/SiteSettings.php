<?php
namespace entity;

use PDO;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class SiteSettings {

  protected $pdo = null;
  protected $app = null;
  protected $view = null;

  public function __construct( \Slim\App $app ) {
    $this->app = $app;
    $this->view = $app->getContainer()->get('view');
    $this->pdo =  $app->getContainer()->get('pdo');
    if ( !$this->pdo instanceof PDO ) {
      throw new \RuntimeException (
        sprintf(
          '%s requires a PDO instance, app did not contain "PDO" key',
          __CLASS__
        )
      );
    }
  }
  public function __invoke( $request, $response, $next ) {
    $settings = $this->getSettings();
    if( $settings ) {
      foreach ( $settings as $row ) {
        $this->view->getEnvironment()->addGlobal(
          $row['setting'],
          $row['value']
        );
      }
      $response = $next(
        $request,
        $response
      );
    }
    return $response;
  }
  protected function getSettings() {
    try {
      $stmt = $this->pdo->query( 'SELECT setting, value, description FROM site_settings' );
      return $stmt->fetchAll();
    } catch ( PDOException $pe ) {
      return false;
    }
  }
}
