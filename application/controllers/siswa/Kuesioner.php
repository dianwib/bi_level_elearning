<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class Kuesioner extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('level')=="1") {
            redirect('admin/dashboard');
        } else if ($this->session->userdata('level')=="3") {
            redirect('instruktur/dashboard');
        } else if ($this->session->userdata('level') == NULL) {
            redirect('');
        } 

    }


    public function kuesioner_ls(){
        $data['sidebar'] = SIDEBAR_TEMPLATE;
        $data['content'] = 'siswa/selfass';
        if($this->session->userdata('ls') == 1){
            redirect('siswa/hasil_kuesioner_ls');
        }
        $this->load->view(MASTER_TEMPLATE, $data);
    }

    public function hasil_kuesioner_ls(){
        $data['sidebar'] = SIDEBAR_TEMPLATE;
        $data['content'] = 'siswa/hasilselfass';
        $hasil = $this->M_Hasil_Kuesioner->selectByUser($this->session->userdata('id'));
        $data['hasil'] = $hasil;
        if($hasil->Active > $hasil->Reflective){
            $hasilKues['AR'] = 'Active';
            $descKues['AR'] = 'peserta didik yang lebih menyukai proses informasi secara aktif dengan melakukan sesuatu dengan materi yang dipelajari seperti contoh mendiskusikan, menjelaskan atau mengujinya.';
        }
        else{
            $hasilKues['AR'] = 'Reflective';
            $descKues['AR'] = 'peserta didik yang lebih menyukai memikirkan materi dan bekerja sendiri.';
        }

        if($hasil->Sensing > $hasil->Intuitive){
            $hasilKues['SI'] = 'Sensing';
            $descKues['SI'] = 'peserta didik yang lebih menyukai konkrit seperti fakta dan data.';
        }
        else{
            $hasilKues['SI'] = 'Intuitive';
            $descKues['SI'] = 'peserta didik yang lebih menyukai mempelajari materi abstrak seperti teori dan makna yang mendasarinya, menganalisis kinerja pada pertanyaan tentang fakta serta pada teori dan konsep.';
        }

        if($hasil->Visual > $hasil->Verbal){
            $hasilKues['VV'] = 'Visual';
            $descKues['VV'] = 'peserta didik yang lebih menyukai sesuatu dari apa yang dapat mereka lihat seperti grafik, gambar, dan diagram.';            
        }
        else{
            $hasilKues['VV'] = 'Verbal';
            $descKues['VV'] = 'peserta didik yang lebih menyukai belajar dari audio atau kata-kata, terlepas kata itu diucapkan atau ditulis.';            
        }

        if($hasil->Sequential > $hasil->Global){
            $hasilKues['SG'] = 'Sequential';
            $descKues['SG'] = 'peserta didik yang lebih nyaman dengan detail dan cenderung melalui kursus langkah demi langkah dengan cara linear.';            
        }
        else{
            $hasilKues['SG'] = 'Global';
            $descKues['SG'] = 'peserta didik yang lebih nyaman belajar dengan lompatan besar, kadang-kadang melewatkan objek pembelajaran dan melompat ke materi yang lebih kompleks atau penting bagi peserta didik tersebut.';            
        }
        $data['hasilKues'] = $hasilKues;
        $data['descKues'] = $descKues;
        $hasil2 = $this->M_Hasil_Kuesioner2->selectByUser($this->session->userdata('id'));
        if($hasil2->hasil == 'Expert'){
            $hasil2Arti = 'Expert memiliki keterampilan dan keahlian yang diperlukan untuk tugas khusus yang ada. Dia memiliki fokus yang kuat pada tugas dan mungkin bersikap defensif ketika orang lain mengganggu pekerjaannya. Expert lebih suka bekerja sendiri dan anggota tim sering memiliki kepercayaan dan keyakinan yang besar terhadap dirinya.';        
        }
        else if($hasil2->hasil == 'Team Player'){
            $hasil2Arti = 'Team player selalu peduli, menghindari konflik, dan menumbuhkan harmoni. Menjadi seseorang yang suka membantu orang lain, Team player umumnya dianggap menyenangkan dan ramah. Ia diplomatis dan menekankan solidaritas dan kohesi tim.';
        }
        else if($hasil2->hasil == 'Completer'){
            $hasil2Arti = 'Completer sangat teliti dan merasa bertanggung jawab atas pencapaian tim. Completers prihatin ketika kesalahan dibuat dan mereka cenderung khawatir karena sifat pengendalian mereka. Completer ini juga dikenal sebagai finisher karena mereka paling efektif digunakan pada akhir tugas, untuk memoles dan meneliti pekerjaan untuk kesalahan, menundukkannya pada standar kontrol kualitas tertinggi.';
            
        }
        else if($hasil2->hasil == 'Chairman'){
            $hasil2Arti = 'Chairman memiliki peran koordinasi yang kuat. Dengan penekanan pada prosedur, chairman akan berusaha membawa dan menjaga tim tetap bersama. Dia komunikatif dan berhubungan dengan anggota tim dengan cara yang sopan dan berpikiran terbuka.';
        }
        else if($hasil2->hasil == 'Driver') {
            $hasil2Arti = 'Driver umumnya sangat ambisius dan energik. Dia mungkin tampak tidak sabar dan impulsif. Driver adalah motivator yang kuat dan akan menantang orang lain pada saat-saat penting. Meskipun tindakan driver kadang-kadang tampak agak emosional, mereka memainkan peran penting dalam mendorong tim maju untuk berhasil.';
        }
        else if($hasil2->hasil == 'Analyst'){
            $hasil2Arti = 'Analis memiliki kecenderungan untuk dilindungi (defensive) dan kritis. Analis juga akan bereaksi terhadap rencana dan ide dengan cara yang rasional dan masuk akal. Dia akan menyukai pendekatan yang bijaksana untuk suatu hal dan akan mengevaluasinya sesuai dengan keakuratannya sebelum bertindak.';
        }
        else if($hasil2->hasil == 'Explorer'){
            $hasil2Arti = 'Penjelajah umumnya bersifat ekstrovert. Dia ceria, suka berteman. Penjelajah juga bersifat investigatif, tertarik dan ingin tahu tentang berbagai hal. Karena para penjelajah suka berimprovisasi dan berkomunikasi dengan orang lain, mereka akan memiliki sedikit masalah dalam menyajikan ide kepada tim dan mengembangkan kontak baru.';
        }
        else if($hasil2->hasil == 'Innovator'){
            $hasil2Arti = 'Inovator sering merupakan generator kreatif dari sebuah tim. Dia memiliki imajinasi yang kuat dan keinginan untuk menjadi original. Inovator lebih memilih untuk mandiri dan cenderung mendekati tugas dengan cara ilmiah/secara logika. Sebagai individu kreatif, inovator memiliki peran penting dalam sebuah tim untuk menyelesaikan tugas dan memecahkan masalah.';
        }
        else if($hasil2->hasil == 'Executive'){
            $hasil2Arti = 'Eksekutif terkadang juga disebut sebagai penyelenggara/peng-organisasi. Eksekutif umumnya disiplin dan bersemangat untuk menyelesaikan pekerjaan. Dia efisien, praktis, dan sistematis. Eksekutif terorganisasi dengan baik dan tekun, dan dengan cepat mengubah ide dari tim menjadi tindakan nyata dan rencana praktis';
        }
        $data['hasil2Arti'] = $hasil2Arti;
        $data['hasilKues2'] = $hasil2;
        $this->load->view(MASTER_TEMPLATE, $data);
    }

    public function kuesioner_tr(){
        $data['sidebar'] = SIDEBAR_TEMPLATE;
        $data['content'] = 'siswa/kuesioner_teamrole';
        if($this->session->userdata('tr') == 1){
            redirect('siswa/hasil_kuesioner_ls');
        }
        $this->load->view(MASTER_TEMPLATE, $data);
    }

    public function calc_kuesioner(){
        $i = 1;
        while($i <= 44){
            $h[$i] = $this->input->post('learningstyle'.$i);
            $i++;
        }
        
        $Active = [1,17,25,29,5,9,13,21,33,37,41];
        $Sensing = [2,30,34,6,10,14,18,26,38,22,42];
        $Visual = [3,7,11,15,19,23,27,31,35,39,43];
        $Sequential = [4,28,40,20,24,32,36,44,8,12,16];
        
        $Reflective = [1,5,17,25,29,9,13,21,33,41,37];
        $Intuitive = [2,14,22,26,30,34,6,10,18,38,42];
        $Verbal = [3,7,11,15,19,27,35,23,31,39,43];
        $Global = [4,8,12,16,28,40,24,32,20,36,44];

        $hasil[0] = $this->calcLs($Active,$Reflective,$h);

        $hasil[1] = $this->calcLs($Sensing,$Intuitive,$h);

        $hasil[2] = $this->calcLs($Visual,$Verbal,$h);

        $hasil[3] = $this->calcLs($Sequential,$Global,$h);


        $mhk = new M_Hasil_Kuesioner;
        $mhk->usr_id = $this->session->userdata('id');
        $mhk->Active = $hasil[0][0];
        $mhk->Reflective = $hasil[0][1];
        $mhk->Sensing = $hasil[1][0];
        $mhk->Intuitive = $hasil[1][1];
        $mhk->Visual = $hasil[2][0];
        $mhk->Verbal = $hasil[2][1];
        $mhk->Sequential = $hasil[3][0];
        $mhk->Global = $hasil[3][1];
        $mhkId = $this->M_Hasil_Kuesioner->insert($mhk);
        /*$mhkId if 0 = error, if 1 = success*/
        if($mhkId != 0){
            $this->session->set_userdata('ls',1);
            redirect('siswa/dashboard');
        }
        else{
            echo 'Error Encountered !';
        }
    }

    public function calcLs($data1,$data2,$hasil){
        $i = 0;
        $A = 0;
        $B = 0;
        
        while($i < count($data1) ){

            if($hasil[$data1[$i]] == 'a'){
                $A++; 
            }

            if($hasil[$data2[$i]] == 'b'){
                $B++;
            }

            $i++;
        }

        $temp = [$A,$B];
        return $temp;
    }

    public function insert_tr(){
        $mhk2 = new M_Hasil_Kuesioner2;
        $mhk2->usr_id = $this->session->userdata('id');
        $mhk2->hasil = $this->input->post('hasil');
        $txt = $this->input->post('minatLainTxt');
        if($txt != NULL){
            $mhk2->minat = $this->input->post('minat').','.$txt;
        }
        else{
            $mhk2->minat = $this->input->post('minat');   
        }
        $mhk2Id = $this->M_Hasil_Kuesioner2->insert($mhk2);

        if($mhk2Id != 0){
            $this->session->set_userdata('tr',1);
            redirect('siswa/hasil_kuesioner_ls');
        }
        else{
            echo 'Error Encountered !';
        }
    }

}

?>