<?php

$app->get('/', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

  $data_category = $this->Category->getCategoryListTopMenu();

    return $this->view->render($response, 'front/home.twig', [
        'categories' => $data_category
    ]);
});


$app->get('/article/{articlename}/{articleid}', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    $data_category = $this->Category->getCategoryListTopMenu();
    return $this->view->render($response, 'front/article.twig', [
        'categories' => $data_category
    ]);
});



$app->get('/login', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    $data_category = $this->Category->getCategoryListTopMenu();

    return $this->view->render($response, 'front/login.twig', [
        'categories' => $data_category
    ]);
});


$app->get('/register', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    $data_category = $this->Category->getCategoryListTopMenu();

    return $this->view->render($response, 'front/register.twig', [
        'categories' => $data_category
    ]);
});


$app->get('/contact', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    $data_category = $this->Category->getCategoryListTopMenu();

    return $this->view->render($response, 'front/contactus.twig', [
        'categories' => $data_category
    ]);
});


$app->get('/info/{pagename}', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    $data_category = $this->Category->getCategoryListTopMenu();

    return $this->view->render($response, 'front/' . $args['pagename'] . '.twig', [
        'categories' => $data_category
    ]);
});

$app->get('/author/{authorname}/{authorid}', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    $data_category = $this->Category->getCategoryListTopMenu();

    return $this->view->render($response, 'front/author.twig', [
        'categories' => $data_category
    ]);
});


$app->get('/category/{categoryname}/{categoryid}', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

// $testdata = $this->OtherF->sendContactForm ('sname', 'semail', '1.2.3.4', 'msg', date('Y-m-d H:i:s'), 'active', 'no');
// $testdata = $this->OtherF->sendVisitorVideo('$temp_video_sender_name', '$temp_video_sender_email', '1', date('Y-m-d H:i:s'), 'read');
// echo $testdata;

     //$dt2 = $this->Other->sendContactForm('a', 'b', '1.2.3.4', 'abc', '', 'active', 'yes');
    // $dt = $this->Others->getTagsx();
   $data_video = $this->Video->getAllVideos();
  // $data_news = $this->Article->getAllArticles();
  // $data_comments = $this->Comment->getAllItemComments('1');
  // $data_stats = $this->Statistics->getMostReadArticles('all');
  $data_category = $this->Category->getCategoryListTopMenu();

    return $this->view->render($response, 'front/category.twig', [
    //     //'news' => $data,
        'categories' => $data_category,
    //     // 'news' => $data_news,
    //     // 'comments' => $data_comments
    //     // 'stats' => $data_stats
    'videos' => $data_video
    //     //'dts' => $dt
    ]);

});




// EX FUNCTIONS USED

//  $this->frontPost->getAllCategories('15');
    // $sql = 'SELECT * FROM category ORDER BY category_order';
    //
    // $query = $this->pdo->prepare($sql);
    //
    // if ( $query->execute( ) ) {
    //   if ( $query->rowCount() ) {
    //      $data = $query->fetchAll(PDO::FETCH_ASSOC);
    //      foreach ( $key as $value ) {
    //         $data = $value;
    //      }
    //   } else {
    //     echo 'nothing to show';
    //   }
    // }


?>
