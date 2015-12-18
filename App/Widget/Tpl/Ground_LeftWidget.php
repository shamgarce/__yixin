<?php
$username = bus('user')['nickname'];
if(!$username)$username = bus('user')['truename'];
$pic = bus('user')['pic'];
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="left-side sidebar-offcanvas">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                  <div class="pull-left image">
                        <img src="<?php echo $pic;?>" class="img-circle" alt="User Image" />
                  </div>
                  <div class="pull-left info">
                        <p>Hello,<?php echo $username;?></p>

                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                  </div>
            </div>

            <!-- search form -
            ->
            <form action="#" method="get" class="sidebar-form">
                  <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                  </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                  <li>
                        <a href="/admin/main/">
                              <i class="fa fa-th"></i> <span>Ground</span> <small class="badge pull-right bg-green">main</small>
                        </a>
                  </li>

                  <!-- 系统设置 -->
                  <li class="treeview active">
                        <a href="javascript:void(0)">
                              <i class="fa fa-table"></i> <span>Set</span>
                              <i class="fa fa-angle-left pull-right"></i>
                        </a>
                  <ul class="treeview-menu">
                              <li><a href="/admin/set/geter/"><i class="fa fa-angle-double-right"></i> Geter </a></li>
                              <li><a href="/admin/set/middleware/"><i class="fa fa-angle-double-right"></i> Middleware </a></li>
                              <li><a href="/admin/set/widget/"><i class="fa fa-angle-double-right"></i> Widget </a></li>
                              <li><a href="/admin/set/mcae/"><i class="fa fa-angle-double-right"></i> Mcae </a></li>
                              <li><a href="/admin/set/menu/"><i class="fa fa-angle-double-right"></i> Menu </a></li>
                        </ul>
                  </li>
                  <!-- 系统设置 -->

            </ul>
      </section>
      <!-- /.sidebar -->
</aside>
