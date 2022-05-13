<div class="navbar-default sidebar nicescroll" role="navigation">
            <div class="sidebar-nav navbar-collapse ">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="ti-search"></i> </button>
                            </span>
                        </div>
                    </li>
                    <?php include"./php/view/sidebar.php"?>
                </ul>
                <!-- <div class="center p-20">
                    <span class="hide-menu"><a href="http://wrappixel.com/templates/myadmin/" target="_blank"
                            class="btn btn-info btn-block btn-rounded waves-effect waves-light">Upgrade to
                            Pro</a></span> -->
                </div>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-12">
                        <h4 class="page-title"><?=$setting['nama']?></h4>
                        <ol class="breadcrumb">
                            <li><a href="<?=$url?>">Dashboard</a></li>
                            <li class="active"><a href="<?=$url.$menu.$bread?>"> <?=$bread?></a></li>
                            <?php 
                            if(isset($_GET['sub'])){
                            ?>
                            <li class="active"><?=$_GET['sub']?></li>
                            <?php    
                            }
                            ?>
                            
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="white-box">