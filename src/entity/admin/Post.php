<?php
namespace admin;

class Category {

  public $category_id;
  public $category_name;
  public $category_route;
  public $category_status;
  public $category_order;
  public $category_visible;
  public $category_created_by;

  public $errors;

  public function __construct( $container ) {
    $this->pdo = $container->get('pdo');
  }

}

interface CategoryInterface {
  public function find( $category_id );
  public function create( Category $category );
  public function remove( Category $category );
}

class CategoryRepository implements CategoryInterface {
  protected $db;

  public function __construct ( $container ) {
    $this->db = $container->get( 'pdo' );
  }

  public function find( $category_id ) {
    $sql = "SELECT category_id, category_name FROM category WHERE category_id = :category_id ORDER BY category_order";

    try {
      $query = $this->pdo->prepare( $sql );

      if ( $query->execute( array ( 'category_id' => $category_id ) ) ) {
        if ( $query->rowCount() ) {
          return $value;
        }
      }
    }
    catch ( PDOException $pe ) {
      trigger_error( 'database error:' . $pe->getMessage() );
    }
  }
}

 ?>
