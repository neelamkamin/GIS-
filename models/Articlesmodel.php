<?php
class Articlesmodel extends CI_Model {

	public function sum_column($limit, $offset)
/*This model function is for landing page after Login */	
	{
		//$this->db->select('user_id, SUM(cost) AS AMOUNT', FALSE);
		$this->db->select('user_id, COUNT(title) AS count_mm', FALSE);
		$this->db->group_by('user_id');
		$this->db->limit ($limit, $offset);
		$this->db->order_by('id','DESC');
		$query = $this->db->get('articles');
		return $query->result();

	}

	public function count_category()
	{
		//$user_id = $this->session->userdata('user_id');
		$query = $this->db
							->select(['title','id'])
							->from('articles')
							->group_by('category')
							->get();
		return $query->num_rows();
	}

	public function sum_category($limit, $offset)
	{
		$this->db->select('category, SUM(cost) AS AMOUNT', FALSE);
		//$this->db->select("user_id, SUM(cost) as AMOUNT");
		$this->db->group_by('category');
		$this->db->limit ($limit, $offset);
		$this->db->order_by('id','DESC');
		$query = $this->db->get('articles');
		return $query->result();

	}
	public function find_category ( $category )//TO FIND 'category' VIA ANCHOR tag/link only//
	{
		$q = $this->db
					->from('articles')
					->where( ['category' => $category] )
					->get();
		return $q->num_rows();

	}
	public function category_pagination( $category, $limit, $offset )
//TO DISPLAY DATA WITH PAGINATION OF CONTROLLER "User/category_result($category)" VIA ANCHOR TAG/LINK ONLY AT VIEW FILE:-  "cat_list.php"//
	{
		$q = $this->db->from('articles')
					->like('category',$category)//HERE WE PASSED "$category" WHICH WE RECEIVED ABOVE AS PARAMETER//
		            ->where( ['category' => $category] )
					->limit ( $limit, $offset)
					//->order_by('reported_at','ASC')
					->order_by('id','DESC')//ID SHOULD BE AUTO INCREMENT, FOR THIS TO WORK PROPERLY//
					->get();
		return $q->result();
	}

	public function articles_list($limit, $offset)
	//THIS FUNCTION IS TO SHOW LIST OF PROJECTS ON DASHBOARD//
	{
		$user_id = $this->session->userdata('user_id');
		$query = $this->db
							->select(['title','id','reported_at','cost','exp','category'])
							->from('articles')
							->where('user_id', $user_id)
							->limit ($limit, $offset) //FOR PAGINATION ONLY//
							->order_by('id','DESC')
							->get();
		//print_r($query->result()); exit;
		return $query->result();
					
	}

	public function all_articles_list($limit, $offset)
	//THIS FUNCTION IS TO SHOW LIST OF ALL PROJECTS ON PUBLIC//
	{
		
		$query = $this->db
							->select([
									'title','id','reported_at','cost','user_id',
									'exp','body','remark','category'
									])//HERE WE JUST ADDED 'reported_at' AS NEW PARAMETER TO SHOW DATE//
							->from('articles')
							->limit ($limit, $offset) //FOR PAGINATION ONLY//
							->order_by('id','DESC')//THIS IS ACTIVE RECORD LIBRARY OF CODEIGNITER
							->get();			//HERE 'DESC' MEANS DESENDING ORDER TO SHOW REPORTS// 
		//print_r($query->result()); exit;
		return $query->result();
	}
/*	public function add_article($array)
	{
		return $this->db->insert('articles',$array);
	}
*/
	public function add_article()
	{
		$data = array(
						'user_id' => $this->input->post('user_id'),
						'title' => $this->input->post('title'),
						'category' => $this->input->post('category'),
						'FY' => $this->input->post('FY'),
						'cost' => $this->input->post('cost'),
						'exp' => $this->input->post('exp'),
						'body' => $this->input->post('body'),
						'remark' => $this->input->post('remark')
					); 
		//echo "<pre>";
		//print_r($data); die();
		return $this->db->insert('articles', $data);
	}

