<aside class="main-sidebar elevation-4 sidebar-light-olive">
    <!-- Brand Logo -->
    <a href="<?= base_url(); ?>/index3.html" class="brand-link navbar-olive text-sm">
        <img src="<?= base_url(); ?>/public/dist/img/emblem.png" alt="Logo" class="brand-image">
        <span class="brand-text font-weight-light w3-text-white text-white text-lg-center"><strong><big>S</big><small>ingle</small> <big>W</big><small>indow</small> <big>P</big><small>ortal</small> - DDD</strong></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php if (session()->has('userPicUrl')) {
    echo(session()->get('userPicUrl'));
} else {
    echo(base_url() . '/public/dist/img/ddd_logo.png');
} ?>" class="" alt="User Image" />
            </div>
            <div class="info">
                <a href="<?= base_url(); ?>/dashboard" class="d-block"><?php if (session()->has('userName')) {
    echo(session()->get('userName'));
} ?></a>
                <p style="margin:0; outline: 0; border: 0; padding: 0;"><?php if (session()->has('userEmail')) {
    echo(session()->get('userEmail'));
} else if (session()->has('userContact')) {
    echo(session()->get('userContact'));
} else {
    
} ?></p>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
              <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-sidebar">
                  <i class="fas fa-search fa-fw"></i>
                </button>
              </div>
            </div>
          </div> -->

        <!-- Sidebar Menu -->

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-collapse-hide-child nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                       with font-awesome or any other icon font library -->
<?php if (session()->has('userRole')): ?>
    <?php if (intval(session()->get('userRole')) == 10): ?>
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>/user-dashboard" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>/service-list" class="nav-link">
                                <i class="nav-icon fas fa-tags"></i>
                                <p>
                                    Service List
                                </p>
                            </a>
                        </li>
    <?php endif; ?>
    <?php if (intval(session()->get('userRole')) == 50): ?>
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>/officer-dashboard" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
    <?php endif; ?>
