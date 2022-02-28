<div class="panel panel-headline">
		<div class="panel-heading">
			<h3 class="panel-title">Data Incoming</h3>
            <div class="pull-right">
                <a href="<?=site_url('stock/in')?>" class="btn btn-info btn-xs">Back</a>
            </div>
		</div>
		<div class="panel-body">
            <div cass="row">
                <form action="<?=site_url('')?>">
                    <input type="hidden" name="total" id="" value="<?= @$_POST['count_add']?>">
                    <div class="form-group">
                        <label for="po">No. PO</label>
                        <input type="text" name="po" id="po" class="form-control">
                    </div>
                </form>
            </div>
        </div>
</div