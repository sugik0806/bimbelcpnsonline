<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public $data = [];

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->helper(['url', 'language', 'string', 'date']);
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->lang->load('auth');
		$this->load->model('Registrasi_model', 'regis');
		$this->load->model('Master_model', 'master');
	}

	public function output_json($data)
	{
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function index()
	{
		if ($this->ion_auth->logged_in()){
			$user_id = $this->ion_auth->user()->row()->id; // Get User ID
			$group = $this->ion_auth->get_users_groups($user_id)->row()->name; // Get user group
			redirect('dashboard');
		}
		$this->data['identity'] = [
			'name' => 'identity',
			'id' => 'identity',
			'type' => 'text',
			'placeholder' => 'Email',
			'autofocus'	=> 'autofocus',
			'class' => 'form-control',
			'autocomplete'=>'off'
		];
		$this->data['password'] = [
			'name' => 'password',
			'id' => 'password',
			'type' => 'password',
			'placeholder' => 'Password',
			'class' => 'form-control',
		];
		$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');



		$this->load->view('_templates/auth/_header.php');
		$this->load->view('auth/login', $this->data);
		$this->load->view('_templates/auth/_footer.php');
	}

	public function cek_login()
	{
		$this->form_validation->set_rules('identity', str_replace(':', '', $this->lang->line('login_identity_label')), 'required|trim');
		$this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required|trim');

		if ($this->form_validation->run() === TRUE)	{
			$remember = (bool)$this->input->post('remember');
			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)){
				$this->cek_akses();
			}else {
				$data = [
					'status' => false,
					'failed' => 'Incorrect Login',
				];
				$this->output_json($data);
			}
		}else{
			$invalid = [
				'identity' => form_error('identity'),
				'password' => form_error('password')
			];
			$data = [
				'status' 	=> false,
				'invalid' 	=> $invalid
			];
			$this->output_json($data);
		}
	}

	public function cek_akses()
	{
		if (!$this->ion_auth->logged_in()){
			$status = false; // jika false, berarti login gagal
			$url = 'auth'; // url untuk redirect
		}else{
			$status = true; // jika true maka login berhasil
			$url = 'dashboard';
		}

		$data = [
			'status' => $status,
			'url'	 => $url
		];
		$this->output_json($data);
	}

	public function logout()
	{
		$this->ion_auth->logout();
		redirect('login','refresh');
	}

	/**
	 * Forgot password
	 */
	public function forgot_password()
	{
		$this->data['title'] = $this->lang->line('forgot_password_heading');
		
		// setting validation rules by checking whether identity is username or email
		if ($this->config->item('identity', 'ion_auth') != 'email')
		{
			$this->form_validation->set_rules('identity', $this->lang->line('forgot_password_identity_label'), 'required');
		}
		else
		{
			$this->form_validation->set_rules('identity', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
		}


		if ($this->form_validation->run() === FALSE)
		{
			$this->data['type'] = $this->config->item('identity', 'ion_auth');
			// setup the input
			$this->data['identity'] = [
				'name' 	=> 'identity',
				'id'	=> 'identity',
				'class'	=> 'form-control',
				'autocomplete'	=> 'off',
				'autofocus'	=> 'autofocus'
			];

			if ($this->config->item('identity', 'ion_auth') != 'email')
			{
				$this->data['identity_label'] = $this->lang->line('forgot_password_identity_label');
			}
			else
			{
				$this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
			}

			// set any errors and display the form
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->load->view('_templates/auth/_header', $this->data);
			$this->load->view('auth/forgot_password');
			$this->load->view('_templates/auth/_footer');
		}
		else
		{
			$identity_column = $this->config->item('identity', 'ion_auth');
			$identity = $this->ion_auth->where($identity_column, $this->input->post('identity'))->users()->row();

			if (empty($identity))
			{

				if ($this->config->item('identity', 'ion_auth') != 'email')
				{
					$this->ion_auth->set_error('forgot_password_identity_not_found');
				}
				else
				{
					$this->ion_auth->set_error('forgot_password_email_not_found');
				}

				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("auth/forgot_password", 'refresh');
			}

			// run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

			if ($forgotten)
			{
				// if there were no errors
				$this->session->set_flashdata('success', $this->ion_auth->messages());
				redirect("auth/forgot_password", 'refresh'); //we should display a confirmation page here instead of the login page
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("auth/forgot_password", 'refresh');
			}
		}
	}

	/**
	 * Reset password - final step for forgotten password
	 *
	 * @param string|null $code The reset code
	 */
	public function reset_password($code = NULL)
	{
		if (!$code)
		{
			show_404();
		}

		$this->data['title'] = $this->lang->line('reset_password_heading');
		
		$user = $this->ion_auth->forgotten_password_check($code);

		if ($user)
		{
			// if the code is valid then display the password reset form

			$this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

			if ($this->form_validation->run() === FALSE)
			{
				// display the form

				// set the flash data error message if there is one
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
				$this->data['new_password'] = [
					'name' => 'new',
					'id' => 'new',
					'type' => 'password',
					'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
				];
				$this->data['new_password_confirm'] = [
					'name' => 'new_confirm',
					'id' => 'new_confirm',
					'type' => 'password',
					'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
				];
				$this->data['user_id'] = [
					'name' => 'user_id',
					'id' => 'user_id',
					'type' => 'hidden',
					'value' => $user->id,
				];
				$this->data['csrf'] = $this->_get_csrf_nonce();
				$this->data['code'] = $code;

				// render
				$this->load->view('_templates/auth/_header');
				$this->load->view('auth/reset_password', $this->data);
				$this->load->view('_templates/auth/_footer');
			}
			else
			{
				$identity = $user->{$this->config->item('identity', 'ion_auth')};

				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id'))
				{

					// something fishy might be up
					$this->ion_auth->clear_forgotten_password_code($identity);

					show_error($this->lang->line('error_csrf'));

				}
				else
				{
					// finally change the password
					$change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

					if ($change)
					{
						// if the password was successfully changed
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						redirect("auth/login", 'refresh');
					}
					else
					{
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect('auth/reset_password/' . $code, 'refresh');
					}
				}
			}
		}
		else
		{
			// if the code is invalid then send them back to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}

	/**
	 * Activate the user
	 *
	 * @param int         $id   The user ID
	 * @param string|bool $code The activation code
	 */
	public function activate($id, $code = FALSE)
	{
		$activation = FALSE;

		if ($code !== FALSE)
		{
			$activation = $this->ion_auth->activate($id, $code);
		}
		else if ($this->ion_auth->is_admin())
		{
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation)
		{
			// redirect them to the auth page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("auth", 'refresh');
		}
		else
		{
			// redirect them to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}

	/**
	 * @return array A CSRF key-value pair
	 */
	public function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return [$key => $value];
	}

	/**
	 * @return bool Whether the posted CSRF token matches
	 */
	public function _valid_csrf_nonce(){
		$csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
		if ($csrfkey && $csrfkey === $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
			return FALSE;
	}

	public function _render_page($view, $data = NULL, $returnhtml = FALSE)//I think this makes more sense
	{

		$viewdata = (empty($data)) ? $this->data : $data;

		$view_html = $this->load->view($view, $viewdata, $returnhtml);

		// This will return html on 3rd argument being true
		if ($returnhtml)
		{
			return $view_html;
		}
	}

	public function registrasi()
	{	
		$this->load->view('_templates/auth/_header.php');
		//$this->load->view('auth/registrasi.php');
		$this->load->view('auth/registrasi', $this->data);
		$this->load->view('_templates/auth/_footer.php');
	}

	public function cek_registrasi()
	{
		$this->form_validation->set_rules('name', 'jurusan', 'email', 'gender', 'whatsapp', 'required');

		$this->form_validation->set_rules('name', str_replace(':', '', $this->lang->line('login_identity_label')), 'required|trim');
		$this->form_validation->set_rules('jurusan', str_replace(':', '', $this->lang->line('login_identity_label')), 'required|trim');
		$this->form_validation->set_rules('email', str_replace(':', '', $this->lang->line('login_password_label')), 'required|trim');
		$this->form_validation->set_rules('gender', str_replace(':', '', $this->lang->line('login_password_label')), 'required|trim');
		$this->form_validation->set_rules('whatsapp', str_replace(':', '', $this->lang->line('login_password_label')), 'required|trim');

			$username = $this->input->post('name', true);
			$email = $this->input->post('email', true);

			//print_r($this->form_validation->run());
			if ($this->form_validation->run() === FALSE)
			{
				$data = [
					'status' => false,
					'msg'	 => 'Lengkapi Semua Isian Sesuai Format!'
				];
				$this->output_json($data);
				//redirect('auth/registrasi');
			}else{
				//print_r($this->regis->email_check_mahasiswa($email));
				if ($this->ion_auth->username_check($username)) {
					$data = [
						'status' => false,
						'msg'	 => 'Username tidak tersedia (sudah digunakan).'
					];
					$this->output_json($data);
				} else if ($this->regis->email_check_mahasiswa($email)) {
					$data = [
						'status' => false,
						'msg'	 => 'Email tidak tersedia (sudah digunakan).'
					];
					$this->output_json($data);
				} else {
					
					$token = strtoupper(random_string('alpha', 5));
					$data = [
						'nama' => $username,
						'nim' => $email,
						'email' => $email,
						'jenis_kelamin' => $this->input->post('gender', true),
						'kelas_id' => $this->input->post('jurusan', true),
						'id_matkul' => 2, //skd
						'whatsapp' => $this->input->post('whatsapp', true),
						'token' => $token,
						'angka_unik' => random_string('numeric',3),
						'tanggal_daftar' => date('Y-m-d')
			        ];

			        $this->regis->create('mahasiswa', $data);

			        //kirim email disini
			        
			        //$this->create_user($email); jika auto bikin user

			        	$data = [
		        				'status'	=> true,
		        				'token' => $token,
		        				'msg'	 => 'Registrasi Berhasil Silakan Transfer Dan Konfirmasi Pembayanan Anda Untuk Mendapatakan Username dan Password'
		        			];
		        		$this->output_json($data);
			        //$emailencr = urlencode($this->encryption->encrypt($email));
			        // http://localhost:81/bimbelcpnsonline/invoice/kirim_email/b63a61f2889d8a7898fcb5e57b3ec05eaecf02f846506220b182988fad6a43d361de0774830768338949777b8387dcc89f0701579d9c90140297e61c0b54442f%2BUl7Ltd5zAKzFMfuCJrptH6mE6fz1C8rgOZfiQmv%2FX3sxE3R9%2Fx17j1g1dYbXRkP/2


			        // http://localhost:81/bimbelcpnsonline/ujian/?key=a6d791be8738f3209ad807a845086bc68fce2f1c529e94043b40014cb56a3547dddd69f680d45fbff0b30c445ef92a0a76f8d15a6dabe62f0200a2da71e43328VvzdnLBpTRk1AGl8OcZ8QGSMnkkAtLP7TauXQWfNwpA%3D

			        //redirect('invoice/kirim_email/'. $this->input->post('whatsapp', true). '/' . $this->input->post('jurusan', true));

				}

				

			}
	}

	public function create_user($email)
	{
		//$id = $this->input->get('id', true);
		$datam = $this->master->getMahasiswaByEmail($email);
		$nama = explode(' ', $datam->nama);
		$first_name = $nama[0];
		$last_name = end($nama);
		$password = 123456;
		$username = $datam->nim;
		$email = $datam->email;
		$additional_data = [
			'first_name'	=> $first_name,
			'last_name'		=> $last_name
		];
		$group = array('3'); // Sets user to dosen.

		$this->ion_auth->register($username, $password, $email, $additional_data, $group);

			$data = [
				'status'	=> true,
				'msg'	 => 'User berhasil dibuat. 123456 digunakan sebagai password Standart pada saat login.'
			];

			//redirect('Kirim_email/kirim_email/'.$password.'/Password/Password'. $password);
		$this->output_json($data);
	}

}
