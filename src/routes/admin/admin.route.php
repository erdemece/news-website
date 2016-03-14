<?php
$app->get('/en/admin', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    echo 'hello';

 })->add(new entity\Auth('admin', $app));


 ?>
