<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Assesment extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('level') == "2") {
            redirect('siswa/dashboard');
        } else if ($this->session->userdata('level') == "1") {
            redirect('admin/dashboard');
        } else if ($this->session->userdata('level') == NULL) {
            redirect('');
        }
    }

    public function add_assesment($crs_id)
    {
        $data['sidebar'] = 'layout/sidebar_instruktur';
        $data['content'] = 'instruktur/tambah_assesment';
        $data['crs_id'] = $crs_id;
        $mclo = new M_Course_Learning_Outcomes;
        $listLo = $mclo->selectBy('crs_id', $crs_id);
        $data['listLo'] = $listLo;

        $mcles = new M_Course_Lesson;
        $listLes = $mcles->selectBy('crs_id', $crs_id);
        $data['listLes'] = $listLes;
        $this->load->view(MASTER_TEMPLATE, $data);
    }

    public function edit_assesment($ass_id)
    {
        $data['sidebar'] = 'layout/sidebar_instruktur';
        $data['content'] = 'instruktur/edit_assesment';
        $data['ass_obj'] = $this->M_Course_Assesment->select($ass_id);
        $data['qst'] = $this->M_Course_Assesment_Question->select($ass_id);
        $i = 0;
        foreach ($data['qst'] as $c) {
            $data['qst_ans'][$i] = $this->M_Course_Assesment_Question_Answer->select($c->qst_id);
            $i++;
        };
        $data['jumSoal'] = $i;
        $mclo = new M_Course_Learning_Outcomes;
        $listLo = $mclo->selectBy('crs_id', $data['ass_obj']->crs_id);
        $data['listLo'] = $listLo;


        $mcles = new M_Course_Lesson;
        $listLes = $mcles->selectBy('crs_id', $data['ass_obj']->crs_id);
        $data['listLes'] = $listLes;

        $this->load->view(MASTER_TEMPLATE, $data);
    }

    public function update_assesment()
    {

        $mca = new M_Course_Assesment;
        $mca->ass_name = $this->input->post('nama');
        $mca->ass_desc = $this->input->post('desc');
        $mca->ass_timeopen = $this->input->post('wmulai');
        $mca->ass_timeclose = $this->input->post('wselesai');
        $mca->crs_id = $this->input->post('crs_id');
        $mca->ass_tipe = $this->input->post('tipe');
        $ass_id = $this->input->post('ass_id');

        $this->M_Course_Assesment->updates($mca, $ass_id);

        $jumSoal = $this->input->post('currNum');
        //loop per soal
        $i = 1;
        while ($i <= $jumSoal) {
            //Update Soal ke DB
            $mcaq = new M_Course_Assesment_Question;
            $soal = $this->input->post('soal' . $i);
            $loc_id = $this->input->post('loc' . $i);
            $lsn_id = $this->input->post('lsn' . $i);
            $mcaq->qst_text = $soal;
            $mcaq->ass_id = $ass_id;
            $mcaq->loc_id = $loc_id;
            $mcaq->lsn_id = $lsn_id;
            $qst_id = $this->input->post('qst_id' . $i);
            $qst_id = $this->M_Course_Assesment_Question->updates($mcaq, $qst_id);
            //end insert soal

            //Insert Option ABCDE ke DB
            $jwbBenar = $this->input->post('opt' . $i);
            $point = $this->input->post('poin' . $i);
            $opt[0] = $this->input->post('A' . $i);
            $opt[1] = $this->input->post('B' . $i);
            $opt[2] = $this->input->post('C' . $i);
            $opt[3] = $this->input->post('D' . $i);
            $opt[4] = $this->input->post('E' . $i);
            $j = 0;

            while ($j < 5) {
                if ($j == $jwbBenar) {
                    $poin = $point;
                } else {
                    $poin = 0;
                }
                $mcaqa = new M_Course_Assesment_Question_Answer;
                $mcaqa->ans_text = $opt[$j];
                $mcaqa->ans_point = $poin;
                $mcaqa->qst_id = $qst_id;
                $ins = $this->M_Course_Assesment_Question_Answer->updates($mcaqa, $this->input->post('ans_id' . $i . '-' . $j));
                $j++;
            }
            //End insert option
            $i++;
        }

        if ($ins) {
            $this->session->set_flashdata('ass_update_success', 'Data Assesment Berhasil Diubah');
        } else {
            $this->session->set_flashdata('ass_update_fail', 'Data Assesment Tidak Berhasil Diubah');
        }
        redirect('instruktur/edit_assesment/' . $ass_id);
    }

    public function delete_qst($qst_id)
    {
        $cek = $this->M_Course_Assesment_Question->deletes($qst_id);
        if ($cek != 0) {
            $this->session->set_flashdata('qst_delete_success', 'Soal Assesment Berhasil Dihapus');
        } else {
            $this->session->set_flashdata('qst_delete_fail', 'Soal Assesment Tidak Berhasil Dihapus');
        }
        echo '<script>window.history.go(-1);</script>';
    }

    public function delete_assesment($ass_id)
    {
        $cek = $this->M_Course_Assesment->deletes($ass_id);
        if ($cek != 0) {
            $this->session->set_flashdata('ass_delete_success', 'Assesment Berhasil Dihapus');
        } else {
            $this->session->set_flashdata('ass_delete_fail', 'Assesment Tidak Berhasil Dihapus');
        }
        echo '<script>window.history.go(-1);</script>';
    }

    public function insert_assesment($crs_id)
    {
        $this->db->trans_begin();
        try {
            $mca = new M_Course_Assesment;
            $mca->ass_name = $this->input->post('nama');
            $mca->ass_desc = $this->input->post('desc');
            $mca->ass_timeopen = $this->input->post('wmulai');
            $mca->ass_timeclose = $this->input->post('wselesai');
            $mca->crs_id = $crs_id;
            $mca->ass_tipe = $this->input->post('tipe');
            $ass_id = $this->M_Course_Assesment->insert($mca);
            $jumSoal = $this->input->post('currNum');
            $i = 1;
            //loop per soal
            while ($i <= $jumSoal) {
                //Insert Soal ke DB
                $mcaq = new M_Course_Assesment_Question;
                $soal = $this->input->post('soal' . $i);
                $loc_id = $this->input->post('loc' . $i);
                $lsn_id = $this->input->post('lsn' . $i);

                $mcaq->qst_text = $soal;
                $mcaq->ass_id = $ass_id;
                $mcaq->loc_id = $loc_id;
                $mcaq->lsn_id = $lsn_id;

                $qst_id = $this->M_Course_Assesment_Question->insert($mcaq);
                //end insert soal

                //Insert Option ABCDE ke DB
                $jwbBenar = $this->input->post('opt' . $i);
                $point = $this->input->post('poin' . $i);
                $opt[0] = $this->input->post('A' . $i);
                $opt[1] = $this->input->post('B' . $i);
                $opt[2] = $this->input->post('C' . $i);
                $opt[3] = $this->input->post('D' . $i);
                $opt[4] = $this->input->post('E' . $i);
                $j = 0;

                while ($j < 5) {
                    if ($j == $jwbBenar) {
                        $poin = $point;
                    } else {
                        $poin = 0;
                    }
                    $mcaqa = new M_Course_Assesment_Question_Answer;
                    $mcaqa->ans_text = $opt[$j];
                    $mcaqa->ans_point = $poin;
                    $mcaqa->qst_id = $qst_id;
                    $ins = $this->M_Course_Assesment_Question_Answer->insert($mcaqa);
                    $j++;
                }
                //End insert option

                $i++;
            }
            $data['course'] = M_Course::leftjoin("users", "users.usr_id", "=", "course.usr_id")
                ->where("course.crs_id", $crs_id)->get();
            //        dd($data['course']);
            if ($ins) {
                $cruses = M_Course_Enrol::where('crs_id', '=', $crs_id)->get();

                foreach ($cruses as $crus) :
                    $notif_content['ntf_type'] = "ASS";
                    $notif_content['ntf_instructor'] = $this->session->userdata('firstname') . " " . $this->session->userdata('lastname');
                    $notif_content['ntf_message'] = "Menambahkan assesment baru.";
                    $notif_content['ntf_read'] = "N";
                    $notif_content['ass_id'] = $ass_id;
                    $notif_content['lsn_id'] = NULL;
                    $notif_content['asg_id'] = NULL;
                    $notif_content['usr_id'] = $crus->usr_id;
                    $insert_notif = $this->M_Notification->insert($notif_content);
                endforeach;

                $this->session->set_flashdata('ass_simpan', 'Data Assesment Berhasil Tersimpan');
                //            $this->session->set_flashdata('ass_notif', $data['course']->usr_firstname.' '.$data['course']->usr_lastname.' menambahkan Assesment baru pada course'.$data['course']->crs_name);
            } else {
                $this->session->set_flashdata('ass_gagal', 'Data Assesment Tidak Berhasil Tersimpan');
            }
            $this->db->trans_begin();
        } catch (\Exception $th) {
            $this->session->set_flashdata('ass_gagal: ', $this->db->error());
            $this->db->trans_rollback();
        }
        redirect('instruktur/add_assesment/' . $crs_id);
    }


    public function add_pretest()
    {
        $data['sidebar'] = 'layout/sidebar_instruktur';
        $data['content'] = 'instruktur/tambah_pretest';
        $this->load->view(MASTER_TEMPLATE, $data);
    }

    public function add_remedial()
    {
        $data['sidebar'] = 'layout/sidebar_instruktur';
        $data['content'] = 'instruktur/tambah_remedial';
        $this->load->view(MASTER_TEMPLATE, $data);
    }

    public function add_exercise()
    {
        $data['sidebar'] = 'layout/sidebar_instruktur';
        $data['content'] = 'instruktur/tambah_latihan';
        $this->load->view(MASTER_TEMPLATE, $data);
    }
    public function result_siswa_assesment($ass_id)
    {
        $data['sidebar'] = 'layout/sidebar_instruktur';
        $data['content'] = 'instruktur/result_siswa_assesment';
        $data['assesment'] = M_Course_Assesment_Result::leftjoin("course_assesment", "course_assesment.ass_id", "=", "course_assesment_result.ass_id")
            ->leftjoin("users", "users.usr_id", "=", "course_assesment_result.usr_id")
            ->where("course_assesment_result.ass_id", $ass_id)->get();

        $data['assesment_instruktur'] = M_Course_Assesment::leftJoin("course", "course.crs_id", "=", "course_assesment.crs_id")
            ->leftJoin("users", "users.usr_id", "=", "course.usr_id")
            ->where("course_assesment.ass_id", $ass_id)->first();

        $this->load->view(MASTER_TEMPLATE, $data);
    }
}
