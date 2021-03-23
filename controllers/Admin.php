<?php 
class Admin extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			if(! $this->session->userdata('user_id'))
				return redirect ('login');
			$this->load->helper('form');
			$this->load->model('articlesmodel');
			$this->load->library('pdf');
		}
		public function show_cost() //THIS IS LANDING PAGE AFTER LOGIN//
		{
		
		 $this->load->library('pagination');
			   $config = [
			   		'base_url'	=> base_url('Admin/show_cost'),//BOZ HERE WE LOAD 'function index()' OF USER CONTROLLER//
			   		'per_page'	=> 5,
			   		'total_rows'=> $this->articlesmodel->count_all_dept(), //HERE 'count_all_articles()' IS THE FUNCTION WE MADE IN 'articlesmodel.php' file at line no. 42//
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

			$tol = $this->articlesmodel->sum_column($config['per_page'], $this->uri->segment(3));
			$this->load->view('admin/single_dept', compact("tol"));
			
		}

		public function dashboard()
		{
			//if(! $this->session->userdata('user_id'))//INSTEAD OF CHECKING IF USER R ALREADY LOGIN OR NOT IN ALL FUNCTIONS TO PERFORM, WE MADE __CONSTRUCT() FUNCTION, i.e-DRY PRINCIPLE//
			//return redirect('login');
			//$this->load->helper('form'); //WE MADE IT UNDER __CONSTRUCT FUNCTION, SEE THE __CONSTRUCT FUNCTION BELOW//
			//$this->load->model('articlesmodel'); //WE MADE IT UNDER __CONSTRUCT FUNCTION//
			   $this->load->library('pagination');
			   $config = [
			   		'base_url'	=> base_url('admin/dashboard'),
			   		'per_page'	=> 5,
			   		'total_rows'=> $this->articlesmodel->num_rows(), //HERE 'num_rows()' IS THE FUNCTION WE MADE IN 'articlesmodel.php' file at line no. 52//
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
			   		'cur_tag_open'	 => "<li class='active'><a>",
			   		'cur_tag_close' => '</a></li>',
			  		];
			   $this->pagination->initialize($config);

			$articles = $this->articlesmodel->articles_list($config['per_page'], $this->uri->segment(3));

			$this->load->view('admin/dashboard',['articles'=>$articles]);
		
		}

		public function show_column()
		{
			
			$this->load->view('admin/all_total');
		}

		

		public function show_category()
		{
		
		 $this->load->library('pagination');
			   $config = [
			   		'base_url'	=> base_url('Admin/show_category'),//BOZ HERE WE LOAD 'function index()' OF USER CONTROLLER//
			   		'per_page'	=> 5,
			   		'total_rows'=> $this->articlesmodel->count_category(), //HERE 'count_all_articles()' IS THE FUNCTION WE MADE IN 'articlesmodel.php' file at line no. 42//
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

			$cat = $this->articlesmodel->sum_category($config['per_page'], $this->uri->segment(3));
			$this->load->view('admin/cat_list', compact("cat"));
			
		}

		public function add_article()
		{
		//if(! $this->session->userdata('user_id'))//INSTEAD OF CHECKING IF USER R ALREADY LOGIN OR NOT IN ALL FUNCTIONS TO PERFORM, WE MADE __CONSTRUCT() FUNCTION, i.e-DRY PRINCIPLE//
		//return redirect('login');
		//$this->load->helper('form');
		//$this->load->view('admin/add_article); //Only upto this line, If Tinymce not added//
			
			//Below we have included TinyMCE intregation code//
			$data = array();
		    if($this->input->post('submit') != NULL )
				    { 
							
					$body = $this->input->post('content');
					$body = preg_replace('/<p[^>]*>/','', $body);
					$body = preg_replace('/</p>/', '</b>', $body);
					$data['content'] = $body;
							
				    }
		//END OF TinyMCE INTREGATION CODE//		    
			$this->load->view('admin/add_article',$data);
		}

/*THIS 'store_article()' FUNCTION IS NEW FUNCTION WHERE WE GET DATA IN MODEL */
		public function store_article()
		{
			
			$this->load->library('form_validation');
			if( $this->form_validation->run('add_article_rules')) 
			{
				$post = $this->input->post();
				//unset($post['submit']); 
				$this->load->model('articlesmodel'); 
				if( $this->articlesmodel->add_article($post) )

				{
					$this->session->set_flashdata('feedback',"Report Added Succesfully.");
					$this->session->set_flashdata('feedback_class','alert-success');
				}else
					 {
					
					$this->session->set_flashdata('feedback',"Failed to Add, Plz Try Again !.");		
					 }
					return redirect('admin/dashboard');

			     }else
					{
						//$upload_error = $this->upload->display_errors();
					$this->load->view('admin/add_article', compact('upload_error','KAMIN'));
					} 
		}

	/*	public function store_article()
		{
			//if(! $this->session->userdata('user_id'))//INSTEAD OF CHECKING IF USER R ALREADY LOGIN OR NOT IN ALL FUNCTIONS TO PERFORM, WE MADE __CONSTRUCT() FUNCTION, i.e-DRY PRINCIPLE//
			//return redirect('login');
			/* $config = [
					'upload_path' => './mm_upload',
					'allowed_types' => 'jpg|gif|png|jpeg|pdf|docx'
				];
			$this->load->library('upload',$config); */
	/*		$this->load->library('form_validation');
			if( $this->form_validation->run('add_article_rules')) //SEE form_validation.php FILE IN CONFIG FOLDER//
			{
				$post = $this->input->post();
				unset($post['submit']); 

				//**TO REMOVE 'SUBMIT' WHICH COMES AS ARRAY, IF WE CHEECK BY SYSTEX "print_r($post); exit;" WE GET 'submit' AS AN ARRAY ALSO & DUE TO THIS WE R NOT ABLE TO POST DATA ON DATABASE**/
				//$data = $this->upload->data();
				//echo "<pre>";
				//print_r($data); exit;
				//$upload_path = base_url("mm_upload/" .$data['raw_name'] . $data['file_ext']);
				//echo $upload_path; exit;
				//$post['upload_path'] = $upload_path;
				//echo "<pre>";
				//print_r($post); exit;
	/*			$this->load->model('articlesmodel'); //WE MADE IT UNDER __CONSTRUCT FUNCTION//
				if( $this->articlesmodel->add_article($post) )

				{
					$this->session->set_flashdata('feedback',"Report Added Succesfully.");
					$this->session->set_flashdata('feedback_class','alert-success');
					//echo "INSERTED SUCCESFULLY";
				}else
					 {
					
					$this->session->set_flashdata('feedback',"Failed to Add, Plz Try Again !.");		
					 }
					return redirect('admin/dashboard');

			     }else
					{
						//$upload_error = $this->upload->display_errors();
					$this->load->view('admin/add_article', compact('upload_error','KAMIN'));
					} 
		}
   */

		public function edit_article($article_id)
		{
			//$this->load->helper('form'); //WE MADE IT UNDER __CONSTRUCT FUNCTION//

			//$this->load->model('articlesmodel'); //WE MADE IT UNDER __CONSTRUCT FUNCTION//
			$user = $this->session->userdata('user_id');

			$article = $this->articlesmodel->find_article($article_id);

			$c_id = $article->user_id;
			//print_r($user);
			//print_r($c_id); exit;
			if($user==$c_id)
				{
					$this->load->view('admin/edit_article',['article'=>$article]);
				}else{

					$this->session->set_flashdata('feedback',"You are not Authorized");
					$this->session->set_flashdata('feedback_class','alert-danger');

					return redirect('Admin/dashboard');
				}
		}

		public function update_article($article_id)//THIS "$article_id" IS TAKEN FORM "edit_article.php" file ON LINE 4// WE USE THIS "$artic_id" PARAMETER ON LINE 72 BELOW IN THIS FILE ITSELF//
		{
			//$post = $this->input->post();
			//unset($post['submit']);
			//echo "<pre>";
			//print_r($post); exit;
			$this->load->library('form_validation');
			if( $this->form_validation->run('edit_article_rules') )//SEE form_validation.php FILE IN CONFIG FOLDER//
			{
				$post = $this->input->post();

				unset($post['submit']); //**TO REMOVE 'SUBMIT' WHICH COMES AS ARRAY, IF WE CHEECK BY SYSTEX "print_r($post); exit;" WE GET 'submit' AS AN ARRAY ALSO & DUE TO THIS WE R NOT ABLE TO POST DATA ON DATABASE**// 

				//print_r($post); exit;
				//$this->load->model('articlesmodel'); //WE MADE IT UNDER __CONSTRUCT FUNCTION//
				if( $this->articlesmodel->update_article($article_id,$post) )

				{
					$this->session->set_flashdata('feedback',"Report Updated Succesfully.");
					$this->session->set_flashdata('feedback_class','alert-success');
					//echo "INSERTED SUCCESFULLY";
				}else
					{	
					$this->session->set_flashdata('feedback',"Failed to Update, Plz report to Kamin about this.");
					//echo "FAILED";
					}
					return redirect('admin/dashboard');

				}else
					{
					$this->load->view('admin/edit_article');
					}


		}

		public function delete_article()
		{
	   //print_r( $this->input->post() ); exit; //TO PRINT article_id, THAT WE RECEIVED AFTER CLICKING DELETE BUTTON//
		$arr_id = $this->input->Post('mm_id');//INSERTING article_id into variable '$article_id'//
			//$this->load->model('articlesmodel'); //WE MADE IT UNDER __CONSTRUCT FUNCTION//
				if( $this->articlesmodel->delete_article($arr_id) )

				{
					$this->session->set_flashdata('feedback',"Report Deleted Succesfully.");
					$this->session->set_flashdata('feedback_class','alert-success');
					//echo "SUCCESS";
				}
				else
				{
					$this->session->set_flashdata('feedback',"Failed to Delete, Plz report to Kamin about this.");
					//echo "FAILED";
				}
				return redirect('admin/dashboard');
		}

		//COPIED FROM "HtmltoPDF.php" OF CONTROLLERS FILE 
		public function pdfdetails()
		 {
		  		if($this->uri->segment(3))
		  	{
			   $id = $this->uri->segment(3);

			   $html_content =  '<h5 align="center">GOVERNMENT OF ARUNACHAL PRADESH <br>
			       
			                        ( System Generated Report : www.ditc.online )
			                        </h5>';

			   $html_content .= $this->articlesmodel->fetch_single_details($id);
			   $this->pdf->loadHtml($html_content);
			   $this->pdf->setPaper('A4','portrait'); //set paper size and orientation
			   $this->pdf->render();
			   $this->pdf->stream("".$id.".pdf", array("Attachment"=>0));
		 	 }
		}

		public function show_name()
		{
			$this->load->view('admin/show_name');
		}

}
?>

	