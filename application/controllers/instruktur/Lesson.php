<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class Lesson extends CI_Controller {

    
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
    
    public function index($id)
    {
        $data['datalesen'] = M_Course_Lesson::where('crs_id', $id)->get();
//        dd($data['datalesen']);
$data['dataasing'] = M_Course_Assignment::where('crs_id', $id)->get();
        $data['jumlah'] = $data['datalesen']->count();
        $data['dataInstruktur'] = M_Course::leftJoin('users','users.usr_id','=','course.usr_id')
            ->where('course.crs_id',$id)
            ->first(['users.usr_firstname','users.usr_lastname','course.crs_name']);
//        dd($data['dataInstruktur']);
        $data['jumlah_siswa'] = M_Course_Enrol::where('crs_id', '=', $id)->count();
        $data['dataSiswa'] = M_Course_Enrol::join('users', 'users.usr_id', '=', 'course_enrol.usr_id')->where('crs_id', '=', $id)->get();
        $data['sidebar'] = 'layout/sidebar_instruktur';
        $data['content'] = 'instruktur/lesson';
        // dd($data['datalesen']);
        $data['id'] = $id;
        $listAss = $this->M_Course_Assesment->selectBy('crs_id',$id);
        $i = 0;
        $jumSoal = array();
        foreach($listAss as $c){
            $soal = $this->M_Course_Assesment_Question->select($c->ass_id);
            $jumSoal[$i] = $soal->count();
            $i++;
        }
        $data['listAss'] = $listAss;
        $data['jumSoal'] = $jumSoal;
        //at-risk
        $data['assesment_instruktur'] = M_Course_Assesment::leftJoin("course", "course.crs_id","=","course_assesment.crs_id")
            ->leftJoin("users","users.usr_id","=","course.usr_id")
            ->where("course_assesment.crs_id", $id)->first();


//        $data['ar'] = M_At_risk::leftjoin("course_assesment","course_assesment.ass_id","=","at_risk.ass_id")
//            ->leftJoin("users","users.usr_id","=","at_risk.usr_id")
//            ->where("course_assesment.crs_id",$crs_id)->get();
//        $data['ar_2'] = M_User::leftjoin("at_risk","at_risk.usr_id","=","users.usr_id")
//            ->leftJoin("course","course.crs_id","=","at_risk.crs_id")
//            ->leftJoin("course_assesment.ass_id","=","at_risk.ass_id")
//            ->where("at_risk.crs_id","=",$crs_id)->get();
        $data['ar'] = M_At_risk::leftjoin("course_assesment","course_assesment.ass_id","=","at_risk.ass_id")
            ->leftJoin("users","users.usr_id","=","at_risk.usr_id")
            ->where("course_assesment.crs_id",$id)->groupby("at_risk.usr_id")->get();
        $data['ar_kuis'] = M_At_risk::leftjoin("course_assesment_result","course_assesment_result.ass_id","=","at_risk.ass_id")
            ->leftJoin("course_assesment","course_assesment.crs_id","=","at_risk.crs_id")
            ->where("course_assesment.crs_id",$id)->groupby("course_assesment_result.ass_result")->get();
        $data['cek'] = M_At_risk::where("at_risk.crs_id","=",$id)->get();
//        dd($data['cek']);
        //end at-risk
        $this->load->view(MASTER_TEMPLATE, $data);
    }

    /* CRUD Course */
   

    public function add($id)
    {
        // $data['addlesen'] = M_Course_Lesson::where('crs_id',$id)
        $data['id'] = $id;
        $data['sidebar'] = 'layout/sidebar_instruktur';
        $data['content'] = "instruktur/add_lesson";
        $this->load->view(MASTER_TEMPLATE,$data);
    }

    public function insert_lesson()
    {
        $lesen['lsn_name'] = $this->input->post('lsn_name');
        $lesen['lsn_intro'] = empty($this->input->post('lsn_intro')) ? NULL : $this->input->post('lsn_intro');
        $lesen['crs_id'] = $this->input->post('crs_id');

        $insert = $this->M_Course_Lesson->insert($lesen);
        
        if($insert)
        {
            $this->session->set_flashdata('data_tersimpan', 'Data Lesson Berhasil Tersimpan');
        }else{
            $this->session->set_flashdata('data_gagal_tersimpan', 'Data Lesson Tidak Berhasil Tersimpan');
        }
        // $data['id'] = $id;
        // $data['sidebar'] = 'layout/sidebar_instruktur';
        // $data['content'] = "instruktur/add_lesson";
        // $this->load->view(MASTER_TEMPLATE, $data);

        
        redirect('instruktur/lesson/'.$lesen['crs_id'],'refresh');
        
    }

    public function edit($id)
    {
        $data['dataLesson'] = M_Course_Lesson::where('lsn_id',$id)->first();
        $data['sidebar'] = "layout/sidebar_instruktur";
        $data['content'] = "instruktur/edit_lesson";
        $this->load->view(MASTER_TEMPLATE, $data);

    }

    public function update_lesson()
    {
        $lesen['lsn_name'] = $this->input->post('lsn_name');
        $lesen['lsn_intro'] = $this->input->post('lsn_intro');
//        $lesen['lsn_intro'] = empty($this->input->post('lsn_intro')) ? NULL : $this->input->post('lsn_intro');
        $lesen['lsn_id'] = $this->input->post('lsn_id');
        $crs_id = M_Course_Lesson::where('lsn_id',$lesen['lsn_id'])->first(['crs_id']);
        // dd($crs_id->crs_id);

        $update = $this->M_Course_Lesson->update_lesson($lesen);

        if($update)
        {
            $this->session->set_flashdata('data_lesson', 'Data Lesson Berhasil Terupdate');
        }else{
            $this->session->set_flashdata('data_lesson_gagal', 'Data Lesson Tidak Berhasil Terupdate');
        }
        
        redirect('instruktur/lesson/'.$crs_id->crs_id);
        
    }

    public function delete_lesson($id)
    {
        $deleteLesson = M_Course_Lesson::where('lsn_id',$id)->first();
        $lsnDelete= $deleteLesson->delete();
            
            if($lsnDelete)
            {
                $this->session->set_flashdata('data_lesson', 'Data Lesson Berhasil Terhapus');
            }else{
                $this->session->set_flashdata('data_lesson_gagal', 'Data Lesson Tidak Berhasil Terhapus');
            }
            
        redirect('instruktur/lesson/'.$deleteLesson->crs_id);
    }
    
}
