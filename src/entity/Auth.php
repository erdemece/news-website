<?php
namespace entity;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class Auth
{

  protected $userType;
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

     public function __construct( $givenAccess, $app ) {
       $this->givenAccess = $givenAccess;
       $this->userType = array( '1' => 'user',
                                '2' => 'author',
                                '3' => 'editor',
                                '4' => 'admin' );
      $this->flash = $app->getContainer()['flash'];
     }

    public function __invoke($request, $response, $next)
    {
      //Do Something before we execute logic
      if ( isset( $_SESSION['userLevel'] ) ) {
        if ( array_search( $this->givenAccess, $this->userType ) == $_SESSION['userLevel'] ) {
          $response =  $next($request, $response);
          return $response;
        } else {
          $this->flash->addMessage('login', 'You need to login to access this page');
          return $response->withStatus(301)->withHeader('Location', '/login');
        }
      }
    }
}

?>
