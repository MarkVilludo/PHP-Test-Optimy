<?php

class Comment
{
    /**
     * Properties for storing comment details.
     */
    protected $id;
    protected $body;
    protected $createdAt;
    protected $newsId;

    /**
     * Constructor to initialize Comment object with provided data or null defaults.
     */
    public function __construct($id = null, $body = null, $createdAt = null, $newsId = null)
    {
        $this->id = $id;
        $this->body = $body;
        $this->createdAt = $createdAt;
        $this->newsId = $newsId;
    }

    // Each method indicating whether it's a setter or getter and which fields/properties it manipulates.

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getNewsId()
    {
        return $this->newsId;
    }

    public function setNewsId($newsId)
    {
        $this->newsId = $newsId;
        return $this;
    }
}
