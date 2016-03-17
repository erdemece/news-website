<?php

namespace admin;
use PDO;

class Users {

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

  public function getUserList() {
    $sql = "SELECT user_id, username, email, last_login, last_post, last_comment, post_count, comment_count, is_active, user_level FROM users ORDER BY last_login";
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

  public function getUserDetails( $userId ) {
    $sql = "SELECT user_id, username, email, last_login, last_post, last_comment, post_count, comment_count, is_active, user_level FROM users WHERE user_id = :user_id";
    $stmt = $this->pdo->prepare( $sql );
    $stmt->bindParam( 'user_id', $userId );
    if( $stmt->execute( ) ) {
      if( $stmt->rowCount() ) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
      }
      return false;
    }
    return false;
    $this->errors = $stmt->errorInfo()[2];
  }

  public function addUser( $parentId, $categoryName, $categorySlug, $categoryDescription, $isActive ) {
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

  public function editUser( $userId, $username, $email, $userLevel, $userStatus ) {
    $sql = "UPDATE users SET username    = :username,
                             email       = :email,
                             user_level  = :user_level,
                             user_status = :user_status,
                             modified    = NOW() WHERE user_id = :user_id";
    $stmt = $this->pdo->prepare( $sql );
    $values = array( 'username'    => $username,
                     'email'       => $email,
                     'user_level'  => $userLevel,
                     'user_status' => $userStatus,
                     'user_id'     => $userId
                   );
    if ( $stmt->execute( $values ) ) {
      return true;
    }
    $this->errors = $stmt->errorInfo()[2];
    return false;
  }

  public function editUserStatus( $userId, $isActive ) {

    $sql = "UPDATE category SET category_visible = :category_visible WHERE category_id = :category_id";
    $stmt = $this->pdo->prepare( $sql );
    $stmt->bindValue( 'user_id', $categoryId, PDO::PARAM_INT );
    $stmt->bindValue( 'is_active', $isActive );

    if ( $stmt->execute( ) ) {
      return true;
    }
    $this->errors = $this->errors = $stmt->errorInfo()[2];
    return false;
  }

}
