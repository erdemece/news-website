<?php
$app->get('/en/admin', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // echo $view->getAttribute('site_logo');
    // $values = array();
    // $stmt = $this->pdo->query( 'SELECT setting, value, description FROM site_settings' );
    // $settings = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // while ( $row = $settings ) {
    //   $setting[] = $row['setting'];
    // }
    //
    // var_dump($value);
    // print_r(array_map('reset', $values));
    return $this->view->render($response, 'admin/add.category.twig', [
      'flash' => $this->flash->getMessages()
    ]);
 });
 // ->add(new entity\Auth('admin', $app));

 ?>
