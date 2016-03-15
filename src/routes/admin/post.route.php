<?php
$app->get('/en/admin/add-article', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // print_r($this->category->getCategoryNames());

    // foreach( $this->category->getCategoryNames() as $row ) {
    //   echo $row['category_name'].'<br />';
    // }

    return $this->view->render($response, 'admin/add.article.twig', [
      'categoryNames' => $this->category->getCategoryNames(),
      'currentTime' => $this->date->format('d/m/Y H:i')
    ]);

 });//->add($authenticate);

 $app->get('/en/admin/get-article-tags/{tags}', function ($request, $response, $args) {
    print_r(json_encode ( array ( 'tag_keyword' => $this->post->getTags($args['tags'])['tag_keyword'] ) ) );
 });

 $app->post('/en/admin/add-article', function ($request, $response, $args) {

     $this->logger->info("Add Post '/' route");

     print_r($request->getParsedBody());
    //  $errors = array();
    //
    //  if ( file_exists( $_FILES['article-image']['tmp_name'] ) ) {
    //      $allowedTypes = array( IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF );
    //      $detectedTypes = exif_imagetype( $_FILES['article']['tmp_name'] );
    //      if ( $_FILES['article']['error'] > 0 ) {
    //          $errors['file_error'] = $_FILES['article']['error'];
    //      }
    //      if ( $_FILES['article']['size'] > 2097152 ) {
    //          $errors['file_size_error'] = '2 MB Limit';
    //      }
    //      if ( !in_array( $detectedTypes, $allowedTypes ) ) {
    //          $errors['filetype_error'] = 'Only png, jpg, jpeg and gif allowed!';
    //      }
    //  }
    //
    //  if ( count( $errors ) > 0 ) {
    //    $this->flash->addMessage('danger', $errors);
    //    return $response->withStatus(301)->withHeader('Location', '/en/admin/add-article');
    //  } else {
    //    if ( $this->post->addArticle( $request->getParsedBody()['article-title'], $request->getParsedBody()['article-category'], $request->getParsedBody()['article-date'], $request->getParsedBody()['article-content'], $request->getParsedBody()['article-tags'], $request->getParsedBody()['is-article-active'], $request->getParsedBody('article-comment') ) ) {
    //
    //    }
    //    if ( file_exists( $_FILES['profilePicture']['tmp_name'] ) ) {
    //        $image = Image::make($_FILES['article-image']['tmp_name']);
    //        $image->backup();
    //        $image->fit(800);
    //        $profilePicture->save( 'media/article-images/'.$this->date->format('Y').'/'.$this->date->format('M').'/'.$this->date->format('D').'_800' );
    //        $picturePath = '/'.$picturePath;
    //      }
    //  }
    //
    //  if( $insert !== false ) {
    //    $this->flash->addMessage('success', 'Category succesfuly added!');
    //    return $response->withStatus(301)->withHeader('Location', '/en/admin/category-list');
    //  } else {
    //    $this->flash->addMessage('warning', $this->category->errors);
    //    return $response->withStatus(301)->withHeader('Location', '/en/admin/add-category');
    //  }

  });//->add($authenticate);
 ?>
