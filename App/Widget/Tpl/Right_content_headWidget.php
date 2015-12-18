<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>
            <?php echo bus('mcae')['name'];?>
      <small><?php echo bus('mcae')['des'];?></small>
      </h1>
      <ol class="breadcrumb">
            <?php
                  $list = bus('path');
                  $res = current($list);
                  $url = "/admin/{$res['controller']}/{$res['action']}/";
                  array_shift($list);
            ?>
            <li><a href="<?php echo $url; ?>"><i class="fa fa-dashboard"></i> <?php echo $res['name'];?></a></li>
<?php
foreach($list as $res){
      if($res['controller'] == bus('router')['c'] && $res['action'] = bus('router')['a']){$active = 'active';}
      echo '<li class="'.$active.'"><a href="'."/admin/{$res['controller']}/{$res['action']}/".'">'.$res['name'].'</a></li>';
}
?>

      </ol>
</section>