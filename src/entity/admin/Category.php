<?php

namespace admin;
use PDO;

class Category {

  public $errors;
  protected $pdo = null;

  public function __construct( $container ) {
    $this->pdo = $container->get('pdo');
    if ( !$this->pdo instanceof PDO ) {
      throw new \RuntimeException (
        sprintf(
          '%s requires a PDO instance, app did not contain "PDO" key',
          __CLASS__
        )
      );
    }
  }

  public function getCategoryNames () {
    $sql = "SELECT category_id, category_parent_id, category_name FROM category";
    $stmt =  $this->pdo->prepare( $sql );
    if( $stmt->execute( ) ) {
      if( $stmt->rowCount() ) {
        $result = $stmt->fetchAll();
        return $result;
      }
      return false;
    }
    return false;
  }

  public function getCategoryDetails( $categoryId ) {
    $sql = "SELECT * FROM category WHERE category_id = :category_id";
    $stmt = $this->pdo->prepare( $sql );
    if ( $stmt->execute( array( 'category_id' => $categoryId ) ) ) {
      if( $stmt->rowCount(  ) ) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
      }
      return false;
    }
    return false;
  }

  public function getCategoryList() {
    $sql = "SELECT * FROM category ORDER BY category_order";
    $stmt = $this->pdo->prepare( $sql );
    if( $stmt->execute( ) ) {
      if( $stmt->rowCount() ) {
        return $stmt->fetchAll();
      }
      return false;
    }
    return false;
    $this->errors = $stmt->errorInfo()[2];
  }

  public function addCategory( $parentId, $categoryName, $categorySlug, $categoryDescription, $isActive ) {
    $sql = "INSERT INTO category ( category_id, category_parent_id, category_name, category_description, category_route, category_status, category_created, category_edited, category_order, category_visible, category_created_by, post_count )
                                  VALUES ( NULL, :category_parent_id, :category_name, :category_description, :category_route, 'active', NOW(),NOW(), 1, :category_visible, :category_created_by, 0)";
    $stmt = $this->pdo->prepare( $sql );
    $values = array( 'category_parent_id'   => $parentId,
                     'category_name'        => $categoryName,
                     'category_description' => $categoryDescription,
                     'category_route'       => $categorySlug,
                     'category_visible'     => $isActive,
                     'category_created_by'  => $_SESSION['user_id']
                   );
    if ( $stmt->execute( $values ) ) {
      return true;
    }
    $this->errors = $stmt->errorInfo()[2];
    return false;
  }

  public function editCategory( $categoryId, $parentId, $categoryName, $categorySlug, $categoryDescription, $isActive ) {
    $sql = "UPDATE category SET category_parent_id = :category_parent_id,
                                category_name = :category_name,
                                category_description = :category_description,
                                category_route = :category_route,
                                category_edited = NOW(),
                                category_visible = :category_visible WHERE category_id = :category_id";
    $stmt = $this->pdo->prepare( $sql );
    $values = array( 'category_parent_id'   => $parentId,
                     'category_name'        => $categoryName,
                     'category_description' => $categoryDescription,
                     'category_route'       => $categorySlug,
                     'category_visible'     => $isActive,
                     'category_id'          => $categoryId
                   );
    if ( $stmt->execute( $values ) ) {
      return true;
    }
    $this->errors = $this->errors = $stmt->errorInfo()[2];
    return false;
  }

  public function editVisibility( $categoryId, $visibility ) {
    $sql = "UPDATE category SET category_visible = :category_visible WHERE category_id = :category_id";
    $stmt = $this->pdo->prepare( $sql );
    $stmt->bindValue( 'category_id', $categoryId, PDO::PARAM_INT );
    $stmt->bindValue( 'category_visible', $visibility );
    if ( $stmt->execute( $values ) ) {
      return true;
    }
    $this->errors = $this->errors = $stmt->errorInfo()[2];
    return false;
    }

  public function deleteCategory( $categoryId ) {
    $sql = "DELETE FROM category WHERE category_id = :category_id";
    $stmt = $this->pdo->prepare( $sql );
    $stmt->bindParam( 'category_id', $categoryId, PDO::PARAM_INT );

    if ( $stmt->execute() ) {
      return true;
    }
    $this->errors = $this->errors = $stmt->errorInfo()[2];
    return false;
  }

}
