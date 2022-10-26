<div class="row">
    <div class="col-lg-12 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-7">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Welcome to TelC Learning! 🎉</h5>
                        <p class="mb-4">
                            You have done <span class="fw-bold">72%</span> more sales today. Check your new badge in
                            your profile.
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
        <div class="col-md-12 col-lg-12 col-xl-12 order-0 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h2 class="m-0 me-2">Course</h2>
                        <small class="text-muted">Your recent Course Enrol</small>
                    </div>
                </div>
                <div class="card-body m-2">
                    <div class="demo-inline-spacing mt-3">
                        <div class="list-group list-group-flush">
                            <?php if (count($list_course) != 0) : ?>
                                <?php foreach ($list_course as $c) { ?>
                                    <a href="<?php echo base_url() . 'siswa/course/log/' . $c->crs_id ?>" class="list-group-item list-group-item-action">
                                        <h6 class="mb-0">[<?php echo $c->crs_code ?>] <?php echo $c->crs_name ?></h6>
                                        <small class="text-muted">diambil pada :<?php echo $c->enr_timecreated ?></small>
                                    </a>
                                <?php } ?>
                            <?php else : ?>
                                <h2>Data tidak ada</h2>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-lg-12 col-xl-12 order-0 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h2 class="m-0 me-2">Assesment</h2>
                        <small class="text-muted">Your recent assesment</small>
                    </div>
                </div>
                <div class="card-body m-2">
                    <div class="demo-inline-spacing mt-3">
                        <ul class="list-group">
                            <?php if (count($ansStd) != 0) : ?>
                                <?php
                                $i = 0;
                                foreach ($ansStd as $c) { ?>
                                    <a href="<?php echo base_url() . 'siswa/result/' . $c->ass_id ?>" class="list-group-item-action">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0">[<?php echo $listAss[$i]->ass_tipe ?>] <?php echo $listAss[$i]->ass_name ?>></h6>
                                            <span class="badge bg-primary">Nilai : <?php echo number_format($c->nilai, 2) ?></span>
                                        </li>
                                    </a>
                                <?php } ?>
                            <?php else : ?>
                                <h2>Data tidak ada</h2>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Transactions -->
    <div class="col-md-6 col-lg-4 order-2 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title m-0 me-2">Forum Activity</h5>

            </div>
            <div class="card-body">
                <ul class="p-0 m-0">
                    <?php if (count($list_thread) != 0) : ?>
                        <?php foreach ($list_thread as $forum) { ?>
                            <a class="" href="<?php echo base_url() . 'siswa/thread/log_detailThread/' . $forum->cft_id ?>">
                                <li class="d-flex mb-4 pb-1">
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <small class="text-muted d-block mb-1">Forum: <?php echo strip_tags($forum->cfr_desc); ?></small>
                                            <h6 class="mb-0"><?php echo $forum->cft_title ?></h6>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <span class="text-muted">dibuat pada :<?php echo $forum->cft_timecreated ?></span>
                                        </div>
                                    </div>
                                </li>
                            </a>
                        <?php } ?>
                    <?php else : ?>
                        <h6>Data tidak ada</h6>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
    <!--/ Transactions -->
</div>
<!-- / Content -->