<?php

$app->get('/', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    $d1 = $this->post->setTitle('Test');


    print_r( $d1->getTitle() ) ;

});


 ?>
