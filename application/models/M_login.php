<?php

class M_login extends CI_Model{

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function cek($username=NULL, $password)
    {
        $this->db->select('usr_id,usr_kode,usr_username,usr_firstname,usr_lastname,usr_password,usr_email,usr_picture,usr_gpa,usr_level,usr_jk,usr_tgllahir,usr_tmpasal,usr_kelas');
        $this->db->from('users');
        $this->db->where('usr_username', $username);
        // $this->db->where('usr_password', $password);
        // $this->db->limit(1);

        $query = $this->db->get();
        return $query;
    }

    public function insert()
    {

        $data['name_pengguna']= $this->input->post('name');
        $data['name_depan']= $this->input->post('name_depan');
        $data['name_belakang']= $this->input->post('name_belakang');
        $data['pass']= md5($this->input->post('pass'));
        $data['email']= ($this->input->post('email'));
        $data['level']= ($this->input->post('level'));
        $data['usr_tempasal'] = $this->input->post('tempatAsal');
        $data['usr_kelas'] = $this->input->post('kelas');
        $data['foto'] = "avatar_default.jpg";
        $data['jenis_kelamin'] = ($this->input->post('jenis_kelamin'));
        $data['tgl_lahir'] = ($this->input->post('tgl_lahir'));
        $insert = $this->db->query("INSERT INTO users (usr_username,usr_firstname,usr_lastname,usr_password,usr_email,usr_level,usr_picture,usr_jk,usr_tgllahir,usr_tmpasal,usr_kelas) VALUES ('".$data['name_pengguna']."' , '".$data['name_depan']."', '".$data['name_belakang']."', '".$data['pass']."', '".$data['email']."','".$data['level']."','".$data['foto']."',".$data['jenis_kelamin'].",'".$data['tgl_lahir']."','".$data['usr_tempasal']."','".$data['usr_kelas']."') ");
    
    }

    public function cekFirstLogin($usr_id){
        $this->db->select('cek');
        $this->db->from('first_login');
        $this->db->where('usr_id', $usr_id);
        return $this->db->get();
    }
}
