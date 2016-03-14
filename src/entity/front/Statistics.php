<?php

namespace front;
use PDO;


class Statistics {

  public function __construct( $container ) {
    $this->pdo = $container->get('pdo');
  }

  public function getItemLikes ($itemid, $itemtype_id) {

    $sql = 'SELECT * FROM item_likes WHERE item_likes_item_id = :item_likes_item_id AND item_likes_item_type_id = :item_likes_item_type_id';

    $query = $this->pdo->prepare($sql);

    if ( $query->execute( array( 'item_likes_item_id' => $itemid, 'item_likes_item_type_id' => $itemtype_id ) ) ) {
      if ( $query->rowCount() ) {
         $data = $query->fetchAll(PDO::FETCH_ASSOC);
        //  foreach ( $key as $value ) {
        //     $data = $value;
        //  }
        return $data;
      } else {
        echo 'nothing to show';
      }
    }
  }

  public function getItemShares ($itemid, $itemtype_id) {

    $sql = 'SELECT * FROM share WHERE share_item_id = :share_item_id AND share_item_type_id = :share_item_type_id';

    $query = $this->pdo->prepare($sql);

    if ( $query->execute( array( 'share_item_id' => $itemid, 'share_item_type_id' => $itemtype_id ) ) ) {
      if ( $query->rowCount() ) {
         $data = $query->fetchAll(PDO::FETCH_ASSOC);
        //  foreach ( $key as $value ) {
        //     $data = $value;
        //  }
        return $data;
      } else {
        echo 'nothing to show';
      }
    }
  }

  public function getItemViews ($itemid, $itemtype_id, $period) {

    // choose the period
    switch ($period) {
        case "all":
            $sql = 'SELECT * FROM item_statistics WHERE item_statistics_item_id = :item_statistics_item_id AND item_statistics_item_type_id = :item_statistics_item_type_id';
            $exarray = array( 'item_statistics_item_id' => $itemid, 'item_statistics_item_type_id' => $itemtype_id);
            // where item_statistics_item_id
            // where item_statistics_item_type_id
            // all time
            break;
        case "today":
            $date_today = date("Y-m-d");
            $sql = 'SELECT * FROM item_statistics WHERE item_statistics_item_id = :item_statistics_item_id AND item_statistics_item_type_id = :item_statistics_item_type_id AND item_statistics_visit_date = :item_statistics_visit_date';
            $exarray = array( 'item_statistics_item_id' => $itemid, 'item_statistics_item_type_id' => $itemtype_id, 'item_statistics_visit_date' => $date_today);
            // where item_statistics_item_id
            // where item_statistics_item_type_id
            // where item_statistics_visit_date = today
            // today
            break;
        case "month":
            $month_today = date("m");
            $year_today = date("Y");
            $sql = 'SELECT * FROM item_statistics WHERE item_statistics_item_id = :item_statistics_item_id AND item_statistics_item_type_id = :item_statistics_item_type_id AND item_statistics_visit_month = :item_statistics_visit_month AND item_statistics_visit_year = :item_statistics_visit_year';
            $exarray = array( 'item_statistics_item_id' => $itemid, 'item_statistics_item_type_id' => $itemtype_id, 'item_statistics_visit_month' => $month_today, 'item_statistics_visit_year' => $year_today );
            // where item_statistics_item_id
            // where item_statistics_item_type_id
            // where item_statistics_visit_month = $month_today
            // where item_statistics_visit_year = $year_today
            // month
            break;
    }

    $query = $this->pdo->prepare($sql);

    if ( $query->execute( $exarray ) ) {
      if ( $query->rowCount() ) {
         $data = $query->fetchAll(PDO::FETCH_ASSOC);
        //  foreach ( $key as $value ) {
        //     $data = $value;
        //  }
        return $data;
      } else {
        echo 'nothing to show';
      }
    }
  }


  public function getMostReadArticles ($period) {

    // choose the period
    switch ($period) {
        case "all":
            //$sql = 'SELECT * FROM item_statistics WHERE (item_statistics_item_id = :item_statistics_item_id AND item_statistics_item_type_id = :item_statistics_item_type_id) GROUP BY (item_statistics_item_id = :item_statistics_item_id AND item_statistics_item_type_id = :item_statistics_item_type_id) ORDER BY count(item_statistics_item_id = :item_statistics_item_id AND item_statistics_item_type_id = :item_statistics_item_type_id) DESC LIMIT 3';
            $sql = 'SELECT item_statistics_item_id, item_statistics_item_type_id, COUNT(*) AS occurrences FROM item_statistics GROUP BY item_statistics_item_id, item_statistics_item_type_id ORDER BY occurrences DESC LIMIT 5';
            $exarray = array( 'item_statistics_item_id' => $itemid, 'item_statistics_item_type_id' => $itemtype_id);
            break;
        case "today":
            $date_today = date("Y-m-d");
            //$sql = 'SELECT count(item_statistics_item_id = :item_statistics_item_id AND item_statistics_item_type_id = :item_statistics_item_type_id AND item_statistics_visit_date = :item_statistics_visit_date) FROM item_statistics ORDER BY count(item_statistics_item_id = :item_statistics_item_id AND item_statistics_item_type_id = :item_statistics_item_type_id AND item_statistics_visit_date = :item_statistics_visit_date) DESC LIMIT 3';
            $sql = 'SELECT item_statistics_item_id, item_statistics_item_type_id, item_statistics_visit_date, COUNT(*) AS occurrences FROM item_statistics GROUP BY item_statistics_item_id, item_statistics_item_type_id, item_statistics_visit_date ORDER BY occurrences DESC LIMIT 5';
            $exarray = array( 'item_statistics_item_id' => $itemid, 'item_statistics_item_type_id' => $itemtype_id, 'item_statistics_visit_date' => $date_today);
            break;
        case "month":
            $month_today = date("m");
            $year_today = date("Y");
            //$sql = 'SELECT count(item_statistics_item_id = :item_statistics_item_id AND item_statistics_item_type_id = :item_statistics_item_type_id AND item_statistics_visit_month = :item_statistics_visit_month AND item_statistics_visit_year = :item_statistics_visit_year) FROM item_statistics ORDER BY count(item_statistics_item_id = :item_statistics_item_id AND item_statistics_item_type_id = :item_statistics_item_type_id AND item_statistics_visit_month = :item_statistics_visit_month AND item_statistics_visit_year = :item_statistics_visit_year) DESC LIMIT 3';
            $sql = 'SELECT item_statistics_item_id, item_statistics_item_type_id, item_statistics_visit_month, item_statistics_visit_year, COUNT(*) AS occurrences FROM item_statistics GROUP BY item_statistics_item_id, item_statistics_item_type_id, item_statistics_visit_month, item_statistics_visit_year ORDER BY occurrences DESC LIMIT 5';
            $exarray = array( 'item_statistics_item_id' => $itemid, 'item_statistics_item_type_id' => $itemtype_id, 'item_statistics_visit_month' => $month_today, 'item_statistics_visit_year' => $year_today );
            break;
    }

    $query = $this->pdo->prepare($sql);

    if ( $query->execute( $exarray ) ) {
      if ( $query->rowCount() ) {
         $data = $query->fetchAll(PDO::FETCH_ASSOC);
        //  foreach ( $key as $value ) {
        //     $data = $value;
        //  }
        return $data;
      } else {
        echo 'nothing to show';
      }
    }
  }


}

 ?>
