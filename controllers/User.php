<?php 
class User  extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			if(! $this->session->userdata('user_id'))
				return redirect ('login');
		}
	
	public function index()
	{
		$this->load->helper('form');
		$this->load->model('articlesmodel');
		$this->load->library('pagination');
			   $config = [
			   		'base_url'	=> base_url('User/index'),//BOZ HERE WE LOAD 'function index()' OF USER CONTROLLER//
			   		'per_page'	=> 5,
			   		'total_rows'=> $this->articlesmodel->count_all_articles(), //HERE 'count_all_articles()' IS THE FUNCTION WE MADE IN 'articlesmodel.php' file at line no. 42//
			   		'full_tag_open'	 => "<ul class='pagination'>",//THIS LINE IS NOW WORKING
			   		'full_tag_close' => "</ul>",
			   		'first_tag_open' => '<li>',
			   		'first_tag_close' => '</li>',
			   		'last_tag_open' => '<li>',
			   		'last_tag_close' => '</li>',
			   		'next_tag_open'	 => '<li>',
			   		'next_tag_close' => '</li>',
			   		'prev_tag_open'	 => '<li>',
			   		'prev_tag_close' => '</li>',
			   		'num_tag_open'	 => '<li>',
			   		'num_tag_close' => '</li>',
			   		'cur_tag_open'	 => "<li class='active'><a>",
			   		'cur_tag_close' => '</a></li>',
			  		];
			   $this->pagination->initialize($config);

			   $articles = $this->articlesmodel->all_articles_list($config['per_page'], $this->uri->segment(3));
		//$this->load->helper('html'); //We have autoload it in autoload.php file of congig folder... 
		//...with syntex= $autoload['helper'] = array('html'); -- where I hav only entered 'html' in array parametres.//
		$this->load->view('pub/project_list',compact('articles'));
		//HERE 'compact('articles')' IS SAME AS ['articles'=>$articles];, JUST WE WRITE DIFFERENTLY//
	}

	public function search()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('query','Query','required');
		if ( ! $this->form_validation->run())
			//return $this->index();
			return redirect("Admin/show_cost");
		$query = $this->input->post('query');
		//print_r($query);
		return redirect("User/search_results/$query"); 
		
	}

	public function search_results( $query )
	{
		$this->load->helper('form');
		$this->load->model('articlesmodel');
		 $this->load->library('pagination');
			   $config = [
			   		'base_url'	=> base_url("User/search_results/$query"),//BOZ HERE WE LOAD 'function index()' OF USER CONTROLLER//
			   		'per_page'	=> 5,
			   		'total_rows'=> $this->articlesmodel->count_search_results($query), //HERE 'count_search_results($query)' IS THE FUNCTION WE MADE IN 'articlesmodel.php' file at line no. 86//
			   		'full_tag_open'	 => "<ul class='pagination'>",//THIS LINE IS NOW WORKING
			   		'full_tag_close' => "</ul>",
			   		'first_tag_open' => '<li>',
			   		'first_tag_close' => '</li>',
			   		'last_tag_open' => '<li>',
			   		'last_tag_close' => '</li>',
			   		'next_tag_open'	 => '<li>',
			   		'next_tag_close' => '</li>',
			   		'prev_tag_open'	 => '<li>',
			   		'prev_tag_close' => '</li>',
			   		'num_tag_open'	 => '<li>',
			   		'num_tag_close' => '</li>',
			   		'cur_tag_open'	 => "<li class='active'>",
			   		'cur_tag_close' => '</a></li>',
			  		];
			   $this->pagination->initialize($config);
			   $src_result = $this->articlesmodel->search($query, $config['per_page'], $this->uri->segment(4));

			   $this->load->view('pub/search_results',compact('src_result'));
	}

	public function article( $id )//HERE "$id" PARAMETER IS RECEIVED FROM "public function find ( $id )" FUNCTION OF "Articlesmodel.php" FILE OF MODELS FOLDER//
	{
		$this->load->helper('form');
		$this->load->model('articlesmodel');
		$art_id = $this->articlesmodel->find( $id ); //HE WIL PASS THIS "$art_id" OBJECT INTO "article_detail.php" FILE OF VIEWS FOLDER//
		$this->load->view('pub/article_detail', compact('art_id'));
	}

	public function dept_result( $user_id )
	{
			
		$this->load->helper('form');
		$this->load->model('articlesmodel');
		 $this->load->library('pagination');
			   $config = [
			   		'base_url'	=> base_url("User/dept_result/$user_id"),
			   		'per_page'	=> 5,
			   		'total_rows'=> $this->articlesmodel->find_dept($user_id), //HERE 'find_dept($user_id)' IS THE FUNCTION WE MADE IN 'articlesmodel.php' file //
			   		'full_tag_open'	 => "<ul class='pagination'>",
			   		'full_tag_close' => "</ul>",
			   		'first_tag_open' => '<li>',
			   		'first_tag_close' => '</li>',
			   		'last_tag_open' => '<li>',
			   		'last_tag_close' => '</li>',
			   		'next_tag_open'	 => '<li>',
			   		'next_tag_close' => '</li>',
			   		'prev_tag_open'	 => '<li>',
			   		'prev_tag_close' => '</li>',
			   		'num_tag_open'	 => '<li>',
			   		'num_tag_close' => '</li>',
			   		'cur_tag_open'	 => "<li class='active'>",
			   		'cur_tag_close' => '</a></li>',
			  		];
			   $this->pagination->initialize($config);


		$dept_id = $this->articlesmodel->dept_pagination( $user_id, $config['per_page'], $this->uri->segment(4) ); //HE WIL PASS THIS "$art_id" OBJECT INTO "article_detail.php" FILE OF VIEWS FOLDER//
		$this->load->view('pub/dept_detail', compact('dept_id'));

	}

	public function category_result( $category )
	{
			
		$this->load->helper('form');
		$this->load->model('articlesmodel');
		 $this->load->library('pagination');
			   $config = [
			   		'base_url'	=> base_url("User/category_result/$category"),
			   		'per_page'	=> 10,
			   		'total_rows'=> $this->articlesmodel->find_category($category), //HERE 'find_dept($user_id)' IS THE FUNCTION WE MADE IN 'articlesmodel.php' file //
			   		'full_tag_open'	 => "<ul class='pagination'>",
			   		'full_tag_close' => "</ul>",
			   		'first_tag_open' => '<li>',
			   		'first_tag_close' => '</li>',
			   		'last_tag_open' => '<li>',
			   		'last_tag_close' => '</li>',
			   		'next_tag_open'	 => '<li>',
			   		'next_tag_close' => '</li>',
			   		'prev_tag_open'	 => '<li>',
			   		'prev_tag_close' => '</li>',
			   		'num_tag_open'	 => '<li>',
			   		'num_tag_close' => '</li>',
			   		'cur_tag_open'	 => "<a><li class='active'>",
			   		'cur_tag_close' => '</a></li>',
			  		];
			   $this->pagination->initialize($config);


		$cat_id = $this->articlesmodel->category_pagination( $category, $config['per_page'], $this->uri->segment(4) ); //HE WIL PASS THIS "$art_id" OBJECT INTO "article_detail.php" FILE OF VIEWS FOLDER//
		$this->load->view('pub/category_detail', compact('cat_id'));

	}

	public function extra()
		{
			
			$this->load->view('pub/extra');
		}

