<?php

$app->get('/en/admin/user-list', function ($request, $response, $args) {

  $this->logger->info("Slim-Skeleton '/en/admin/user-list' route");

  return $this->view->render($response, 'admin/user.list.twig', [
    'userList' => $this->users->getUserList(),
    'flash' => $this->flash->getMessages()
  ]);

});

$app->get('/en/admin/edit-user/{userId}[/{isUserActive}]', function ($request, $response, $args) {
  $this->logger->info("Edit User '/en/admin/edit-user' route");

  $userId = filter_var( $args['userId'], FILTER_SANITIZE_NUMBER_INT );

  if ( !empty( $userId ) ) {
    if( !empty( $args['isUserActive'] ) ) {
        $isActive = filter_var( $args['isUserActive'], FILTER_SANITIZE_NUMBER_INT );
        if ( $isActive == 1 ){ $isActive = 0; } else { $isActive = 1; }
        $updateUser = $this->users->editUserStatus( $userId, $isActive );
        if( $updateUser !== false ) {
          $this->flash->addMessage('success', 'User succesfuly edited!');
          return $response->withStatus(302)->withHeader('Location', '/en/admin/user-list');
        } else {
          $this->flash->addMessage('danger', $this->users->errors);
          return $response->withStatus(302)->withHeader('Location', '/en/admin/user-list');
        }
    } else {
      if ( !filter_var( $userId, FILTER_VALIDATE_INT) === false ) {
        return $this->view->render($response, 'admin/edit.user.twig', [
          'userList' => $this->users->getUserDetails( $userId ),
          'flash' => $this->flash->getMessages()
        ]);
      } else {
        return $response->withStatus(302)->withHeader('Location', '/en/admin/user-list');
      }
    }
  } else {
    return $response->withStatus(302)->withHeader('Location', '/en/admin/user-list');
  }

});

$app->post('/en/admin/edit-user', function ($request, $response, $args) {

  $this->logger->info("Edit Category '/edit-category' route");

  $userId     = filter_var( $request->getParsedBody()['user-id'], FILTER_SANITIZE_NUMBER_INT );
  $username   = filter_var( $request->getParsedBody()['username'], FILTER_SANITIZE_STRING );
  $username   = strtolower( $username );
  $email      = filter_var( $request->getParsedBody()['email'], FILTER_SANITIZE_EMAIL );
  $email      = strtolower( $email );
  $userLevel  = filter_var( $request->getParsedBody()['user-level'], FILTER_SANITIZE_NUMBER_INT );
  $userStatus = filter_var( $request->getParsedBody()['user-status'], FILTER_SANITIZE_NUMBER_INT );

  $isUserExist = $this->frontUsers->isUserExist( $username, $email );
  if ( $isUserExist !== false ) {
    if( $isUserExist['username'] == $username ) {
      $this->flash->addMessage('warning', 'The username ( '.$username.' ) you choose is already exist ');
      return $response->withStatus(301)->withHeader('Location', '/en/admin/edit-user/'.$userId);
    }
    if( $isUserExist['email'] == $email ) {
      $this->flash->addMessage('warning', 'The email ( '.$email.' ) you choose is already exist');
      return $response->withStatus(301)->withHeader('Location', '/en/admin/edit-user/'.$userId);
    }
  } else {
    $updateUsers = $this->users->editUser( $userId, $username, $email, $userLevel, $userStatus );

    if( $updateUsers !== false ) {
      $this->flash->addMessage('success', 'User succesfuly updated!');
      return $response->withStatus(301)->withHeader('Location', '/en/admin/user-list');
    } else {
      $this->flash->addMessage('danger', $this->users->errors);
      return $response->withStatus(301)->withHeader('Location', '/en/admin/edit-user/'.$userId );
    }
  }

});
