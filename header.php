<?php
  /**
   * Header
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: header.php, v1.00 2011-11-10 10:12:05 gewa Exp $
   */
  
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>:: <?php echo $core->company;?> - Registered ::</title>
	<script language="javascript" type="text/javascript">
		var SITEURL = "<?php echo SITEURL; ?>";
	</script>
	
    <meta name="author" content="a2ngsa" />
    <meta name="description" content="SIM Diklat PPPPTK BMTI Bandung" />
    <meta name="keywords" content="SIM Diklat, PPPPTK BMTI, Bandung" />
    <meta name="application-name" content="SIM Diklat PPPPTK BMTI Bandung" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Le styles -->

    <!-- Use new way for google web fonts 
    http://www.smashingmagazine.com/2012/07/11/avoiding-faux-weights-styles-google-web-fonts -->
	
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css' /> <!-- Headings -->
    <link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css' /> <!-- Text -->
	
    <!--[if lt IE 9]>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:700" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Droid+Sans:400" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Droid+Sans:700" rel="stylesheet" type="text/css" />
    <![endif]-->

    <!-- Core stylesheets do not remove -->
    <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />
    <link href="css/supr-theme/jquery.ui.supr.css" rel="stylesheet" type="text/css"/>
    <link href="css/icons.css" rel="stylesheet" type="text/css" />

    <!-- Plugin stylesheets -->
    <link href="plugins/misc/qtip/jquery.qtip.css" rel="stylesheet" type="text/css" />
    <link href="plugins/forms/uniform/uniform.default.css" type="text/css" rel="stylesheet" />
    <link href="plugins/forms/select/select2.css" type="text/css" rel="stylesheet" />
    <link href="plugins/forms/validate/validate.css" type="text/css" rel="stylesheet" />
    
    <!-- Main stylesheets -->
    <link href="css/main.css" rel="stylesheet" type="text/css" /> 

    <!-- Custom stylesheets ( Put your own changes here ) -->
    <link href="css/custom.css" rel="stylesheet" type="text/css" /> 
    <link href="css/gmaps.css" rel="stylesheet" type="text/css" /> 
    
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="images/favicon.ico" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/apple-touch-icon-144-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/apple-touch-icon-114-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/apple-touch-icon-72-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" href="images/apple-touch-icon-57-precomposed.png" />

    <script type="text/javascript">
        //adding load class to body and hide page
        document.documentElement.className += 'loadstate';
    </script>

    <!-- Le javascript
    ================================================== -->		
    <!-- Important plugins put in all pages -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap/bootstrap.js"></script>  
    <script type="text/javascript" src="js/jquery.cookie.js"></script>
    <script type="text/javascript" src="js/jquery.mousewheel.js"></script>
		
    </head>
      
    <body>

    <!-- loading animation -->
    <div id="qLoverlay"></div>
    <div id="qLbar"></div>
    
    <div id="header">

        <div class="navbar">
            <div class="navbar-inner">
              <div class="container-fluid">
                <a class="brand" href="index.php">SIM Diklat.<span class="slogan">PPPPTK BMTI Bandung</span></a>
                <div class="nav-no-collapse">

                    <ul class="nav pull-right usernav">
                        <?php if (($user->usermode == 'P') && ($user->ptkid > 0)):?>
                            <li><a href="account.php?do=ptk_edit"><span class="icon16 icomoon-icon-user-4"></span> Identitas PTK</a></li>
                            <li><a href="account.php?do=sekolah_edit"><span class="icon16 icomoon-icon-home-8"></span> Profil Sekolah</a></li>
                        <?php endif;?>

                        <?php if (($user->usermode == 'S') && ($user->ptkid > 0)):?>
                            <li><a href="account.php?do=staff_edit"><span class="icon16 icomoon-icon-user-4"></span> Identitas</a></li>
                        <?php endif;?>

                        <li><a href="logout.php" ><span class="icon16 icomoon-icon-exit"></span> Logout</a></li>
                    </ul>
                </div><!-- /.nav-collapse -->
              </div>
            </div><!-- /navbar-inner -->
          </div><!-- /navbar --> 

    </div><!-- End #header -->

    <div id="wrapper">

        <!--Responsive navigation button-->  
        <div class="resBtn">
            <a href="#"><span class="icon16 minia-icon-list-3"></span></a>
        </div>

        <!--Sidebar collapse button-->  
        <div class="collapseBtn leftbar">
             <a href="#" class="tipR" title="Hide sidebar"><span class="icon12 minia-icon-layout"></span></a>
        </div>

        <!--Sidebar background-->
        <div id="sidebarbg"></div>
        <!--Sidebar content-->
        <div id="sidebar">

            <div class="shortcuts">
                <ul>
                    <li><a href="index.php" title="Home" class="tip"><span class="icon24 icomoon-icon-home"></span></a></li>
                    <li><a href="account.php?do=user_account" title="Login User" class="tip"><span class="icon24 icomoon-icon-user"></span></a></li>
                </ul>
            </div><!-- End search -->            

            <div class="sidenav">

                <div class="sidebar-widget" style="margin: -1px 0 0 0;">
                    <h5 class="title" style="margin-bottom:0">Navigasi</h5>
                </div><!-- End .sidenav-widget -->

                <div class="mainnav">
                    <ul>						
                        <li><a href="account.php?do=ptk"><span class="icon16 icomoon-icon-user-4"></span>PTK</a></li>
                        <li><a href="account.php?do=sekolah"><span class="icon16 icomoon-icon-home-8"></span>Sekolah</a></li>
                        <li><a href="account.php?do=diklat"><span class="icon16 icomoon-icon-graduation"></span>Katalog Diklat</a></li>
                        <li><a href="account.php?do=diklat_jadwal"><span class="icon16 icomoon-icon-calendar-2"></span>Jadwal Diklat</a></li>
                        <li><a href="account.php?do=diklat_peserta"><span class="icon16 icomoon-icon-user-3"></span>Peserta Diklat</a></li>
												
                        <!-- ptk & staff only -->

                        <?php if ((($user->usermode == 'P') || ($user->usermode == 'S')) && ($user->ptkid > 0)) :?>
                            <li><a href="account.php?do=tna"><span class="icon16 icomoon-icon-rocket"></span>TNA Online</a></li>
                        <?php endif;?>							

                        <!-- grafik -->
                        
                        <li>
                            <a href="#"><span class="icon16 icomoon-icon-chart"></span>Grafik<span class="notification blue">3</span></a>
                            <ul class="sub">
                                <li><a href="account.php?do=chart_ptk_sekolah_peserta"><span class="icon16 icomoon-icon-arrow-right-2"></span>PTK/Sekolah/Peserta</a></li>
                                <li><a href="account.php?do=chart_ptk_ijazah"><span class="icon16 icomoon-icon-arrow-right-2"></span>Tingkat Pendidikan PTK</a></li>
                                <li><a href="account.php?do=chart_diklat_peserta"><span class="icon16 icomoon-icon-arrow-right-2"></span>Ajuan & Peserta Diklat</a></li>
                            </ul>
                        </li>
                                                    
                        <!-- admin / opp only -->

                        <?php if ($user->is_Admin()):?>
                            <li><a href="admin/index.php"><span class="icon16 icomoon-icon-cogs"></span>Admin</a></li>
                        <?php endif;?>							
												
                    </ul>
                </div>
            </div><!-- End sidenav -->

        </div><!-- End #sidebar -->
		