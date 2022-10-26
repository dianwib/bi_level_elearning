<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-pills flex-column flex-md-row mb-3">
            <li class="nav-item">
                <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('siswa/hasil_kuesioner_ls') ?>"><i class="bx bxl-twitch"></i> Lihat Kuisioner</a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="pages-account-settings-connections.html"><i class="bx bx-link-alt me-1"></i> Connections</a>
            </li> -->
        </ul>
        <div class="card mb-4">
            <form action="<?php echo site_url('siswa/akun/update_user'); ?>" method="post" enctype="multipart/form-data">

            <h5 class="card-header">Profile Details</h5>
            <!-- Account -->
            <div class="card-body">
                <div class="d-flex align-items-start align-items-sm-center gap-4">
                    <img id="blah" src="<?php echo base_url(); ?>res/assets/images/uploads/<?php echo $this->session->userdata('foto'); ?>" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                    <div class="button-wrapper">
                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Upload new photo</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <!-- <input hidden name="upload_foto" class="input-file" type="file" onchange="readURL(this);"/> -->
                            <input type="file" name="upload_foto" onchange="readURL(this);" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" />
                        </label>
                        <!-- <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                            <i class="bx bx-reset d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Reset</span>
                        </button> -->

                        <!-- <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p> -->
                    </div>
                </div>
            </div>
            <hr class="my-0" />
            <div class="card-body">
                <!-- <form id="formAccountSettings" method="POST" onsubmit="return false"> -->
                    <div class="row">
                        <div class="mb-3 col-md-6">
                        <label class="form-label">Username</label>
                            <input type="text" name="username" value="<?php echo $this->session->userdata('username'); ?>" class="form-control">
                        </div>
                        <div class="mb-3 col-md-6">
                        <label class="form-label">Nama Depan</label>
                            <input type="text" name="nama_depan" value="<?php echo $this->session->userdata('firstname'); ?>" class="form-control">
                       </div>
                        <div class="mb-3 col-md-6">
                        <label class="form-label">Nama Belakang</label>
                            <input name="nama_belakang" type="text" value="<?php echo $this->session->userdata('lastname'); ?>" class="form-control">
                        </div>
                        <div class="mb-3 col-md-6">
                        <label class="form-label">Email Address</label>
                            <input name="email" type="email" value="<?php echo $this->session->userdata('email'); ?>" class="form-control">
                        </div>
                        <div class="mb-3 col-md-6">
                        <label class="form-label">IPK</label>
                            <input name="ipk" type="number" min="0" max="4" step=".01" value="<?php echo $this->session->userdata('gpa'); ?>" class="form-control">
                        
                        </div>
                        <div class="mb-3 col-md-6">
                        <label class="form-label">Kelas</label>
                            <select class="form-control  select2 form-select" name="kelas">
                                <option><?php echo $this->session->userdata('kelas') ?></option>
                                <option>IF-39-02</option>
                                <option>IF-40-02</option>
                                <option>IF-41-INT</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                        <label class="form-label">Tempat Asal</label>
                            <select class="form-control select2 form-select" name="tempatAsal">
                                <option><?php echo $this->session->userdata('tmpasal'); ?></option>
                                <option>Aceh</option>
                                <option>Sumatera Utara</option>
                                <option>Sumatera Barat</option>
                                <option>Riau</option>
                                <option>Jambi</option>
                                <option>Sumatera Selatan</option>
                                <option>Bengkulu</option>
                                <option>Lampung</option>
                                <option>Kepulauan Bangka Belitung</option>
                                <option>Kepulauan Riau</option>
                                <option>DKI Jakarta</option>
                                <option>Jawa Barat</option>
                                <option>Jawa Tengah</option>
                                <option>DI Yogyakarta</option>
                                <option>Jawa Timur</option>
                                <option>Banten</option>
                                <option>Bali</option>
                                <option>Nusa Tenggara Barat</option>
                                <option>Nusa Tenggara Timur</option>
                                <option>Kalimantan Barat</option>
                                <option>Kalimantan Tengah</option>
                                <option>Kalimantan Selatan</option>
                                <option>Kalimantan Timur</option>
                                <option>Kalimantan Utara</option>
                                <option>Sulawesi Utara</option>
                                <option>Sulawesi Tengah</option>
                                <option>Sulawesi Selatan</option>
                                <option>Sulawesi Tenggara</option>
                                <option>Gorontalo</option>
                                <option>Sulawesi Barat</option>
                                <option>Maluku</option>
                                <option>Maluku Utara</option>
                                <option>Papua</option>
                                <option>Papua Barat</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                        <label class="form-label">Tanggal Lahir</label>
                            <input disabled name="ttl" type="text" value="<?php echo $this->session->userdata('ttl'); ?>" class="form-control">
                        </div>
                        <div class="mb-3 col-md-6">
                        <label class="form-label">Jenis Kelamin</label>
                            <input disabled name="ttl" type="text" value="<?php if ($this->session->userdata('jk') == 1) echo 'Pria';
                                                                            else echo 'Wanita'; ?>" class="form-control">
                        
                        </div>
                        
                    </div>
                    <div class="mt-2">
                    <input type="hidden" value="<?php echo $this->session->userdata('id') ?>" class="form-control" name="id" style="display:none" required />
                          
                        <button type="submit" class="btn btn-primary me-2">Save changes</button>
                        <!-- <button type="reset" class="btn btn-outline-secondary">Cancel</button> -->
                    </div>
                <!-- </form> -->
            </div>
            <!-- /Account -->
            </form>
        </div>
    </div>
</div>


<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>