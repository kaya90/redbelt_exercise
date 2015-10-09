<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BookReviews extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('bookreview');
		$this->load->library('form_validation');
	}
	public function index()
	{
		if(isset($this->session->userdata['current_user']))
		{
			redirect('view_home');
		}
		else{
			$this->load->view('index');
		}
		
	}
	public function add()
	{
		if($this->input->post('validation') == 'registration')
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('first_name', 'First Name', 'required|alpha|trim');
			$this->form_validation->set_rules('last_name', 'Last Name', 'required|alpha|trim');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]|trim');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[7]|trim');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
			
				if($this->form_validation ->run() === FALSE)
				{
					$this->view_data["errors"] = validation_errors();
					$errors = $this->view_data["errors"];
					$this->session->set_flashdata('messages', $errors);
				}
				else
				{
					$this->bookreview->create($this->input->post());
					$no_errors= "<p class='green'> Your registration is complete. You may now log in.</p>";
					$this->session->set_flashdata('success', $no_errors);
				}
			redirect('/');
		}
	}
	public function login()
	{
		if($this->input->post('validation') == 'login')
		{
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[7]|trim');
			$current_user = ($this->bookreview->check_id($this->input->post()));
				if($this->form_validation->run() === FALSE)
				{
					$this->view_data["errors"] = validation_errors();
					$errors = $this->view_data["errors"];
					$this->session->set_flashdata('messages', $errors);
					redirect('/');
				}
				else if ($current_user == null)
				{
					$errors = "<p class='red'>The email and password you entered don't match.</p>";
					$this->session->set_flashdata('messages', $errors);
				   	redirect('/');
				}
				else
				{
					$this->session->set_userdata('current_user', $current_user);
					$this->view_home();
				}
		}
		
	}
	public function view_home()
	{
		$reviews = $this->bookreview->fetch_all_reviews();
		$this->load->view('books_home', array('reviews' => $reviews));
	}
	public function view_add_book()
	{
		$authors = $this->bookreview->fetch_all_authors();
		$this->load->view('add_book', array('authors' => $authors));
	}
	public function book_info($id)
	{
		$fetch_reviews = $this->bookreview->fetch_all_reviews_by_id($id);
		$book_info = $this->bookreview->fetch_book($id);
		$this->load->view('book_info', array('book_info' => $book_info, 'fetch_reviews' => $fetch_reviews));
	}
	public function add_bookreview()
	{
		
		$post = $this->input->post();
		$this->form_validation->set_rules('title', 'Title', 'required');			


		$this->form_validation->set_rules('review', 'Review', 'required');


		if($post['select_author'] == "Select Author")
		{
			$this->form_validation->set_rules('type_author', 'Type Author', 'required|is_unique[authors.name]');		
		}
		if($this->form_validation->run() === FALSE)
		{
			// die('apple');
			$this->view_data["errors"] = validation_errors();
			$errors = $this->view_data["errors"];
			$this->session->set_flashdata('messages', $errors);

		}
		else if($post['select_author'] == "Select Author" && empty($post['type_author']))
		{
			// die('carrot');
			$errors = "<p class='red'>Select OR type author.</p>";
			$this->session->set_flashdata('messages', $errors);
		}
		else if($post['select_author'] != "Select Author" && !empty($post['type_author']))
		{
			// die('carrot');
			$errors = "<p class='red'>Select OR type author.</p>";
			$this->session->set_flashdata('messages', $errors);
		}		
		else {
			$this->bookreview->add_review($this->input->post());
			$sucess = "<p class='green'>Book review successfully added.</p>";
			// die('melon');
			$this->session->set_flashdata('success', $sucess);
		}	// die('dojo');


		
		redirect('/view_add_book');
		
	}
	public function add_bookreview_from_book()
	{
		$id = $this->input->post('book_id');
		// die('snack');
		$this->form_validation->set_rules('review', 'Review', 'required');
		if($this->form_validation->run() === FALSE)
		{
			// die('apple');
			$this->view_data["errors"] = validation_errors();
			$errors = $this->view_data["errors"];
			$this->session->set_flashdata('messages', $errors);

		}
		else
		{
			$this->bookreview->add_review_from_book($this->input->post());
			$sucess = "<p class='green'>Book review successfully added.</p>";
			// die('melon');
			$this->session->set_flashdata('success', $sucess);
		}
		$this->book_info($id);
	}
	public function delete_review($review_id, $book_id)
	{
		$this->bookreview->delete_review($review_id);
		$check_reviews = $this->bookreview->check_reviews_exist($book_id);

		if(count($check_reviews) == 0)
		{
			die('where');
		}
		else{
			die('here');
			$this->book_info($book_id);
		}
		
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/');
	}

}
