<?php
    $is_image = $url == '/honda/image';
    $is_info = $url == '/honda/info';
?>

<h1>Honda</h1>
<ul class="nav nav-pills">
  <li class="nav-item">
    <a class="nav-link <?= $is_image ? "active" : '' ?>" href="/honda/image">
        Картинка
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/honda/info">Информация</a>
  </li>
</ul>
<br>
<?php if ($is_image) { ?>
    <?php include('honda_image.php') ?>
<?php } else if ($is_info) { ?>
    <?php include('honda_info.php') ?>
<?php } ?>
