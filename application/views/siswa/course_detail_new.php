<div class="row">
    <div class="col-lg-12 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-7">
                    <div class="card-body">
                        <h5 class="card-title text-primary"><?php echo $course->crs_name ?> 🎉</h5>
                        <p class="mb-4">
                            <?= $course->crs_summary  ?>
                            <span class="fw-bold">
                                <?= $course->crs_univ ?>
                            </span>
                        </p>
                    </div>
                </div>
                <div class="col-sm-5 text-center text-sm-left">
                    <div class="card-body pb-0 px-0 px-md-4">
                        <img src="<?= base_url('res/assets/theme1/assets/img/illustrations/man-with-laptop-light.png') ?>" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Order Statistics -->
    <div class="col-md-6 col-lg-8 col-xl-8 order-0 mb-4">
        <div class="mb-4 card">
            <div class="card-header d-flex align-items-center justify-content-betwee">
                <label class="form-label"> <span class="fw-bold">Target Pembelajaran(Apa yang ingin Anda pelajari?)</span></label>
            </div>
            <div class="card-body">
                <select id="selectLoc" class="form-control js-example-placeholder-single  select2 form-select" name="kelas">
                    <option value="AL">Semua</option>
                    <?php
                    foreach ($loc as $lo) : ?>
                        <option <?php
                                if ($learning_goal !== NULL) {
                                    if ($lo->loc_id == $learning_goal->loc_id) {
                                        echo "selected";
                                    } else if ($lo->loc_id == NULL) {
                                        echo "";
                                    }
                                }
                                ?> value="<?php echo $lo->loc_id ?>"><?php echo $lo->loc_desc ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>





        <div class="nav-align-top">
            <ul class="nav nav-tabs nav-fill" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-home" aria-controls="navs-justified-home" aria-selected="true">
                        <i class="tf-icons bx bx-home"></i> Lesson Content
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-profile" aria-controls="navs-justified-profile" aria-selected="false">
                        <i class="tf-icons bx bx-user"></i> Assessment
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-messages" aria-controls="navs-justified-messages" aria-selected="false">
                        <i class="tf-icons bx bx-message-square"></i> Assignment
                    </button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-justified-home" role="tabpanel">
                    <div class="demo-inline-spacing mt-3">
                        <div class="list-group list-group-flush">
                            <small class="text-light text-center fw-semibold">Materi pembelajaran di
                                course <?php echo $course->crs_name ?></small>
                            <?php if (count($lesson) != 0) : ?>
                                <?php
                                $num = 1;
                                foreach ($lesson as $lessons) : ?>
                                    <a style="<?php echo $lsnAccessColor[$num - 2] ?>" href="<?php echo site_url('siswa/content/log_lesson/' . $lessons->lsn_id) ?>" class="list-group-item list-group-item-action">
                                        <span style="margin-right: 25px;"><?php echo $num++ ?>.</span>
                                        <?php echo 'Materi - ' . $lessons->lsn_name ?>
                                    </a>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <h6>Data Tidak Ada</h6>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
                    <div class="demo-inline-spacing mt-3">
                        <div class="list-group list-group-flush">
                            <small class="text-light text-center fw-semibold">Assessment terdiri dari Kuis, Pre-test, Remedial dan
                                Exercise</small>
                            <?php if (count($listAss) != 0) : ?>
                                <?php
                                $num = 1;
                                $i = 0;
                                foreach ($listAss as $ass) : ?>
                                    <a href="<?php echo site_url('siswa/assesment_info/' . $ass->ass_id) ?>" class="list-group-item list-group-item-action">
                                        <span style="margin-right: 25px;"><?php echo $num++ ?>.</span>

                                        <?php echo $ass->ass_tipe . ' - ' . $ass->ass_name ?>
                                        <span class="badge bg-primary rounded-pill"><?php echo $jumSoal[$i] ?> </span>

                                    </a>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <h6>Data Tidak Ada</h6>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-justified-messages" role="tabpanel">
                    <div class="demo-inline-spacing mt-3">
                        <div class="list-group list-group-flush">
                            <small class="text-light text-center fw-semibold">
                                Tugas dikerjakan sesuai dengan tenggat waktu yang diberikan</small>
                            <?php if (count($assignment) != 0) : ?>
                                <?php
                                $num = 1;
                                foreach ($assignment as $c) : ?>
                                    <a href="<?php echo site_url('siswa/assignment_detail/' . $c->asg_id) ?>" class="list-group-item list-group-item-action">
                                        <span style="margin-right: 25px;"><?php echo $num++ ?>.</span>
                                        <?php echo $c->asg_name ?>

                                    </a>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <h6>Data Tidak Ada</h6>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Transactions -->
    <div class="col-md-6 col-lg-4 order-2 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title m-0 me-2">Informasi Course</h5>

            </div>
            <div class="card-body">
                <ul class="p-0 m-0">
                    <li class="d-flex mb-4 pb-1">
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <small class="text-muted d-block mb-1">Course :</small>
                                <h6 class="mb-0"><?php echo $course->crs_name ?></h6>
                            </div>
                        </div>
                    </li>

                    <li class="d-flex mb-4 pb-1">
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <small class="text-muted d-block mb-1">Instruktur : </small>
                                <h6 class="mb-0"><?php echo $course->usr_firstname ?> <?php echo $course->usr_lastname ?></h6>
                            </div>
                        </div>
                    </li>

                    <li class="d-flex mb-4 pb-1">
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <small class="text-muted d-block mb-1">Jumlah lesson: </small>
                                <h6 class="mb-0"><?php echo $jml_lesson ?></h6>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--/ Transactions -->
</div>
<!-- / Content -->

<script>
    $(document).ready(function() {
        $(".js-example-placeholder-single").select2({
            placeholder: "Apa yang ingin Anda pelajari?",
            allowClear: true
        });

        $('#selectLoc').on('select2:select',
            function(e) {
                var data = e.params.data.id;
                console.log(data);
                console.log("Ss")


                $.ajax({
                    url: '<?php echo base_url() . 'siswa/course/goals/' ?>' + data,
                    type: 'POST',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        location.reload();
                    },
                    error: function(res) {
                        alert('Error');
                    }
                });
                return false;

            });
    });
</script>