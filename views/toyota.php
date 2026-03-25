<?php
    $is_image = $url == '/toyota/image';
    $is_info = $url == '/toyota/info';
?>

<h1>Toyota</h1>
<a href="/toyota/image">Картинка</a>
<a href="/toyota/info">Информация</a>
<br>
<?php if ($is_image) { ?>
    <?php include('toyota_image.php') ?>
<?php } else if ($is_info) { ?>
    <?php include('toyota_info.php') ?>
<?php } ?>