<?php

$app->get('/', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    $messages = $this->flash->getMessages();

    return $this->view->render($response, 'home.twig', [
        'flash' => $messages
    ]);
});


 ?>
