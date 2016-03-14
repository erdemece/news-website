<?php

namespace front;
use PDO;


class OtherF {

  public function __construct( $container ) {
    $this->pdo = $container->get('pdo');
  }

  public function thisIsATest ($articleid) {
    return $articleid;
  }


/////////////////////////////////////////

    public function getTags ($itemid, $itemtype_id) {

      $sql = 'SELECT * FROM tag WHERE tag_item_id = :tag_item_id AND tag_item_type_id = :tag_item_type_id ORDER BY comment_id DESC';
      $query = $this->pdo->prepare($sql);

      if ( $query->execute( array( 'tag_item_id' => $itemid, 'tag_item_type_id' => $itemtype_id ) ) ) {
        if ( $query->rowCount() ) {
           $data = $query->fetchAll(PDO::FETCH_ASSOC);
          return $data;
        } else {
          echo 'nothing to show';
        }
      }
    }


    public function getEditorsPick ($itemid, $itemtype_id, $editorspick_locid) {

      $sql = 'SELECT * FROM editors_pick WHERE editors_pick_item_id = :editors_pick_item_id AND editors_pick_item_type_id = :editors_pick_item_type_id AND editors_pick_location_id = :editors_pick_location_id ORDER BY editors_pick_id DESC LIMIT 5';
      $query = $this->pdo->prepare($sql);

      if ( $query->execute( array( 'editors_pick_item_id' => $itemid, 'editors_pick_item_type_id' => $itemtype_id, 'editors_pick_location_id' => $editorspick_locid ) ) ) {
        if ( $query->rowCount() ) {
           $data = $query->fetchAll(PDO::FETCH_ASSOC);
          return $data;
        } else {
          echo 'nothing to show';
        }
      }
    }

    public function getRelatedArticles ($itemid) {

      $sql = 'SELECT * FROM related_articles WHERE related_articles_article_id = :related_articles_article_id LIMIT 1';
      $query = $this->pdo->prepare($sql);

      if ( $query->execute( array( 'related_articles_article_id' => $itemid ) ) ) {
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

    public function setNewsletter ($newsletter_name, $newsletter_email, $newsletter_status, $newsletter_date) {

      $sql = 'INSERT INTO newsletter
                (newsletter_id, newsletter_name, newsletter_email, newsletter_status, newsletter_date)
                VALUES
                (NULL, :newsletter_name, :newsletter_email, :newsletter_status, :newsletter_date)';

      $query = $this->pdo->prepare($sql);

      $values = array(
        'newsletter_name' => $newsletter_name,
        'newsletter_email' => $newsletter_email,
        'newsletter_status' => $newsletter_status,
        'newsletter_date' => $newsletter_date
        );

      if ( $query->execute(  $values  ) ) {
          return true;
        } else {
          return false;
        }
    }

    public function sendVisitorArticle ($temp_article_main_content, $temp_article_sender_name, $temp_article_sender_email, $temp_article_sender_ip, $temp_article_date, $temp_article_status) {

      $sql = 'INSERT INTO temp_article
                (temp_article_id, temp_article_main_content, temp_article_sender_name, temp_article_sender_email, temp_article_sender_ip, temp_article_date, temp_article_status)
                VALUES
                (NULL, :temp_article_main_content, :temp_article_sender_name, :temp_article_sender_email, :temp_article_sender_ip, :temp_article_date, :temp_article_status)';

      $query = $this->pdo->prepare($sql);

      $values = array(
        'temp_article_main_content' => $temp_article_main_content,
        'temp_article_sender_name' => $temp_article_sender_name,
        'temp_article_sender_email' => $temp_article_sender_email,
        'temp_article_sender_ip' => $temp_article_sender_ip,
        'temp_article_date' => $temp_article_date,
        'temp_article_status' => $temp_article_status
        );

      if ( $query->execute(  $values  ) ) {
          return true;
        } else {
          return false;
        }

    }

    public function sendVisitorPhoto ($temp_photo_sender_name, $temp_photo_sender_email, $temp_photo_sender_ip, $temp_photo_date, $temp_photo_status) {

      $sql = 'INSERT INTO temp_photo
                (temp_photo_id, temp_photo_sender_name, temp_photo_sender_email, temp_photo_sender_ip, temp_photo_date, temp_photo_status)
                VALUES
                (NULL, :temp_photo_sender_name, :temp_photo_sender_email, :temp_photo_sender_ip, :temp_photo_date, :temp_photo_status)';

      $query = $this->pdo->prepare($sql);

      $values = array(
          'temp_photo_sender_name' => $temp_photo_sender_name,
          'temp_photo_sender_email' => $temp_photo_sender_email,
          'temp_photo_sender_ip' => $temp_photo_sender_ip,
          'temp_photo_date' => $temp_photo_date,
          'temp_photo_status' => $temp_photo_status
        );

      if ( $query->execute(  $values  ) ) {
          return true;
        } else {
          return false;
        }

    }

    public function sendVisitorVideo ($temp_video_sender_name, $temp_video_sender_email, $temp_video_sender_ip, $temp_video_date, $temp_video_status) {

      $sql = 'INSERT INTO temp_video
                (temp_video_id, temp_video_sender_name, temp_video_sender_email, temp_video_sender_ip, temp_video_date, temp_video_status)
                VALUES
                (NULL, :temp_video_sender_name, :temp_video_sender_email, :temp_video_sender_ip, :temp_video_date, :temp_video_status)';

      $query = $this->pdo->prepare($sql);

      $values = array(
          'temp_video_sender_name' => $temp_video_sender_name,
          'temp_video_sender_email' => $temp_video_sender_email,
          'temp_video_sender_ip' => $temp_video_sender_ip,
          'temp_video_date' => $temp_video_date,
          'temp_video_status' => $temp_video_status
        );

      if ( $query->execute(  $values  ) ) {
          return true;
        } else {
          return false;
        }

    }

}

 ?>
