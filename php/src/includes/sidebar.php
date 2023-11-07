<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  <div class="dropdown">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html"> <?php if($_SESSION['login_type'] == 1): ?> <div class="sidebar-brand-text mx-3">Admin</div> <?php else: ?> <div class="sidebar-brand-text mx-3">User</div> <?php endif; ?> </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
      <a class="nav-link" href="index.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading"> Manage </div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Tasks</span>
      </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded"> <?php if($_SESSION['login_type'] != 3): ?> <a class="collapse-item" href="./index.php?page=new_project"> Add New </a> <?php endif; ?> <a class="collapse-item" href="./index.php?page=project_list"> List Tasks </a>
        </div>
      </div>
    </li> <?php if($_SESSION['login_type'] == 1): ?>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>Users</span>
      </a>
      <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="./index.php?page=new_user">Add New</a>
          <a class="collapse-item" href="./index.php?page=user_list">List Users</a>
        </div>
      </div>
    </li> <?php endif; ?>
</ul>