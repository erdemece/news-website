<?php
$app->get('/en/admin/add-post', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // print_r($this->category->getCategoryNames());

    // foreach( $this->category->getCategoryNames() as $row ) {
    //   echo $row['category_name'].'<br />';
    // }

    return $this->view->render($response, 'admin/add.post.twig', [
      'categoryNames' => $this->category->getCategoryNames(),
      'currentTime' => $this->date->format('d/m/Y H:i')
    ]);

 });//->add($authenticate);

 $app->post('/en/admin/add-post', function ($request, $response, $args) {
     // Sample log message
     $this->logger->info("Slim-Skeleton '/' route");


  });//->add($authenticate);
 ?>
