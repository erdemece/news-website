<?php

namespace admin;
use PDO;

class Category {

  public $errors;
  public $order;
  public $starts;
  public $ends;

  public function __construct( $container ) {
    $this->pdo = $container->get('pdo');
  }

  public function getCategoryNames () {

    $sql = "SELECT category_id, category_parent_id, category_name FROM category";

    try {
      $query =  $this->pdo->prepare( $sql );

      if( $query->execute( ) ) {
        if( $query->rowCount() ) {
          return $query->fetchAll();
        }
        return false;
      }
      return false;
    } catch ( PDOException $pe ) {
      return false;
      $this->error = $pe->getMessage();
    }
  }

  public function getCategoryDetails( $categoryId ) {
    $sql = "SELECT * FROM category WHERE category_id = :category_id";

    try {
      $query = $this->pdo->prepare( $sql );
      if ( $query->execute( array( 'category_id' => $categoryId ) ) ) {
        if( $query->rowCount(  ) ) {
          return $query->fetch(PDO::FETCH_ASSOC);
        }
        return false;
      }
      return false;
    } catch ( PDOException $pe ) {
      return false;
      $this->errors = $pe->getMessage();
    }

  }

  public function getCategoryList() {

    $sql = "SELECT * FROM category ORDER BY category_order";

    try {

      $query = $this->pdo->prepare( $sql );

      if( $query->execute( ) ) {
        if( $query->rowCount() ) {
          return $query->fetchAll();
        }
        return false;
      }
      return false;
      $this->errors = $query->errorInfo()[2];
    } catch ( PDOEception $pe ) {
      $this->errors = $pe->getMessage();
    }
  }

  public function addCategory( $parentId, $categoryName, $categorySlug, $categoryDescription, $isActive ) {

    $sql = "INSERT INTO category ( category_id, category_parent_id, category_name, category_description, category_route, category_status, category_created, category_edited, category_order, category_visible, category_created_by, post_count )
                                  VALUES ( NULL, :category_parent_id, :category_name, :category_description, :category_route, 'active', NOW(),NOW(), 1, :category_visible, :category_created_by, 0)";

    try {
      $query = $this->pdo->prepare( $sql );

      $values = array( 'category_parent_id' => $parentId,
                       'category_name' => $categoryName,
                       'category_description' => $categoryDescription,
                       'category_route' => $categorySlug,
                       'category_visible' => $isActive,
                       'category_created_by' => 1);

      if ( $query->execute( $values ) ) {
        return true;
      } else {
        $this->errors = $query->errorInfo();
        return false;
      }
    } catch ( PDOEception $pe ) {
      $this->errors = $pe->getMesaage();
      return false;
    }

  }

  public function editCategory( $categoryId, $parentId, $categoryName, $categorySlug, $categoryDescription, $isActive ) {

    $sql = "UPDATE category SET category_parent_id = :category_parent_id,
                                category_name = :category_name,
                                category_description = :category_description,
                                category_route = :category_route,
                                category_edited = NOW(),
                                category_visible = :category_visible WHERE category_id = :category_id";

    try {
      $query = $this->pdo->prepare( $sql );

      $values = array( 'category_parent_id' => $parentId,
                       'category_name' => $categoryName,
                       'category_description' => $categoryDescription,
                       'category_route' => $categorySlug,
                       'category_visible' => $isActive,
                       'category_id' => $categoryId );

      if ( $query->execute( $values ) ) {
        return true;
      } else {
        $this->errors = $this->errors = $query->errorInfo()[2];
        return false;
      }
    } catch ( PDOEception $pe ) {
      $this->errors = $pe->getMesaage();
      return false;
    }

  }

  public function editVisibility( $categoryId, $visibility ) {

    $sql = "UPDATE category SET category_visible = :category_visible WHERE category_id = :category_id";

    try {
      $query = $this->pdo->prepare( $sql );
      $query->bindValue( 'category_id', $categoryId, PDO::PARAM_INT );
      $query->bindValue( 'category_visible', $visibility );

      if ( $query->execute( $values ) ) {
        return true;
      } else {
        $this->errors = $this->errors = $query->errorInfo()[2];
        return false;
      }
    } catch ( PDOEception $pe ) {
      $this->errors = $pe->getMesaage();
      return false;
    }

  }

  public function deleteCategory( $categoryId ) {

    $sql = "DELETE FROM category WHERE category_id = :category_id";

    try {
      $query = $this->pdo->prepare( $sql );
      $query->bindParam( 'category_id', $categoryId, PDO::PARAM_INT );

      if ( $query->execute() ) {
        return true;
      } else {
        $this->errors = $this->errors = $query->errorInfo()[2];
        return false;
      }
    } catch ( PDOEception $pe ) {
      $this->errors = $pe->getMesaage();
      return false;
    }

  }

}
