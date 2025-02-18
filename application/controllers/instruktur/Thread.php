<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class Thread extends CI_Controller {


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

    public function list_thread_instruktur($cfr_id)
    {
        $data['dataThread'] = M_Course_Forum_Thread::leftJoin('users','users.usr_id','=','course_forum_thread.usr_id')
            ->where('course_forum_thread.cfr_id',$cfr_id)
            ->get(['course_forum_thread.*','users.usr_firstname','users.usr_lastname']);
        $data['judul_lesson'] = M_Course_Forum::leftJoin('course_lesson','course_lesson.lsn_id','=','course_forum.lsn_id')
            ->where('course_forum.cfr_id',$cfr_id)
            ->first(['course_lesson.lsn_name']);
//        dd($data['judul_lesson']);
        $data['sidebar'] = 'layout/sidebar_instruktur';
        $data['content'] = 'instruktur/list_thread_instruktur';
        $this->load->view(MASTER_TEMPLATE,$data);
    }

    public function detail_thread_instruktur($cft_id)
    {
        $data['dataforumthread'] = M_Course_Forum::leftJoin('course_forum_thread','course_forum_thread.cfr_id','=','course_forum.cfr_id')
                                ->leftJoin('users','users.usr_id','=','course_forum_thread.usr_id')
                                ->where('course_forum_thread.cft_id',$cft_id)
                                ->first();
                                //dd($data['dataawalthread']);

        $data['sidebar'] = 'layout/sidebar_instruktur';
        $data['content'] = 'instruktur/detail_thread_instruktur';
        $this->load->view(MASTER_TEMPLATE,$data);
    }

    public function insert_komentar_reply($cft_id)
    {
        $data['ftr_content'] = $this->input->post('forum_komentarr');
        $data['usr_id'] = $this->session->userdata('id');
        $data['cft_id'] = $cft_id;
        $idftr = $this->M_Course_Forum_Thread_Reply->insert_thread_reply($data);
        $insert = $this->M_Rating_Reply->insert_id_rating($idftr);

        redirect('instruktur/detail_thread_instruktur/'.$cft_id);
    }

    public function insert_komentar_reply_reply($ftr_id,$cft_id)
    {
        $data['trr_content'] = $this->input->post('forum_komentar1');
        $data['ftr_id'] = $ftr_id;
        $data['usr_id'] = $this->session->userdata('id');
        $idtrr = $this->M_Course_Forum_Thread_Reply_Reply->insert_thread_reply_reply($data);
        $insert = $this->M_Rating_Reply_Reply->insert_id_rating($idtrr);

        redirect('instruktur/detail_thread_instruktur/'.$cft_id);
    }

    public function insert_komentar_reply_reply_reply($trr_id,$cft_id)
    {
        $data['rrr_content'] = $this->input->post('forum_komentar2');
        $data['usr_id'] = $this->session->userdata('id');
        $data['trr_id'] = $trr_id;
        $idrrr = $this->M_Course_Forum_Thread_Reply_Reply_Reply->insert_thread_reply_reply_reply($data);
        $insert = $this->M_Rating_Reply_Reply_Reply->insert_id_rating($idrrr);

        redirect('instruktur/detail_thread_instruktur/'.$cft_id);
    }

    public function insert_rating_reply($ftr_id,$cft_id,$k,$cfr_id)
    {
        $data['ftr_id'] = $ftr_id;
        $data['usr_id'] = $this->session->userdata('id');
        $data['rry_rated'] = $k;

        $getrating = M_Course_Forum_Thread_Reply::where('course_forum_thread_reply.ftr_id','=',$ftr_id)->first(['ftr_ratingsum','ftr_ratingcount']);
        $ftrratingsum = $getrating->ftr_ratingsum;
        $ftrratingcount = $getrating->ftr_ratingcount;

        $ftrratingsum = $ftrratingsum + $k;
        $ftrratingcount++;

        $datarating['ftr_id'] = $ftr_id;
        $datarating['ftr_ratingsum'] = $ftrratingsum;
        $datarating['ftr_ratingcount'] = $ftrratingcount;
        
        $insert = $this->M_Rating_Reply->update_rating_reply($data, $ftrratingsum);
        $update = $this->M_Course_Forum_Thread_Reply->update_rating_reply($datarating);

        $getidftr = M_Course_Forum_Thread_Reply::where('course_forum_thread_reply.ftr_id','=',$ftr_id)->first();

        $datauserrating = M_Course_Forum_User::where('usr_id','=',$getidftr->usr_id)
                                            ->where('cfr_id','=', $cfr_id)
                                            ->first();
        
        $cfu_id = $datauserrating->cfu_id;
        
        //Update Rating Count
        $updateratingcount = $this->M_Course_Forum_User->updateratingcount_forum_user($cfu_id);

        //Update Rating Sum
        $updateratingsum = $this->M_Course_Forum_User->updateratingsum_forum_user($cfu_id,$k);
        
        $data['datathread'] = M_Course_Forum_Thread::where("cft_id", "=", $cft_id)->first();
        $event = array(
            'usr_id'            => $this->session->userdata('id'),
            'log_event_context' => "Rate Post:" . " " . $data['datathread']->cft_title,
            'log_referrer'      => $this->input->server('REQUEST_URI'),
            'log_name'          => "Rate Post",
            'log_origin'        => $this->agent->agent_string(),
            'log_ip'            => $this->input->server('REMOTE_ADDR'),
            'log_desc'          => $this->session->userdata('username'). " " 
            ."melakukan aksi Rate Post pada" . " '" . $data['datathread']->cft_title . "'"
        );
        $this->lib_event_log->add_user_event($event);

        redirect('instruktur/detail_thread_instruktur/'.$cft_id);
    }

    public function insert_rating_reply_reply($trr_id,$cft_id,$k,$cfr_id)
    {
        $data['trr_id'] = $trr_id;
        $data['usr_id'] = $this->session->userdata('id');
        $data['rrp_rated'] = $k;

        $getrating = M_Course_Forum_Thread_Reply_Reply::where('course_forum_thread_reply_reply.trr_id','=',$trr_id)->first(['trr_ratingsum','trr_ratingcount']);
        $trrratingsum = $getrating->trr_ratingsum;
        $trrratingcount = $getrating->trr_ratingcount;

        $trrratingsum = $trrratingsum + $k;
        $trrratingcount++;

        $datarating['trr_id'] = $trr_id;
        $datarating['trr_ratingsum'] = $trrratingsum;
        $datarating['trr_ratingcount'] = $trrratingcount;
        
        $insert = $this->M_Rating_Reply_Reply->update_rating_reply_reply($data, $trrratingsum);
        $update = $this->M_Course_Forum_Thread_Reply_Reply->update_rating_reply_reply($datarating);

        $getidtrr = M_Course_Forum_Thread_Reply_Reply::where('course_forum_thread_reply_reply.trr_id','=',$trr_id)->first();

        $datauserrating = M_Course_Forum_User::where('usr_id','=',$getidtrr->usr_id)
                                            ->where('cfr_id','=', $cfr_id)
                                            ->first();
        
        $cfu_id = $datauserrating->cfu_id;

        //Update Rating Count
        $updateratingcount = $this->M_Course_Forum_User->updateratingcount_forum_user($cfu_id);

        //Update Rating Sum
        $updateratingsum = $this->M_Course_Forum_User->updateratingsum_forum_user($cfu_id,$k);
        
        $data['datathread'] = M_Course_Forum_Thread::where("cft_id", "=", $cft_id)->first();
        $event = array(
            'usr_id'            => $this->session->userdata('id'),
            'log_event_context' => "Rate Post:" . " " . $data['datathread']->cft_title,
            'log_referrer'      => $this->input->server('REQUEST_URI'),
            'log_name'          => "Rate Post",
            'log_origin'        => $this->agent->agent_string(),
            'log_ip'            => $this->input->server('REMOTE_ADDR'),
            'log_desc'          => $this->session->userdata('username'). " " 
            ."melakukan aksi Rate Post pada" . " '" . $data['datathread']->cft_title . "'"
        );
        $this->lib_event_log->add_user_event($event);

        redirect('instruktur/detail_thread_instruktur/'.$cft_id);
    }

    public function insert_rating_reply_reply_reply($rrr_id,$cft_id,$k,$cfr_id)
    {
        $data['rrr_id'] = $rrr_id;
        $data['usr_id'] = $this->session->userdata('id');
        $data['rrl_rated'] = $k;

        $getrating = M_Course_Forum_Thread_Reply_Reply_Reply::where('course_forum_thread_reply_reply_reply.rrr_id','=',$rrr_id)->first(['rrr_ratingsum','rrr_ratingcount']);
        $rrrratingsum = $getrating->rrr_ratingsum;
        $rrrratingcount = $getrating->rrr_ratingcount;

        $rrrratingsum = $rrrratingsum + $k;
        $rrrratingcount++;

        $datarating['rrr_id'] = $rrr_id;
        $datarating['rrr_ratingsum'] = $rrrratingsum;
        $datarating['rrr_ratingcount'] = $rrrratingcount;
        
        $insert = $this->M_Rating_Reply_Reply_Reply->update_rating_reply_reply_reply($data, $rrrratingsum);
        $update = $this->M_Course_Forum_Thread_Reply_Reply_Reply->update_rating_reply_reply_reply($datarating);

        $getidrrr = M_Course_Forum_Thread_Reply_Reply_Reply::where('course_forum_thread_reply_reply_reply.rrr_id','=',$rrr_id)->first();

        $datauserrating = M_Course_Forum_User::where('usr_id','=',$getidrrr->usr_id)
                                            ->where('cfr_id','=', $cfr_id)
                                            ->first();
        
        $cfu_id = $datauserrating->cfu_id;

        //Update Rating Count
        $updateratingcount = $this->M_Course_Forum_User->updateratingcount_forum_user($cfu_id);

        //Update Rating Sum
        $updateratingsum = $this->M_Course_Forum_User->updateratingsum_forum_user($cfu_id,$k);
        
        $data['datathread'] = M_Course_Forum_Thread::where("cft_id", "=", $cft_id)->first();
        $event = array(
            'usr_id'            => $this->session->userdata('id'),
            'log_event_context' => "Rate Post:" . " " . $data['datathread']->cft_title,
            'log_referrer'      => $this->input->server('REQUEST_URI'),
            'log_name'          => "Rate Post",
            'log_origin'        => $this->agent->agent_string(),
            'log_ip'            => $this->input->server('REMOTE_ADDR'),
            'log_desc'          => $this->session->userdata('username'). " " 
            ."melakukan aksi Rate Post pada" . " '" . $data['datathread']->cft_title . "'"
        );
        $this->lib_event_log->add_user_event($event);

        redirect('instruktur/detail_thread_instruktur/'.$cft_id);
    }

    public function delete_thread_instruktur($cft_id,$cfr_id)
    {
        $deleteThread= M_Course_Forum_Thread::where('cft_id',$cft_id)->delete();

        if($deleteThread)
        {
            $event = array(
                'usr_id'            => $this->session->userdata('id'),
                'log_event_context' => "Delete Thread:" . " " . $data['cft_title'],
                'log_referrer'      => $this->input->server('REQUEST_URI'),
                'log_name'          => "Delete Thread",
                'log_origin'        => $this->agent->agent_string(),
                'log_ip'            => $this->input->server('REMOTE_ADDR'),
                'log_desc'          => $this->session->userdata('username'). " " 
                ."melakukan aksi Delete Thread" . " '" . $data['cft_title'] . "'"
            );
            $this->lib_event_log->add_user_event($event);

            $this->session->set_flashdata('data_thread', 'Data Thread Berhasil Terhapus');
        }else{
            $this->session->set_flashdata('data_gagal_thread', 'Data Thread Tidak Berhasil Terhapus');
        }
        redirect('instruktur/list_thread_instruktur/'.$cfr_id);
    }

    public function delete_komentar_reply($ftr_id,$cft_id)
    {
        $deleteThread= M_Course_Forum_Thread_Reply::where('ftr_id',$ftr_id)->delete();

        if($deleteForum)
        {
            $this->session->set_flashdata('data_komentar_reply', 'Data Thread Berhasil Terhapus');
        }else{
            $this->session->set_flashdata('data_gagal_komentar_reply', 'Data Thread Tidak Berhasil Terhapus');
        }
        redirect('instruktur/detail_thread_instruktur/'.$cft_id);
    }

    public function delete_komentar_reply_reply($trr_id,$cft_id)
    {
        $deleteThread= M_Course_Forum_Thread_Reply_Reply::where('trr_id',$trr_id)->delete();

        if($deleteForum)
        {
            $this->session->set_flashdata('data_komentar_reply_reply', 'Data Thread Berhasil Terhapus');
        }else{
            $this->session->set_flashdata('data_gagal_komentar_reply_reply', 'Data Thread Tidak Berhasil Terhapus');
        }
        redirect('instruktur/detail_thread_instruktur/'.$cft_id);
    }

    public function delete_komentar_reply_reply_reply($rrr_id,$cft_id)
    {
        $deleteThread= M_Course_Forum_Thread_Reply_Reply_Reply::where('rrr_id',$rrr_id)->delete();

        if($deleteForum)
        {
            $this->session->set_flashdata('data_komentar_reply_reply', 'Data Thread Berhasil Terhapus');
        }else{
            $this->session->set_flashdata('data_gagal_komentar_reply_reply', 'Data Thread Tidak Berhasil Terhapus');
        }
        redirect('instruktur/detail_thread_instruktur/'.$cft_id);
    }



}
