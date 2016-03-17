<?php

$app->get('/login', function ($request, $response, $args) {

    $this->logger->info("Slim-Skeleton '/login' route");

    if( !empty( $_SESSION['user_id'] ) ) {
      return $response->withStatus(302)->withHeader('Location', '/');
    } else {
      return $this->view->render($response, 'front/login.twig', [
        'flash' => $this->flash->getMessages()
      ]);
    }
});

$app->post('/login', function ($request, $response, $args) {

    $this->logger->info("Slim-Skeleton '/login' route");

    $errors = array();

    $username = filter_var( $request->getParsedBody()['username'], FILTER_SANITIZE_STRING );
    $password = filter_var( $request->getParsedBody()['password'], FILTER_SANITIZE_STRING );

    if ( !$this->users->validateUsername( $username ) ) {
      $errors[0] = "Only '.', '-' and '_' without space and numbers allowed for the user name";
    }

    if ( !$this->users->validatePassword( $password ) ) {
      $errors[1] = "Password must have at least 8 character, at least a number and special characters such as '@!_'";
    }

    if ( count( $errors ) > 0 ) {
      foreach( $errors as $error ) {
        $message[] = $this->flash->addMessage('warning', $error);
      }
      return $response->withStatus(302)->withHeader('Location', '/login');
    } else {
      $loginUser = $this->users->loginUser( $username, $password );
      if( $loginUser !== false ) {
        $this->flash->addMessage('success', 'Welcome back '.$username);
        return $response->withStatus(302)->withHeader('Location', '/');
      } else {
        $this->flash->addMessage('warning', 'Wrong password or username');
        return $response->withStatus(302)->withHeader('Location', '/login');
      }
    }
});


$app->get('/logout', function ($request, $response, $args) {
    $this->logger->info("Slim-Skeleton '/logout' route");
      unset( $_SESSION['userid'], $_SESSION['user_level'], $_SESSION['username'], $_SESSION['email'], $_SESSION['is_active'], $_SESSION['last_post'], $_SESSION['last_comment'], $_SESSION['user_activation_key'] );
      session_unset();
      $this->flash->addMessage('success', 'Have a nice day...');
      return $response->withStatus(302)->withHeader('Location', '/');
});

$app->get('/register', function ($request, $response, $args) {

    $this->logger->info("Slim-Skeleton '/register' route");

    if( !empty( $_SESSION['user_id'] ) ) {
      return $response->withStatus(302)->withHeader('Location', '/');
    } else {
      return $this->view->render($response, 'front/register.twig', [
        'flash' => $this->flash->getMessages(),
      ]);
    }

});

$app->post('/register', function ($request, $response, $args) {

    $this->logger->info("Slim-Skeleton '/register' route");

    $errors = array();

    $username = filter_var( $request->getParsedBody()['username'], FILTER_SANITIZE_STRING );
    $email = filter_var( $request->getParsedBody()['email'], FILTER_SANITIZE_EMAIL );
    $password = filter_var( $request->getParsedBody()['password'], FILTER_SANITIZE_STRING );

    if ( !$this->users->validateUsername( $username ) ) {
      $errors[0] = "Only '.', '-' and '_' without space and numbers allowed for the user name";
    }

    if ( !$this->users->validatePassword( $password ) ) {
      $errors[1] = "Password must have at least 8 character, at least a number and special characters such as '@!_'";
    }

    if ( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
      $errors[2] = "Please type correct email address";
    }

    if ( count( $errors ) > 0 ) {
      foreach( $errors as $error ) {
        $message[] = $this->flash->addMessage('warning', $error);
      }
      return $response->withStatus(302)->withHeader('Location', '/register');
    } else {
      $isUserExist = $this->users->isUserExist( $username, $email );
      if ( $isUserExist !== false ) {
        if( $isUserExist['username'] == $username ) {
          $this->flash->addMessage('warning', 'The username ( '.$username.' ) you choose is already exist ');
          return $response->withStatus(302)->withHeader('Location', '/register');
        }
        if( $isUserExist['email'] == $email ) {
          $this->flash->addMessage('warning', 'The email ( '.$email.' ) you choose is already exist');
          return $response->withStatus(302)->withHeader('Location', '/register');
        }
      } else {
        $addUser = $this->users->addUser( $username, $email, $password );
        if( $addUser == false ) {
          $this->flash->addMessage('warning', 'We cannot register you at the moment.');
          return $response->withStatus(302)->withHeader('Location', '/register');
        } else {
          $emailTemplate = $this->view->render($response, 'front\user.activation.template.twig' );
          $sendActivationEmail = $this->users->sendActivationEmail( $_SESSION['username'], $template );

          if ( $emailTemplate == false ) {
            $this->flash->addMessage('warning', 'We are not able send you activation email. If your email address is not real please update your e-mail address.');
            return $response->withStatus(302)->withHeader('Location', '/register');
          } else {
            $this->flash->addMessage('success', 'You are succesfuly registered! Please verify your e-mail address by clicking on the link that we sent to your emaill address.');
            return $response->withStatus(302)->withHeader('Location', '/');
          }
        }
      }
    }

});
