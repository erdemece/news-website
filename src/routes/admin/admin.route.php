<?php
$app->get('/en/admin', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");
    $result = $this->frontCategory->getCategoryListTopMenu();
    $ref    = array();
    $list   = array();

    foreach( $result as $row ) {
      $ref = & $refs[$row['category_id']];

      $ref['category_parent_id'] = $row['category_parent_id'];
      $ref['category_name']      = $row['category_name'];

      if ($row['category_parent_id'] == 0)
      {
          $list[$row['category_id']] = & $ref;
      }
      else
      {
          $refs[$row['category_parent_id']]['children'][$row['category_id']] = & $ref;
      }
    }

   function buildParent( array $array ) {
     $html = '<ul class="dropdown-menu">';
     $html .= '<li>';
     $html .= '<div class="yamm-content">';
     $html .= '<div class="row">';
     $html .= '<div class="col-lg-3 col-md-3">';
     $html .= '<ul class="mega-links">';
     foreach( $array as $value ) {
       $html .= '<li><a href="">'. $value['category_name'] .'</a></li>';
     }
     $html .= '</ul>';
     $html .= '</div>';
     $html .= '</div>';
     $html .= '</div>';
     $html .= '</li>';
     $html .= '</ul>';
     return $html;
    }

    function buildMenu(array $array)
    {
      $html = '<li class="dropdown yamm-fw">';
      foreach ( $array as $value ) {
        $html .= '<li class="dropdown yamm-fw">';
        $html .= '<a class="dropdown-link" href="">'. $value['category_name'] .'</a>';
        $html .= '<a class="dropdown-caret dropdown-toggle" data-hover="dropdown" ><b class="caret hidden-xs"></b></a>';
        if (!empty($value['children'])){
          $html .= buildParent($value['children']);
        }
      }
      $html .= '</li>';
      return $html;
    }

    var_dump( buildMenu($list) );
    // var_dump($this->users->isUserExist('erdeEmece', 'erdemece@hotmail.com'));
    // var_dump($this->users->errors);
    // return $this->view->render($response, 'admin/add.category.twig', [
    //   'flash' => $this->flash->getMessages()
    // ]);
 });
 // ->add(new entity\Auth('admin', $app));

 ?>
