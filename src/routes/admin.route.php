<?php

$app->get('/en/admin', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    $messages = $this->flash->getMessages();

    return $this->view->render($response, 'admin/home.twig', [
        'flash' => $messages
    ]);
});


 ?>
