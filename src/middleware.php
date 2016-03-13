<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);

$authenticate = function ($request, $response, $next) {
    //Do Something before we execute logic
    if ( !isset( $_SESSION['userid'] ) ) {
        $this->flash->addMessage('login', 'You need to login to access this page');
        return $response->withStatus(301)->withHeader('Location', '/login');
    }
    $response =  $next($request, $response);
    return $response;
};
