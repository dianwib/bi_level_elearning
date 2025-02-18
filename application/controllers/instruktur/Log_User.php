<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class Log_User extends CI_Controller {


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
        $data['sidebar'] = "layout/sidebar_instruktur";
        $data['content'] = "instruktur/log_user";
        $data['log_user'] = M_Log::leftJoin('users','users.usr_id','=','user_logs.usr_id')->get();
        $this->load->view(MASTER_TEMPLATE,$data);
    }
}

/* End of file Controllername.php */

