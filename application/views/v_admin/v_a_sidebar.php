 <!-- ============================================================== -->
 <!-- ============================================================== -->
 <!-- Left Sidebar - style you can find in sidebar.scss  -->
 <!-- ============================================================== -->
 <aside class="left-sidebar" data-sidebarbg="skin6">
     <!-- Sidebar scroll-->
     <div class="scroll-sidebar" data-sidebarbg="skin6">
         <!-- Sidebar navigation-->

         <?php if ($user['role_id'] == 1) { ?>
             <nav class="sidebar-nav">
                 <ul id="sidebarnav">
                     <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="<?= base_url() ?>admin" aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span class="hide-menu">Dashboard</span></a></li>
                     <li class="list-divider"></li>

                     <li class="nav-small-cap"><span class="hide-menu">Personalitation</span></li>

                     <li class="sidebar-item"> <a class="sidebar-link" href="<?= base_url() ?>admin/personalitation" aria-expanded="false"><i data-feather="user" class="feather-icon"></i><span class="hide-menu">My Profile</span></a>
                     </li>
                     <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false"><i data-feather="settings" class="feather-icon"></i><span class="hide-menu">Account Setting </span></a>
                         <ul aria-expanded="false" class="collapse  first-level base-level-line">
                             <li class="sidebar-item">
                                 <a href="<?= base_url() ?>admin/personalitation/deactive" class="sidebar-link"><span class="hide-menu">Deactive Account</span></a>
                             </li>
                             <li class="sidebar-item">
                                 <a href="<?= base_url() ?>admin/personalitation/change_password" class="sidebar-link"><span class="hide-menu">Change Password</span></a>
                             </li>
                         </ul>
                     </li>
                     <li class="list-divider"></li>
                     <li class="nav-small-cap"><span class="hide-menu">Users</span></li>
                     <li class="sidebar-item">
                         <a class="sidebar-link sidebar-link" href="<?= base_url() ?>admin/user" aria-expanded="false"><i class="feather-icon icon-people"></i><span class="hide-menu">All User</span></a>
                     </li>
                     <li class="list-divider"></li>

                     <li class="nav-small-cap"><span class="hide-menu">Expert System</span></li>

                     <li class="sidebar-item">
                         <a class="sidebar-link sidebar-link" href="<?= base_url() ?>admin/expert/iphone" aria-expanded="false"><i class=" fab fa-apple"></i><span class="hide-menu">iPhone Series</span></a>
                     </li>
                     <li class="sidebar-item">
                         <a class="sidebar-link sidebar-link" href="<?= base_url() ?>admin/expert/question" aria-expanded="false"><i class="icon-question"></i><span class="hide-menu">Question Table</span></a>
                     </li>
                     <li class="sidebar-item">
                         <a class="sidebar-link sidebar-link" href="<?= base_url() ?>admin/expert/rule" aria-expanded="false"><i class=" icon-list"></i><span class="hide-menu">Rule Table</span></a>
                     </li>
                     <li class="sidebar-item">
                         <a class="sidebar-link sidebar-link" href="<?= base_url() ?>admin/expert/damage" aria-expanded="false"><i class="icon-close"></i><span class="hide-menu">Damage Table</span></a>
                     </li>
                     <li class="sidebar-item">
                         <a class="sidebar-link sidebar-link" href="<?= base_url() ?>admin/expert/symtoms" aria-expanded="false"><i class=" icon-screen-smartphone"></i><span class="hide-menu">Symptoms Table</span></a>
                     </li>
                     <li class="sidebar-item">
                         <a class="sidebar-link sidebar-link" href="<?= base_url() ?>admin/ask" aria-expanded="false"><i class="icon-question"></i><span class="hide-menu">Try To Ask</span></a>
                     </li>
                 </ul>
             </nav>
         <?php } else { ?>
             <nav class="sidebar-nav">
                 <ul id="sidebarnav">
                     <li class="nav-small-cap"><span class="hide-menu">Personalitation</span></li>

                     <li class="sidebar-item"> <a class="sidebar-link" href="<?= base_url() ?>admin/personalitation" aria-expanded="false"><i data-feather="user" class="feather-icon"></i><span class="hide-menu">My Profile</span></a>
                     </li>
                     <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false"><i data-feather="settings" class="feather-icon"></i><span class="hide-menu">Account Setting </span></a>
                         <ul aria-expanded="false" class="collapse  first-level base-level-line">
                             <li class="sidebar-item">
                                 <a href="<?= base_url() ?>admin/personalitation/deactive" class="sidebar-link"><span class="hide-menu">Deactive Account</span></a>
                             </li>
                             <li class="sidebar-item">
                                 <a href="<?= base_url() ?>admin/personalitation/change_password" class="sidebar-link"><span class="hide-menu">Change Password</span></a>
                             </li>
                         </ul>
                     </li>
                     <li class="list-divider"></li>
                     <li class="sidebar-item">
                         <a class="sidebar-link sidebar-link" href="<?= base_url() ?>admin/ask" aria-expanded="false"><i class="icon-question"></i><span class="hide-menu">Try To Ask</span></a>
                     </li>
                 </ul>
             </nav>
         <?php } ?>
         <!-- End Sidebar navigation -->
     </div>
     <!-- End Sidebar scroll-->
 </aside>
 <!-- ============================================================== -->
 <!-- End Left Sidebar - style you can find in sidebar.scss  -->
 <!-- ============================================================== -->
 <!-- ============================================================== -->

 <!-- Page wrapper  -->
 <!-- ============================================================== -->
 <div class="page-wrapper">
     <!-- ============================================================== -->
     <!-- Bread crumb and right sidebar toggle -->
     <!-- ============================================================== -->
     <div class="page-breadcrumb">
         <div class="row">
             <div class="col-7 align-self-center">
                 <h3 class="page-title text-truncate text-dark font-weight-medium mb-1"><?= $breadcrumtext ?></h3>
                 <div class="d-flex align-items-center">
                     <nav aria-label="breadcrumb">
                         <ol class="breadcrumb m-0 p-0">
                             <li class="breadcrumb-item"><a href="<?= $url ?>"><?= $tittle ?></a>
                             </li>
                         </ol>
                     </nav>
                 </div>
             </div>
         </div>
     </div>
     <!-- ============================================================== -->
     <!-- End Bread crumb and right sidebar toggle -->
     <!-- ============================================================== -->
     <!-- ============================================================== -->
     <!-- Container fluid  -->
     <!-- ============================================================== -->
     <div class="container-fluid">