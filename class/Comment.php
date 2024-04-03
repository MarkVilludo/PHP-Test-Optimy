<?php

class Comment
{
	protected $id, $body, $createdAt, $newsId; //properties for storing comment details

	 // Constructor to initialize Comment object with provided data // or null default will be save to database
	 public function __construct($id = null, $body = null, $createdAt = null, $newsId = null)
	 {
		$this->id = $id;
		$this->body = $body;
		$this->createdAt = $createdAt;
		$this->newsId = $newsId;
	 }

	// this each method indicating if its setter or getter and what fields/properties it manipulate
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