	public function find_article($article_id)
	{
		$q = $this->db->select(['id','user_id','title','body','remark','cost','exp','category'])
				->where('id',$article_id)
				->get('articles');

		return $q->row(); //HERE WE RETURN 'ROW'TO FETCH ONLY ONE AFFECTED ROW, IF WE RETURN 'RESULT' THEN ARRAY WILL START WITH ZERO (0) INDEX// 
	}

	public function update_article($article_id, Array $article)
	{
		return $this->db
				->where('id',$article_id)
				->update('articles',$article);
	}

	public function delete_article($arr_id)
	{
		return $this->db->delete('articles',['id'=>$arr_id]); //HERE 1ST PARAMETER IS TABLE NAME, i.e->articles & 2ND PARAMETER IS ID OF THE REPORT-ARTICLE TO BE DELETED//
	}

	public function count_all_articles()
	{
		$user_id = $this->session->userdata('user_id');
		$query = $this->db
							->select(['title','id'])
							->from('articles')
							->get();
		return $query->num_rows();
	}

	public function num_rows() //THIS NEW FUNCTION IS MADE TO GET 'total_rows' FOR PAGINATION, SEE LINE 14 OF ADMIN.PHP FILE //
	{
		$user_id = $this->session->userdata('user_id');
		$query = $this->db
							->select(['title','id'])
							->from('articles')
							->where('user_id', $user_id)
							->get();
		return $query->num_rows();
	}

	public function count_all_dept()
	{
		$user_id = $this->session->userdata('user_id');
		$query = $this->db
							->select(['title','id'])
							->from('articles')
							->group_by('user_id')
							->get();
		return $query->num_rows();
	}

	public function search( $query, $limit, $offset )//HERE WE RECEIVED PARAMETER "$query" FROM 'public function search()' OF 'user.php' FILE AT LINE 39//
	{
		$q = $this->db->from('articles')
					->like('title',$query)//HERE WE PASSED "$query" WHICH WE RECEIVED ABOVE AS PARAMETER//
					->limit ( $limit, $offset)
					->order_by('reported_at','DESC')
					->get();
		return $q->result();
	}

	public function count_search_results($query)
	{
		$qr = $this->db->from('articles')
						->like('title',$query)
						->get();
		return $qr->num_rows();
	}

	public function dept_pagination( $user_id, $limit, $offset )
//TO DISPLAY DATA WITH PAGINATION OF CONTROLLER "User/dept_result($user_id)" VIA ANCHOR TAG/LINK ONLY AT VIEW FILE:-  "single_dept.php"//
	{
		$q = $this->db->from('articles')
					->like('user_id',$user_id)//HERE WE PASSED "$user_id" WHICH WE RECEIVED ABOVE AS PARAMETER//
		            //->where( ['user_id' => $user_id] )
					->limit ( $limit, $offset)
					//->order_by('reported_at','DESC')
					->order_by('id','DESC')//ID SHOULD BE AUTO INCREMENT, FOR THIS TO WORK PROPERLY//
					->get();
		return $q->result();
	}

	public function find_dept ( $user_id )//TO FIND 'user_id' VIA ANCHOR tag/link only//
	{
		$q = $this->db
					->from('articles')
					->where( ['user_id' => $user_id] )
					->get();
		return $q->num_rows();

	}

