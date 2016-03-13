<?php
namespace entity;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class Auth
{

  protected $userType = array( '1' => 'user',
                               '2' => 'author',
                               '3' => 'editor',
                               '4' => 'admin' );
  public $givenAccess;
    /**
     * Example middleware invokable class
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  callable                                 $next     Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */

    public function __construct( $container ) {
      $this->flash = $container->get('flash');

    }

    public function __invoke($request, $response, $next)
    {
      //Do Something before we execute logic
      if ( $this->checkPermission() === true ) {
          $this->flash->addMessage('login', 'You need to login to access this page');
          return $response->withStatus(301)->withHeader('Location', '/login');
      } else {
        $response =  $next($request, $response);
        return $response;
      }

    }

    public function givenAccess($access) {
      $this->givenAccess = $access;
    }

    protected function checkPermission() {
      if ( isset( $_SESSION['userLevel'] ) ) {
        if ( array_search( $givenAccess, $userType ) == $_SESSION['userLevel'] ) {
          return true;
        }
        return false;
      }
      return false;
    }
}

?>