<?php endif; ?>

                <!--        <li class="nav-item">
                          <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                              Land Section
                              <i class="right fas fa-angle-left"></i>
                            </p>
                          </a>
                          <ul class="nav nav-treeview">
                            <li class="nav-item">
                              <a href="<?= base_url(); ?>/na-permission-form" class="nav-link">
                                <i class="far fa-circle nav-icon text-danger"></i>
                                <p>NA Permission</p>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="<?= base_url(); ?>/sale-permission-form" class="nav-link">
                                <i class="far fa-circle nav-icon text-warning"></i>
                                <p>Sale Permission</p>
                              </a>
                            </li>
                
                            <li class="nav-item">
                              <a href="<?= base_url(); ?>/gift-permission-form" class="nav-link">
                                <i class="far fa-circle nav-icon text-primary"></i>
                                <p>Gift Permission</p>
                              </a>
                            </li>
                          </ul>
                        </li>-->

                <!--        <li class="nav-item">
                          <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-cake-candles"></i>
                            <p>
                              Birth
                              <i class="right fas fa-angle-left"></i>
                            </p>
                          </a>
                          <ul class="nav nav-treeview">
                            <li class="nav-item">
                              <a href="<?= base_url(); ?>/f-new-birth" class="nav-link">
                                <i class="far fa-circle nav-icon text-danger"></i>
                                <p>New Birth</p>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="<?= base_url(); ?>/f-teor-birth" class="nav-link">
                                <i class="far fa-circle nav-icon text-warning"></i>
                                <p>Teor Birth</p>
                              </a>
                            </li>
                
                            <li class="nav-item">
                              <a href="<?= base_url(); ?>/f-certificate-birth" class="nav-link">
                                <i class="far fa-circle nav-icon text-primary"></i>
                                <p>Birth</p>
                              </a>
                            </li>
                          </ul>
                        </li>-->



                <!--        <li class="nav-item">
                          <a href="<?= base_url(); ?>/pda-dashboard" class="nav-link">
                            <i class="nav-icon fas fa-tachometer"></i>
                            <p>
                              Department Dashboard
                            </p>
                          </a>
                        </li>
                        
                <!-- <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                      <i class="nav-icon fas fa-tachometer-alt"></i>
                      <p>
                        Dashboard
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/" class="nav-link active">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Dashboard v1</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/2" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Dashboard v2</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/3" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Dashboard v3</p>
                        </a>
                      </li>
                    </ul>
                  </li> -->
                <!-- <li class="nav-item">
                    <a href="<?= base_url(); ?>/public/pages/widgets.html" class="nav-link">
                      <i class="nav-icon fas fa-th"></i>
                      <p>
                        Widgets
                        <span class="right badge badge-danger">New</span>
                      </p>
                    </a>
                  </li> -->
                <!-- <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-copy"></i>
                      <p>
                        Layout Options
                        <i class="fas fa-angle-left right"></i>
                        <span class="badge badge-info right">6</span>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/layout/top-nav.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Top Navigation</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/layout/top-nav-sidebar.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Top Navigation + Sidebar</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/layout/boxed.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Boxed</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/layout/fixed-sidebar.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Fixed Sidebar</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/layout/fixed-sidebar-custom.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Fixed Sidebar <small>+ Custom Area</small></p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/layout/fixed-topnav.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Fixed Navbar</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/layout/fixed-footer.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Fixed Footer</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/layout/collapsed-sidebar.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Collapsed Sidebar</p>
                        </a>
                      </li>
                    </ul>
                  </li> -->
                <!-- <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-chart-pie"></i>
                      <p>
                        Charts
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/charts/chartjs.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>ChartJS</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/charts/flot.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Flot</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/charts/inline.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Inline</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/charts/uplot.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>uPlot</p>
                        </a>
                      </li>
                    </ul>
                  </li> -->
                <!-- <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-tree"></i>
                      <p>
                        UI Elements
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/UI/general.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>General</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/UI/icons.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Icons</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/UI/buttons.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Buttons</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/UI/sliders.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Sliders</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/UI/modals.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Modals & Alerts</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/UI/navbar.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Navbar & Tabs</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/UI/timeline.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Timeline</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/UI/ribbons.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Ribbons</p>
                        </a>
                      </li>
                    </ul>
                  </li> -->
                <!-- <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-edit"></i>
                      <p>
                        Forms
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/forms/general.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>General Elements</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/forms/advanced.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Advanced Elements</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/forms/editors.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Editors</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/forms/validation.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Validation</p>
                        </a>
                      </li>
                    </ul>
                  </li> -->
                <!-- <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-table"></i>
                      <p>
                        Tables
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/tables/simple.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Simple Tables</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/tables/data.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>DataTables</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/tables/jsgrid.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>jsGrid</p>
                        </a>
                      </li>
                    </ul>
                  </li> -->
                <!-- <li class="nav-header">EXAMPLES</li>
                  <li class="nav-item">
                    <a href="<?= base_url(); ?>/public/pages/calendar.html" class="nav-link">
                      <i class="nav-icon far fa-calendar-alt"></i>
                      <p>
                        Calendar
                        <span class="badge badge-info right">2</span>
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url(); ?>/public/pages/gallery.html" class="nav-link">
                      <i class="nav-icon far fa-image"></i>
                      <p>
                        Gallery
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url(); ?>/public/pages/kanban.html" class="nav-link">
                      <i class="nav-icon fas fa-columns"></i>
                      <p>
                        Kanban Board
                      </p>
                    </a>
                  </li> -->
                <!-- <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon far fa-envelope"></i>
                      <p>
                        Mailbox
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/mailbox/mailbox.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Inbox</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/mailbox/compose.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Compose</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/mailbox/read-mail.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Read</p>
                        </a>
                      </li>
                    </ul>
                  </li> -->
                <!-- <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-book"></i>
                      <p>
                        Pages
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/examples/invoice.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Invoice</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/examples/profile.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Profile</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/examples/e-commerce.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>E-commerce</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/examples/projects.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Projects</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/examples/project-add.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Project Add</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/examples/project-edit.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Project Edit</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/examples/project-detail.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Project Detail</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/examples/contacts.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Contacts</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/examples/faq.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>FAQ</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/examples/contact-us.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Contact us</p>
                        </a>
                      </li>
                    </ul>
                  </li> -->
                <!-- <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon far fa-plus-square"></i>
                      <p>
                        Extras
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>
                            Login & Register v1
                            <i class="fas fa-angle-left right"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="<?= base_url(); ?>/public/pages/examples/login.html" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Login v1</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="<?= base_url(); ?>/public/pages/examples/register.html" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Register v1</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="<?= base_url(); ?>/public/pages/examples/forgot-password.html" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Forgot Password v1</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="<?= base_url(); ?>/public/pages/examples/recover-password.html" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Recover Password v1</p>
                            </a>
                          </li>
                        </ul>
                      </li> -->
                <!-- <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>
                            Login & Register v2
                            <i class="fas fa-angle-left right"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="<?= base_url(); ?>/public/pages/examples/login-v2.html" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Login v2</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="<?= base_url(); ?>/public/pages/examples/register-v2.html" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Register v2</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="<?= base_url(); ?>/public/pages/examples/forgot-password-v2.html" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Forgot Password v2</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="<?= base_url(); ?>/public/pages/examples/recover-password-v2.html" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Recover Password v2</p>
                            </a>
                          </li>
                        </ul>
                      </li> -->
                <!-- <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/examples/lockscreen.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Lockscreen</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/examples/legacy-user-menu.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Legacy User Menu</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/examples/language-menu.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Language Menu</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/examples/404.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Error 404</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/examples/500.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Error 500</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/examples/pace.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Pace</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/examples/blank.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Blank Page</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/starter.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Starter Page</p>
                        </a>
                      </li>
                    </ul>
                  </li> -->
                <!-- <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-search"></i>
                      <p>
                        Search
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/search/simple.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Simple Search</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= base_url(); ?>/public/pages/search/enhanced.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Enhanced</p>
                        </a>
                      </li>
                    </ul>
                  </li> -->
                <!-- <li class="nav-header">MISCELLANEOUS</li>
                  <li class="nav-item">
                    <a href="iframe.html" class="nav-link">
                      <i class="nav-icon fas fa-ellipsis-h"></i>
                      <p>Tabbed IFrame Plugin</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url(); ?>/public/https://adminlte.io/docs/3.1/" class="nav-link">
                      <i class="nav-icon fas fa-file"></i>
                      <p>Documentation</p>
                    </a>
                  </li> -->
                <!-- <li class="nav-header">MULTI LEVEL EXAMPLE</li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="fas fa-circle nav-icon"></i>
                      <p>Level 1</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-circle"></i>
                      <p>
                        Level 1
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Level 2</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>
                            Level 2
                            <i class="right fas fa-angle-left"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="#" class="nav-link">
                              <i class="far fa-dot-circle nav-icon"></i>
                              <p>Level 3</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link">
                              <i class="far fa-dot-circle nav-icon"></i>
                              <p>Level 3</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link">
                              <i class="far fa-dot-circle nav-icon"></i>
                              <p>Level 3</p>
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Level 2</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="fas fa-circle nav-icon"></i>
                      <p>Level 1</p>
                    </a>
                  </li>
                  <li class="nav-header">LABELS</li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon far fa-circle text-danger"></i>
                      <p class="text">Important</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon far fa-circle text-warning"></i>
                      <p>Warning</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon far fa-circle text-info"></i>
                      <p>Informational</p>
                    </a>
                  </li>
                </ul> -->
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>