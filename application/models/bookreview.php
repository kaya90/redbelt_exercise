<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BookReview extends CI_Model {

	
	public function create($post)
	{
		$query = "INSERT INTO users (first_name, last_name, email, password, created_at, updated_at) VALUES (?,?,?,?,NOW(),NOW())";
		$values = array($post['first_name'], $post['last_name'], $post['email'], $post['password']);
		return $this->db->query($query, $values);
	}
	public function check_id($post)
	{
		$query = "SELECT id, first_name, last_name, email FROM users WHERE email = ? AND password = ?";
		$values = array($post['email'], $post['password']);
		return $this->db->query($query, $values) -> row_array();
	}
	public function check_book($name)
	{	
		return $this->db->query("SELECT books.id FROM books JOIN authors ON books.author_id = authors.id
		WHERE authors.name='$name'")-> row_array();
		
	}
	public function check_author($name)
	{
		return $this->db->query("SELECT authors.id FROM authors WHERE name = '{$name}'")->row_array();
	}
	public function add_review($post)
	{
		
		if($post['select_author'] == 'Select Author')
		{
			// die('task');
			$this->db->query("INSERT INTO authors (name) VALUES ('{$post['type_author']}')" );
		
			$book_id = $this->check_book($post['type_author']);
			// var_dump($book_id);
			// die('here');
			if(count($book_id) == 0)
			{
				// die('effort');
				
				$author_id = $this->check_author($post['type_author']);
				// die('just');
				$this->db->query("INSERT INTO books (title, author_id) VALUES ('{$post['title']}', '{$author_id['id']}')");	
				$book_id = $this->check_book($post['type_author']);	
			}
		}
		else if(empty($post['type_author']))
		{
			// die('good');
			$book_id = $this->check_book($post['select_author']);
			if(count($book_id) == 0)
			{
				// die('hello');
				$author_id = $this->check_author($post['select_author']);
				$this->db->query("INSERT INTO books (title, author_id) VALUES ('{$post['title']}', '{$author_id['id']}')");
				$book_id = $this->check_book($post['type_author']);	
			}
			// die('kiwi');
		}
		// die('integer');

		$query = "INSERT INTO reviews (reviews.comment, reviews.rating, reviews.book_id,
		reviews.created_at, reviews.updated_at, reviews.user_id) values (?,?,?, NOW(), NOW(), ?)";
		$values = array($post['review'], $post['rating'], $book_id['id'], $post['current_user_id']);
		// die('lemon');
		$this->db->query($query, $values);
	}
	public function add_review_from_book($post)
	{
		$query = "INSERT INTO reviews (reviews.comment, reviews.rating, reviews.book_id,
		reviews.created_at, reviews.updated_at, reviews.user_id) values (?,?,?, NOW(), NOW(), ?)";
		$values = array($post['review'], $post['rating'], $post['book_id'], $post['current_user_id']);
		// die('lemon');
		$this->db->query($query, $values);
	}
	public function fetch_all_reviews()
	{
		$query = "SELECT books.id as book_id, books.title, authors.name, users.first_name, reviews.comment, reviews.rating, 
		reviews.created_at, reviews.updated_at, reviews.user_id FROM reviews
		JOIN books ON reviews.book_id = books.id
		JOIN users ON reviews.user_id = users.id
		JOIN authors ON books.author_id = authors.id";
		return $this->db->query($query)->result_array();
	}
	public function fetch_all_reviews_by_id($id)
	{
		$query = "SELECT books.id as book_id, books.title, authors.name, users.first_name, reviews.comment, reviews.rating, 
		reviews.created_at, reviews.updated_at, reviews.user_id,reviews.id as review_id  FROM reviews
		JOIN books ON reviews.book_id = books.id
		JOIN users ON reviews.user_id = users.id
		JOIN authors ON books.author_id = authors.id
		WHERE books.id = $id";
		return $this->db->query($query)->result_array();
	}
	public function fetch_book($id)
	{
		$query = "SELECT books.id as book_id, books.title, authors.name FROM books 

		JOIN authors ON books.author_id = authors.id
		WHERE books.id = $id";
		return $this->db->query($query)->row_array();
	}
	public function delete_review($id)
	{
		$this->db->query("DELETE FROM reviews WHERE reviews.id = $id");
	}
	public function check_book_exist($id)
	{
		$query = "SELECT * FROM reviews
		JOIN books ON reviews.book_id = books.id
		where books. id = $id";
		return $this->db->query($query)->result_array();
	}
	public function fetch_all_authors()
	{
		return $this->db->query("SELECT * FROM authors ORDER BY name")->result_array();
	}
}
