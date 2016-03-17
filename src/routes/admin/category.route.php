<?php

$app->get('/en/admin/add-category', function ($request, $response, $args) {

  $this->logger->info("Slim-Skeleton '/' route");

  return $this->view->render($response, 'admin/add.category.twig', [
    'categoryNames' => $this->category->getCategoryNames(),
    'flash' => $this->flash->getMessages()
  ]);

});//->add($authenticate);

  $app->post('/en/admin/add-category', function ($request, $response, $args) {

    $this->logger->info("Slim-Skeleton '/' route");

    $categoryParent      = filter_var( $request->getParsedBody()['category-parent'], FILTER_SANITIZE_INT );
    $categoryName        = filter_var( $request->getParsedBody()['category-name'], FILTER_SANITIZE_STRING );
    $categorySlug        = filter_var( $request->getParsedBody()['category-slug'], FILTER_SANITIZE_STRING );
    $categoryDescription = filter_var( $request->getParsedBody()['category-description'], FILTER_SANITIZE_STRING );
    $visibility          = filter_var( $request->getParsedBody()['visibility'], FILTER_SANITIZE_STRING );

    $insert = $this->category->addCategory( $categoryParent, $categoryName, $categorySlug, $categoryDescription, $visibility );

    if( $insert !== false ) {
      $this->flash->addMessage('success', 'Category succesfuly added!');
      return $response->withStatus(301)->withHeader('Location', '/en/admin/category-list');
    } else {
      $this->flash->addMessage('warning', $this->category->errors);
      return $response->withStatus(301)->withHeader('Location', '/en/admin/add-category');
    }

  });//->add($authenticate);

  $app->post('/en/admin/edit-category', function ($request, $response, $args) {

    $this->logger->info("Edit Category '/edit-category' route");

    $updateCategory = $this->category->editCategory( $request->getParsedBody()['category-id'],
                                  $request->getParsedBody()['category-parent'],
                                  $request->getParsedBody()['category-name'],
                                  $request->getParsedBody()['category-slug'],
                                  $request->getParsedBody()['category-description'],
                                  $request->getParsedBody()['visibility'] );

    if( $updateCategory !== false ) {
      $this->flash->addMessage('success', 'Category succesfuly edited!');
      return $response->withStatus(301)->withHeader('Location', '/en/admin/category-list');
    } else {
      $this->flash->addMessage('danger', $this->category->errors);
      return $response->withStatus(301)->withHeader('Location', '/en/admin/edit-category/'.$request->getParsedBody()['category-id']);
    }

  });

$app->get('/en/admin/category-list', function ($request, $response, $args) {

  $this->logger->info("Slim-Skeleton '/' route");

  $this->category->order = 'DESC';

  return $this->view->render($response, 'admin/category.list.twig', [
    'categoryList' => $this->category->getCategoryList(),
    'flash' => $this->flash->getMessages()
  ]);

});//->add($authenticate);

$app->get('/en/admin/edit-category/{categoryId}[/{visibility}]', function ($request, $response, $args) {
  $this->logger->info("Edit Category '/en/admin/edit-category' route");

  if ( !empty( $args['categoryId'] ) ) {
    if( !empty( $args['visibility'] ) ) {
        if ( $args['visibility'] == 'yes' ){ $visibility = 'no'; } else { $visibility = 'yes'; }
        $updateCategory = $this->category->editVisibility( $args['categoryId'], $visibility );
        if( $updateCategory !== false ) {
          $this->flash->addMessage('success', 'Category succesfuly edited!');
          return $response->withStatus(301)->withHeader('Location', '/en/admin/category-list');
        } else {
          $this->flash->addMessage('danger', $this->category->errors);
          return $response->withStatus(301)->withHeader('Location', '/en/admin/category-list');
        }
    } else {
      if ( !filter_var( $args['categoryId'], FILTER_VALIDATE_INT) === false ) {
        $categoryId = filter_var($args['categoryId'], FILTER_SANITIZE_NUMBER_INT);
        return $this->view->render($response, 'admin/edit.category.twig', [
          'categoryDetails' => $this->category->getCategoryDetails( $categoryId ),
          'categoryNames' => $this->category->getCategoryNames(),
          'flash' => $this->flash->getMessages()
        ]);
      } else {
        return $response->withStatus(301)->withHeader('Location', '/en/admin/category-list');
      }
    }
  } else {
    return $response->withStatus(301)->withHeader('Location', '/en/admin/category-list');
  }

});

$app->get('/en/admin/delete-category/{categoryId}', function ($request, $response, $args) {
  $this->logger->info("Edit Category '/en/admin/edit-category' route");

  if ( !empty( $args['categoryId'] ) ) {
    if ( !filter_var( $args['categoryId'], FILTER_VALIDATE_INT) === false ) {
      $categoryId = filter_var($args['categoryId'], FILTER_SANITIZE_NUMBER_INT);
      $deleteCategory = $this->category->deleteCategory( $categoryId );
      if( $deleteCategory !== false ) {
        $this->flash->addMessage('success', 'Category succesfuly deleted!');
        return $response->withStatus(301)->withHeader('Location', '/en/admin/category-list');
      } else {
        $this->flash->addMessage('danger', $this->category->errors);
        return $response->withStatus(301)->withHeader('Location', '/en/admin/category-list');
      }
    } else {
      return $response->withStatus(301)->withHeader('Location', '/en/admin/category-list');
    }
  } else {
    return $response->withStatus(301)->withHeader('Location', '/en/admin/category-list');
  }

});

$app->post('/en/admin/generate-slug', function ($request, $response, $args) {
  $this->logger->info("Ajax category slug generetor '/en/admin/generate-slug' route");

  $response = $response->withHeader('Content-type', 'application/json');

  if ( !empty( $request->getParsedBody()['category-name'] ) ) {
    return json_encode( array( 'status' => 'success', 'slug' => $this->slugger->slugify( $request->getParsedBody()['category-name'] ) ) );
  }

});
?>
