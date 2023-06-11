<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');

class Setting extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('model_setting');
		$this->load->model('model_beranda');
		$this->load->model('model_product');
		$this->load->library('user_agent');
		$this->load->library('cart');
		$this->load->library('RajaOngkir');
		$this->load->helper('captcha');
		$this->load->library('user_agent');
		$params = array('server_key' => 'SB-Mid-server-gPkv8dUz9jtwmnO2o2NbLKml', 'production' => false);
		$this->load->library('midtrans');
		$this->load->library('veritrans');
		$this->veritrans->config($params);
		$this->midtrans->config($params);
		$this->load->helper('url');
	}

	public function done_payment()
	{
		$json_result = file_get_contents('php://input');
		$result = json_decode($json_result);

		$transaction_id = $result->order_id;
		if($result->status_code==200){
			if ($result->transaction_status == 'settlement') {
				$data = array (
							'status' => 'Preparing Product For Shipping'
							);

				$this->db->where('random_key',$transaction_id);
				$this->db->update('transaction',$data);
			} else if ($result->transaction_status == 'pending') {
				
			} else if ($result->transaction_status == 'expire') {
				$data = array (
							'status' => 'Cancel'
							);

				$this->db->where('random_key',$transaction_id);
				$this->db->update('transaction',$data);
			} else if ($result->transaction_status == 'deny') {
				$data = array (
							'status' => 'Cancel'
							);

				$this->db->where('random_key',$transaction_id);
				$this->db->update('transaction',$data);
			} else if ($result->transaction_status == 'cancel') {
				$data = array (
							'status' => 'Cancel'
							);

				$this->db->where('random_key',$transaction_id);
				$this->db->update('transaction',$data);
			}
			// $data = array (
			// 			'status' => 'Preparing Product For Shipping'
			// 			);

			// $this->db->where('random_key',$transaction_id);
			// $this->db->update('transaction',$data);
		} else if($result->status_code==202){


			$data = array (
						'status' => 'Cancel'
						);

			$this->db->where('random_key',$transaction_id);
			$this->db->update('transaction',$data);

		}

		//notification handler sample

		/*
		$transaction = $notif->transaction_status;
		$type = $notif->payment_type;
		$order_id = $notif->order_id;
		$fraud = $notif->fraud_status;

		if ($transaction == 'capture') {
		  // For credit card transaction, we need to check whether transaction is challenge by FDS or not
		  if ($type == 'credit_card'){
		    if($fraud == 'challenge'){
		      // TODO set payment status in merchant's database to 'Challenge by FDS'
		      // TODO merchant should decide whether this transaction is authorized or not in MAP
		      echo "Transaction order_id: " . $order_id ." is challenged by FDS";
		      } 
		      else {
		      // TODO set payment status in merchant's database to 'Success'
		      echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;
		      }
		    }
		  }
		else if ($transaction == 'settlement'){
		  // TODO set payment status in merchant's database to 'Settlement'
		  echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
		  } 
		  else if($transaction == 'pending'){
		  // TODO set payment status in merchant's database to 'Pending'
		  echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
		  } 
		  else if ($transaction == 'deny') {
		  // TODO set payment status in merchant's database to 'Denied'
		  echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
		}*/

	}

	 public function token()
    {	
		
		// Required
		$transaction_details = array(
		  'order_id' => rand(),
		  'gross_amount' => 94000, // no decimal allowed for creditcard
		);

		// Optional
		$item1_details = array(
		  'id' => 'a1',
		  'price' => 18000,
		  'quantity' => 3,
		  'name' => "Apple"
		);

		// Optional
		$item2_details = array(
		  'id' => 'a2',
		  'price' => 20000,
		  'quantity' => 2,
		  'name' => "Orange"
		);

		// Optional
		$item_details = array ($item1_details, $item2_details);

		// Optional
		$billing_address = array(
		  'first_name'    => "Andri",
		  'last_name'     => "Litani",
		  'address'       => "Mangga 20",
		  'city'          => "Jakarta",
		  'postal_code'   => "16602",
		  'phone'         => "081122334455",
		  'country_code'  => 'IDN'
		);

		// Optional
		$shipping_address = array(
		  'first_name'    => "Obet",
		  'last_name'     => "Supriadi",
		  'address'       => "Manggis 90",
		  'city'          => "Jakarta",
		  'postal_code'   => "16601",
		  'phone'         => "08113366345",
		  'country_code'  => 'IDN'
		);

		// Optional
		$customer_details = array(
		  'first_name'    => "Andri",
		  'last_name'     => "Litani",
		  'email'         => "andri@litani.com",
		  'phone'         => "081122334455",
		  'billing_address'  => $billing_address,
		  'shipping_address' => $shipping_address
		);

		// Data yang akan dikirim untuk request redirect_url.
        $credit_card['secure'] = true;
        //ser save_card true to enable oneclick or 2click
        //$credit_card['save_card'] = true;

        $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O",$time),
            'unit' => 'minute', 
            'duration'  => 2
        );
        
        $transaction_data = array(
            'transaction_details'=> $transaction_details,
            'item_details'       => $item_details,
            'customer_details'   => $customer_details,
            'credit_card'        => $credit_card,
            'expiry'             => $custom_expiry
        );

		error_log(json_encode($transaction_data));
		$snapToken = $this->midtrans->getSnapToken($transaction_data);
		error_log($snapToken);
		echo $snapToken;
    }

	public function content()
	{
		
		$data['content'] = $this->model_setting->data_content();
		$this->load->view('setting/content/index_content',$data);
	}

	public function confirm_otp()
	{	


	
		
		$server = "localhost";
		$user   = 'u9670307_user_ci_version';//u6978468_reiromnewuser
		$pass   = 'reirom12345@!';//wKx0?Qp~*EuV
		$db     = 'u9670307_ci_ver';//u6978468_reiromnew
			
		$connection = mysqli_connect($server,$user,$pass,$db);

		$id = $this->input->post('id');
		$mobile = $this->input->post('new_mobile');
		$code = $this->input->post('code');
		$val = $this->db->where('id',$id)->from('member')->get()->row();
	
		$value = md5($val->email);

        $row   = mysqli_query($connection,"SELECT * FROM `code_confirm` WHERE `value`='$value' AND `code` = '$code' AND `status` = '0' ORDER BY id DESC");

        $row   = mysqli_fetch_object($row);

      
        if (!$row) {

        	$pesan = "Sorry, invalid code!";
			$this->session->set_flashdata('gagal', $pesan);
			redirect('setting/change_numbers/'.$id.'/'.$mobile);

            //eturn ['success' => false, 'msg' => 'invalid code'];

        } else {

            //print_r($row);

            if ($row->expired > time()) {
            	
                $ids  = $row->id;

                    mysqli_query($connection,"UPDATE `code_confirm` SET `status`=1 WHERE `id`='$ids'");

 					mysqli_query($connection,"UPDATE member SET `mobile`='$mobile' WHERE `id`='$id'");
               
 				$subject = "Notification for Phone number successfully updated";
                $message = "Hallo ".$val->name."<br/> You have successfully updated your Phone number to ".$mobile." <br/> <br/> If you unsure about this activity , please notify us right now.";

                $config = array(
			    'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
			    'smtp_host' => 'mail.reiromstore.com', 
			    'smtp_port' => 465,
			    'smtp_user' => '_mainaccount@reiromstore.com',
			    'smtp_pass' => 'reirom12345@!',
			    'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
			    'mailtype' => 'html', //plaintext 'text' mails or 'html'
			    'smtp_timeout' => '4', //in seconds
			    'charset' => 'iso-8859-1',
			    'wordwrap' => TRUE
			);
			$this->load->library('email');
			$this->email->initialize($config);

			$this->email->set_newline("\r\n");
	        $this->email->from('admin@reiromstore.com','Admin reirom indonesia');
	        $this->email->to($val->email);
	        $this->email->subject($subject);
	        $this->email->message($message);
	        $this->email->send();

                $pesan = "Sukses ganti nomor!";
				$this->session->set_flashdata('sukses', $pesan);
				redirect('beranda/my_profile');

            } else {
            	$pesan = "This code already expired, please request a new one";
				$this->session->set_flashdata('gagal', $pesan);
				redirect('setting/change_numbers/'.$id.'/'.$mobile);
                //return ['success' => false, 'msg' => ''];

            }

        }

    }

	public function change_number()
	{	
		
		$mobile= $this->input->post('new_mobile');
		$id= $this->input->post('id');
		$data['id'] = $id;
		$data['mobile'] = $mobile;
		$this->model_setting->change_number($id,$mobile);
		//$this->load->view('beranda/proses_change_number',$data);
		
	}	

	public function proses_change_number($id,$mobile)
	{	
		$data['id'] = $id;
		$data['mobile'] = $mobile;
		if($this->agent->is_mobile()){
			$this->load->view('mobile2/proses_change_number',$data);
		} else {
			$this->load->view('beranda/proses_change_number',$data);
		}
		
	}

	public function change_numbers($id,$mobile)
	{	
		$data['id'] = $id;
		$data['mobile'] = $mobile;
		$this->load->view('beranda/proses_change_number',$data);
		
	}

	public function forgot(){

		$where = array(
			'email' => $this->input->post('email')
			);

		$cek = $this->model_beranda->cek_login("member",$where)->num_rows();

		if($cek>0){

		if($this->input->post('captchavalue') != $this->session->userdata('captcha_str')){

			$path = './assets/captcha/';
	 	
	        //Menampilkan huruf acak untuk dijadikan captcha
	        $word = array_merge(range('A', 'Z'));
	        $acak = shuffle($word);
	        $str  = substr(implode($word), 0, 4);
	 
	        //Menyimpan huruf acak tersebut kedalam session
	        $data_ses = array('captcha_str' => $str  );

	        $this->session->set_userdata($data_ses);
	 
	        //array untuk menampilkan gambar captcha
	        $vals = array(
	            'word'  => $str, //huruf acak yang telah dibuat diatas
	            'img_path'      => FCPATH.'assets/captcha/',
	            'img_url'       => base_url().'assets/captcha/',
	            'font_path'     => FCPATH.'system/fonts/texb.ttf',
	            'img_width'     => '250',
	            'img_height'    => 50,
	            'expiration'    => 7200,
	            'word_length'   => 4,
	            'font_size'     => 20,
	            'colors'        => array(
	                    'background'	=> array(255,255,255),
					'border'	=> array(153,102,102),
					'text' => array(0, 0, 0),
					'grid' => array(255, 140, 40)
	       		 )
	        );
	 
	        $cap = create_captcha($vals);
	        $data['captcha_image'] = $cap['image'];
	        $pesan = "Captcha salah!";
			$this->session->set_flashdata('gagal', $pesan);
			$this->load->view('beranda/forgot',$data);

		}else {



		$server = "localhost";
		$user   = 'u9670307_user_ci_version';//u6978468_reiromnewuser
		$pass   = 'reirom12345@!';//wKx0?Qp~*EuV
		$db     = 'u9670307_ci_ver';//u6978468_reiromnew
			
		$connection = mysqli_connect($server,$user,$pass,$db);

		$querytesti = 'select * from member where email="'.$this->input->post('email').'"';

		//echo $querytesti;		

		$result=mysqli_query($connection,$querytesti);
		if(mysqli_num_rows($result) > 0){

			$row = mysqli_fetch_object($result);

			$to = $this->input->post('email');
			
			$reset_salt = md5(date('Y-m-d H:i:s').$to.rand(10));

			$given_pass = uniqid();
			$reset_limit = date('Y-m-d H:i:s', strtotime("+5 minutes"));

			$query_salt = "UPDATE `member` SET `reset_salt` = '".$reset_salt."', `reset_limit` = '".$reset_limit."' WHERE `email` = '".$to."'";
			
			$result=mysqli_query($connection,$query_salt);
			
			// subject

			$subject = 'Your request for  Password Reset';

			
			$site_url = base_url()."beranda/reset_password/".$to ;
			// message
			
			// Your password  : <strong>'.$row->password.'</strong><br />

			$message = '

			<html>

			<head>

			  <title>Password Reset</title>

			</head>

			<body>

			  <p>

				Hello '.$row->first_name.' '.$row->last_name.'<br />

				<br />
				You have requested to retrive password recently. Please click link below this to reset your password
				,<br />
                <a href="'.$site_url.'">'.$site_url.'</a>
				<br />

				

				<br />

				<br />
				if you unsure about this activity , please let us now immidietely
				<br />

				

<strong>Reirom Indonesia</strong> 

<br />

Technical Support 
<br />

0813 9818 1812 

<br />
<br />

Customer Service 
<br />

0813 9818 1816 <br />
<br />


			  </p>

			</body>

			</html>

			';

		 $config = array(
		    'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
		    'smtp_host' => 'mail.reiromstore.com', 
		    'smtp_port' => 465,
		    'smtp_user' => '_mainaccount@reiromstore.com',
		    'smtp_pass' => 'reirom12345@!',
		    'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
		    'mailtype' => 'html', //plaintext 'text' mails or 'html'
		    'smtp_timeout' => '4', //in seconds
		    'charset' => 'iso-8859-1',
		    'wordwrap' => TRUE
		);
		$this->load->library('email');
		$this->email->initialize($config);
       

		$this->email->set_newline("\r\n");
        $this->email->from('admin@reiromstore.com','Admin reirom indonesia');
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();


		$pesan = "Email reset password sudah dikirim ke email anda";
		$this->session->set_flashdata('sukses', $pesan);
		redirect('beranda/forgot');
		}


		}
		

		}else {

		$pesan = "Email tidak terdaftar";
		$this->session->set_flashdata('gagal', $pesan);
		redirect('beranda/forgot');


		}

	}

	public function member()
	{
		
		$data['list'] = $this->model_setting->data_member();
		$this->load->view('setting/member/index_member',$data);
	}

	public function register()
	{
		$list = $this->db->from('member')->where('email',$this->input->post('email'))->get()->row();
		if($list){

		$pesan = "Email sudah terdaftar";
		$this->session->set_flashdata('gagal', $pesan);
		redirect('beranda/register');

		}else {



		if($this->input->post('password')==$this->input->post('passwordConfirm')) {

		$data = array (
						'email' => $this->input->post('email'),
						'password' => md5($this->input->post('password')),
						'first_name' => $this->input->post('name'),
						'last_name' => $this->input->post('name2'),
						'mobile' => $this->input->post('mobile'),
						'address' => $this->input->post('address'),
						'postcode' => $this->input->post('postcode'),
						'country' => $this->input->post('country'),
						'province' => $this->input->post('province'),
						'city' => $this->input->post('city'),
						'district' => $this->input->post('district'),
						'register_date' => date('Y-m-d H:i:s'),
						'status' =>1
						);
		$this->db->insert('member',$data);

		$subject = 'www.reirom.com - Member Register';
		
		$message .= '
			<html>
			  <head>
				<title>www.reirom.com Registeration</title>
			  </head>
			  <body>
				<p>
				  Hi , '.$this->input->post('name').'
					Thanks for register with  www.reirom.com.
					
						
				   
                    <br />
                    
                   
                    <strong>Reirom Indonesia</strong> 
                    
                    <br />
                    
                    Technical Support 
                    <br />
                    
                    0813 9818 1812 
                    
                    <br />
                    <br />
                    
                    Customer Service 
                    <br />
                    
                    0813 9818 1816 <br />
                    <br />
				</p>
			  </body>
			</html>';


		 $config = array(
		    'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
		    'smtp_host' => 'mail.reiromstore.com', 
		    'smtp_port' => 465,
		    'smtp_user' => '_mainaccount@reiromstore.com',
		    'smtp_pass' => 'reirom12345@!',
		    'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
		    'mailtype' => 'html', //plaintext 'text' mails or 'html'
		    'smtp_timeout' => '4', //in seconds
		    'charset' => 'iso-8859-1',
		    'wordwrap' => TRUE
		);
		$this->load->library('email');
		$this->email->initialize($config);
       

		$this->email->set_newline("\r\n");
        $this->email->from('admin@reiromstore.com','Admin reirom indonesia');
        $this->email->to($this->input->post('email'));
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();


		$pesan = "Registrasi berhasil silahkan sign in";
		$this->session->set_flashdata('sukses', $pesan);
		redirect('beranda/register');

		}else {

		$pesan = "Konfirmasi password tidak sama";
		$this->session->set_flashdata('gagal', $pesan);
		redirect('beranda/register');

		}


		}


		
	}

	public function reset_password()
	{
	
		$email = $this->input->post('email');


		$q = $this->db->where('email',$email)->from('member')->get()->row();
		$new_password = $this->input->post('new_password');
		$new_password2 = $this->input->post('new_password2');
		$datee= date('Y-m-d H:i:s');
		$new_password2= $new_password2;

		$datetime1 = new DateTime($q->reset_limit);
		$datetime2 = new DateTime($datee);

		if($new_password==$new_password2){
			if($q->reset_limit > $datee){
			
			$data = array (
						'password' => md5($new_password)
						);

			$this->db->where('email',$email);
			$this->db->update('member',$data);

		

			$subject = 'Your Reset Password has Successfully change';

			
			// message
			
			// Your password  : <strong>'.$row->password.'</strong><br />

			$message = '

			<html>

			<head>

			  <title>Password Reset</title>

			</head>

			<body>

			  <p>

				Hello '.$q->first_name.' '.$q->last_name.'<br />

				<br />
				You have done reset your password, now you can login using new password
				,<br />
                
				<br />

				

				<br />

				<br />
				if you unsure about this activity , please let us now immidietely
				<br />

				

<strong>Reirom Indonesia</strong> 

<br />

Technical Support 
<br />

0813 9818 1812 

<br />
<br />

Customer Service 
<br />

0813 9818 1816 <br />
<br />


			  </p>

			</body>

			</html>

			';

		 $config = array(
		    'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
		    'smtp_host' => 'mail.reiromstore.com', 
		    'smtp_port' => 465,
		    'smtp_user' => '_mainaccount@reiromstore.com',
		    'smtp_pass' => 'reirom12345@!',
		    'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
		    'mailtype' => 'html', //plaintext 'text' mails or 'html'
		    'smtp_timeout' => '4', //in seconds
		    'charset' => 'iso-8859-1',
		    'wordwrap' => TRUE
		);
		$this->load->library('email');
		$this->email->initialize($config);
       

		$this->email->set_newline("\r\n");
        $this->email->from('admin@reiromstore.com','Admin reirom indonesia');
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();

			$pesan = "Password Berhasil Diubah";
			$this->session->set_flashdata('sukses', $pesan);
			redirect('beranda/login');



			}else {

			
			$pesan = "Maaf link anda sudah expired!";
			$this->session->set_flashdata('gagal', $pesan);
			redirect('beranda/forgot');

			}

			

		}else{

			$pesan = "Konfirmasi Password Tidak Sama";
			$this->session->set_flashdata('gagal', $pesan);
						redirect('beranda/reset_password/'.$email);

		}
		

		


		
	}

	

	public function edit_content($id)
	{
		$data['content'] = $this->model_setting->cariid_content($id);
		$this->load->view('setting/content/content_edit',$data);
	}

	public function shopping_cart()
	{
		$data['content'] = $this->cart->contents();
		if($this->agent->is_mobile()){
			$this->load->view('mobile2/beranda',$data);
		} else {
			$this->load->view('beranda/shopping_cart',$data);
		}
		
		
	}

	public function end_confirmation()
	{	
		if($this->agent->is_mobile()){
			$this->load->view('mobile2/end_confirmation');
		} else {
			$this->load->view('beranda/end_confirmation');
		}
		
	}

	public function personal_detail()
	{	

		$this->session->unset_userdata('promotion_code');
		$this->session->unset_userdata('notfound','0');
		$data['content'] = $this->cart->contents();
		if($this->agent->is_mobile()){
			$this->load->view('mobile2/personal_detail',$data);
		}
		else {
			$this->load->view('beranda/personal_detail',$data);
		}
		
	}

	public function delivery_type()
	{	


		$this->session->unset_userdata('promotion_code');
		$this->session->unset_userdata('notfound','0');

		$field_first_name= $this->input->post('field_first_name');
		$field_surname= $this->input->post('field_surname');
		$field_email= $this->input->post('field_email');
		$field_shipping_address= $this->input->post('field_shipping_address');
		$field_country= $this->input->post('field_country');
		$field_province= $this->input->post('field_province');
		$field_city= $this->input->post('field_city');
		$field_district= $this->input->post('field_district');
		$field_post_code= $this->input->post('field_post_code');
		$field_mobile_phone= $this->input->post('field_mobile_phone');

		if($field_province==""){
			$pesan = "Data provinsi tidak boleh kosong";
			$this->session->set_flashdata('gagal', $pesan);
			redirect('setting/personal_detail');
		}

		if($field_city==""){
			$pesan = "Data city tidak boleh kosong";
			$this->session->set_flashdata('gagal', $pesan);
			redirect('setting/personal_detail');
		}

		if($field_district==""){
			$pesan = "Data district tidak boleh kosong";
			$this->session->set_flashdata('gagal', $pesan);
			redirect('setting/personal_detail');
		}

		$data['field_first_name'] = $field_first_name;
		$data['field_surname'] = $field_surname;
		$data['field_email'] = $field_email;
		$data['field_shipping_address'] = $field_shipping_address;
		$data['field_country'] = $field_country;
		$data['field_province'] = $field_province;
		$data['field_city'] = $field_city;
		$data['field_district'] = $field_district;
		$data['field_post_code'] = $field_post_code;
		$data['field_mobile_phone'] = $field_mobile_phone;

		$data['content'] = $this->cart->contents();
		if($this->agent->is_mobile()){
					$this->load->view('mobile2/delivery_type',$data);
		}
		else {
					$this->load->view('beranda/delivery_type',$data);
		}


	}

	public function delivery_type2($field_first_name,$field_surname,$field_email,$field_shipping_address,$field_country,$field_province,$field_city,$field_district,$field_post_code,$field_mobile_phone)
	{	
		$this->session->unset_userdata('promotion_code');
		$this->session->unset_userdata('notfound','0');

		$field_shipping_address = str_replace('-',' ',$field_shipping_address);
		$field_first_name = str_replace(' ','',$field_first_name);
		$data['field_first_name'] = $field_first_name;
		$data['field_surname'] = $field_surname;
		$data['field_email'] = $field_email;
		$data['field_shipping_address'] = $field_shipping_address;
		$data['field_country'] = $field_country;
		$data['field_province'] = $field_province;
		$data['field_city'] = $field_city;
		$data['field_district'] = $field_district;
		$data['field_post_code'] = $field_post_code;
		$data['field_mobile_phone'] = $field_mobile_phone;

		$data['content'] = $this->cart->contents();
		if($this->agent->is_mobile()){
					$this->load->view('mobile/delivery_type',$data);
		}
		else {
					$this->load->view('beranda/delivery_type',$data);
		}
	}

	public function final_confirmation()
	{	

		$field_first_name= $this->input->post('field_first_name');
		$field_service= $this->input->post('field_service');
		$field_surname= $this->input->post('field_surname');
		$field_email= $this->input->post('field_email');
		$field_shipping_address= $this->input->post('field_shipping_address');
		$field_country= $this->input->post('field_country');
		$field_province= $this->input->post('field_province');
		$field_city= $this->input->post('field_city');
		$field_district= $this->input->post('field_district');
		$field_post_code= $this->input->post('field_post_code');
		$field_mobile_phone= $this->input->post('field_mobile_phone');

		$data['field_first_name'] = $field_first_name;
		$data['field_surname'] = $field_surname;
		$data['field_email'] = $field_email;
		$data['field_shipping_address'] = $field_shipping_address;
		$data['field_country'] = $field_country;
		$data['field_province'] = $field_province;
		$data['field_city'] = $field_city;
		$data['field_district'] = $field_district;
		$data['field_post_code'] = $field_post_code;
		$data['field_mobile_phone'] = $field_mobile_phone;
		
		$shipfe = explode("_",$_POST['field_delivery_type']);
		$shipfees = end($shipfe);

		$data_session = array(
				'shipping_request' => $this->input->post('field_delivery_type'),
				'shipfees' => $shipfees
		);
		$this->session->set_userdata($data_session);

		//$data['shipping_request'] =$this->input->post('field_delivery_type');
		$field = $this->input->post('field_delivery_type');
		$selected = explode('_', $this->input->post('field_delivery_type'));

	    $shipping_fee = end($selected);

		$kurir = strtoupper($selected[0]);

		$service = strtoupper($selected[1]);
		
		$data['kurir'] = $kurir;

		$data['service'] = $service;

		$data['field_delivery_type'] = $field;

		$data['shipping_fee'] = $shipping_fee;

		$data['content'] = $this->cart->contents();
		//posisi folder untuk menyimpan gambar captcha
        $path = './assets/captcha/';
 		//echo $path;die;
    
 
        //Menampilkan huruf acak untuk dijadikan captcha
        $word = array_merge(range('A', 'Z'));
        $acak = shuffle($word);
        $str  = substr(implode($word), 0, 4);
 
        //Menyimpan huruf acak tersebut kedalam session
        $data_ses = array('captcha_str' => $str  );
        $this->session->set_userdata($data_ses);
 
        //array untuk menampilkan gambar captcha
        $vals = array(
            'word'  => $str, //huruf acak yang telah dibuat diatas
            'img_path'      => FCPATH.'assets/captcha/',
            'img_url'       => base_url().'assets/captcha/',
            'font_path'     => FCPATH.'system/fonts/texb.ttf',
            'img_width'     => '250',
            'img_height'    => 50,
            'expiration'    => 7200,
            'word_length'   => 4,
            'font_size'     => 20,
            'colors'        => array(
                    'background'	=> array(255,255,255),
				'border'	=> array(153,102,102),
				'text' => array(0, 0, 0),
				'grid' => array(255, 140, 40)
        )
        );
 
        $cap = create_captcha($vals);
        $data['captcha_image'] = $cap['image'];
        
        if($this->agent->is_mobile()){
					$this->load->view('mobile2/final_confirmation',$data);
		}
		else {
					$this->load->view('beranda/final_confirmation',$data);
		}

		
	}

	public function proses_cart()
	{	

		$id = $this->input->post('id');

		$field_quantity = $this->input->post('field_quantity');
		$weight =  $this->input->post('weight');
		$id_product_price =  $this->input->post('id_product_price');
		$summ =  $this->input->post('summ');
		$addons = $this->input->post('addons') ?: [];
		
		//$oks = array ('addons' => $addons);
		//var_dump($oks);die;
		//$this->session->set_userdata($oks);


			$cart = $this->cart->contents(); //get all items in the cart
            $exists = 0;             //lets say that the new item we're adding is not in the cart
            $rowid = '';
           // echo $exists;die;

            foreach($cart as $item){
                if($item['id'] == $id)     //if the item we're adding is in cart add up those two quantities
                {
                    $exists = 1;
                    $rowid = $item['rowid'];
                    $qty = $item['qty'] + $field_quantity;
                    $price = $item['price'] + $summ;
                    
                }       
            }


            if($exists==1)
            {		
            	//echo $qty;die;
                //$this->cart_model->update_item($rowid, $qty);  

		        // Create an array with the products rowid's and quantities. 
		        $data = array(
		             'rowid' => $rowid,
		             'qty'   => $qty,
		             'subtotal' => $price 
		          );

		    // Update the cart with the new information
		        $this->cart->update($data);
		        redirect('beranda');
                //echo 'true'; // For ajax calls if javascript is enabled, return true, so the cart gets updated          
            }
            else
            {	
            	//echo 'asas';die;
                $data = array (
					'id'      => $id_product_price,
			        'qty'     => $field_quantity,
			        'price'  => $summ,
			        'name'    => 'Tshirt',
			        'id_product' => $id,
			        'addons' => $addons
				 );
                //var_dump($data);die;
				$this->cart->insert($data);

				redirect('setting/shopping_cart');;
            }  

		
	}

	public function update_cart()
	{	

		$rowid = $this->input->post('rowid');
		$field_quantity = $this->input->post('qty');
		$total =  $this->input->post('rows');
     
	    // Retrieve the posted information
	    $item = $this->input->post('rowid');
	    $subtotal = $this->input->post('subtotal');
	 
	    $qty = $this->input->post('qty');
	    for($i=0;$i <$total;$i++)
	    {
	        // Create an array with the products rowid's and quantities.
	        if($item[$i]!=''){
	        $data = array(
	           'rowid' => $item[$i],
	           'qty'   => $qty[$i],
	           'subtotal' => $subtotal[$i]
	        );	
	        } 


	        //print_r($data);
	        $this->cart->update($data);
	        // Update the cart with the new information
	        //$this->cart->update($data);
	    }


	        redirect('setting/shopping_cart');

		
	}

	public function finish()
    {
    	$result = json_decode($this->input->post('result_data'));
    	if($result){

    	$finish_redirect_url = $result->finish_redirect_url;
    	$pdf_url = $result->pdf_url;
    	$order_id = $result->order_id;
    	$order_id_midtrans = $result->order_id;
    	$transaction_id = $result->transaction_id;
    	$transaction_time = $result->transaction_time;

		$datax = array (
						
						'order_id' => $order_id,
						'order_id_midtrans' => $transaction_id,
						'pdf_url' => $pdf_url,
						'finish_redirect_url' => $finish_redirect_url,
						'status' => 'Pending',
						'tanggal' => $transaction_time

					);
		$this->db->insert('mt_transaction',$datax);

		$data_session = array(
								'shipping_request' =>'',
								'shipfees' =>'',
								'shipping_service' => '',
								'promotion_code' => '',
								'promotion_value_result'=>''
							);
		$this->session->set_userdata($data_session);  

		$this->cart->destroy();  


    	redirect('setting/end_confirmation');


    	}else {

    		$this->model_setting->insert_transaction_transfer($this->input->post());
    	}
    	

    	

    }

	public function prosess_end_confirmation()
	{	

		if (!$this->session->userdata('id')) {
	      redirect('login');
	    }

		$this->model_setting->insert_transaction($_POST);
		
	}


	public function remove_cart($rowid)
	{	

	        $data = array(
	           'rowid' => $rowid,
	           'qty'   => 0
	        );	
	     
	        $this->cart->update($data);
	        redirect('setting/shopping_cart');;
	      

		
	}

	public function edit_member($id)
	{
		$data['list'] = $this->model_setting->cariid_member($id);
		$this->load->view('setting/member/member_edit',$data);
	}

	function get_province(){
        $province_id = $this->input->post('id',TRUE);

        $data = $this->db->from('datakurir_province')->join('datakurir_city','datakurir_province.id=datakurir_city.province_id')->where('datakurir_province.id', $province_id)->get()->result();
        echo json_encode($data);
    }

    function get_district(){
        $city_id = $this->input->post('id',TRUE);
        $province_id = $this->input->post('province_id',TRUE);
		$data = $this->db->from('datakurir_district')->where('province_id', $province_id)->where('city_id', $city_id)->order_by('id','DESC')->get()->result();
        echo json_encode($data);
    }

	public function content_update()
	{
		if(isset($_POST['btn']))
		{
		    $this->model_setting->update_content($_POST);
		}
		$pesan = "Data Berhasil Diubah. $msg";
		$this->session->set_flashdata('sukses', $pesan);
		redirect('setting/content');
	}

	public function member_update()
	{
		if(isset($_POST['btn']))
		{
		    $this->model_setting->update_member($_POST);
		}
	    $pesan = "Data Berhasil Diubah. $msg";
		$this->session->set_flashdata('sukses', $pesan);
		redirect('setting/member');
	}

	public function sending_mail(){

		 		$subject = "Hallo  ".$this->input->post('first_name')."";
                $message = "";
            // To send HTML mail, the Content-type header must be set
                
                $message .="
                 Halo ".$this->input->post('first_name')." ,<br>
Kami memiliki catatan mengenai transaksi order anda nomor ".$this->input->post('track_key'
	).".<br>

