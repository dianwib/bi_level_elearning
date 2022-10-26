<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title><?= ucfirst(@$this->uri->segment(1)) ?> <?= ucfirst(@$this->uri->segment(2)) ?></title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="<?= base_url('res/assets/theme1/assets/img/favicon/favicon.ico') ?>" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="<?= base_url('res/assets/theme1/assets/vendor/fonts/boxicons.css') ?>" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="<?= base_url('res/assets/theme1/assets/vendor/css/core.css') ?>" class="template-customizer-core-css" />
  <link rel="stylesheet" href="<?= base_url('res/assets/theme1/assets/vendor/css/theme-default.css') ?>" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="<?= base_url('res/assets/theme1/assets/css/demo.css') ?>" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="<?= base_url('res/assets/theme1/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') ?>" />

  <link rel="stylesheet" href="<?= base_url('res/assets/theme1/assets/vendor/libs/apex-charts/apex-charts.css') ?>" />

  <!-- Page CSS -->

  <!-- Helpers -->
  <script src="<?= base_url('res/assets/theme1/assets/vendor/js/helpers.js') ?>"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="<?= base_url('res/assets/theme1/assets/js/config.js') ?>"></script>

  <!-- Core JS -->
  <script src="<?= base_url('res/assets/theme1/assets/vendor/libs/jquery/jquery.js') ?>"></script>
  <script src="<?= base_url('res/assets/theme1/assets/vendor/libs/popper/popper.js') ?>"></script>
  <script src="<?= base_url('res/assets/theme1/assets/vendor/js/bootstrap.js') ?>"></script>
  <script src="<?= base_url('res/assets/theme1/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') ?>"></script>

  <script src="<?= base_url('res/assets/theme1/assets/vendor/js/menu.js') ?>"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="<?= base_url('res/assets/theme1/assets/vendor/libs/apex-charts/apexcharts.js') ?>"></script>

  <!-- Main JS -->
  <script src="<?= base_url('res/assets/theme1/assets/js/main.js') ?>"></script>

  <!-- Page JS -->
  <script src="<?= base_url('res/assets/theme1/assets/js/dashboards-analytics.js') ?>"></script>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
</head>