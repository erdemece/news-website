<?php
$app->get('/en/admin', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");
    $this->auth->givenAccess('admin');
    return $this->view->render($response, 'admin/home.twig');
 });


 ?>