Catatan :<br>
".$this->input->post('catatan_customer')."<br><br>

Untuk lebih detail , silahkan login ke member area atau hubungi cs kami<br>
            
            <strong>Reirom Indonesia</strong><br />
            Customer Service & Technical Support<br />

            0813 9818 1812<br />

            info@reirom.com<br />";



            $config = array(
		    'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
		    'smtp_host' => 'mail.reiromstore.com', 
		    'smtp_port' => 465,
		    'smtp_user' => '_mainaccount@reiromstore.com',
		    'smtp_pass' => 'reirom12345@!',
		    'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
		    'mailtype' => 'html', //plaintext 'text' mails or 'html'
		    'smtp_timeout' => '4', //in seconds
		    'charset' => 'iso-8859-1',
		    'wordwrap' => TRUE
			);
			$this->load->library('email');
			$this->email->initialize($config);

			$this->email->set_newline("\r\n");
	        $this->email->from('admin@reiromstore.com','Admin reirom indonesia','Admin reirom indonesia');
	        $this->email->to($this->input->post('email'));
	        $this->email->subject($subject);
	        $this->email->message($message);
	        $this->email->send();

	        redirect('transaction/detail_trans/'.$this->input->post('id_trans'));
	}

	public function catatan($string){

			if($string=="internal"){

				$data = array (
						'catatan_internal' => $this->input->post('internal_note')
						);

			
			}else {


				$data = array (
						'catatan_customer' => $this->input->post('customer_note')
						);

			}
			
			$this->db->where('id',$this->input->post('id_trans'));
			$this->db->update('transaction',$data);

			redirect('transaction/detail_trans/'.$this->input->post('id_trans'));

	}

	public function change_password()
	{
		$id = $this->input->post('id');
		$old_password = $this->input->post('old_password');
		$new_password = $this->input->post('new_password');
		$new_password2 = $this->input->post('new_password2');

		$old_password= md5($old_password);

		$query = $this->db->where('password',$old_password)->where('id',$id)->from('member');
		$query = $this->db->get();
		$rows=$query->num_rows();
	
		if($rows>0){

		if($new_password==$new_password2){


			$cek = $this->db->where('id',$id)->from('member')->get()->row();

			$data = array (
						'password' => md5($new_password)
						);

			$this->db->where('id',$id);
			$this->db->update('member',$data);

			$subject = 'Your Reset Password has Successfully change';

			
			// message
			
			// Your password  : <strong>'.$row->password.'</strong><br />

			$message = '

			<html>

			<head>

			  <title>Password Reset</title>

			</head>

			<body>

			  <p>

				Hello '.$cek->first_name.' '.$cek->last_name.'<br />

				<br />
				You have done change your password
				,<br />
                
				<br />

				

				<br />

				<br />
				if you unsure about this activity , please let us now immidietely
				<br />

				

<strong>Reirom Indonesia</strong> 

<br />

Technical Support 
<br />

0813 9818 1812 

<br />
<br />

Customer Service 
<br />

0813 9818 1816 <br />
<br />


			  </p>

			</body>

			</html>

			';

		 $config = array(
		    'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
		    'smtp_host' => 'mail.reiromstore.com', 
		    'smtp_port' => 465,
		    'smtp_user' => '_mainaccount@reiromstore.com',
		    'smtp_pass' => 'reirom12345@!',
		    'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
		    'mailtype' => 'html', //plaintext 'text' mails or 'html'
		    'smtp_timeout' => '4', //in seconds
		    'charset' => 'iso-8859-1',
		    'wordwrap' => TRUE
		);
		$this->load->library('email');
		$this->email->initialize($config);
       

		$this->email->set_newline("\r\n");
        $this->email->from('admin@reiromstore.com','Admin reirom indonesia');
        $this->email->to($cek->email);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();

			$pesan = "Password Berhasil Diubah";
			$this->session->set_flashdata('sukses', $pesan);
			redirect('beranda/change_password');

		}else{

			$pesan = "Konfirmasi Password Tidak Sama";
			$this->session->set_flashdata('gagal', $pesan);
						redirect('beranda/change_password');

		}
		

		}else {

			$pesan = "Password Lama Anda Salah";
			$this->session->set_flashdata('gagal', $pesan);
			redirect('beranda/change_password');

		}
		
	}



	public function delete_member($id)
	{
		if(isset($id))
		{
			$this->model_setting->delete_member($id);
		}
		$pesan = "Data Berhasil Dihapus";
		$this->session->set_flashdata('sukses', $pesan);
		redirect('setting/member');
	}

	public function get_promo(){

	$server = "localhost";
	$user   = 'u9670307_user_ci_version';//u6978468_reiromnewuser
	$pass   = 'reirom12345@!';//wKx0?Qp~*EuV
	$db     = 'u9670307_ci_ver';//u6978468_reiromnew
		
	$connection = mysqli_connect($server,$user,$pass,$db);
	 $message = "";
	    $querymember = mysqli_fetch_array(mysqli_query($connection,"SELECT * FROM member WHERE email = '".$this->session->userdata('email')."'"));
		if(is_array($querymember)){
			if($_POST['action'] == 'validate'){

				$shipfe = explode("_",$_POST['shipping_request']);
				$shipfees = end($shipfe);

				  
				$data_session = array(
								'shipping_request' =>$_POST['shipping_request'],
								'shipfees' =>$shipfees,
								'shipping_service' => $_POST['shipping_service'],
								'promotion_code' => $_POST['code'],
								);
				$this->session->set_userdata($data_session);
				$promo = $_POST['code'];
				$eglibed = false;

				$promotion=mysqli_fetch_object(mysqli_query($connection,"SELECT * FROM promotion WHERE promotion_code = '".$_POST['code']."'"));

				$exist = mysqli_num_rows(mysqli_query($connection,"SELECT * FROM promotion WHERE promotion_code = '".$_POST['code']."'"));
				
				if($exist>0){

				$countUsed = mysqli_num_rows(mysqli_query($connection,"SELECT * FROM transaction WHERE promotion_code = '".$promotion->promotion_code."'"));
				$array_users = unserialize($promotion->user_for);
				$user_id = $_POST['user_id'];

				
				$array_categories = unserialize($promotion->category_for);

				/********************************
				* Cari apakah ada kategory parent, jika iya ambil id child
				*********************************/
				
				
				$array_products = unserialize($promotion->product_for);
				$products = json_decode($_POST['products']);
				$product_categories = json_decode($_POST['product_categories']);
				$total_price_idr = $_POST['total_cart'];
				$is_valid_for_user = false;
        		     $is_valid_for_category = false;
        		     $is_valid_for_product = false;
		        /**************************
		         * Cek promo masih aktif atau expired dan masih bisa digunakan
		         * ************************/
		          
				if ($promo != NULL && $promotion->is_active == 1 && time() <= strtotime($promotion->to_date) && $countUsed < $promotion->limit_counter ) {


				     /**************************
        		     * Cek jenis promo
        		     * *************************/
        		     $cara_hitung_promo = $promotion->promotion_type;

        		     if($cara_hitung_promo=="fixed"){

        		     	  $kurang = $promotion->value;
        		     }else {

        		     	  $kurang = ($total_price_idr * $promotion->value) / 100;
        		     }
        		 
					if($kurang > $promotion->max_amount){
						    $message .= "9-";
							$kurang = $promotion->max_amount;
						}
				
				    /****************************
				     * Hasil akhir
				     * ****************************/
				    $data_sessions = array(
								'promotion_value_result' =>$kurang
								);
					$this->session->set_userdata($data_sessions);
					


					$data = array(
						'status' => true,
						'msg' => 'Congratulation, your promotion code is valid and applied!',
						'promotion_code' => $_POST['code'],
						'promotion_value' => $kurang,
						'message'=> $message
					);
        		     
					
				   
					
				} //end cek promo aktif
				else{
				    $final_msg_status = 0;
				    if($promo == NULL || $promotion->is_active != 1){
		                $final_msg = "Promo code not found";
		                $final_msg_status = 1;
		            }
		            if(strtotime($promotion->to_date) >= time() && $final_msg_status == 0){
		                $final_msg = "Promo code expired";
		                $final_msg_status = 1;
		            }
		            if($countUsed >= $promotion->limit_counter && $final_msg_status == 0){
		                $final_msg = "Promo code no quota";
		            }


		            $data = array(
						'status' => false,
						'msg' => $final_msg,
						'promotion_code' => $_POST['code']
					);
		            
				}
			

				$data_sessionxx = array(
								'notfound' => '1',

								);
				$this->session->set_userdata($data_sessionxx);


				}
				else {

				$data = array(
						'status' => false,
						'msg' => 'Promo code not found'
					);

				$data_sessionxx = array(
								'shipping_request' =>$_POST['shipping_request'],
								'shipfees' =>$shipfees,
								'promotion_code' => '',
								'notfound' => '0',

								);
				$this->session->unset_userdata('notfound');
				$this->session->set_userdata($data_sessionxx);


				}

				
			}
			else if($_POST['action'] == 'remove'){
				$shipfe = explode("_",$_POST['shipping_request']);
				$shipfees = end($shipfe);
				$data_sessionx = array(
								'shipping_request' =>$_POST['shipping_request'],
								'shipfees' =>$shipfees,
								'promotion_code' => '',
								'notfound' => '0'
								);
				$this->session->set_userdata($data_sessionx);
				$this->session->unset_userdata('promotion_code');
				$promo = $_POST['code'];
				$eglibed = false;

				$promotion = mysqli_fetch_object(mysqli_query($connection,"SELECT * FROM promotion WHERE promotion_code = '".$_POST['code']."'"));
				$countUsed = mysqli_num_rows(mysqli_query($connection,"SELECT * FROM transaction WHERE promotion_code = '".$promotion->promotion_code."'"));
				$array_users = unserialize($promotion->user_for);
				$user_id = $_POST['user_id'];
				
					$array_categories = unserialize($promotion->category_for);
				/********************************
				* Cari apakah ada kategory parent, jika iya ambil id child
				*********************************/
				if(!empty($array_categories)){
				    foreach($array_categories as $pcat){
				        	$cat = mysqli_fetch_object(mysqli_query($connection,"SELECT * FROM category WHERE id = '".$pcat."'"));
				        	if($cat->is_top){
				        	    	$childs = mysqli_query($connection,"SELECT * FROM category WHERE group_id = '".$pcat."'");
				        	    	
				        	    	 while($row = mysqli_fetch_array($childs)){
				        	    	        $array_categories[] = $row['id'];
				        	    	    }
				        	}
				    }	                    
				}
				
				$array_products = unserialize($promotion->product_for);
				$products = json_decode($_POST['products']);
				$product_categories = json_decode($_POST['product_categories']);
				$total_price_idr = $_POST['total_cart'];
		
				if ( ($promo != NULL) && ($promotion->is_active == 1) && (strtotime($promotion->to_date) > time()) && ($countUsed < $promotion->limit_counter) ) {
				    
				      /**************************
        		     * Cek jenis promo
        		     * *************************/
        		     $cara_hitung_promo = $promotion->promotion_type;
        		     $is_valid_for_user = false;
        		     $is_valid_for_category = false;
        		     $is_valid_for_product = false;
        		     
					if( ($promotion->valid_for == 'all') || ($promotion->valid_for == 'single' && in_array($user_id, $array_users)) ){
					$is_valid_for_user = true;
					}
					
				 if(($promotion->valid_category_for == 'all')){
						   $is_valid_for_category = true;
					    }else{
					        if($promotion->valid_category_for == 'specific'){
					            if(!empty($product_categories)){
					                foreach($product_categories as $cat){
					                    if(in_array($cat,$array_categories)){
					                        $is_valid_for_category = true;
					                        break;
					                    }
					                }
					            }
					        }
					    }
					    
					 if(($promotion->valid_product_for == 'all')){
						    $is_valid_for_product = true;
					    }else{
					         if(empty($array_products)){
					                $is_valid_for_product = true;
					            }
					            else{
        					        if($promotion->valid_product_for == 'specific'){
        					            if(!empty($products)){
        					                foreach($products as $prod){
        					                    if(in_array($pro,$array_products)){
        					                        $is_valid_for_product = true;
        					                        break;
        					                    }
        					                }
        					            }
        					        }
					            }
					    }
				}
			
				if(  $is_valid_for_user && $is_valid_for_category && $is_valid_for_product){
				    
				     /********************************
				     * Cara hitung promo disini apakah grand total atau shipment
				     * ******************************/
				        if ($promotion->type == 'fixed') {
							$kurang = $promotion->value;
							if($promotion->promotion_type == "shippingcost"){
						         $shipment = explode("_",$_POST['shipping_request']);
						        $shipcost = $shipment[1];
						        if($kurang > $shipcost){
						            $kurang = $shipcost;
						        }
						    }
						} else {
						    if($promotion->promotion_type == "shippingcost"){
						          $shipment = explode("_",$_POST['shipping_request']);
						        $shipcost = $shipment[1];
						        $kurang = $shipcost * ($promotion->value / 100);
						    }else if($promotion->promotion_type == "grandtotal"){
						        $kurang = $total_price_idr * ($promotion->value / 100);
						    }
							
						}
						
						 /**************************
        		         * Cek promo penggunaannya sudah mencapai maximum atau belum
        		         * *************************/
						if($kurang > $promotion->max_amount){
							$kurang = $promotion->max_amount;
						}
				    
				    $this->session->unset_userdata('promotion_value_result');
				    $data = array(
						'status' => true,
						'msg' => 'Congratulation, your promotion code removed from your cart!',
						'promotion_code' => $_POST['code'],
						'promotion_value' => $kurang
					);
				}
				else{
					$data = array(
						'status' => false,
						'msg' => 'Your pormotion code is invalid!',
						'promotion_code' => $_POST['code']
					);
				}
			}
		} //elif action
		else{
			$data = array(
				'status' => false,
				'msg' => 'You must login to use promo code!'
			);
		}
	
		header('Content-type: application/json');
		$hasil = json_encode($data, JSON_PRETTY_PRINT);
		echo $hasil;
		die();
   

	}


	public function ajax2(){

	$request = $_POST['track'];

	$q9=$this->db->where('random_key',$request)->from('transaction')->get()->row();

	echo $q9->total_amount+$q9->delivery_fee-$q9->diskon;

	}

	public function ajax3(){

	$request = $_POST['track'];

	$q9=$this->db->where('random_key',$request)->from('transaction')->get()->row();

	echo $q9->delivery_agency_number;

	}

	public function confirmation_payment(){

	$nominal = $this->input->post('field_payments');

	$server = "localhost";
	$user   = 'u9670307_user_ci_version';//u6978468_reiromnewuser
	$pass   = 'reirom12345@!';//wKx0?Qp~*EuV
	$db     = 'u9670307_ci_ver';//u6978468_reiromnew
		
	$connection = mysqli_connect($server,$user,$pass,$db);

	$query_check = "select * from `transaction` where `random_key`='".$this->input->post('field_track_key')."' and `status` = 'Waiting Payment'";

	$rs_check = mysqli_query($connection,$query_check);
	$row=mysqli_fetch_array($rs_check);
	if(mysqli_num_rows($rs_check) > 0)
	{
	
	$total_amount = str_replace('.00', '', $row['total_amount']);
	$diskon = str_replace('.00', '', $row['diskon']);
	$delivery_fee = str_replace('.00', '', $row['delivery_fee']);
	$totals = $total_amount + $delivery_fee - $diskon;
	if($nominal==$totals){

		$transaction_id = substr($this->input->post('field_track_key'),3,-3);
		
		$file = $this->do_upload();
		$foto = $file['file_name'];

		$query = "update `transaction` set `status`='Payment Validation ', 
		`payment_amount`='".$nominal."', 
		`currency_payment`='IDR',
		`validation_rekeningno`='".$this->input->post('field_norek')."',
		`validation_name`='".$this->input->post('field_nmrek')."',
		`validation_bank_name`='".$this->input->post('field_bank_name')."',
		`validation_resi_file`='".$foto."',
		`confirm_customer_payment_date`='".date("Y-m-d H:i:s")."' where `random_key`='".$row['random_key']."'";
		mysqli_query($connection,$query);


		$query_detail = "select * from `transaction` where `random_key`='".$this->input->post('field_track_key')."'";
		$rs_detail = mysqli_query($connection,$query_detail);
		$row_detail = mysqli_fetch_object($rs_detail);

		$cek = $this->db->where('id',$row_detail->customer_id)->from('member')->get()->row();

		$id = $row_detail->id;
		$first_name = $row_detail->first_name;
		$surname = $row_detail->surname;
		$email = $row_detail->email;
		$shipping_address = $row_detail->shipping_address;
		$q1 = mysqli_fetch_object(mysqli_query($connection,'select * from datakurir_city where id='.$cek->city));
		$city = $q1->city_fullname;
		$id_provinsi = $q1->province_id;
		$q2 = mysqli_fetch_object(mysqli_query($connection,'select * from datakurir_province where id='.$id_provinsi));
		$provinsi = $q2->province;
		$postcode = $row_detail->postcode;
		$mobile_phone = $row_detail->mobile_phone;
		$payment_to = $row_detail->payment_to;
		$delivery_agency = $row_detail->delivery_agency;
		$delivery_agency_number = $row_detail->delivery_agency_number;
		$currency_type = $row_detail->currency_type;
		$delivery_fee = $row_detail->delivery_fee;
		$status = $row_detail->status;
		$subject = "[CONFIRMATION PAYMENT ] for Order Number ".$this->input->post('field_track_key');
		$message = "";
		$message .='
		<table width="100%"  border="0" cellspacing="0" cellpadding="0">
		<tr>
		<td>
		Admin,<br>
		Customer  : '. urldecode($first_name) . ' ' . urldecode($surname) .'<br>
		have did a payment confirmation for Order Number  : '. $this->input->post('field_track_key') .'<br />
		Please check the validation on the Bank Account<br>
		<br />
		If the transaction VALID , Please Confirm it at menu <strong>ADMIN - > TRANSACTION -> VALIDATION TRANSACTION </strong>
		<br />  <br />
		<strong> Order Number  : '. $this->input->post('field_track_key') .' </strong>
		<br />
		</TD>
		</tr>';

		/*$query_trans_detail = "select * from `transaction_detail` where `transaction_id`='".$id."'";
		$rs_trans_detail = mysqli_query($connection,$query_trans_detail);
		$message .='
		<tr>
		<td><table width="100%"  border="1" cellspacing="0" cellpadding="2">
		<tr>
		<td width="5%" align="center">No</td>
		<td width="31%" align="center">Name</td>
		<td width="10%" align="center">Quantity</td>
		<td width="16%" align="center">Price</td>
		<td width="16%" align="center">Total Price </td>
		</tr>';
		$no = 1;
		$total_price = 0;
		$totalTax = 0;
		if($currency_type == "IDR") $currency_symbol = "Rp. ";
		while($row_trans_detail = mysqli_fetch_object($rs_trans_detail))
		{		
        		

			   

			$totalTax += $row_trans_detail->tax;
			$quantity = $row_trans_detail->product_quantity;
			$total_price += $quantity*$row_trans_detail->product_price; 
			$message .='
			<tr valign="top">
			<td><div id="#" align="right">'.$no++.'.</div></td>
			<td><div id="#" align="left">'.$row_trans_detail->product_name.'</div></td>
			<td><div id="#" align="center">'.$quantity.'</div></td>
			<td><div id="#" align="right">'.$currency_symbol.number_format($row_trans_detail->product_price).'</div></td>
			<td><div id="#" align="right">'.$currency_symbol.number_format($quantity*$total_price).'</div></td>
			</tr>';
		} 
		$message .='
		<tr valign="top">
		<td colspan="4" align="right">Total Price<br>
		Shipping Fee
		<br>
		PPN
		<br>
		Diskon
		</td>
		<td align="right">'.$currency_symbol.number_format($total_price).'<br>
		'.$currency_symbol.number_format($delivery_fee).'<br>
		'.$currency_symbol.number_format($totalTax).'<br>
		'.$currency_symbol.number_format($row_detail->diskon).'
		</td>
		</tr>
		<tr valign="top">
		<td colspan="4" align="right"><strong>Grand Total </strong></td>
		<td align="right"><strong>'.$currency_symbol.number_format($total_price+$delivery_fee+$totalTax-$row_detail->diskon).'</strong></td>
		</tr>
		</table></td>
		</tr>
		</table>';	*/


		$config = array(
		    'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
		    'smtp_host' => 'mail.reiromstore.com', 
		    'smtp_port' => 465,
		    'smtp_user' => '_mainaccount@reiromstore.com',
		    'smtp_pass' => 'reirom12345@!',
		    'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
		    'mailtype' => 'html', //plaintext 'text' mails or 'html'
		    'smtp_timeout' => '4', //in seconds
		    'charset' => 'iso-8859-1',
		    'wordwrap' => TRUE
		);
		$this->load->library('email');
		$this->email->initialize($config);

		$this->email->set_newline("\r\n");
        $this->email->from('admin@reiromstore.com','Admin reirom indonesia');
        $this->email->to('reiromtesting@gmail.com');
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();


		$pesan = "Order NUmber: ".$this->input->post('field_track_key')." Successfully confirmed. Please wait while we validate your order. We will sent update to your registered email and order status";
		$this->session->set_flashdata('sukses', $pesan);
		redirect('beranda/confirmation_payment');

	}else {

		$pesan = "Nominal yang anda masukkan tidak sama";
		$this->session->set_flashdata('gagal', $pesan);
		redirect('beranda/confirmation_payment');

	}
    /*$transaction_id = substr($this->input->post('field_track_key'),3,-3);
	$updateResi = '';
	if (move_uploaded_file($_FILES["field_file_resi"]["tmp_name"],"".base_url()."images/resi/" . $_FILES["field_file_resi"]["name"])) {
		$updateResi = "`validation_resi_file`='".$_FILES["field_file_resi"]["name"]."',";
	}
	$query = "update `transaction` set `status`='Payment Validation ', 
	`payment_amount`='".$this->input->post('field_payment')."', 
	`currency_payment`='IDR',
	`validation_rekeningno`='".$this->input->post('field_norek')."',
	`validation_name`='".$this->input->post('field_nmrek')."',
	`validation_bank_name`='".$this->input->post('field_bank_name')."',
	".$updateResi."
	`confirm_customer_payment_date`='".date("Y-m-d H:i:s")."' where `random_key`='".$row['random_key']."'";
	mysqli_query($query) or die(mysqli_error());
	

	email_after_confirmation($row['random_key'],$adminEmail);*/

	}
	else
	{
		

	}

	/*


		$config = array(
		    'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
		    'smtp_host' => 'mail.reiromstore.com', 
		    'smtp_port' => 465,
		    'smtp_user' => '_mainaccount@reiromstore.com',
		    'smtp_pass' => 'reirom12345@!',
		    'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
		    'mailtype' => 'html', //plaintext 'text' mails or 'html'
		    'smtp_timeout' => '4', //in seconds
		    'charset' => 'iso-8859-1',
		    'wordwrap' => TRUE
		);
		$this->load->library('email');
		$this->email->initialize($config);

		$this->email->set_newline("\r\n");
        $this->email->from('admin@reiromstore.com','Admin reirom indonesia');
        $this->email->to($to_user);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();*/


	}

	public function do_upload()
	{
	    $config['upload_path']   = './images/resi';
	    $config['allowed_types'] = 'gif|jpg|png';
	    $config['max_size']      = 2048; //max 2MB
	    $config['max_width']     = 5000; //max lebar 5000 pixel
	    $config['max_height']    = 5000; //max tinggi 5000 pixel
        $config['file_name']     = date("ymdhis").rand(1111,9999); //generate nama file

        $this->load->library('upload', $config);
		$this->upload->initialize($config);

	    if (!$this->upload->do_upload('field_file_resi')) //foto adalah name pada input type file
	    {
	            $hasil['msg'] = $this->upload->display_errors();
	            $hasil['file_name'] = "";
	    }
	    else
	    {
	            $data = $this->upload->data();
	            $hasil['msg'] = "Upload Success";
	            $hasil['file_name'] = $data['file_name'];
	    }
	    return $hasil;
	}


	public function add_wishlist(){

	$server = "localhost";
	$user   = 'u9670307_user_ci_version';//u6978468_reiromnewuser
	$pass   = 'reirom12345@!';//wKx0?Qp~*EuV
	$db     = 'u9670307_ci_ver';//u6978468_reiromnew
		
	$connection = mysqli_connect($server,$user,$pass,$db);

	$email      = $this->session->userdata('email');
	$product_id = $_POST['product_id'];
	$varian     = $_POST['varian'];
	$query      = mysqli_query($connection,"SELECT * from `wishlist_db` WHERE `product_id`='$product_id' AND `email`='$email'");
	if ($query) {	
	    if (mysqli_num_rows($query) > 0) {
	        $query = mysqli_query($connection,"DELETE from `wishlist_db` WHERE `product_id`='$product_id' AND `email`='$email'");
	    }
	}
	$datess= date('Y-m-d H:i:s');
	$query = "INSERT INTO `wishlist_db`( `email`, `product_id`, `price`,`waktu`)VALUES('$email', '$product_id','$varian','$datess')";

	mysqli_query($connection,$query);
	

	}


	public function add_wishlist2($id){

	$server = "localhost";
	$user   = 'u9670307_user_ci_version';//u6978468_reiromnewuser
	$pass   = 'reirom12345@!';//wKx0?Qp~*EuV
	$db     = 'u9670307_ci_ver';//u6978468_reiromnew
		
	$connection = mysqli_connect($server,$user,$pass,$db);

	$email      = $this->session->userdata('email');
	$query      = mysqli_query($connection,"SELECT * from `wishlist_db` WHERE `product_id`='$id' AND `email`='$email'");
	if ($query) {	
	    if (mysqli_num_rows($query) > 0) {
	        $query = mysqli_query($connection,"DELETE from `wishlist_db` WHERE `product_id`='$id' AND `email`='$email'");
	    }
	}
	$datess= date('Y-m-d H:i:s');
	$query = "INSERT INTO `wishlist_db`( `email`, `product_id`, `waktu`)VALUES('$email', '$id','$datess')";

	mysqli_query($connection,$query);
	
	redirect('setting/shopping_cart');

	}

	public function diskusi_add(){

	if (!$this->session->userdata('id')) {
	      redirect('beranda/login');
	}
	$id = $this->input->post('id_product');
	$wording = $this->input->post('wording');
	
	$data = array(
			'wording' => $wording,
			'id_product' => $id,
			'user_id'=> $this->session->userdata('id'),
			'tgl_diskusi'=> date('Y-m-d H:i:s'),
			'ip_address' => $this->input->ip_address(),
			);

	$this->db->insert('diskusi',$data);


	redirect('products/detail/'.$id);

	}

	public function diskusi_detail(){

	if (!$this->session->userdata('id')) {
	      redirect('beranda/login');
	}

	$user_id = $this->input->post('user_id');
	$id_product = $this->input->post('id_product');
	$id_detail = $this->input->post('id_detail');
	$wording = $this->input->post('wordings');
	
	$list=$this->db->where('id',$user_id)->from('member')->get()->row();
	$list2=$this->db->where('id',$id_product)->from('product')->get()->row();
	$data = array(
			'id_diskusi' => $id_detail,
			'wording' => $wording,
			'id_product' => $id_product,
			'user_id'=> $this->session->userdata('id'),
			'tgl_diskusi'=> date('Y-m-d H:i:s'),
			'ip_address' => $this->input->ip_address(),
			);


	$subject = "Notification for Discussion product";
                $message = "Hallo ".$list->first_name."<br/> You got reply from discussion product  ".$list2->name." <br/> <br/> 

                Click this link to see the discussion <a href=".base_url("products/detail/".$id_product).">".base_url("products/detail/".$id_product)."</a>
                <br/> <br/> 
                If you unsure about this activity , please notify us right now.";

                $config = array(
			    'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
			    'smtp_host' => 'mail.reiromstore.com', 
			    'smtp_port' => 465,
			    'smtp_user' => '_mainaccount@reiromstore.com',
			    'smtp_pass' => 'reirom12345@!',
			    'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
			    'mailtype' => 'html', //plaintext 'text' mails or 'html'
			    'smtp_timeout' => '4', //in seconds
			    'charset' => 'iso-8859-1',
			    'wordwrap' => TRUE
			);
			$this->load->library('email');
			$this->email->initialize($config);

			$this->email->set_newline("\r\n");
	        $this->email->from('admin@reiromstore.com','Admin reirom indonesia');
	        $this->email->to($list->email);
	        $this->email->subject($subject);
	        $this->email->message($message);
	        $this->email->send();

	$this->db->insert('diskusi_detail',$data);

	redirect('products/detail/'.$id_product);

	}


	public function delete_wish($id)
	{	
		
		$this->db->where('wish_id',$id);
		$this->db->delete('wishlist_db');

		
		$pesan = "Data Berhasil Dihapus";
		$this->session->set_flashdata('sukses', $pesan);
		redirect('beranda/wishlist');
	}
	

	public function get_notif(){

		$server = "localhost";
		$user   = 'u9670307_user_ci_version';//u6978468_reiromnewuser
		$pass   = 'reirom12345@!';//wKx0?Qp~*EuV
		$db     = 'u9670307_ci_ver';//u6978468_reiromnew
			
		$id = $this->session->userdata('id');
		$con = mysqli_connect($server,$user,$pass,$db);
		$count=0;
		if(isset($_POST['view'])){
		// $con = mysqli_connect("localhost", "root", "", "notif");
		if($_POST["view"] != '')
		{
		   $update_query = "UPDATE diskusi_detail SET is_read = 1 WHERE is_read=0 and user_id=$id and deleted=0";
		   mysqli_query($con, $update_query);
		}
		$query = "SELECT * FROM diskusi_detail WHERE user_id=$id  and deleted=0 ORDER BY id_detail DESC LIMIT 5";
		$result = mysqli_query($con, $query);
		$output = '';
		if(mysqli_num_rows($result) > 0)
		{
		while($row = mysqli_fetch_array($result))
		{
		  $output .= '
		  <li>
		  <a href="'.base_url("products/detail/".$row['id_product']).'">
		  <small><em>You have notification</em></small>
		  <strong>'.$row["wording"].'</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />
		  </a>
		  </li>
		  ';
		}
		}
		else{
		    $output .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
		}
		$status_query = "SELECT * FROM diskusi_detail WHERE is_read=0 and deleted=0 and user_id=$id";
		$result_query = mysqli_query($con, $status_query);
		$count = mysqli_num_rows($result_query);
		$data = array(
		   'notification' => $output,
		   'unseen_notification'  => $count
		);
		echo json_encode($data);
		}
	}

	public function delete_diskusi(){

		$id_product = $this->input->post('id_product');
		$id_detail = $this->input->post('id_detail');
		
		

			$data = array (
						'deleted' => '1'
						);

			$this->db->where('id_detail',$id_detail);
			$this->db->update('diskusi_detail',$data);

			redirect('products/detail/'.$id_product);

	}

	public function delete_diskusi2(){

		$id_product = $this->input->post('id_product');
		$id = $this->input->post('id');
		
		

			$data = array (
						'deleted' => '1'
						);

			$this->db->where('id',$id);
			$this->db->update('diskusi',$data);

			redirect('products/detail/'.$id_product);

	}

	public function report_produk_sold()
	{
		$idk = $this->input->get('idk');
		if(is_numeric($idk) and $idk > 0 )
		{
			$data['product'] = $this->model_product->datafilter2($idk);
		} else {
			$data['product'] = $this->model_product->data2();
		}
		$this->load->view('report/report_produk_sold',$data);
	}

	public function report_produk_view()
	{
		$idk = $this->input->get('idk');
		if(is_numeric($idk) and $idk > 0 )
		{
			$data['product'] = $this->model_product->datafilter3($idk);
		} else {
			$data['product'] = $this->model_product->data3();
		}
		$this->load->view('report/report_produk_view',$data);
	}

	public function report_category_view()
	{
	
		$data['product'] = $this->model_product->data4();
		
		$this->load->view('report/report_category_view',$data);
	}


	public function report_member()
	{	
		$data['list_mail'] = $this->db->order_by('first_name','ASC')->from('member')->get()->result();
		$this->load->view('report/report_member',$data);
		
	}

	public function generate_report_member()
	{	
		$date_to = $this->input->post('date_to');
		$date_from = $this->input->post('date_from');
		$id_member = $this->input->post('user_id');
		//echo $date_to;die;

		$data['list'] = $this->db->where('user_id',$id_member)->where('DATE(tanggal) >=',$date_from)->where('DATE(tanggal) <=',$date_to)->from('log_user')->get()->result();
		$this->load->view('report/generate_report_member',$data);
		
	}

	public function detail_resi()
	{	
		$random_key = $this->input->post('field_track_key');

		$list = $this->db->from('transaction')->where('random_key',$random_key)->get()->row();

		//echo $date_to;die;

		$data["id"] = $list->id;
		$this->load->view('beranda/hasil_cek_resi',$data);
		
	}

	public function write_review($id,$random_key){

		$data["id"] = $id;
		$data["random_key"] = $random_key;
		$this->load->view('beranda/write_review',$data);
	}

	public function submit_rating(){

		$star=$this->input->post('whatever3');
		$random_key=$this->input->post('random_key');

		$comment=$this->input->post('comment');
		$id=$this->input->post('id');
		
		$data = array (
						'user_id' => $this->session->userdata('id'),
						'product_id' => $id,
						'star' => $star,
						'comment' => $comment,
						'tanggal' => date('Y-m-d H:i:s'),
						'status' =>1
						);
		$this->db->insert('review',$data);

		$trans = $this->db->where('random_key',$random_key)->from('transaction')->get()->row();

		$trans2 = $this->db->where('transaction_id',$trans->id)->where('product_id',$id)->from('transaction_detail')->get()->row();
		
		$datax = array (
						'rating' => 1
						);
		$this->db->where('id',$trans2->id);
		$this->db->update('transaction_detail',$datax);

		$val = $this->db->where('id',$this->session->userdata('id'))->from('member')->get()->row();

		$subject = "Notification for Rating and comment";
                $message = "Hallo ".$val->first_name."<br/> Thanks for giving us rating and comment <br/> <br/> If you unsure about this activity , please notify us right now.";

                $config = array(
			    'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
			    'smtp_host' => 'mail.reiromstore.com', 
			    'smtp_port' => 465,
			    'smtp_user' => '_mainaccount@reiromstore.com',
			    'smtp_pass' => 'reirom12345@!',
			    'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
			    'mailtype' => 'html', //plaintext 'text' mails or 'html'
			    'smtp_timeout' => '4', //in seconds
			    'charset' => 'iso-8859-1',
			    'wordwrap' => TRUE
			);
			$this->load->library('email');
			$this->email->initialize($config);

			$this->email->set_newline("\r\n");
	        $this->email->from('admin@reiromstore.com','Admin reirom indonesia');
	        $this->email->to($val->email);
	        $this->email->subject($subject);
	        $this->email->message($message);
	        $this->email->send();


		redirect('beranda/my_review');
	}
	
}
