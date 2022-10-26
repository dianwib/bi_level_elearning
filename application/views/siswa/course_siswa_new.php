<div class="row mb-5">
<?php foreach($courses as $course_siswa): ?> 
    <div class="col-md-6 col-lg-4 mb-3">
        <div class="card h-100">
            <img class="card-img-top" src="<?= base_url('res/assets/theme1/assets/img/illustrations/man-with-laptop-light.png') ?>" alt="Card image cap" />
            <div class="card-body">
                <h5 class="card-title"><?php echo $course_siswa->crs_name; ?></h5>
                <p class="card-text">
                <?php echo $course_siswa->usr_firstname.' '.$course_siswa->usr_lastname;?>
            </p>
                <?php
                            $course_enrol = M_Course_Enrol::where('crs_id',$course_siswa->crs_id)
                                ->where('usr_id',$this->session->userdata('id'))->first();
//                            dd($pt->ass_id);

//                      ?>
                <a href="<?php if($course_enrol != NULL) echo site_url('siswa/course/log/'.$course_siswa->crs_id);else echo site_url('siswa/course_close/'.$course_siswa->crs_id); ?>" class="btn btn-outline-primary">Enter</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>