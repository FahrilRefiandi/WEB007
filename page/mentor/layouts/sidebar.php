



<nav id="sidebar" aria-label="Main Navigation">
  <!-- Side Header -->
  <div class="content-header">
    <!-- Logo -->
    <a class="fw-semibold text-dual" href="<?=url('/student/dashboard')?>">
      <span class="smini-visible">
        <i class="fa fa-circle-notch text-primary"></i>
      </span>
      <span class="smini-hide fs-5 tracking-wider">Kasipaham</span>
    </a>
    <!-- END Logo -->

    <!-- Extra -->
    <div>
      <!-- Dark Mode -->
      <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
      <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="layout" data-action="dark_mode_toggle">
        <i class="far fa-moon"></i>
      </button>
      <!-- END Dark Mode -->

      <!-- Close Sidebar, Visible only on mobile screens -->
      <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
      <a class="d-lg-none btn btn-sm btn-alt-secondary ms-1" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
        <i class="fa fa-fw fa-times"></i>
      </a>
      <!-- END Close Sidebar -->
    </div>
    <!-- END Extra -->
  </div>
  <!-- END Side Header -->

  <!-- Sidebar Scrolling -->
  <div class="js-sidebar-scroll">
    <!-- Side Navigation -->
    <div class="content-side">
      <ul class="nav-main">
        <li class="nav-main-item">
          <a class="nav-main-link" href="<?=url('/student/dashboard')?>">
            <i class="nav-main-link-icon si si-speedometer"></i>
            <span class="nav-main-link-name">Dashboard</span>
          </a>
        </li>
        <li class="nav-main-item">
          <a class="nav-main-link" href="<?=url('/student/course')?>">
            <i class="nav-main-link-icon bi bi-book"></i>
            <span class="nav-main-link-name">Course</span>
          </a>
        </li>
        <li class="nav-main-heading">Fitur</li>
        <li class="nav-main-item">
          <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">  
          <i class="nav-main-link-icon bi bi-book"></i>
            <span class="nav-main-link-name">Course</span>
          </a>
          <ul class="nav-main-submenu">
            <li class="nav-main-item">
              <a class="nav-main-link" href="<?=url('/student/course')?>">
                <span class="nav-main-link-name">Course</span>
              </a>
            </li>
            <li class="nav-main-item">
              <a class="nav-main-link" href="<?=url('/student/materi')?>">
                <span class="nav-main-link-name">Materi</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-main-item">
          <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
          <i class="nav-main-link-icon bi bi-pc-display"></i>  
            <span class="nav-main-link-name">Try Out</span>
          </a>
          <ul class="nav-main-submenu">
            <li class="nav-main-item">
              <a class="nav-main-link" href="be_widgets_tiles.html">
                <span class="nav-main-link-name">Tambah</span>
              </a>
            </li>
            <li class="nav-main-item">
              <a class="nav-main-link" href="<?=url('/student/tryout')?>">
                <span class="nav-main-link-name">Lihat</span>
              </a>
            </li>
            <li class="nav-main-item">
              <a class="nav-main-link" href="be_widgets_stats.html">
                <span class="nav-main-link-name">Perbarui</span>
              </a>
            </li>
            <li class="nav-main-item">
              <a class="nav-main-link" href="be_widgets_blog.html">
                <span class="nav-main-link-name">Hapus</span>
              </a>
            </li>
          </ul>
        </li>
    </div>
    <!-- END Side Navigation -->
  </div>
  <!-- END Sidebar Scrolling -->
</nav>