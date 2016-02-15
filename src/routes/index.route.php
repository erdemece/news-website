<?php

$app->get('/', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    print_r($this->slugger->slugify('ananin amini session_get_cookie_params'));

});


 ?>
