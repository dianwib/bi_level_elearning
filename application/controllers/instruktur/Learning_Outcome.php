<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Learning_Outcome extends CI_Controller {


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
        $data['dataLO'] = M_Course_Learning_Outcomes::get();
        $data['sidebar'] = 'layout/sidebar_instruktur';
        $data['content'] = 'instruktur/learning_outcome';
        $this->load->view(MASTER_TEMPLATE,$data);
    }

    public function add_lo()
    {
        $data['data_course']= M_Course::get(['crs_name','crs_id']);
//        dd($data['data_course']);
        $data['sidebar'] = 'layout/sidebar_instruktur';
        $data['content'] = 'instruktur/add_LO';
        $this->load->view(MASTER_TEMPLATE, $data);


    }

    public function insert_lo()
    {
        $data['loc_desc'] = $this->input->post('loc_desc');
        $data['crs_id'] = $this->input->post('crs_id');
        // dd($data['loc_desc']);
        $insert= $this->M_Course_Learning_Outcomes->insert_lo_single($data);
//         dd($insert);
        if($insert)
        {
            $this->session->set_flashdata('data_lo', 'Data Learning Outcome Berhasil Tersimpan');
        }else{
            $this->session->set_flashdata('data_gagal_lo', 'Data learning Outcome Tidak Berhasil Tersimpan');
        }
        
        redirect('instruktur/add_lo');
    
    }
    public function edit_lo($id)
    {
        $data['data_course']= M_Course::get();
        $data['dataLO'] = M_Course_Learning_Outcomes::where('loc_id',$id)->first();
//        dd( $data['dataLO']->crs_id);
        $data['course_Lo'] =M_Course::where('crs_id',$data['dataLO']->crs_id)->first(['crs_name']);
//        dd( $data['course_Lo']);
        $data['sidebar'] = 'layout/sidebar_instruktur';
        $data['content'] = 'instruktur/edit_LO';
        $this->load->view(MASTER_TEMPLATE, $data);
    }

    public function update_lo()
    {
        $data['id'] = $this->input->post('id');
        $data['loc_desc'] = $this->input->post('loc_desc');
        $data['crs_id'] = $this->input->post('crs_id');
        $update = $this->M_Course_Learning_Outcomes->update_lo($data);
        if($update)
        {
            $this->session->set_flashdata('aksi_lo', 'Data Learning Outcome Berhasil Diupdate');
        }else{
            $this->session->set_flashdata('data_gagal_aksi_lo', 'Data learning Outcome Tidak Berhasil Terupdate');
        }

        redirect('instruktur/learning_outcome','refresh');
        
    }

    public function delete_Lo($id)
    {
        $deleteLo = M_Course_Learning_Outcomes::where('loc_id',$id)->first();
        // dd($deleteUser);
        $Delete= $deleteLo->delete();
        
        if($Delete)
        {
            $this->session->set_flashdata('aksi_lo', 'Data Learning Outcome Berhasil Terhapus');
        }else{
            $this->session->set_flashdata('data_gagal_aksi_lo', 'Data Learning Outcome Tidak Berhasil Terhapus');
        }
        
        redirect('instruktur/learning_outcome','refresh');
        
    }




}

/* End of file Controllername.php */
