<?php
// Routes

$app->get('/', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    $messages = $this->flash->getMessages();

    return $this->view->render($response, 'index.twig', [
        'flash' => $messages
    ]);
});


$app->post('/upload', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    if ( empty($request->getParsedBody()['imageOneWidht']) ||
         empty($request->getParsedBody()['imageOneHeight']) ||
         empty($request->getParsedBody()['imageTwoWidht']) ||
         empty($request->getParsedBody()['imageTwoHeight'])) {
           $this->flash->addMessage('danger', 'Kutulari doldur');
           return $response->withStatus(302)->withHeader('Location', '/');
         }

    if ( file_exists( $_FILES['image']['tmp_name'] ) ) {

        $allowedTypes = array( IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF );
        $detectedTypes = exif_imagetype( $_FILES['image']['tmp_name'] );

        if ( $_FILES['image']['error'] > 0 ) {
          $this->flash->addMessage('danger', 'Gecersiz Foto');
          return $response->withStatus(302)->withHeader('Location', '/');
        }

        if ( !in_array( $detectedTypes, $allowedTypes ) ) {
          $this->flash->addMessage('danger', 'png, jpg, jpeg, gif bunların oluru var.');
          return $response->withStatus(302)->withHeader('Location', '/');
        }

        $image = $this->imgupload->make($_FILES['image']['tmp_name']);

        $image->backup();

        $image1 = $image->fit($request->getParsedBody()['imageOneWidht'], $request->getParsedBody()['imageOneHeight']);
        $image1_name = 'media/image1_'.$request->getParsedBody()['imageOneWidht'].'x'.$request->getParsedBody()['imageOneHeight'].'.jpg';
        $image1->save( $image1_name );

        $image1->reset();

        $image2 = $image->fit($request->getParsedBody()['imageTwoWidht'], $request->getParsedBody()['imageTwoHeight']);
        $image2_name = 'media/image2_'.$request->getParsedBody()['imageTwoWidht'].'x'.$request->getParsedBody()['imageTwoHeight'].'.jpg';
        $image->save( $image2_name );

        return $this->view->render($response, 'index.twig', ['image1' => $image1_name, 'image2' => $image2_name]);

    } else {

      $this->flash->addMessage('danger', 'Fotoğraf 2 MB dan fazla veya tam olarak bir fotoğraf değil.');
      return $response->withStatus(302)->withHeader('Location', '/');

    }



});