	public function find ( $id )
	{
		$q = $this->db->from('articles')
					->where( ['id' => $id] )
					->get();
		if($q->num_rows())
			return $q->row();
		return false;

	}
		//COPIED FROM "Htmltopdf_model.php"
	 function fetch_single_details($id) /*FOR PDF */
          {
          $this->db->where('id', $id);
          $data = $this->db->get('articles');
          $output = '<table width="90%" cellspacing="5" cellpadding="5">';
          foreach($data->result() as $row)
          {
            $output .= '   
           <tr>
            <td width="100%">  <font size="2"> 
             <p><b>PROJECT NAME : </b>'.$row->title.'</p>
             <p><b>PROJECT IN-CHARGE : </b>'.$row->user_id.'</p>
             <p><b>SADA FINANCIAL YEAR : </b>'.$row->FY.'</p>
             <p><b>CATEGORY OF FUND : </b>'.$row->category.'</p>
             <p><b>TOTAL PROJECT COST : Rs. </b>'.$row->cost.' Lakhs</p>
             <p><b>TOTAL EXPENDITURE : Rs. </b>'.$row->exp.' Lakhs</p>
             <p><b>AVAILABLE BALANCE : Rs. </b>'.($row->cost - $row->exp).' Lakhs</p>
             <p><b>SUBMITTED DATE : </b>'.date('d M Y', strtotime($row->reported_at)).'</p>
          </font>    </td>
           </tr>
          <tr>

          <td>
          <hr>
          <p align="center"><b> PROJECT REPORT : </b> </br></p>
  <font size="3"> 
                <style type="text/css">
							pre {
								    white-space: pre-wrap;       /* Since CSS 2.1 */
								    white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
								    white-space: -pre-wrap;      /* Opera 4-6 */
								    white-space: -o-pre-wrap;    /* Opera 7 */
								    word-wrap: break-word;       /* Internet Explorer 5.5+ */
								    text-align: justify;
								}
		         </style>	      				

           <pre> <b>PROJECT DESCRIPTION:-</b> '.$row->body.' </pre>
        
           <pre><b>REMAKS, IF ANY:-</b>  '.$row->remark.' </pre>

     </font>
            </td>
          </tr>
             ';
            }
            $output .= '
            <tr> 
             <td colspan="2" align="center"><a href="'.base_url().'Admin/show_cost" class="btn btn-primary">Back</a></td> 
            </tr>  '; //HERE IN ABOVE LINE '.base_url().'user" IS THE LINK (href) TO "User.php" FILE OF CONTROLLERS WHERE WE LOAD VIEW OF "project_list.php" FILE THROUGH CONTROLLER//
            //IN MVC FRAMEWORK EVERY WEB PAGE HAS TO BE LOAD THROUGH CONTROLLER ONLY//
            $output .= '</table>';
            return $output;
           }
     //FOR INSERTING TASK INTO DATABASE//      
     public function add_task($array)
		{
		//return $this->db->insert('task_db',$array);
			//if(isset($_POST['message']))
		   $servername = "localhost:3306";
			$username = "root";
			$password = "";
			$database = "rms_db";

			$conn = new mysqli($servername, $username, $password, $database);
				//{
				  $message  = $_POST['message'];
				  $emp_list   = $_POST['emp'];
				  $assign_by  = $_POST['id'];
				  
				foreach ($emp_list as $mm): 
				  
				    $sql = "INSERT INTO task_db (t_id, task, user_id, assign_by)
				                VALUES ('', '$message', '$mm', '$assign_by')";
				      
				      $res =mysqli_query($conn,$sql);
				 endforeach;
				 
				    if($res)  
				      {
				      	return true;
				      }else{
				      	return false;
				      }
		}
//FOR TASK MODULE//
	public function find_task($task_id)
		{
			$q = $this->db->select()
					->where('t_id',$task_id)
					->get('task_db');

			return $q->row(); //HERE WE RETURN 'ROW'TO FETCH ONLY ONE AFFECTED ROW, IF WE RETURN 'RESULT' THEN ARRAY WILL START WITH ZERO (0) INDEX// 
		}
	public function add_reply($array)
		{
		//return $this->db->insert('task_db',$array);
			//if(isset($_POST['message']))
		   $servername = "localhost:3306";
			$username = "root";
			$password = "";
			$database = "rms_db";

			$conn = new mysqli($servername, $username, $password, $database);
				//{
				  $reply      = $_POST['reply'];
				  $reply_by   = $_POST['reply_by'];
				  $reply_to  = $_POST['reply_to'];
				  $task_id  = $_POST['task_id'];
				  
				//foreach ($emp_list as $mm): 
				  
				    $sql = "INSERT INTO reply_db (r_id, reply, reply_by, reply_to, task_id)
				                VALUES ('', '$reply', '$reply_by', '$reply_to', '$task_id')";
				      
				      $res =mysqli_query($conn,$sql);
				 //endforeach;
				 
				    if($res)  
				      {
				      	return true;
				      }else{
				      	return false;
				      }
		}

	public function delete_task($delete_id)
		{
			return $this->db->delete('task_db',['t_id'=>$delete_id]); 
		}

	public function delete_reply($delete_Rid)
		{
			return $this->db->delete('reply_db',['r_id'=>$delete_Rid]); 
		}

}
?>