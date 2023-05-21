<?php if($_COOKIE['idgroup'] == 2) { ?>
    <h2>Добавить материал</h2>
    <form action="./vendor/create-material.php" method="post">
        <input type="text" name="name" placeholder="Название" required>
        <button>Добавить</button>
    </form>
    <?php if(empty($_SESSION['errCreateMat'])) {
        echo "";
    } else {
        echo $_SESSION['errCreateMat'];
    } ?>
<?php } ?>
<?php if($_COOKIE['idgroup'] == 2) { ?>
    <h2>Добавить продукт</h2>
    <form action="./vendor/create-product.php" method="post" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Название" required>
        <br>
        <p>Материалы: </p>
        <?php 
        $select_mateials = mysqli_query($link, "SELECT * FROM `material`");
        $select_mateials = mysqli_fetch_all($select_mateials);

        foreach($select_mateials as $sm) { ?>
            <input type="checkbox" name="materials[]" value="<?= $sm[1] ?>"><?= $sm[1] ?>
            <br>
        <?php } ?>
        <br>
        <input type="text" name="quantity" placeholder="Количество на складе" required>
        <br><br>
        <input type="file" name="product_img">
        <br><br>
        <button>Добавить</button>
    </form>
    <?php if(empty($_SESSION['errCreateMat'])) {
        echo "";
    } else {
        echo $_SESSION['errCreateMat'];
    } ?>
<?php } ?>