<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public $status;
    public $roles;

    function __construct(){
        parent::__construct();
        $this->load->model('User_model', 'user_model', TRUE);
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->status = $this->config->item('status');
        $this->roles = $this->config->item('roles');
        $this->load->library('userlevel');
        $this->load->library('email');

        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.gmail.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'soportetrazalog24@gmail.com';
        $config['smtp_pass']    = '123trazalog24';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'text'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not      
        
        $this->email->initialize($config);
        
    }
    public function setdir()
    {
        $this->session->set_userdata('direccion',$this->input->get('direccion'));
        $this->session->set_userdata('direccionsalida',$this->input->get('direccionsalida'));
        redirect('Main/index');
    }
    //index dasboard
		public function index()
		{
				//user data from session
					$data = $this->session->userdata;
					
				if(empty($data)){
						redirect(site_url().'main/login/');
				}

				//check user level
				if(empty($data['role'])){
						redirect(site_url().'main/login/');
				}
				$dataLevel = $this->userlevel->checkLevel($data['role']);
				//check user level

				$data['title'] = "Arbolado";
				
					if(empty($this->session->userdata['email'])){
							redirect(site_url().'main/login/');
					}else{
						/*  $this->load->view('header', $data);
							$this->load->view('navbar', $data);
							$this->load->view('container');
							$this->load->view('index', $data);
							$this->load->view('footer');*/
					
					
						//redirect($config['base_url']./.$this->session->userdata['direccion']);
						//redirect(HOST.$this->session->userdata['direccion']);
						redirect(HOST.'sema-desa-arbolado/web');


					}

		}
	
		public function checkLoginUser(){
				//user data from session
				$data = $this->session->userdata;
				if(empty($data)){
						redirect(site_url().'main/login/');
				}
				
				$this->load->library('user_agent');
				$browser = $this->agent->browser();
				$os = $this->agent->platform();
				$getip = $this->input->ip_address();
				
				$result = $this->user_model->getAllSettings();
				$stLe = $result->site_title;
				$tz = $result->timezone;
				
				$now = new DateTime();
				$now->setTimezone(new DateTimezone($tz));
				$dTod =  $now->format('Y-m-d');
				$dTim =  $now->format('H:i:s');
				
				$this->load->helper('cookie');
				$keyid = rand(1,9000);
				$scSh = sha1($keyid);
				$neMSC = md5($data['email']);
				$setLogin = array(
						'name'   => $neMSC,
						'value'  => $scSh,
						'expire' => strtotime("+2 year"),
				);
				$getAccess = get_cookie($neMSC);
				
				if(!$getAccess && $setLogin["name"] == $neMSC){
						$config = array(
								'protocol'  => 'smtp',
								'smtp_host' => 'ssl://smtp.gmail.com',
								'smtp_port' => 	465,
								'smtp_user' => 'soportetrazalog24@gmail.com',
								'smtp_pass' => '123trazalog24',
								'smtp_timeout' => 90,
								'newline'      => "\r\n",
								'crlf'         => "\r\n",
								'mailtype'     => 'html',
								'charset'      => 'utf-8'
						);
						$this->load->library('email',$config);
						$this->load->library('sendmail');
						$bUrl = base_url();
						$message = $this->sendmail->secureMail($data['first_name'],$data['last_name'],$data['email'],$dTod,$dTim,$stLe,$browser,$os,$getip,$bUrl);
						$to_email = $data['email'];
						$this->email->from($this->config->item('register'), 'New sign-in! from '.$browser.'');
						$this->email->to($to_email);
						$this->email->subject('New sign-in! from '.$browser.'');
						$this->email->message($message);
						$this->email->set_mailtype("html");
						$this->email->send();
						
						$this->input->set_cookie($setLogin, TRUE);
						redirect(site_url().'main/');
				}else{
						$this->input->set_cookie($setLogin, TRUE);
						redirect(site_url().'main/');
				}
		}
	
		public function settings(){
				$data = $this->session->userdata;
					if(empty($data['role'])){
						redirect(site_url().'main/login/');
				}
				$dataLevel = $this->userlevel->checkLevel($data['role']);
				//check user level

					$data['title'] = "Configuracion";
					$this->form_validation->set_rules('site_title', 'Site Title', 'required');
					$this->form_validation->set_rules('timezone', 'Timezone', 'required');
					$this->form_validation->set_rules('recaptcha', 'Recaptcha', 'required');
					$this->form_validation->set_rules('theme', 'Theme', 'required');

					$result = $this->user_model->getAllSettings();
					$data['id'] = $result->id;
				$data['site_title'] = $result->site_title;
				$data['timezone'] = $result->timezone;
				$data['theme'] = $result->theme;
				if (!empty($data['timezone']))
				{
						$data['timezonevalue'] = $result->timezone;
						$data['timezone'] = $result->timezone;
				}
				else
				{
						$data['timezonevalue'] = "";
							$data['timezone'] = "Select a time zone";
				}
				
				if($dataLevel == "is_admin"){
							if ($this->form_validation->run() == FALSE) {
									$this->load->view('header', $data);
									$this->load->view('navbar', $data);
									$this->load->view('container');
									$this->load->view('settings', $data);
									$this->load->view('footer');
							}else{
									$post = $this->input->post(NULL, TRUE);
									$cleanPost = $this->security->xss_clean($post);
									$cleanPost['id'] = $this->input->post('id');
									$cleanPost['site_title'] = $this->input->post('site_title');
									$cleanPost['timezone'] = $this->input->post('timezone');
									$cleanPost['recaptcha'] = $this->input->post('recaptcha');
									$cleanPost['theme'] = $this->input->post('theme');
			
									if(!$this->user_model->settings($cleanPost)){
											$this->session->set_flashdata('flash_message', 'Hubo un problema actualizando los datos');
									}else{
											$this->session->set_flashdata('success_message', 'Los datos se actualizaron correctamente');
									}
									redirect(site_url().'main/settings/');
							}
				}

		}
    
    	//user list
		public function users()
		{
				$data = $this->session->userdata;
				$data['title'] = "Lista de usuarios";
				$data['groups'] = $this->user_model->getUserData();

				//check user level
				if(empty($data['role'])){
						redirect(site_url().'main/login/');
				}
				$dataLevel = $this->userlevel->checkLevel($data['role']);
				//check user level

				//check is admin or not
				if($dataLevel == "is_admin"){
							$this->load->view('header', $data);
							$this->load->view('navbar', $data);
							$this->load->view('container');
							$this->load->view('user', $data);
							$this->load->view('footer');
				}else{
						redirect(site_url().'main/');
				}
		}

    	//change level user
		public function changelevel()
		{
					$data = $this->session->userdata;
					//check user level
				if(empty($data['role'])){
						redirect(site_url().'main/login/');
				}
				$dataLevel = $this->userlevel->checkLevel($data['role']);
				//check user level

				$data['title'] = "Cambiar Roles";
				$data['groups'] = $this->user_model->getUserData();

				//check is admin or not
				if($dataLevel == "is_admin"){

							$this->form_validation->set_rules('email', 'Your Email', 'required');
							$this->form_validation->set_rules('level', 'User Level', 'required');

							if ($this->form_validation->run() == FALSE) {
									$this->load->view('header', $data);
									$this->load->view('navbar', $data);
									$this->load->view('container');
									$this->load->view('changelevel', $data);
									$this->load->view('footer');
							}else{
									$cleanPost['email'] = $this->input->post('email');
									$cleanPost['level'] = $this->input->post('level');
									if(!$this->user_model->updateUserLevel($cleanPost)){
											$this->session->set_flashdata('flash_message', 'Hubo un problema Actualizando los datos');
									}else{
											$this->session->set_flashdata('success_message', 'Los datos se actualizaron correctamente');
									}
									redirect(site_url().'main/changelevel');
							}
				}else{
						redirect(site_url().'main/');
				}
		}
    
    	//ban or unban user
		public function banuser() 
		{
					$data = $this->session->userdata;
					//check user level
				if(empty($data['role'])){
						redirect(site_url().'main/login/');
				}
				$dataLevel = $this->userlevel->checkLevel($data['role']);
				//check user level

				$data['title'] = "Prohibir Usuario";
				$data['groups'] = $this->user_model->getUserData();

				//check is admin or not
				if($dataLevel == "is_admin"){

							$this->form_validation->set_rules('email', 'Your Email', 'required');
							$this->form_validation->set_rules('banuser', 'Ban or Unban', 'required');

							if ($this->form_validation->run() == FALSE) {
									$this->load->view('header', $data);
									$this->load->view('navbar', $data);
									$this->load->view('container');
									$this->load->view('banuser', $data);
									$this->load->view('footer');
							}else{
									$post = $this->input->post(NULL, TRUE);
									$cleanPost = $this->security->xss_clean($post);
									$cleanPost['email'] = $this->input->post('email');
									$cleanPost['banuser'] = $this->input->post('banuser');
									if(!$this->user_model->updateUserban($cleanPost)){
											$this->session->set_flashdata('flash_message', 'Hubo un problema actualizando los datos');
									}else{
											$this->session->set_flashdata('success_message', 'El estado del usuario se ha actualizado corectamente');
									}
									redirect(site_url().'main/banuser');
							}
				}else{
						redirect(site_url().'main/');
				}
		}

    //edit user
		public function changeuser()
    {
        $data = $this->session->userdata;
        if(empty($data['role'])){
	        redirect(site_url().'main/login/');
	    }

        $dataInfo = array(
            'firstName'=> $data['first_name'],
            'id'=>$data['id'],
        );

        $data['title'] = "Modificar Perfil";
        $this->form_validation->set_rules('firstname', 'First Name', 'required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');

        $data['groups'] = $this->user_model->getUserInfo($dataInfo['id']);

        if ($this->form_validation->run() == FALSE) {
           $data['control']= $this->input->get('control');
            $this->load->view('header', $data);
            $this->load->view('navbar', $data);
            $this->load->view('container');
            $this->load->view('changeuser', $data);
            $this->load->view('footer');
        }else{
            $this->load->library('password');
            $post = $this->input->post(NULL, TRUE);
            $cleanPost = $this->security->xss_clean($post);
            $hashed = $this->password->create_hash($cleanPost['password']);
            $cleanPost['password'] = $hashed;
            $cleanPost['user_id'] = $dataInfo['id'];
            $cleanPost['email'] = $this->input->post('email');
            $cleanPost['firstname'] = $this->input->post('firstname');
            $cleanPost['lastname'] = $this->input->post('lastname');
            unset($cleanPost['passconf']);
            if(!$this->user_model->updateProfile($cleanPost)){
                $this->session->set_flashdata('flash_message', 'Hubo un problema actualizando su perfil');
            }else{
                $this->session->set_flashdata('success_message', 'Su perfil se actualizo correctamente');
            }
            redirect(site_url().'main/');
        }
    }

    //open profile and gravatar user
    public function profile()
    {
        $data = $this->session->userdata;
        if(empty($data['role'])){
	        redirect(site_url().'main/login/');
	    }

        $data['title'] = "Perfil";
        $this->load->view('header', $data);
        $this->load->view('navbar', $data);
        $this->load->view('container');
        $this->load->view('profile', $data);
        $this->load->view('footer');

    }

    //delete user  
		public function deleteuser($mail) {	

			$data = $this->session->userdata;
			if(empty($data['role'])){
				redirect(site_url().'main/login/');
			}

			log_message('DEBUG', 'Dnato/Main/deleteuser($mail)-> ' . $mail);

			//check user level
	    $dataLevel = $this->userlevel->checkLevel($data['role']);

	    //check is admin or not
	    if($dataLevel == "is_admin"){

				$responseDnato = $this->user_model->deleteUser($mail);
				if( !$responseDnato ){
						
						$this->session->set_flashdata('flash_message', 'Error, No puede eliminar ese Usuario');
						log_message('DEBUG', 'NO elimino Usr en Dnato-> ' . $mail);
				}else{
						$responseLocal = $this->user_model->deleteUserLocal($mail);
						if( $responseLocal ){
							
								$this->session->set_flashdata('flash_message', 'Error, No puede eliminar ese Usuario');
								log_message('DEBUG', 'NO elimino Usr en BD arbolado-> ' . $mail);
						}else{

								$responseWSO2 = $this->user_model->deleteUserWSO2($mail);
								if ( $responseWSO2 ) {

										$this->session->set_flashdata('success_message', 'Usuario Eliminado correctamente');

								} else {									
									  log_message('DEBUG', 'NO elimino Usr en BD WSO2-> ' . $mail);
										$this->session->set_flashdata('flash_message', 'Error, No puede eliminar ese Usuario');
								}								
						}
				}

    		redirect(site_url().'main/users/');
	    }else{
		    redirect(site_url().'main/');
	    }
    }

    //add new user from backend
    public function adduser()
    {
			$data = $this->session->userdata;
			if(empty($data['role'])){
				redirect(site_url().'main/login/');
	    }

        //check user level
	    if(empty($data['role'])){
	        redirect(site_url().'main/login/');
	    }
	    $dataLevel = $this->userlevel->checkLevel($data['role']);
	    //check user level

	    //check is admin or not
	    if($dataLevel == "is_admin"){
            $this->form_validation->set_rules('firstname', 'First Name', 'required');
            $this->form_validation->set_rules('lastname', 'Last Name', 'required');
            //$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('role', 'role', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');

            $data['title'] = "Agregar Usuario";
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('header', $data);
                $this->load->view('navbar');
                $this->load->view('container');
                $this->load->view('adduser', $data);
                $this->load->view('footer');
            }else{
                if($this->user_model->isDuplicate($this->input->post('email'))){
                    $this->session->set_flashdata('flash_message', 'Usuario ya existe');
                    redirect(site_url().'main/adduser');
                }else{
                    $this->load->library('password');
                    $post = $this->input->post(NULL, TRUE);
                    $cleanPost = $this->security->xss_clean($post);
                    $hashed = $this->password->create_hash($cleanPost['password']);
                    $cleanPost['email'] = $this->input->post('email');
                    $cleanPost['role'] = $this->input->post('role');
                    $cleanPost['firstname'] = $this->input->post('firstname');
                    $cleanPost['lastname'] = $this->input->post('lastname');
										$cleanPost['banned_users'] = 'unban';
										// resguardo la password y encodeo en md5                 
                    $cleanPost['password_orig'] = md5( $cleanPost['password'] );
                    $cleanPost['password'] = $hashed;
                    unset($cleanPost['passconf']);
										// inserto en DB WSO2
										$this->user_model->addUserWSO2($cleanPost);
										// llamar al servicio post de perfil customizado no lleva foto
										$restResponse = $this->user_model->addUserLocal($cleanPost);	
                    //insert to database
                    if(!$this->user_model->addUser($cleanPost)){
                        $this->session->set_flashdata('flash_message', 'Hubo un problema agregando el usuario');
                    }else{
										     $this->session->set_flashdata('success_message', 'Usuario agregado correctamente');
                    }
                    redirect(site_url().'main/users/');
                };
            }
	    }else{
	        redirect(site_url().'main/');
	    }
    }

    //register new user from frontend
    public function register()
    {
        $data['title'] = "Registrarse";
        $this->load->library('curl');
        $this->load->library('recaptcha');
        $this->form_validation->set_rules('firstname', 'First Name', 'required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        
        $result = $this->user_model->getAllSettings();
        $sTl = $result->site_title;
        $data['recaptcha'] = $result->recaptcha;

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('header', $data);
            $this->load->view('container');
            $this->load->view('register');
            $this->load->view('footer');
        }else{
            if($this->user_model->isDuplicate($this->input->post('email'))){
                $this->session->set_flashdata('flash_message', 'Mail de usuario ya existente');
                redirect(site_url().'main/register');
            }else{
                $post = $this->input->post(NULL, TRUE);
                $clean = $this->security->xss_clean($post);

                if($data['recaptcha'] == 'yes'){
                    //recaptcha
                    $recaptchaResponse = $this->input->post('g-recaptcha-response');
                    $userIp = $_SERVER['REMOTE_ADDR'];
                    $key = $this->recaptcha->secret;
                    $url = "https://www.google.com/recaptcha/api/siteverify?secret=".$key."&response=".$recaptchaResponse."&remoteip=".$userIp; //link
                    $response = $this->curl->simple_get($url);
                    $status= json_decode($response, true);
    
                    //recaptcha check
                    if($status['success']){
                        //insert to database
                        $id = $this->user_model->insertUser($clean);
                        $token = $this->user_model->insertToken($id);
    
                        //generate token
                        $qstring = $this->base64url_encode($token);
                        $url = site_url() . 'main/complete/token/' . $qstring;
                        $link = '<a href="' . $url . '">' . $url . '</a>';
    
                        $config = array(
                            'protocol'  => 'smtp',
                            'smtp_host' => 'ssl://smtp.gmail.com',
                            'smtp_port' => 	465,
                            'smtp_user' => 'soportetrazalog24@gmail.com',
                            'smtp_pass' => '123trazalog24',
                            'smtp_timeout' => 90,
                            'newline'      => "\r\n",
                            'crlf'         => "\r\n",
                            'mailtype'     => 'html',
                            'charset'      => 'utf-8'
                        );
                        $this->load->library('email',$config);
                        $this->load->library('sendmail');
                        
                        $message = $this->sendmail->sendRegister($this->input->post('lastname'),$this->input->post('email'),$link, $sTl);
                        $to_email = $this->input->post('email');
                        $this->email->from($this->config->item('register'), 'Set Password ' . $this->input->post('firstname') .' '. $this->input->post('lastname')); //from sender, title email
                        $this->email->to($to_email);
                        $this->email->subject('Set Password Login');
                        $this->email->message($message);
                        $this->email->set_mailtype("html");
    
                        //Sending mail
                        if($this->email->send()){
                            redirect(site_url().'main/successregister/');
                        }else{
                            $this->session->set_flashdata('flash_message', 'Hubo un problema enviando el Mail');
                            exit;
                        }
                    }else{
                        //recaptcha failed
                        $this->session->set_flashdata('flash_message', 'Error...! Google Recaptcha UnSuccessful!');
                        redirect(site_url().'main/register/');
                        exit;
                    }
                }else{
                    //insert to database
                    $id = $this->user_model->insertUser($clean);
										$token = $this->user_model->insertToken($id);	
                    //generate token
                    $qstring = $this->base64url_encode($token);
                    $url = site_url() . 'main/complete/token/' . $qstring;
                    $link = '<a href="' . $url . '">' . $url . '</a>';
    
                    $config = array(
                        'protocol'  => 'smtp',
                        'smtp_host' => 'ssl://smtp.gmail.com',
                        'smtp_port' => 	465,
                        'smtp_user' => 'soportetrazalog24@gmail.com',
                        'smtp_pass' => '123trazalog24',
                        'smtp_timeout' => 90,
                        'newline'      => "\r\n",
                        'crlf'         => "\r\n",
                        'mailtype'     => 'html',
                        'charset'      => 'utf-8'
                    );
                    $this->load->library('email',$config);
                    $this->load->library('sendmail');
                    
                    $message = $this->sendmail->sendRegister($this->input->post('lastname'),$this->input->post('email'),$link,$sTl);
                    $to_email = $this->input->post('email');
                    $this->email->from($this->config->item('register'), 'Set Password ' . $this->input->post('firstname') .' '. $this->input->post('lastname')); //from sender, title email
                    $this->email->to($to_email);
                    $this->email->subject('Set Password Login');
                    $this->email->message($message);
                    $this->email->set_mailtype("html");
    
                    //Sending mail
                    if($this->email->send()){
                        redirect(site_url().'main/successregister/');
                    }else{
                        $this->session->set_flashdata('flash_message', 'Hubo un problema enviando el Mail');
                        exit;
                    }
                }
            };
        }
    }

    //if success new user register
    public function successregister()
    {
        $data['title'] = "Registro Exitoso";
        $this->load->view('header', $data);
        $this->load->view('container');
        $this->load->view('register-info');
        $this->load->view('footer');
    }

    //if success after set password
    public function successresetpassword()
    {
        $data['title'] = "Cambio contraseña exitoso";
        $this->load->view('header', $data);
        $this->load->view('container');
        $this->load->view('reset-pass-info');
        $this->load->view('footer');
    }

    protected function _islocal(){
        return strpos($_SERVER['HTTP_HOST'], 'local');
    }

    //check if complate after add new user
    public function complete()
    {
        $token = base64_decode($this->uri->segment(4));
        $cleanToken = $this->security->xss_clean($token);

        $user_info = $this->user_model->isTokenValid($cleanToken); //either false or array();

        if(!$user_info){
            $this->session->set_flashdata('flash_message', 'Token invalido o expirado');
            redirect(site_url().'main/login');
        }
        $data = array(
            'firstName'=> $user_info->first_name,
            'email'=>$user_info->email,
            'user_id'=>$user_info->id,
            'token'=>$this->base64url_encode($token)
        );

        $data['title'] = "Contraseña";

        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('header', $data);
            $this->load->view('container');
            $this->load->view('complete', $data);
            $this->load->view('footer');
        }else{
            $this->load->library('password');
            $post = $this->input->post(NULL, TRUE);

            $cleanPost = $this->security->xss_clean($post);

            $hashed = $this->password->create_hash($cleanPost['password']);
            $cleanPost['password'] = $hashed;
            unset($cleanPost['passconf']);
            $userInfo = $this->user_model->updateUserInfo($cleanPost);

            if(!$userInfo){
                $this->session->set_flashdata('flash_message', 'Hubo un problema actualizando los datos');
                redirect(site_url().'main/login');
            }

            unset($userInfo->password);

            foreach($userInfo as $key=>$val){
                if($key !== '__ci_last_regenerate')
                {
                $this->session->set_userdata($key, $val);
                }
            }
            redirect(site_url().'main/');

        }
    }

    //check login failed or success
    public function login()
    {
			$data = $this->session->userdata;
			if(!empty($data['email'])){
	        redirect(site_url().'main/');
	    }else{
	        	$this->load->library('curl');
            $this->load->library('recaptcha');
            //$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');
            
            $data['title'] = "Bienvenido!";
            
            $result = $this->user_model->getAllSettings();
            $data['recaptcha'] = $result->recaptcha;

            if($this->form_validation->run() == FALSE) {
                $this->load->view('header', $data);
                $this->load->view('container');
                $this->load->view('login');
                $this->load->view('footer');
            }else{
                $post = $this->input->post();
                $clean = $this->security->xss_clean($post);
                $userInfo = $this->user_model->checkLogin($clean);
                
                if($data['recaptcha'] == 'yes'){
                    //recaptcha
                    $recaptchaResponse = $this->input->post('g-recaptcha-response');
                    $userIp = $_SERVER['REMOTE_ADDR'];
                    $key = $this->recaptcha->secret;
                    $url = "https://www.google.com/recaptcha/api/siteverify?secret=".$key."&response=".$recaptchaResponse."&remoteip=".$userIp; //link
                    //$url = 'https://www.google.com/recaptcha/api/siteverify?secret="6Lca0qAUAAAAAA7Z_LwW7WC-1wxe2JIUlSDD19xT"&response='.$recaptchaResponse.'&remoteip='.$userIp; //link
                    $response = $this->curl->simple_get($url);
                    $status= json_decode($response, true);
    
                    if(!$userInfo)
                    {
                        $this->session->set_flashdata('flash_message', 'Email o Contraseña incorrectos');
                        redirect(site_url().'main/login');
                    }
                    elseif($userInfo->banned_users == "ban")
                    {
                        $this->session->set_flashdata('danger_message', 'Temporalmente el sitio no esta disponible para usted');
                        redirect(site_url().'main/login');
                    }
                    else if(!$status['success'])
                    {
                        //recaptcha failed
                        $this->session->set_flashdata('flash_message', 'Error...! Google Recaptcha UnSuccessful!');
                        redirect(site_url().'main/login/');
                        exit;
                    }
                    elseif($status['success'] && $userInfo && $userInfo->banned_users == "unban") //recaptcha check, success login, ban or unban
                    {
                        foreach($userInfo as $key=>$val){
                            if($key !== '__ci_last_regenerate')
                            {
                        $this->session->set_userdata($key, $val);
                            }
                        }
                        redirect(site_url().'main/checkLoginUser/');
                    }
                    else
                    {
                        $this->session->set_flashdata('flash_message', 'Something Error!');
                        redirect(site_url().'main/login/');
                        exit;
                    }
                }else{
                    if(!$userInfo)
                    {
                        $this->session->set_flashdata('flash_message', 'Email o Contraseña incorrectos.');
                        redirect(site_url().'main/login');
                    }
                    elseif($userInfo->banned_users == "ban")
                    {
                        $this->session->set_flashdata('danger_message', 'Temporalmente el sitio no esta disponible para usted');
                        redirect(site_url().'main/login');
                    }
                    elseif($userInfo && $userInfo->banned_users == "unban") //recaptcha check, success login, ban or unban
                    {
                        foreach($userInfo as $key=>$val){
                            if($key !== '__ci_last_regenerate')
                            {
                        			$this->session->set_userdata($key, $val);
                            }
                        }
                        redirect(site_url().'main/checkLoginUser/');
                    }
                    else
                    {
                        $this->session->set_flashdata('flash_message', 'Something Error!');
                        redirect(site_url().'main/login/');
                        exit;
                    }
                }
            }
	    }
    }

    //Logout
    public function logout()
    {
        $dir = $this->session->userdata['direccionsalida'];
        $this->session->sess_destroy();
       // redirect(site_url().'main/login');
        //redirect($config['base_url'].'/'.$dir);
        redirect(HOST.$dir);
    }

    //forgot password
    public function forgot()
    {
        $data['title'] = "Olvide Contraseña";
        $this->load->library('curl');
        $this->load->library('recaptcha');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        
        $result = $this->user_model->getAllSettings();
        $sTl = $result->site_title;
        $data['recaptcha'] = $result->recaptcha;

        if($this->form_validation->run() == FALSE) {
            $this->load->view('header', $data);
            $this->load->view('container');
            $this->load->view('forgot');
            $this->load->view('footer');
        }else{
            $email = $this->input->post('email');
            $clean = $this->security->xss_clean($email);
            $userInfo = $this->user_model->getUserInfoByEmail($clean);

            if(!$userInfo){
                $this->session->set_flashdata('flash_message', 'No hemos encontrado tu Mail');
                redirect(site_url().'main/login');
            }

            if($userInfo->status != $this->status[1]){ //if status is not approved
                $this->session->set_flashdata('flash_message', 'Tu cuenta aun no ha sido Aprobada');
                redirect(site_url().'main/login');
            }

            if($data['recaptcha'] == 'yes'){
                //recaptcha
                $recaptchaResponse = $this->input->post('g-recaptcha-response');
                $userIp = $_SERVER['REMOTE_ADDR'];
                $key = $this->recaptcha->secret;
                $url = "https://www.google.com/recaptcha/api/siteverify?secret=".$key."&response=".$recaptchaResponse."&remoteip=".$userIp; //link
                $response = $this->curl->simple_get($url);
                $status= json_decode($response, true);
    
                //recaptcha check
                if($status['success']){
    
                    //generate token
                    $token = $this->user_model->insertToken($userInfo->id);
                    $qstring = $this->base64url_encode($token);
                    $url = site_url() . 'main/reset_password/token/' . $qstring;
                    $link = '<a href="' . $url . '">' . $url . '</a>';
    
                    $config = array(
                        'protocol'  => 'smtp',
                        'smtp_host' => 'ssl://smtp.gmail.com',
                        'smtp_port' => 	465,
                        'smtp_user' => 'soportetrazalog24@gmail.com',
                        'smtp_pass' => '123trazalog24',
                        'smtp_timeout' => 90,
                        'newline'      => "\r\n",
                        'crlf'         => "\r\n",
                        'mailtype'     => 'html',
                        'charset'      => 'utf-8'
                    );
                    $this->load->library('email',$config);
                    $this->load->library('sendmail');
                    
                    $message = $this->sendmail->sendForgot($this->input->post('lastname'),$this->input->post('email'),$link,$sTl);
                    $to_email = $this->input->post('email');
                    $this->email->from($this->config->item('forgot'), 'Reset Password! ' . $this->input->post('firstname') .' '. $this->input->post('lastname')); //from sender, title email
                    $this->email->to($to_email);
                    $this->email->subject('Reset Password');
                    $this->email->message($message);
                    $this->email->set_mailtype("html");
    
                    if($this->email->send()){
                        redirect(site_url().'main/successresetpassword/');
                    }else{
                        $this->session->set_flashdata('flash_message', 'Hubo un problema enviando el Email');
                        exit;
                    }
                }else{
                    //recaptcha failed
                    $this->session->set_flashdata('flash_message', 'Error...! Google Recaptcha UnSuccessful!');
                    redirect(site_url().'main/register/');
                    exit;
                }
            }else{
                //generate token
                $token = $this->user_model->insertToken($userInfo->id);
                $qstring = $this->base64url_encode($token);
                $url = site_url() . 'main/reset_password/token/' . $qstring;
                $link = '<a href="' . $url . '">' . $url . '</a>';

                $config = array(
                    'protocol'  => 'smtp',
                    'smtp_host' => 'ssl://smtp.gmail.com',
                    'smtp_port' => 	465,
                    'smtp_user' => 'soportetrazalog24@gmail.com',
                    'smtp_pass' => '123trazalog24',
                    'smtp_timeout' => 90,
                    'newline'      => "\r\n",
                    'crlf'         => "\r\n",
                    'mailtype'     => 'html',
                    'charset'      => 'utf-8'
                );
                $this->load->library('email',$config);
                $this->load->library('sendmail');
                
                $message = $this->sendmail->sendForgot($this->input->post('lastname'),$this->input->post('email'),$link,$sTl);
                $to_email = $this->input->post('email');
                $this->email->from($this->config->item('forgot'), 'Reset Password! ' . $this->input->post('firstname') .' '. $this->input->post('lastname')); //from sender, title email
                $this->email->to($to_email);
                $this->email->subject('Reset Password');
                $this->email->message($message);
                $this->email->set_mailtype("html");

                if($this->email->send()){
                    redirect(site_url().'main/successresetpassword/');
                }else{
                    $this->session->set_flashdata('flash_message', 'Hubo un problema enviando el email');
                    exit;
                }
            }
            
        }

    }

    //reset password
    public function reset_password()
    {
        $token = $this->base64url_decode($this->uri->segment(4));
        $cleanToken = $this->security->xss_clean($token);
        $user_info = $this->user_model->isTokenValid($cleanToken); //either false or array();

        if(!$user_info){
            $this->session->set_flashdata('flash_message', 'Token Invalido o expirado');
            redirect(site_url().'main/login');
        }
        $data = array(
            'firstName'=> $user_info->first_name,
            'email'=>$user_info->email,
            //'user_id'=>$user_info->id,
            'token'=>$this->base64url_encode($token)
        );

        $data['title'] = "Reestablecer Contraseña";
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('header', $data);
            $this->load->view('container');
            $this->load->view('reset_password', $data);
            $this->load->view('footer');
        }else{
            $this->load->library('password');
            $post = $this->input->post(NULL, TRUE);
            $cleanPost = $this->security->xss_clean($post);
            $hashed = $this->password->create_hash($cleanPost['password']);
            $cleanPost['password'] = $hashed;
            $cleanPost['user_id'] = $user_info->id;
            unset($cleanPost['passconf']);
            if(!$this->user_model->updatePassword($cleanPost)){
                $this->session->set_flashdata('flash_message', 'Hubo un problema actualizando tu contraseña');
            }else{
                $this->session->set_flashdata('success_message', 'Tu contraseña ha sido actualizada correctamente');
            }
            redirect(site_url().'main/checkLoginUser');
        }
    }

    public function base64url_encode($data) {
      return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    public function base64url_decode($data) {
      return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }
}
