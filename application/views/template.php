<!doctype html>
<html lang="en">
<head>
	<title>Inv - <?=$this->uri->segment(1)?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="stylesheet" href="<?=base_url()?>assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/css/main.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/vendor/DataTables/DataTables-1.11.3/css/dataTables.bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<link rel="apple-touch-icon" sizes="76x76" href="<?=base_url()?>assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?=base_url()?>assets/img/favicon.png">
</head>
<body>
	<div id="wrapper">
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand"> 
                <p>Inventory</p>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				<form class="navbar-form navbar-left">
					<div class="input-group">
						<input type="text" value="" class="form-control" placeholder="Search dashboard...">
						<span class="input-group-btn"><button type="button" class="btn btn-primary">Go</button></span>
					</div>
				</form>
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<!-- <li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?=base_url()?>assets/img/user.png" class="img-circle" alt="Avatar"><span><?=$this->fungsi->user_login()->name?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="#"><i class="lnr lnr-cog"></i> <span>Settings</span></a></li> -->
								<li><a href="<?=site_url('auth/logout')?>"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
							<!-- </ul>
						</li> -->
					</ul>
				</div>
			</div>
		</nav>
		
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="<?=site_url('dashboard')?>" <?=$this->uri->segment(1) == 'dashboard' ? 'class="active"' : '' ?> ><i class="lnr lnr-home"></i> <span>Home</span></a></li>
						<?php if($this->fungsi->user_login()->level == 1) { ?>
						<li><a href="<?=site_url('vendor')?>" <?=$this->uri->segment(1) == 'vendor' ? 'class="active"' : '' ?>><i class="lnr lnr-users"></i> <span>Vendor</span></a></li>
						<li>
							<a href="#subPages" data-toggle="collapse"><i class="lnr lnr-file-empty"></i> <span>Item</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages" class="collapse">
								<ul class="nav">
									<li><a href="<?=site_url('category')?>">Category</a></li>
									<li><a href="<?=site_url('group')?>">Group</a></li>
									<li><a href="<?=site_url('unit')?>">Unit</a></li>
									<li><a href="<?=site_url('item')?>">Warehouse</a></li>
								</ul>
							</div>
						</li>
						<?php } ?>
						<li><a href="<?=site_url('stock/in')?>" <?=$this->uri->segment(1) == 'stock' && $this->uri->segment(2) == 'in' ? 'class="active"' : '' ?>><i class="lnr lnr-enter"></i> <span>Incoming</span></a></li>
						<li><a href="<?=site_url('stock/out')?>" <?=$this->uri->segment(1) == 'stock' && $this->uri->segment(2) == 'out' ? 'class="active"' : '' ?> ><i class="lnr lnr-pencil"></i> <span>Use Stock</span></a></li>
                        <li><a href="<?=site_url('report')?>" <?=$this->uri->segment(1) == 'report' ? 'class="active"' : '' ?>><i class="lnr lnr-chart-bars"></i> <span>Reports</span></a></li>
                        <?php if($this->fungsi->user_login()->level == 1) { ?>
                        <li><a href="<?=site_url('user')?>" <?=$this->uri->segment(1) == 'user' ? 'class="active"' : '' ?>><i class="lnr lnr-user"></i> <span>User</span></a></li>
                        <?php } ?>
					</ul>
				</nav>
			</div>
		</div>

		<!-- Javascript -->
		<script src="<?=base_url()?>assets/vendor/jquery/jquery.min.js"></script>
		<script src="<?=base_url()?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?= base_url()?>assets/vendor/DataTables/datatables.min.js"></script>
		<script src="<?= base_url()?>assets/vendor/DataTables/DataTables-1.11.3/js/dataTables.bootstrap.min.js"></script>
		<script src="<?=base_url()?>assets/scripts/klorofil-common.js"></script>
		
		<div class="main">
			<div class="main-content">
				<div class="container-fluid">
                    <?=$contents?>
				</div>
			</div>
		</div>

		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy; 2020 All Rights Reserved.</p>
			</div>
		</footer>
	</div>
</body>
</html>
