<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class Course extends CI_Controller {

    
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
        $data['sidebar'] = 'layout/sidebar_instruktur';
        $data['content'] = 'instruktur/myCourse';
        $data['courses']= M_course::where('course.usr_id', '=', $this->session->userdata('id'))->get();

        $this->load->view(MASTER_TEMPLATE, $data);
    }

    /* CRUD Course */
  
    public function add()
    {
        $data['sidebar'] = 'layout/sidebar_instruktur';
        $data['content'] = "instruktur/add_course";
        $this->load->view(MASTER_TEMPLATE,$data);
    }

    public function insert()
    {
//        $lo = $this->input->post('Loc[]');
//        dd($lo[0]);
        $course = new M_Course();
        $course->crs_code = $_POST['m-kode-course'];
        $course->crs_name = $_POST['m-nama-course'];
        $course->crs_summary = empty($_POST['m-deskripsi-course']) ? NULL : $_POST['m-deskripsi-course'];
        $course->crs_univ = empty($_POST['m-univ-course']) ? NULL : $_POST['m-univ-course'];
        $course->cat_id = 1;
        $course->usr_id = $_POST['usr_id'];
        $course->save();
        $crs_id = $course->crs_id;
        $lo = $this->input->post('Loc[]');
        $insert= $this->M_Course_Learning_Outcomes->insert_lo($lo,$crs_id);
        
        if($insert)
        {
            $this->session->set_flashdata('insert_course', 'Data Course Berhasil Tersimpan');
        }else{
            $this->session->set_flashdata('insert_course', 'Data Course Tidak Berhasil Tersimpan');
        }

        redirect('instruktur/MyCourse');
    }

    public function edit($id)
    {

        $data['course'] = M_Course::where('crs_id',$id)
                                    ->first();
        $data['sidebar'] = 'layout/sidebar_instruktur';
        $data['content'] = 'instruktur/edit_course';
        $this->load->view(MASTER_TEMPLATE,$data);

    }

    public function update()
    {
        $course_update = M_Course::where('crs_id',$this->input->post('m-id-course'))
                                    ->first();
        $course_update->crs_code = $_POST['m-kode-course'];
        $course_update->crs_name = $_POST['m-nama-course'];
        $course_update->crs_summary = $_POST['m-deskripsi-course'];
        $course_update->crs_univ = $_POST['m-univ-course'];
        $update = $course_update->save();
        if($update)
        {
            $this->session->set_flashdata('data_course', 'Data Course Berhasil Terupdate');
        }else{
            $this->session->set_flashdata('data_course', 'Data Course Tidak Berhasil Terupdate');
        }

        redirect('instruktur/MyCourse');
    }

    public function delete($id)
    {
        $course = M_Course::find($id);
        $course->delete();
    }
    
}
