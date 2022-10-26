<?php
define('TIMEBEFORE_NOW',         'Sekarang');
define('TIMEBEFORE_MINUTE',      '{num} menit yang lalu');
define('TIMEBEFORE_MINUTES',     '{num} menit yang lalu');
define('TIMEBEFORE_HOUR',        '{num} jam yang lalu');
define('TIMEBEFORE_HOURS',       '{num} jam yang lalu');
define('TIMEBEFORE_YESTERDAY',   'Kemarin');
define('TIMEBEFORE_FORMAT',      '%e %b');
define('TIMEBEFORE_FORMAT_YEAR', '%e %b, %Y');

function time_ago($time)
{
    $out    = ''; // what we will print out
    $now    = time(); // current time
    $diff   = $now - $time; // difference between the current and the provided dates

    if ($diff < 60) // it happened now
        return TIMEBEFORE_NOW;

    elseif ($diff < 3600) // it happened X minutes ago
        return str_replace('{num}', ($out = round($diff / 60)), $out == 1 ? TIMEBEFORE_MINUTE : TIMEBEFORE_MINUTES);

    elseif ($diff < 3600 * 24) // it happened X hours ago
        return str_replace('{num}', ($out = round($diff / 3600)), $out == 1 ? TIMEBEFORE_HOUR : TIMEBEFORE_HOURS);

    elseif ($diff < 3600 * 24 * 2) // it happened yesterday
        return TIMEBEFORE_YESTERDAY;

    else // falling back on a usual date format as it happened later than yesterday
        return gmdate("j M Y, g:i a", $time);
}

$jumlah_notif = M_Notification::where('usr_id', '=', $this->session->userdata('id'))->where('ntf_read', '=', 'N')->count();
$notifs = M_Notification::where('usr_id', '=', $this->session->userdata('id'))->where('ntf_read', '=', 'N')->get();
?>

<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <!-- <div class="navbar-nav align-items-center">
            <div class="nav-item d-flex align-items-center">
                <i class="bx bx-search fs-4 lh-0"></i>
                <input type="text" class="form-control border-0 shadow-none" placeholder="Search..." aria-label="Search..." />
            </div>
        </div> -->
        <!-- /Search -->


        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Place this tag where you want the button to render. -->
            <!-- <li class="nav-item lh-1 me-3">
                <a class="github-button" href="https://github.com/themeselection/sneat-html-admin-template-free" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star themeselection/sneat-html-admin-template-free on GitHub">Star</a>
            </li> -->



            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="<?php echo base_url(); ?>res/assets/images/uploads/<?php echo $this->session->userdata('foto'); ?>" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="<?php echo base_url(); ?>res/assets/images/uploads/<?php echo $this->session->userdata('foto'); ?>" alt class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block"><?php echo $this->session->userdata('firstname'); ?></span>
                                    <small class="text-muted"><?php echo $this->session->userdata('email'); ?></small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="<?php if ($this->session->userdata('level') == 1) echo site_url('instruktur/akun');
                                                        elseif ($this->session->userdata('level') == 2) echo site_url('siswa/akun');
                                                        else echo site_url('instruktur/akun'); ?>">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">My Profile</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="<?php if ($this->session->userdata('level') == 1) echo site_url('admin/akun');
                                                        elseif ($this->session->userdata('level') == 2) echo site_url('siswa/password');
                                                        else echo site_url('instruktur/password'); ?>">
                            <i class="bx bx-cog me-2"></i>
                            <span class="align-middle">Change Password</span>
                        </a>
                    </li>

                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="<?php echo site_url('logout'); ?>">
                            <i class="bx bx-power-off me-2"></i>
                            <span class="align-middle">Log Out</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!--/ User -->


            <!-- INBOX -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar">
                        <?php if (count($jumlah_notif) > 0) { ?>
                            <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20"><?php echo $jumlah_notif ?></span>
                        <?php } ?>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <?php foreach ($notifs as $notif) : ?>
                        <li>
                            <a class="dropdown-item" href="<?php
                                                            if ($notif->ntf_type == "LSN") {
                                                                echo base_url() . 'siswa/Notif/read_notif/materi/' . $notif->lsn_id . '/' . $notif->ntf_id;
                                                            } else if ($notif->ntf_type == "ASS") {
                                                                echo base_url() . 'siswa/Notif/read_notif/assesment_info/' . $notif->ass_id . '/' . $notif->ntf_id;
                                                            } else if ($notif->ntf_type == "ASG") {
                                                                echo base_url() . 'siswa/Notif/read_notif/assignment_detail/' . $notif->asg_id . '/' . $notif->ntf_id;
                                                            }
                                                            ?>">
                                <div class="d-flex">

                                    <div class="flex-grow-1">
                                        <span class="fw-bold d-block">
                                            <?php echo $notif->ntf_instructor ?> </span>
                                        <span class="fw-semibold"> 
                                        <i class='bx bx-user-voice'></i>

                                            <?php echo $notif->ntf_message ?></span></span>
                                        <br><small class="text-muted">
                                            <i class="bx bx-timer"></i>
                                            <?php echo time_ago($notif->ntf_time->format('U')) ?></small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                    <?php endforeach; ?>

                    <li>
                        <a class="dropdown-item" href="<?php echo site_url('notifikasi') ?>">
                            <span class="align-middle">Lihat Semua Notifikasi</span>
                        </a>
                    </li>

                </ul>
            </li>


        </ul>
    </div>
</nav>