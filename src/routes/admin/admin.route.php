<?php
$app->get('/en/admin', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");
    echo $request->getAttribute('site_url');
    echo $request->getAttribute('site_logo');

    return $this->view->render($response, 'admin/add.category.twig', [
      'flash' => $this->flash->getMessages()
    ]);
 });
 // ->add(new entity\Auth('admin', $app));

 ?>
