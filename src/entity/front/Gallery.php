<?php

namespace front;
use PDO;


class Gallery {

  public function __construct( $container ) {
    $this->pdo = $container->get('pdo');
  }

  public function getGalleryList () {

    $sql = 'SELECT * FROM gallery WHERE gallery_status = :gallery_status AND (gallery_visibility = :gallery_visibility OR gallery_visibility = :gallery_visibility2) ORDER BY gallery_date DESC';

    $query = $this->pdo->prepare($sql);

    if ( $query->execute( array( 'gallery_status' => 'active', 'gallery_visibility' => 'gallery_only', 'gallery_visibility2' => 'both' ) ) ) {
      if ( $query->rowCount() ) {
         $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
      } else {
        echo 'nothing to show';
      }
    }
  }

  public function getGalleryDetail ($galleryid) {

    $sql = 'SELECT * FROM gallery WHERE gallery_status = :gallery_status AND gallery_id = :gallery_id ORDER BY gallery_date DESC';

    $query = $this->pdo->prepare($sql);

    if ( $query->execute( array( 'gallery_status' => 'active', 'gallery_id' => $galleryid ) ) ) {
      if ( $query->rowCount() ) {
         $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
      } else {
        echo 'nothing to show';
      }
    }
  }

  public function getGalleryItems ($galleryid) {

    $sql = 'SELECT * FROM gallery_item_gallery WHERE gallery_item_gallery_gallery_id = :gallery_item_gallery_gallery_id ORDER BY gallery_item_gallery_id ASC';

    $query = $this->pdo->prepare($sql);

    if ( $query->execute( array( 'gallery_item_gallery_gallery_id' => $galleryid ) ) ) {
      if ( $query->rowCount() ) {
         $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
      } else {
        echo 'nothing to show';
      }
    }
  }

  public function getGalleryItemDetail ($galleryitem_id) {

    $sql = 'SELECT * FROM gallery_item WHERE gallery_item_id = :gallery_item_id ORDER BY gallery_item_gallery_id DESC';

    $query = $this->pdo->prepare($sql);

    if ( $query->execute( array( 'gallery_item_id' => $galleryitem_id ) ) ) {
      if ( $query->rowCount() ) {
         $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
      } else {
        echo 'nothing to show';
      }
    }
  }


  public function getGalleryForArticle ($articleid) {

    $sql = 'SELECT * FROM gallery_article WHERE gallery_article_article_id = :gallery_article_article_id';

    $query = $this->pdo->prepare($sql);

    if ( $query->execute( array( 'gallery_article_article_id' => $articleid ) ) ) {
      if ( $query->rowCount() ) {
         $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
      } else {
        echo 'nothing to show';
      }
    }
  }

  public function getGalleryItemForArticle ($articleid) {

    $sql = 'SELECT * FROM gallery_item_article WHERE gallery_item_article_article_id = :gallery_item_article_article_id';

    $query = $this->pdo->prepare($sql);

    if ( $query->execute( array( 'gallery_item_article_article_id' => $articleid ) ) ) {
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
