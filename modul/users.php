<?php if($_COOKIE['idgroup'] == 1) { ?>
    <h2>Добавить администратора</h2>
    <form action="./vendor/create-admin.php" method="post">
        <input type="text" name="login" placeholder="Логин" required>
        <input type="password" name="password" placeholder="Пароль" required>
        <input type="email" name="email" placeholder="Email" required>
        <button>Добавить</button>
    </form>
    <?php if(empty($_SESSION['errCreateAdm'])) {
        echo "";
    } else {
        echo $_SESSION['errCreateAdm'];
    } ?>
<?php } ?>
<?php if($_COOKIE['idgroup'] == 1) { ?>
    <h2>Список администраторов</h2>
    <ul class="list_admin">
        <?php
        $select_admins = mysqli_query($link, "SELECT `id`,`login` FROM `user` WHERE `idgroup` = '2' AND `blocked` = 0");
        $select_admins = mysqli_fetch_all($select_admins);
        foreach($select_admins as $sa) { ?>
            <li class="list_admin_item">
                <div class="user">
                    <p>Логин: <strong><?= $sa[1]; ?></strong></p>
                </div>
                <div class="block_user">
                    <a href="./vendor/block-admin.php?id=<?= $sa[0]; ?>">Заблокировать</a>
                </div>
            </li>
        <?php } ?>
    </ul>
<?php } ?>
<?php if($_COOKIE['idgroup'] == 2) { ?>
    <h2>Добавить агента</h2>
    <form action="./vendor/create-agent.php" method="post">
        <input type="text" name="login" placeholder="Логин" required>
        <input type="password" name="password" placeholder="Пароль" required>
        <input type="email" name="email" placeholder="Email" required>
        <button>Добавить</button>
    </form>
    <?php if(empty($_SESSION['errCreateAgent'])) {
        echo "";
    } else {
        echo $_SESSION['errCreateAgent'];
    } ?>
<?php } ?>
<?php if($_COOKIE['idgroup'] == 2) { ?>
    <h2>Список агентов</h2>
    <ul class="list_admin">
        <?php
        $select_agent = mysqli_query($link, "SELECT `id`,`login` FROM `user` WHERE `idgroup` = '3' AND `blocked` = 0");
        $select_agent = mysqli_fetch_all($select_agent);
        foreach($select_agent as $sag) { ?>
            <li class="list_admin_item">
                <div class="user">
                    <p>Логин: <strong><?= $sag[1]; ?></strong></p>
                </div>
                <div class="block_user">
                    <a href="./vendor/block-agent.php?id=<?= $sag[0]; ?>">Заблокировать</a>
                </div>
            </li>
        <?php } ?>
    </ul>
<?php } ?>