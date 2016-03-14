<?php

namespace front;
use PDO;


class Article {

  public function __construct( $container ) {
    $this->pdo = $container->get('pdo');
  }

  public function getAllArticles () {

    $sql = 'SELECT * FROM article WHERE article_status = :article_status ORDER BY article_id DESC';

    $query = $this->pdo->prepare($sql);

    if ( $query->execute( array( 'article_status' => 'active' ) ) ) {
      if ( $query->rowCount() ) {
         $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
      } else {
        echo 'nothing to show';
      }
    }
  }

  public function getAllArticlesByAuthor ($authorid) {

    $sql = 'SELECT * FROM article WHERE article_author_id = :article_author_id ORDER BY article_id DESC';

    $query = $this->pdo->prepare($sql);

    if ( $query->execute( array( 'article_author_id' => $authorid ) ) ) {
      if ( $query->rowCount() ) {
         $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
      } else {
        echo 'nothing to show';
      }
    }
  }

  public function getAllArticlesByCategory ($categoryid) {

    $sql = 'SELECT * FROM article WHERE (article_category1_id = :article_category1_id OR article_category2_id = :article_category2_id OR article_category3_id = :article_category3_id) ORDER BY article_id DESC';

    $query = $this->pdo->prepare($sql);

    if ( $query->execute( array( 'article_category1_id' => $categoryid, 'article_category2_id' => $categoryid, 'article_category3_id' => $categoryid ) ) ) {
      if ( $query->rowCount() ) {
         $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
      } else {
        echo 'nothing to show';
      }
    }
  }


  public function getSingleArticle ($articleid) {

    $sql = 'SELECT * FROM article WHERE article_id= :article_id AND article_status = :article_status LIMIT 1';

    $query = $this->pdo->prepare($sql);

    if ( $query->execute( array( 'article_id' => $articleid, 'article_status' => 'active' ) ) ) {
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
