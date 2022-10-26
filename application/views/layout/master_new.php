<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="<?= base_url('res/assets/theme1/assets/') ?>"
  data-template="vertical-menu-template-free"
>
<?php $this->load->view('layout/header_new'); ?>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <?php $this->load->view($sidebar); ?>

        
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
<?php $this->load->view('layout/navbar_new'); ?>
         

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
                   
                <?php if ($this->session->flashdata('password_tersimpan') == TRUE) : ?>
                  <div class="alert alert-success alert-dismissible container-xxl mt-2" role="alert">
                        <span class="text-sm"><?php echo $this->session->flashdata('password_tersimpan') ?></span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif ($this->session->flashdata('data_tersimpan') == TRUE) : ?>
                   <div class="alert alert-success alert-dismissible container-xxl mt-2" role="alert">
                        <span class="text-sm"><?php echo $this->session->flashdata('data_tersimpan') ?></span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif ($this->session->flashdata('ass_notif') == TRUE) : ?>
           
                    <div class="alert alert-danger alert-dismissible container-xxl mt-2" role="alert">
                        <span class="text-sm"><?php echo $this->session->flashdata('ass_notif') ?></span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php elseif ($this->session->flashdata('data_gagal_tersimpan') == TRUE) : ?>
            
                    <div class="alert alert-danger alert-dismissible container-xxl mt-2" role="alert">
                        <span class="text-sm"><?php echo $this->session->flashdata('data_gagal_tersimpanf') ?></span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                <?php endif; ?>
                <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="fw-bold py-3 mb-4">
                  <span class="text-muted fw-light"><?= ucfirst(@$this->uri->segment(1)) ?> / </span> <?= ucfirst(@$this->uri->segment(2)) ?></h4>

    <?php $this->load->view($content . CONTENT_TEMPLATE); ?>
                </div>

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , made with ❤️ by
                  <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
                </div>
                <div>
                  <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                  <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

                  <a
                    href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                    target="_blank"
                    class="footer-link me-4"
                    >Documentation</a
                  >

                  <a
                    href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                    target="_blank"
                    class="footer-link me-4"
                    >Support</a
                  >
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- <div class="buy-now">
      <a
        href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/"
        target="_blank"
        class="btn btn-danger btn-buy-now"
        >Upgrade to Pro</a
      >
    </div> -->

    

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>

<script>
            window.setTimeout(function() {
                $(".alert-dismissible").fadeTo(3500, 500).slideUp(500, function() {
                    $(".alert-dismissible").remove();
                });
            }, 3500);
</script>