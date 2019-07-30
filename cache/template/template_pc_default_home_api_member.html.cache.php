<?php if ($member) { ?>

<ul class="nav navbar-nav">
    <li class="dropdown dropdown-user dropdown-dark">
        <a href="<?php echo MEMBER_URL; ?>" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
            <span class="fc-member-name"><?php echo $member['username']; ?></span>
            <img class="img-circle fc-member-avatar" src="<?php echo dr_avatar($member['uid']); ?>">
        </a>
        <ul class="dropdown-menu dropdown-menu-default">
            <li>
                <a href="<?php echo MEMBER_URL; ?>"><i class="fa fa-user"></i> 用户中心 </a>
            </li>
            <li>
                <a href="<?php echo dr_member_url('account/index'); ?>">
                    <i class="fa fa-edit"></i> 我的资料 </a>
            </li>
            <li>
                <a href="<?php echo dr_member_url('account/password'); ?>">
                    <i class="fa fa-lock"></i> 修改密码 </a>
            </li>
            <li>
                <a href="<?php echo dr_member_url('account/avatar'); ?>">
                    <i class="fa fa-photo"></i> 上传头像
                </a>
            </li>
            <li class="divider"> </li>
            <li>
                <a href="javascript:;" onclick="dr_loginout('退出成功')">
                    <i class="fa fa-key"></i> 我要退出 </a>
            </li>
        </ul>
    </li>
</ul>

<?php } else { ?>
<div class="fc-login">
    <a href="<?php echo dr_member_url('register/index'); ?>" class="btn dark btn-outline btn-xs">用户注册</a>
    <a href="<?php echo dr_member_url('login/index'); ?>" class="btn blue btn-outline btn-xs">用户登录</a>
</div>
<?php } ?>