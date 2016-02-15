<?php

$app->get('/', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    print_r($this->post->getTitle('Test'));

});


 ?>
