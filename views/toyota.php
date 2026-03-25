<?php
    $is_image = $url == '/toyota/image';
    $is_info = $url == '/toyota/info';
?>

<h1>Toyota</h1>
<ul class="nav nav-pills">
  <li class="nav-item">
    <a class="nav-link <?= $is_image ? "active" : '' ?>" href="/toyota/image">
        Картинка
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/toyota/info">Информация</a>
  </li>
</ul>
<br>
<?php if ($is_image) { ?>
    <?php include('toyota_image.php') ?>
<?php } else if ($is_info) { ?>
    <?php include('toyota_info.php') ?>
<?php } ?>
