<?php

$app->get('/en/admin/settings/logo', function ($request, $response, $args) {
    $this->logger->info("Kurdish Question '/en/admin/settings/logo' route");
    return $this->view->render($response, 'admin/site.settings.twig', [
      'flash' => $this->flash->getMessages()
    ]);
 });

 $app->post('/en/admin/settings/logo', function ($request, $response, $args) {
   $this->logger->info("Kurdish Question '/en/admin/settings/logo' route");

   $errors = array();
   $allowedTypes = array( IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF );
   $imagePath = 'skin/default/front/images/logo.png';
   if ( empty($request->getParsedBody()['logo-width']) )
    $logoWidth = '150';
   else
    $logoWidth =  $request->getParsedBody()['logo-width'];


   if ( file_exists( $_FILES['site-logo']['tmp_name'] ) ) {
       $detectedTypes = exif_imagetype( $_FILES['site-logo']['tmp_name'] );
       if ( $_FILES['site-logo']['error'] > 0 ) {
           $errors['file_error'] = $_FILES['site-logo']['error'];
       }
       if ( $_FILES['site-logo']['size'] > 2097152 ) {
           $errors['file_size_error'] = '2 MB Limit';
       }
       if ( !in_array( $detectedTypes, $allowedTypes ) ) {
           $errors['filetype_error'] = 'Only png, jpg, jpeg and gif allowed!';
       }
   }

   if ( count( $errors ) > 0 ) {
     $this->flash->addMessage('danger', $errors);
     return $response->withStatus(301)->withHeader('Location', '/en/admin/settings/logo');
   } else {
     $image = $this->imgupload->make($_FILES['site-logo']['tmp_name']);
     $image->backup();
     $image->resize($logoWidth, null, function ($constraint) {
       $constraint->aspectRatio();
     });
     $image->save( $imagePath );

     if( $image ) {
       $addLogo = $this->siteSettings->addLogo( '/'.$imagePath );
     }

     if( $addLogo !== false ) {
       $this->flash->addMessage('success', 'Website logo added!');
       return $response->withStatus(301)->withHeader('Location', '/en/admin/settings/logo');
     } else {
       $this->flash->addMessage('warning', $errors);
       return $response->withStatus(301)->withHeader('Location', '/en/admin/settings/logo');
     }
   }

  });
