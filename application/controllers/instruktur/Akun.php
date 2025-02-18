
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class Akun extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('level')=="2") {
            redirect('siswa/dashboard');
        } else if ($this->session->userdata('level')=="1") {
            redirect('admin/dashboard');
        } else if ($this->session->userdata('level') == NULL) {
            redirect('');
        }
    }
    
    public function index()
    {
        
    }

    /* CRUD Course */
    public function manage_akun()
    {
        $data['sidebar'] = 'layout/sidebar_instruktur';
        $data['content'] = 'instruktur/akun_instruktur';
        $this->load->view(MASTER_TEMPLATE, $data);
    }
    public function manage_password()
    {
        $data['sidebar'] = 'layout/sidebar_instruktur';
        $data['content'] = 'instruktur/password';
        $this->load->view(MASTER_TEMPLATE, $data);
    }
    
    public function update_user()
    {
        $nmfoto = $this->input->post('username').time();
        $config['upload_path'] ='./res/assets/images/uploads';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['file_name'] = $nmfoto;
        $this->load->library('upload',$config);
        $this->upload->do_upload('upload_foto');
        
        $result= $this->upload->data();
        // dd($result['file_name']);

        $usr_id = $this->input->post('id');
        
        $userData['usr_kode'] = empty($this->input->post('kode')) ? NULL : $this->input->post('kode');
        $userData['usr_username'] = $this->input->post('username');
        $userData['usr_firstname'] = $this->input->post('nama_depan');
        $userData['usr_lastname'] = $this->input->post('nama_belakang');
//        $userData['usr_password'] = $this->input->post('password');
        $userData['usr_email'] = empty($this->input->post('email')) ? NULL : $this->input->post('email');
        if ($this->upload->do_upload('upload_foto'))
        {
            $userData['usr_picture'] = $result['file_name'];
        } else {
            $userData['usr_picture'] = $this->session->userdata('foto');
//            echo $this->upload->display_errors(); die();

        }
        
        // $userData['usr_gpa'] = empty($this->input->post('ipk')) ? NULL : $this->input->post('ipk');
        $userData['usr_jk'] = empty($this->input->post('jenis_kelamin')) ? NULL : $this->input->post('jenis_kelamin');
        // dd($userData['usr_picture']);
        $user= array(
            'kode' =>empty($this->input->post('kode')) ? NULL : $this->input->post('kode'),
            'username' =>$this->input->post('username'),
//            'password' =>$this->input->post('password'),
            'email' => empty($this->input->post('email')) ? NULL : $this->input->post('email'),
            'firstname' =>$this->input->post('nama_depan'),
            'lastname' =>$this->input->post('nama_belakang'),
            // 'gpa' =>empty($this->input->post('ipk')) ? NULL : $this->input->post('ipk'),
            'foto' =>$userData['usr_picture'],
//            'jk' =>empty($this->input->post('jenis_kelamin')) ? NULL : $this->input->post('jenis_kelamin'),
        );
        $this->session->set_userdata($user);
        $update = $this->M_User->update_user_akun($userData,$usr_id);
        if($update)
        {
            $this->session->set_flashdata('password_tersimpan', 'Data User Berhasil Terbarui');
        }else{
            $this->session->set_flashdata('data_gagal_tersimpan', 'Data User Tidak Berhasil Terbarui');
        }
        redirect('instruktur/dashboard');
    }
    public function password_instruktur()
    {
        $usr_id = $this->input->post('id');
//        dd($usr_id);

        $userData['current_password'] = $this->input->post('current_password');
        $userData['new_password'] = $this->input->post('new_password');
        $userData['repeat_password'] = $this->input->post('repeat_password');
        $userData['result'] = $this->session->userdata('password');
//        dd($userData['result']);
        $update = $this->M_User->update_password($userData,$usr_id);
//        dd($update);
//        $user= array(
//            'password' => $update
//        );
//        $this->session->set_userdata($user);
//        dd($update);

        if($update)
        {
            $user= array(
                'password' => md5($userData['new_password'])
            );
            $this->session->set_userdata($user);
//            dd($user['password']);
            $this->session->set_flashdata('password_tersimpan', 'Password Berhasil Terbarui');
            redirect('instruktur/dashboard');
        }
        else {
//            dd($userData['new_password']);
            $this->session->set_flashdata('password_gagal', 'Password Tidak Cocok atau Current Password Salah');
            redirect('instruktur/password');
//                dd($update);
        }

    }
}
