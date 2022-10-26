<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <form action="<?php echo site_url('siswa/akun/password_siswa') ?>" method="post" enctype="multipart/form-data">

                <h5 class="card-header">Profile Details</h5>
                <!-- Account -->
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img src="<?php echo base_url(); ?>res/assets/images/uploads/<?php echo $this->session->userdata('foto'); ?>" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                    </div>
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Current Password</label>
                            <input name="current_password" type="password" class="form-control input-md" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">New Password</label>
                            <input name="new_password" type="password" class="form-control input-md" required>

                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Repeat Password</label>
                            <input name="repeat_password" type="password" class="form-control input-md" required>

                        </div>

                    </div>
                    <div class="mt-2">
                        <input type="text" value="<?php echo $this->session->userdata('id') ?>" class="form-control" name="id" style="display:none" required />

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