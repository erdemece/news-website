<?php
namespace entity;
use PDO;

class Users {
  public $errors = array();
  private $passhash_options = array();
  private $allowed_username_char = array();
  protected $pdo = null;
  protected $mail = null;


  public function __construct( $container ) {
    $this->pdo = $container->get('pdo');
    $this->mail = $container->get('phpmailer');
    $this->passhash_options = [
			'cost' => 8,
			'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
		];
    $this->allowed_username_char = [
      '.', '-', '_'
    ];
    if ( !$this->pdo instanceof PDO ) {
      throw new \RuntimeException (
        sprintf(
          '%s requires a PDO instance, app did not contain "PDO" key',
          __CLASS__
        )
      );
    }
  }

  public function isUserExist( $username, $email ) {
    $sql = "SELECT username, email FROM users WHERE username = :username OR email = :email";
    $stmt = $this->pdo->prepare( $sql );
    if( $stmt->execute( array ( 'username' => $username, 'email' => $email ) ) ) {
      if( $stmt->rowCount() > 0 ) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
      }
      return false;
    }
    $this->errors = $stmt->errorInfo()[2];
    return false;
  }

  public function addUser( $username, $email, $password ) {
    $password = $this->saltPassword( $password );
    $activationKey = $this->generateUserActivationKey();
    $sql = "INSERT INTO users (user_id, username, password, email, created_by, created, modified, last_login, last_post, last_comment, is_active, user_level, deleted, deleted_by, user_activation_key, notes)
                       VALUES (NULL, :username, :password, :email, 0, NOW(), NOW(), NOW(), NULL, NULL, 0, 1, NULL, NULL, :user_activation_key, NULL )";
    $stmt = $this->pdo->prepare( $sql );
    if( $stmt->execute( array( 'username' => $username, 'password' => $password, 'email' => $email, 'user_activation_key' => $activationKey ) ) ) {
      $generateSessions = $this->generateSessions( $this->pdo->lastInsertId() );
      if ( $generateSessions !== true ) {
        return true;
      }
      return false;
    }
    $this->errors = $stmt->errorInfo()[2];
    return false;
  }

  public function editUser() {

  }

  public function deleteUser() {

  }

  public function loginUser( $username, $password ) {
    $sql = "SELECT user_id, username, password FROM users WHERE username = :username";
    $stmt = $this->pdo->prepare( $sql );
    if ( $stmt->execute( array( 'username' => $username ) ) ) {
      if ( $stmt->rowCount() ) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ( $this->verifyPassword ( $password, $result['password'] ) !== false ) {
          $generateSessions = $this->generateSessions( $result['user_id'] );
          if( $generateSessions !== false  ) {
            return true;
          }
          return false;
        }
        return false;
      }
      return false;
    }
    $this->errors = $stmt->errorInfo();
    return false;
  }

  public function changePassword() {

  }

  protected function verifyPassword( $password, $hash ) {
		if ( password_verify( $password, $hash ) ) {
			return true;
		}
		return false;
	}

  public function verifyEmail( $key ) {

  }

  protected function generateSessions( $userId ) {
    if ( $userId > 0 ) {
      $sql = "SELECT user_id, username, email, last_post, last_comment, is_active, user_level, user_activation_key FROM users WHERE user_id = :user_id LIMIT 1";
      $stmt = $this->pdo->prepare( $sql );
      $stmt->bindParam( 'user_id', $userId );
      if( $stmt->execute() ) {
        if ( $stmt->rowCount() > 0 ) {
          $result = $stmt->fetch( PDO::FETCH_ASSOC );
          $_SESSION['user_id']        = $result['user_id'];
          $_SESSION['user_level']     = $result['user_level'];
          $_SESSION['username']       = $result['username'];
          $_SESSION['email']          = $result['email'];
          $_SESSION['is_active']      = $result['is_active'];
          $_SESSION['last_post']      = $result['last_post'];
          $_SESSION['last_comment']   = $result['last_comment'];
          if ( $result['is_active'] == 0 ) {
            $_SESSION['user_activation_key'] = $result['user_activation_key'];
          }
          return true;
        }
        return false;
      }
      $this->errors = $stmt->errorInfo()[2];
      return false;
    }
    return false;
  }

  protected function saltPassword( $password ) {
    return password_hash($password, PASSWORD_BCRYPT, $this->passhash_options) . "\n";
  }

  public function validatePassword( $password ) {
    if (!preg_match_all('$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$', $password)) {
      return false;
    }
      return true;
  }

  public function validateUsername ( $username ) {
    if ( ctype_alnum ( str_replace ( $this->allowed_username_char, '', $username ) ) ) {
      return true;
    }
      return false;
	}

  protected function generateUserActivationKey () {
		return md5 ( mcrypt_create_iv ( 32, MCRYPT_DEV_URANDOM ) );
	}

  public function sendActivationEmail( $email, $template ) {
    if ( !empty( $email ) ) {
      if ( !empty( $template ) ) {
        $this->mail->addAddress($email);
        $this->mail->Subject = 'Aktivasyon Emaili';
        $this->mail->Body = $template;
        // $this->mail->AltBody = $plainText;
        $sendEmail = $this->mail->send();
        if ( $sendEmail ) {
          return true;
        }
        return false;
      }
      return false;
    }
    return false;
  }

}

 ?>
