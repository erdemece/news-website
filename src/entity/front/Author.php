<?php

namespace front;
use PDO;


class Author {

  public function __construct( $container ) {
    $this->pdo = $container->get('pdo');
  }


    public function getSingleAuthor ($authorid) {

      $sql = 'SELECT * FROM author WHERE author_status = :author_status AND author_id = :author_id ORDER BY author_id ASC';
      $query = $this->pdo->prepare($sql);

      $values = array(
        'author_id' => $authorid,
        'author_status' => 'active'
      );

      if ( $query->execute( array( $values ) ) ) {
        if ( $query->rowCount() ) {
             $data = $query->fetchAll(PDO::FETCH_ASSOC);
            return $data;
      } else {
        echo 'nothing to show';
        }
      }
    }


    public function getAuthors () {

      $sql = 'SELECT * FROM author WHERE author_status = :author_status ORDER BY author_id ASC';
      $query = $this->pdo->prepare($sql);

      $values = array(
        'author_status' => 'active'
      );

      if ( $query->execute( array( $values ) ) ) {
        if ( $query->rowCount() ) {
           $data = $query->fetchAll(PDO::FETCH_ASSOC);
          return $data;
        } else {
          echo 'nothing to show';
        }
      }
    }




    public function sendContactForm ($contact_message_sender_name, $contact_message_sender_email, $contact_message_sender_ip, $contact_message_content, $contact_message_date, $contact_message_status, $contact_message_read) {

      $sql = 'INSERT INTO contact_message
                (contact_message_id, contact_message_sender_name, contact_message_sender_email, contact_message_sender_ip, contact_message_content,  contact_message_date, contact_message_status, contact_message_read)
                VALUES
                (NULL, :contact_message_sender_name, :contact_message_sender_email, :contact_message_sender_ip, :contact_message_content, :contact_message_date, :contact_message_status, :contact_message_read)';

      $query = $this->pdo->prepare($sql);

      $values = array(
        // 'contact_message_id' => $contact_message_id,
        'contact_message_sender_name' => $contact_message_sender_name,
        'contact_message_sender_email' => $contact_message_sender_email,
        'contact_message_sender_ip' => $contact_message_sender_ip,
        'contact_message_content' => $contact_message_content,
        'contact_message_date' => $contact_message_date,
        'contact_message_status' => $contact_message_status,
        'contact_message_read' => $contact_message_read
        );

      if ( $query->execute(  $values  ) ) {

        return true;

        } else {

          return false;
        }
    }



}

 ?>
