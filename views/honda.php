<?php
    $is_image = $url == '/honda/image';
    $is_info = $url == '/honda/info';
?>

<h1>Honda</h1>
<a href="/honda/image">Картинка</a>
<a href="/honda/info">Информация</a>
<br>
<?php if ($is_image) { ?>
    <?php include('honda_image.php') ?>
<?php } else if ($is_info) { ?>
    <?php include('honda_info.php') ?>
<?php } ?>