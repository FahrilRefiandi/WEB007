



<nav id="sidebar" aria-label="Main Navigation">
  <!-- Side Header -->
  <div class="content-header">
    <!-- Logo -->
    <a class="fw-semibold text-dual" href="<?=url('/admin/dashboard')?>">
      <span class="smini-visible">
        <i class="bi bi-layout-sidebar text-primary"></i>
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
          <a class="nav-main-link" href="<?=url('/admin/dashboard')?>">
            <i class="nav-main-link-icon si si-speedometer"></i>
            <span class="nav-main-link-name">Dashboard</span>
          </a>
        </li>
        <li class="nav-main-item">
          <a class="nav-main-link" href="<?=url('/admin/course')?>">
            <i class="nav-main-link-icon bi bi-book"></i>
            <span class="nav-main-link-name">Course</span>
          </a>
        </li>
        <li class="nav-main-heading">Management</li>
        <li class="nav-main-item">
          <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
          <i class="nav-main-link-icon bi bi-person-circle"></i>  
            <span class="nav-main-link-name">User</span>
          </a>
          <ul class="nav-main-submenu">
          <li class="nav-main-item">
              <a class="nav-main-link" href="<?=url('/admin/users')?>">
                <span class="nav-main-link-name">Lihat Semua</span>
              </a>
            </li>
            <li class="nav-main-item">
              <a class="nav-main-link" href="<?=url('/admin/users?filter=admin')?>">
                <span class="nav-main-link-name">Admin</span>
              </a>
            </li>
            <li class="nav-main-item">
              <a class="nav-main-link" href="<?=url('/admin/users?filter=mentor')?>">
                <span class="nav-main-link-name">Mentor</span>
              </a>
            </li>
            <li class="nav-main-item">
              <a class="nav-main-link" href="<?=url('/admin/users?filter=student')?>">
                <span class="nav-main-link-name">Student</span>
              </a>
            </li>
          </ul>
        </li> 
        <li class="nav-main-item">
          <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">  
          <i class="nav-main-link-icon bi bi-book"></i>
            <span class="nav-main-link-name">Course</span>
          </a>
          <ul class="nav-main-submenu">
            <li class="nav-main-item">
              <a class="nav-main-link" href="<?=url('/admin/course')?>">
                <span class="nav-main-link-name">Course</span>
              </a>
            </li>
            <li class="nav-main-item">
              <a class="nav-main-link" href="<?=url('/admin/materi')?>">
                <span class="nav-main-link-name">Materi</span>
              </a>
            </li>
          </ul>
        </li>
        
    </div>
    <!-- END Side Navigation -->
  </div>
  <!-- END Sidebar Scrolling -->
</nav>