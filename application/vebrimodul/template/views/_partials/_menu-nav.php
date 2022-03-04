<!--MAIN NAVIGATION-->
<!--===================================================-->
<nav id="mainnav-container">
    <div id="mainnav">

        <!--Menu-->
        <!--================================-->
        <div id="mainnav-menu-wrap">
            <div class="nano">
                <div class="nano-content">

                    <!--Profile Widget-->
                    <!--================================-->
                    <div id="mainnav-profile" class="mainnav-profile">
                        <div class="profile-wrap text-center">
                            <div class="pad-btm">
                                <?php if ($this->session->userdata('image') == "default.jpg") { ?>
                                    <img class="img-circle img-md" src="<?php echo base_url("assets/img/user_default.jpg") ?>" alt="Profile Picture">
                                <?php } else { ?>
                                    <img class="img-circle img-md" src="<?php echo base_url('assets/upload/images/user_management/') ?><?php echo $this->session->userdata('image') ?>" alt="Profile Picture">
                                <?php } ?>
                            </div>
                            <a href="#profile-nav" class="box-block" data-toggle="collapse" aria-expanded="false">
                                <span class="pull-right dropdown-toggle">
                                    <i class="dropdown-caret"></i>
                                </span>
                                <p class="mnp-name"><?php echo $this->session->userdata('name') ?></p>
                                <span class="mnp-desc"><?php echo $this->session->userdata('email') ?></span>
                            </a>
                        </div>
                        <div id="profile-nav" class="collapse list-group bg-trans">
                            <a href="<?php echo base_url('profile') ?>" class="list-group-item">
                                <i class="demo-pli-male icon-lg icon-fw"></i> View Profile
                            </a>
                            <a href="<?php echo base_url('setting') ?>" class="list-group-item">
                                <i class="demo-pli-gear icon-lg icon-fw"></i> Settings
                            </a>
                            <a href="<?php echo base_url('login/logout') ?>" class="list-group-item">
                                <i class="demo-pli-unlock icon-lg icon-fw"></i> Logout
                            </a>
                        </div>
                    </div>

                    <ul id="mainnav-menu" class="list-group">

                        <!--Category name-->
                        <li class="list-header">Menu</li>

                        <!--Dashboard Menu-->
                        <?php if ($this->uri->segment('1') == 'dashboard') { ?>
                            <li class="active-link">
                                <a href="<?php echo base_url('dashboard') ?>">
                                    <i class="demo-pli-home"></i>
                                    <span class="menu-title">Dashboard</span>
                                </a>
                            </li>
                        <?php } else { ?>
                            <li>
                                <a href="<?php echo base_url('dashboard') ?>">
                                    <i class="demo-pli-home"></i>
                                    <span class="menu-title">Dashboard</span>
                                </a>
                            </li>
                        <?php } ?>

                        <!--Data Inventory-->
                        <?php if ($this->uri->segment('1') == 'inventory') { ?>
                            <li class="active-link">
                                <a href="<?php echo base_url('inventory') ?>">
                                    <i class="ti-bookmark-alt"></i>
                                    <span class="menu-title">Inventory</span>
                                </a>
                            </li>
                        <?php } else { ?>
                            <li>
                                <a href="<?php echo base_url('inventory') ?>">
                                    <i class="ti-bookmark-alt"></i>
                                    <span class="menu-title">Inventory</span>
                                </a>
                            </li>
                        <?php } ?>

                        <li class="list-divider"></li>

                        <!-- Profile Menu -->
                        <?php if ($this->uri->segment('1') == 'profile') { ?>
                            <li class="active-link">
                                <a href="<?php echo base_url('profile') ?>">
                                    <i class="ti-id-badge"></i>
                                    <span class="menu-title">Profile</span>
                                </a>
                            </li>
                        <?php } else { ?>
                            <li>
                                <a href="<?php echo base_url('profile') ?>">
                                    <i class="ti-id-badge"></i>
                                    <span class="menu-title">Profile</span>
                                </a>
                            </li>
                        <?php } ?>

                        <!-- User Management Menu -->
                        <?php if ($this->uri->segment('1') == 'user_management') { ?>
                            <li class="active-link">
                                <a href="<?php echo base_url('user_management') ?>">
                                    <i class="ti-agenda"></i>
                                    <span class="menu-title">User Management</span>
                                </a>
                            </li>
                        <?php } else { ?>
                            <li>
                                <a href="<?php echo base_url('user_management') ?>">
                                    <i class="ti-agenda"></i>
                                    <span class="menu-title">User Management</span>
                                </a>
                            </li>
                        <?php } ?>

                        <!-- Setting Menu -->
                        <?php if ($this->uri->segment('1') == 'setting') { ?>
                            <li class="active-link">
                                <a href="<?php echo base_url('setting') ?>">
                                    <i class="ti-settings"></i>
                                    <span class="menu-title">Setting</span>
                                </a>
                            </li>
                        <?php } else { ?>
                            <li>
                                <a href="<?php echo base_url('setting') ?>">
                                    <i class="ti-settings"></i>
                                    <span class="menu-title">Setting</span>
                                </a>
                            </li>
                        <?php } ?>


                    </ul>

                </div>
            </div>
        </div>
        <!--================================-->
        <!--End menu-->

    </div>
</nav>
<!--===================================================-->
<!--END MAIN NAVIGATION-->