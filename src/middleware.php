<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);
$authenticate = function ( $app ) {
    return function () use ( $app ) {
        if ( !isset( $_SESSION['userid'] ) ) {
            echo 'test';
        }
    };
};
