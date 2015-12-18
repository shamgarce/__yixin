<!-- header logo: style can be found in header.less -->
<header class="header">
      <a href="/admin/" class="logo">
            <!-- Add the class icon to your logo image or logo icon to add the margining -->
            GraceAdmin
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
            </a>
            <div class="navbar-right">
                  <ul class="nav navbar-nav">

                        <?php //W('head_message',[]);?>
                        <?php //W('head_notifications',[]);?>
                        <?php //W('head_tasks',[]);?>
                        <?php W('head_useraccount',[]);?>
                  </ul>
            </div>
      </nav>
</header>
        
        