//TASK MUDULE START HERE//
	public function task()
		{
			$this->load->helper('form');	
			$this->load->view('pub/task');			
		}
	
	public function insert_task()
		{
				$this->load->model('articlesmodel');
			$post =	$this->input->post();
			//echo "<pre>";
			//print_r($post);
			//exit;
		if( $this->articlesmodel->add_task($post) )

				{
					$this->session->set_flashdata('feedback',"Task Assigned Succesfully.");
					$this->session->set_flashdata('feedback_class','alert-success');
					//echo "INSERTED SUCCESFULLY";
				}else
					 {
					
					$this->session->set_flashdata('feedback',"Failed to Assign Task, Plz Try Again !.");		
					 }

					return redirect('User/task_list');

		}
	public function task_list()
		{
			$this->load->helper('form');
			$this->load->view('pub/task_list');
		}

	public function view_msg($task_id)
		{
			//$this->load->helper('form'); //WE MADE IT UNDER __CONSTRUCT FUNCTION//
			$this->load->helper('form');
			$this->load->model('articlesmodel'); 
			$task = $this->articlesmodel->find_task($task_id);
			
			$this->load->view('pub/view_msg',['task'=>$task]);
		}

	public function insert_reply()
		{
				$this->load->model('articlesmodel');
			$post =	$this->input->post();
			//echo "<pre>";
			//print_r($post);
			//exit;
		if( $this->articlesmodel->add_reply($post) )

				{
					$this->session->set_flashdata('feedback',"Replied Succesfully.");
					$this->session->set_flashdata('feedback_class','alert-success');
					//echo "INSERTED SUCCESFULLY";
				}else
					 {
					
					$this->session->set_flashdata('feedback',"Failed to Assign Task, Plz Try Again !.");		
					 }

					return redirect('User/task_list');

		}
	public function delete_task()
		{
	   //print_r( $this->input->post() ); exit; //TO PRINT article_id, THAT WE RECEIVED AFTER CLICKING DELETE BUTTON//
		$d_id = $this->input->Post('delete_id');//INSERTING article_id into variable '$article_id'//
			$this->load->model('articlesmodel'); 
				if( $this->articlesmodel->delete_task($d_id) )

				{
					$this->session->set_flashdata('feedback',"Task Deleted Succesfully.");
					$this->session->set_flashdata('feedback_class','alert-success');
					//echo "SUCCESS";
				}
				else
				{
					$this->session->set_flashdata('feedback',"Failed to Delete, Plz report to Kamin about this.");
					//echo "FAILED";
				}
				return redirect('User/task_list');
		}

	public function all_reply()
		{
			$this->load->helper('form');
			$this->load->view('pub/all_reply');
		}

	public function my_reply()
		{
			$this->load->helper('form');
			$this->load->view('pub/my_reply');
		}

	public function delete_reply()
		{
	   //print_r( $this->input->post() ); exit; //TO PRINT article_id, THAT WE RECEIVED AFTER CLICKING DELETE BUTTON//
		$d_Rid = $this->input->Post('delete_Rid');//INSERTING article_id into variable '$article_id'//
			$this->load->model('articlesmodel'); 
				if( $this->articlesmodel->delete_reply($d_Rid) )

				{
					$this->session->set_flashdata('feedback',"Reply Deleted Succesfully.");
					$this->session->set_flashdata('feedback_class','alert-success');
					//echo "SUCCESS";
				}
				else
				{
					$this->session->set_flashdata('feedback',"Failed to Delete, Plz report to Kamin about this.");
					//echo "FAILED";
				}
				return redirect('User/all_reply');
		}



}
?>