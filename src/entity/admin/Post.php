<?php
namespace admin;
use PDO;

class Post {

  public $category_id;
  public $category_name;
  public $category_route;
  public $category_status;
  public $category_order;
  public $category_visible;
  public $category_created_by;

  public $errors;
  public $lastInsertId;

  public function __construct( $container ) {
    $this->pdo = $container->get('pdo');
  }

  public function addPost( $articleTitle, $articleSlug, $articleShortDescription, $articleContent, $articleAuthor, $isActive, $articleCategory) {
    $sql = "INSERT INTO article (article_id, article_title, article_slug, article_short_description, article_main_content, article_author_id, article_created, article_updated, is_active )
                        VALUES( NULL, :article_title, :article_slug, :article_short_description, :article_main_content, :article_author_id, NOW(), NOW(), :is_active )";
    try {
      $query = $this->pdo->preparae( $sql );
      if ( $query->execute( array( 'article_title' => $articleTitle, 'article_slug' => $articleSlug, 'article_short_description' => $articleShortDescription, ':article_main_content' => $articleContent, ':article_author_id' => $articleAuthor, ':is_active' => $isActive) ) ) {
        if ( $this->addArticleCategory( $articleCategory, $this->pdo->lastInsertId() ) ) {
          $this->lastInsertId = $this->pdo->lastInsertId();
          return true;
        }
        return false;
      }
      return false;
    } catch ( PDOException $pe ) {
      return false;
    }
  }

  public function addArticleImage( $articleId, $imagePath ) {
    $sql = "INSERT INTO article_image (id, article_id, image_path ) VALUES (NULL, :article_id, :image_path)";
    try {
      $query = $this->pdo->prepare( $sql );
      if ( $query->execute( array( ':article_id' => $articleId, 'image_path' => $imagePath ) ) ) {
        return ture;
      }
    } catch ( PDOException $pe ) {
      return false;
    }
  }

  public function addArticleCategory( $categoryId, $articleId ) {

    $args = array_fill( 0, count($categoryId[0]), ':category_id' );
    $sql = "INSERT INTO article_category (id, category_id, article_id) VALUES ( NULL, implode( ',' $args ), :article_id )";
    try {
      $query = $this->pdo->prepare( $sql );
      foreach ( $categoryId as $row ) {
        $query->execute( array( 'category_id' => $row, 'article_id' => $article_id ) );
      }
      if ( $query->errorInfo() == '0' ) {
        return true;
      }
      return false;
    } catch( PDOException $pe ) {
      return false;
    }
  }

  public function getTags ($tags) {
    $sql = "SELECT tag_keyword FROM tags WHERE tag_keyword LIKE ? ORDER BY tag_count";
    try {
      $query = $this->pdo->prepare($sql);
      if( $query->execute( array( "$tags%" ) ) ) {
        if ( $query->rowCount() >= 1 ) {
          return $query->fetch(PDO::FETCH_ASSOC);
        }
        return false;
      }
      return false;
    } catch ( PDOException $pe) {
      return false;
    }

  }
}

 ?>
