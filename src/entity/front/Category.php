<?php

namespace front;
use PDO;


class Category {

  public function __construct( $container ) {
    $this->pdo = $container->get('pdo');
  }

  public function getCategoryListTopMenu () {

    $sql = 'SELECT * FROM category ORDER BY category_order ASC';

    $query = $this->pdo->prepare($sql);

    if ( $query->execute( ) ) {
      if ( $query->rowCount() ) {
         $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
      } else {
        echo 'nothing to show';
      }
    }
  }


  public function getSingleCategory ($catid) {

    $sql = 'SELECT * FROM category WHERE category_id = :category_id ORDER BY category_order ASC';

    $query = $this->pdo->prepare($sql);

    if ( $query->execute( array( 'category_id' => $catid ) ) ) {
      if ( $query->rowCount() ) {
         $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
      } else {
        echo 'nothing to show';
      }
    }
  }

}

 ?>
