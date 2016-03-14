<?php

namespace front;
use PDO;


class Comment {

  public function __construct( $container ) {
    $this->pdo = $container->get('pdo');
  }

  public function getAllItemComments ($itemid) {

    $sql = 'SELECT * FROM comment WHERE comment_item_id = :comment_item_id AND comment_status = :comment_status ORDER BY comment_id DESC';
    $query = $this->pdo->prepare($sql);

    if ( $query->execute( array( 'comment_item_id' => $itemid, 'comment_status' => 'active' ) ) ) {
      if ( $query->rowCount() ) {
         $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
      } else {
        echo 'nothing to show';
      }
    }
  }

  public function countAllItemComments ($itemid) {

    $sql = 'SELECT * FROM comment WHERE comment_item_id = :comment_item_id AND comment_status = :comment_status ORDER BY comment_id DESC';
    $query = $this->pdo->prepare($sql);

    if ( $query->execute( array( 'comment_id' => $itemid, 'comment_status' => 'active' ) ) ) {
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
