<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->model('Users_model');
		
		$data['title'] = "Páscoa do #SBL - Inscrições";
		$data['users'] = $this->Users_model->get_all();
		if($this->is_logged()){
			$id = $this->session->userdata('id');
			$data['acc_switch'] = 'account';
			$data['user_data'] = (array)$this->Users_model->get_user_data($id);
		}
		else $data['acc_switch'] = 'login';

		$this->load->helper('form');
		$this->load->view('main',$data);
	}

	public function save()
	{
		$id = $this->session->userdata('id');
		$this->load->library('form_validation');
		$this->load->library('input');

		$data = $this->input->post(NULL, true);
		if($data)
		{
			$this->form_validation->set_rules('name', 'Nome', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|email');
			$this->form_validation->set_rules('address', 'Endereço', 'required');
			$this->form_validation->set_rules('area', 'Bairro', 'required');
			$this->form_validation->set_rules('state', 'Estado', 'required');
			$this->form_validation->set_rules('zip', 'CEP', 'required');
			$this->form_validation->set_rules('city', 'Cidade', 'required');
			$this->form_validation->set_rules('number', 'Número', 'required|numeric');
			$this->form_validation->set_rules('phone', 'Telefone', 'numeric');
			$this->form_validation->set_rules('mobile', 'Celular', 'required|numeric');
			if(empty($id)) $this->form_validation->set_rules('pswd', 'Senha', 'required');

			$this->form_validation->set_error_delimiters('<div class="alert" style="margin-bottom: 2px; font-weight: 700;">', '</div>');
			$this->form_validation->set_message('required','O campo %s é obrigatório!');
			$this->form_validation->set_message('numeric','O campo %s deve ser numérico!');
			$this->form_validation->set_message('email','O campo %s deve ser um e-mal válido!');

			if ($this->form_validation->run())
			{
				$this->load->model('Users_model');
				$data['pswd'] = sha1($data['pswd']);
				$data['twitter'] = str_replace('@', '', $data['twitter']);

				//Se estiver logado somente atualiza os dados (passando a id necessária)
				if(!empty($id)){
					$data['id'] = $id;
					if($data['pswd'] == sha1('')) unset($data['pswd']);	//Caso o campo senha seja deixado em branco, não considerar seu conteúdo
					else $this->session->set_userdata(array('pswd'=>$data['pswd']));

					if($this->Users_model->save($data))
						echo '<div class="alert alert-success">Sucesso - Atualizado com sucesso!</div>';
					else
						echo '<div class="alert alert-error">Erro no banco de dados</div>';
				}
				//Caso não estiver logado o formulário será de adição de usuários e checa se o e-mail não é duplicado
				elseif($this->Users_model->chk_user($data['email']) == 0 && !$id)
				{
					$data['date'] = unix_to_human(time());
					if($this->Users_model->save($data))
						echo '<div class="alert alert-success">Sucesso - Adicionado ao sorteio!</div>';
					else
						echo '<div class="alert alert-error">Erro no banco de dados</div>';
				}
				else
					echo '<div class="alert alert-error">E-mail duplicado!</div>';
			}
			else
				echo validation_errors();	//Erros de validação nos campos enviados
		}
		else echo '<div class="alert">Nenhum dado enviado</div>';
		
	}

	public function login(){
		$this->load->library('input');
		$data = $this->input->post(NULL, true);
		if($data){
			$this->load->model('Users_model');
			$id = $this->Users_model->login($data['email'], sha1($data['pswd']));
			if(!empty($id))
			{
				$this->session->set_userdata(array('email'=>$data['email'], 'pswd'=>sha1($data['pswd']), 'id'=>$id));
				echo '<script>parent.window.location.reload(true);</script>';
				echo '<script>parent.window.location.reload(true);</script>';
				echo '<script>parent.window.location.reload(true);</script>';
			}
			else 
				echo '<div class="alert alert-error">Inscrição não existente</div>';
		}
		else echo '<div class="alert">Nenhum dado enviado</div>';
	}

	public function is_logged(){
		$email = $this->session->userdata('email');
		$pswd = $this->session->userdata('pswd');
		if($this->Users_model->login($email, $pswd))
			return true;
		else return false;
	}

	public function logout(){
		$this->load->helper('url');
		$this->session->sess_destroy();
		redirect('/');
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */