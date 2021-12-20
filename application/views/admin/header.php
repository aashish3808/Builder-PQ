<style>

.heading__bg {
    
    background: #a757ea !important;
}
</style>
<header class="page-header">
    <div class="page-header__inner">
        <a href="<?php echo base_url(); ?>" class="page-header__logo">
           <img src="https://purplequarter.com/wp-content/uploads/2021/05/Purple-Quarter-Logo.png" style="
    width: 258px;
" />
        </a>
        <div class="page-header__navigation" id="page-header__navigation">
            <svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" id="page-header__menu__button--open" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 0h24v24H0z" fill="none"></path>
                <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"></path>
            </svg>
            <svg class="page-header__menu__button page-header__menu__button--close" id="page-header__menu__button--close" fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path>
                <path d="M0 0h24v24H0z" fill="none"></path>
            </svg>
            <ul class="page-header__menu">

                <?php if (@$admin_user->id) { ?>
                    <li class="page-header__menu__item"><a class="active" aria-current="page" href="<?php echo base_url();?>">Dashboard</a> | </li>
                    <li class="page-header__menu__item"><a class="active" aria-current="page" href="<?php echo base_url();?>preview">Preview Resume Template</a> | </li>

                     <?php if($user_group_id == 1) { ?>
                    <li class="page-header__menu__item"><a class="active" aria-current="page" href="<?php echo base_url();?>myaccount/listing">All Employee List</a> | </li>      
                     <?php } ?>   
                    <li class="page-header__menu__item"><a class="active" aria-current="page" href="<?php echo base_url();?>myaccount">Update Profile Detail</a> | </li>
                    <li class="page-header__menu__item"><a href="<?php echo base_url();?>myaccount/changepassword">Change Password</a> | </li>
                    <li class="page-header__menu__item"><a href="<?php echo base_url();?>authentication/logout">Log Out</a></li>
                <?php } else { ?>
                    <li class="page-header__menu__item"><a class="active" aria-current="page" href="<?php echo base_url();?>authentication/add">New Employee Signup</a> | </li>
                    <li class="page-header__menu__item"><a href="<?php echo base_url();?>authentication">Log In</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</header>