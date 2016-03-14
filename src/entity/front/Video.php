<?php

namespace front;
use PDO;


class Video {

  public function __construct( $container ) {
    $this->pdo = $container->get('pdo');
  }

  public function getAllVideos () {

    $sql = 'SELECT * FROM video WHERE video_status = :video_status ORDER BY video_id DESC';

    $query = $this->pdo->prepare($sql);

    if ( $query->execute( array( 'video_status' => 'active' ) ) ) {
      if ( $query->rowCount() ) {
         $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
      } else {
        echo 'nothing to show';
      }
    }
  }

  public function getSingleVideo ($videoid) {

    $sql = 'SELECT * FROM video WHERE video_id= :video_id AND video_status = :video_status LIMIT 1';

    $query = $this->pdo->prepare($sql);

    if ( $query->execute( array( 'video_id' => $videoid, 'video_status' => 'active' ) ) ) {
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
