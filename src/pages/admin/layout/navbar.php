<?php if(isset($_SESSION['user']['id'])){ ?>
<div class="ui centered grid"  id='top-menu'>
    <div class="five wide column" id="mobile-menu">
        <i class="bars icon"></i>
    </div>
    <div class="six wide column">
        <img class="ui fluid image logo pt-2" src="<?= $site['base_url'] ?>/assets/img/login/logouniversidad.png" alt="">
    </div>
    <div class="five wide column" id="user-description">
        <a href="<?= $site['base_url'] ?>/perfil/">
        <span class="font-size-12 text-light"><?= $_SESSION['user']['nombre'] ?></span>
        <?= (isset($avatar) ? "<div class='user-avatar'><img src='" . $avatar . "' /></div>" : '<i class="user circle icon text-light"></i>') ?></a>
    </div>
</div>
<?php } ?>