<?php 
    if(isset($_SESSION['id'])) {
        $firstname = ucfirst($_SESSION['firstname']);
        $lastname = ucfirst($_SESSION['lastname']);
        $fullname = $firstname ." ".$lastname;
        $email = $_SESSION['email'];
    }
?>
<div class="page-sidebar">
    <div class="page-sidebar-inner">
        <div class="page-sidebar-profile">
            <div class="sidebar-profile-image">
                <img src="assets/images/avatars/avatar1.png">
            </div>
            <div class="sidebar-profile-info">
                <a href="javascript:void(0);" class="account-settings-link">
                    <?php if ($_SESSION['id'] && $_SESSION['email']): ?>
                        <p><?= $fullname; ?></p>
                        <span><?= $email; ?><i class="material-icons float-right">arrow_drop_down</i></span>
                    <?php endif ?>
                </a>
            </div>
        </div>
        <div class="page-sidebar-menu">
            <div class="page-sidebar-settings hidden">
                <ul class="sidebar-menu list-unstyled">
                    <li><a href="mailbox.php" class="waves-effect waves-grey"><i class="material-icons">inbox</i>Inbox</a></li>
                    <li><a href="#" class="waves-effect waves-grey"><i class="material-icons">star_border</i>Starred</a></li>
                    <li><a href="#" class="waves-effect waves-grey"><i class="material-icons">done</i>Sent Mail</a></li>
                    <li><a href="#" class="waves-effect waves-grey"><i class="material-icons">history</i>History</a></li>
                    <li class="divider"></li>
                    <li><a href="../../api/auth/logout.php" class="waves-effect waves-grey"><i class="material-icons">exit_to_app</i>Sign Out</a></li>
                </ul>
            </div>
            <div class="sidebar-accordion-menu">
                <ul class="sidebar-menu list-unstyled">
                    <li>
                        <a href="dashboard.php" class="waves-effect waves-grey active">
                            <i class="material-icons">apps</i>Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="live.php" class="waves-effect waves-grey" id="add_genre_page">
                            <i class="material-icons">videocam</i>Video
                        </a>
                    </li>
                    <li>
                        <a href="mailbox.php" class="waves-effect waves-grey">
                            <i class="material-icons">email</i>Messages
                            <span style="border-radius: 50%;background-color: #ff8f00;color: #fff;" class="badge badge-danger"><?php if ($messageNum) { echo $messageNum; } ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="faq.php" class="waves-effect waves-grey" id="add_genre_page">
                            <i class="material-icons">forum</i>FAQs
                        </a>
                    </li>
                    <li>
                        <a href="chat.php" class="waves-effect waves-grey" id="add_genre_page">
                            <i class="material-icons">chat</i>Chat
                        </a>
                    </li>
                    <!-- <li>
                        <a href="#" class="waves-effect waves-grey">
                            <i class="material-icons">person_add_alt_1</i> Admin<i class="material-icons sub-arrow">keyboard_arrow_right</i>
                        </a>
                        <ul class="accordion-submenu list-unstyled">
                            <li><a href="javascript:void(0);" id="add_admin_modal">Add Admin</a></li>
                            <li><a href="all-admin.php" id="all_admin_modal">All Admin</a></li>
                        </ul>
                    </li> -->
                    
                </ul>
            </div>
        </div>
        <div class="sidebar-footer">
            <p class="copyright">Stacks ©</p>
            <a href="#!">Privacy</a> &amp; <a href="#!">Terms</a>
        </div>
    </div>
</div><!-- Left Sidebar -->