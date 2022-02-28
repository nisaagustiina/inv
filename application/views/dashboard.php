    <div class="panel panel-headline">
		<div class="panel-heading">
			<h3 class="panel-title">Dashboard</h3>
				<p class="panel-subtitle"><?php echo date('j F Y, H:i:s')?></p>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-3">
					<div class="metric">
						<span class="icon"><i class="fa fa-shopping-bag"></i></span>
						<p>
							<span class="number"><?=$this->fungsi->count_item()?></span>
							<span class="title"><a href="<?=base_url('item')?>">Stock Item</a> </span>
						</p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="metric">
					    <span class="icon"><i class="lnr lnr-enter"></i></span>
						<p>
							<span class="number"><?=$this->fungsi->count_stock_in()?></span>
							<span class="title"><a href="<?=base_url('stock/in')?>">Stock In</a></span>
						</p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="metric">
						<span class="icon"><i class="lnr lnr-exit"></i></span>
						<p>
						<span class="number"><?=$this->fungsi->count_stock_out()?></span>
						<span class="title"><a href="<?=base_url('stock/out')?>">Stock Out</a></span>
						</p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="metric">
						<span class="icon"><i class="fa fa-user"></i></span>
							<p>
							<span class="number"><?=$this->fungsi->count_user()?></span>
							<span class="title"><a href="<?=base_url('user')?>">User</a></span>
							</p>
					</div>
				</div>
							</div>
			</div>
		</div>
    </div>