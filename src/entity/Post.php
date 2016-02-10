<?php

namespace src\entity;

class Post {

  const NUM_ITEMS =10;

  private $id;
  private $title;
  private $slug;
  private $summary;
  private $content;
  private $authorEmail;
  private $publishedAt;
  private $comments;

  public function __consttruct() {

    $this->publishedAt = new DateTime();
    $this->comments = new ArrayCollection();

  }

  public function getId() {

    return $this->id;

  }

  public function getTitle() {

    return $this->title;

  }

  public function setTitle( $title ) {

    $this->title = $title;

  }

  public function getSlug() {

    return $this->slug;

  }

  public function setSlug( $slug ) {

    $this->slug = $slug;

  }

  public function getContent() {

    return $this->content;

  }

  public function setContent( $content ) {

    $this->content = $content;

  }

  public function getAuthorEmail() {

    return $this->authorEmail;

  }

  public function setAuthorEmail( $authorEmail ) {

    $this->authorEmail = $authorEmail;

  }

  public function isAuthor( User $user ) {

    return $user->getEmail() == $this->getAuthorEmail();

  }

  public function getPublushedAt() {

    return $this->publishedAt;

  }

  public function setPublishedAt(DateTime $publishedAt) {

    $this->publishedAt = $publishedAt;

  }

  public function getComments() {

    return $this->comments;

  }

  public function addComment( Comment $comment ) {

    $this->comments->add( $comment );
    $comment->setPost( $this );

  }

  public function removeComment( Comment $comment ) {

    $this->comments->removeElement( $comment );
    $comment->setPost( null );

  }

  public function getSummary() {

    return $this->summary;

  }

  public function setSummary( $summary ) {

    $this->summary = $summary;

  }

}

 ?>
