<?php

namespace front;
use PDO;


class Category {

  public function __construct( $container ) {
    $this->pdo = $container->get('pdo');
  }

  public function getCategoryListTopMenu () {
    $sql = 'SELECT category_id, category_parent_id, category_name FROM category ORDER BY category_order ASC';
    $stmt = $this->pdo->prepare($sql);
    if ( $stmt->execute( ) ) {
      if ( $stmt->rowCount() ) {
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
      }
      return false;
    }
    return false;
  }


  public function getSingleCategory ($catid) {

    $sql = 'SELECT * FROM category WHERE category_id = :category_id ORDER BY category_order ASC';

    $stmt = $this->pdo->prepare($sql);

    if ( $stmt->execute( array( 'category_id' => $catid ) ) ) {
      if ( $stmt->rowCount() ) {
         $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
      } else {
        echo 'nothing to show';
      }
    }
  }

}

 ?>
