<div class="panel panel-headline">
		<div class="panel-heading">
			<h3 class="panel-title">Use Stock</h3>
		</div>
		<div class="panel-body">
            <div class="pull-left">
                <button class="btn btn-danger btn-xs" id="btnAdd"><i class="fa fa-minus"></i> Use</button>
                <!-- <button class="btn btn-xs" onclick="reload()"><i class="fa fa-refresh"></i> Refresh</button> -->
            </div><br><br>
            <div class="collapse" id="collapse-new">    
                <form action="<?= site_url('stock/process')?>" method="post">
                    <div class="form-group col-md-2 ">
                        <label for="">Date</label>
                        <input type="date" name="date" id="date" value="<?=date('Y-m-d')?>" class="form-control"><br>
                        <label for="">Qty</label>
                        <input type="number" name="qty" id="qty" class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">No. Ticket/DO</label>
                        <input type="text" name="po" id="po" class="form-control"><br>
                        <label for="">Note</label>
                        <textarea name="note" id="note" cols="" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">ID Material</label>
                        <div class="form-group input-group">
                            <input type="text" name="code_item" id="code_item" class="form-control" required autofocus>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-item">
                                    <i class="fa fa-search"></i>
                                    </button>
                                </span>
                        </div>
                    </div>
                    <input type="hidden" name="id_item" id="id_item">
                    <div class="form-group col-md-3">
                        <label for="nama">Item Name</label>
                        <input type="text" name="name_item"  class="form-control" id="name_item" disabled>
                    </div>
                    <div class="form-group col-md-1 ">
                        <label for="">Unit</label>
                        <input type="text" name="unit" id="unit" class="form-control" disabled>
                    </div>
                    <div class="form-group col-md-5">
                        <br><br><br>
                        <button type="submit" name="out_add" class="btn btn-success btn-xs"><i class="fa fa-paper-plane"></i> Save</button>  
                    </div>
                </form>
            </div>
            <table class="table table-bordered" id="table">
			    <thead>
                    <tr>
                        <th style="width=5%">No</th>
                        <th>No. PO</th>
                        <th>ID Material</th>
                        <th>Qty</th>
                        <th>Date</th>
                        <th>PIC</th>
                        <th>Note</th>
                        <th>Action</th>
                    </tr>
                </thead>
				<tbody>
                    <?php
                    $no = 1;
                    foreach($stock_out as $i) { ?>
                    <tr>
                        <td><?= $no++?></td>
                        <td><?= $i->po?></td>
                        <td><?= $i->id_item?></td>
                        <td><?= $i->qty?></td>
                        <td><?= indo_date($i->date)?></td>
                        <td><?= $i->name?></td>
                        <td><?= $i->note?></td>
                        <td class="text-center">
                            <a id="detail_barang" class="btn btn-default btn-xs"
                            data-toggle="modal" data-target="#modal-detail" 
                            data-code="<?=$i->code_item?>"
                            data-name="<?=$i->name_item?>"
                            data-satuan="<?=$i->unit?>"
                            data-kty="<?=$i->qty?>"
                            data-group="<?=$i->group?>"
                            data-category="<?=$i->category?>"
                            data-tgl="<?=indo_date($i->date)?>"><i class="fa fa-eye"></i> Detail</a>
                            <a href="<?= site_url('stock/out/del/'.$i->id_stock.'/'.$i->id_item)?>" onclick="return confirm('Apakah yakin akan menghapus data ini?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a></td>
                    </tr>
                    <?php } ?>
                </tbody>							
			</table>
		</div>
</div>

    <!-- Modal unit -->
        <div class="modal fade" id="modal-item" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title"> Select Item </h4>
                    </div>
                    <div class="modal-body table-responsive">
                        <table class="table table-bordered table-striped" id="tabel">
                            <thead>
                                <tr>
                                    <th>Code Item</th>
                                    <th>Name</th>
                                    <th>Unit</th>
                                    <th>Vendor</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($item as $i){ ?>
                                    <tr>
                                        <td><?=$i->code_item?></td>
                                        <td><?=$i->name_item?></td>
                                        <td><?=$i->unit?></td>
                                        <td><?=$i->vendor?></td>
                                        <td><button class="btn btn-info btn-xs" id="select" data-id_item="<?=$i->id_item?>" data-code_item="<?=$i->code_item?>"data-name_item="<?=$i->name_item?>" data-unit="<?=$i->unit?>" data-vendor="<?=$i->vendor?>">
                                        Select
                                        </button>
                                    </td>
                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                   
                </div>
            </div>
        </div>
    <!-- End Modal unit -->
    <!-- Modal Detail -->
    <div class="modal fade" id="modal-detail">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Incoming Detail</h4>
                </div>
                <div class="modal-body table-responsive">
                    <table class="table table-bordered table-striped" id="table">
                        <thead>
                            <tr>
                                <th>Group</th>
                                <td><span id="group"></span></td>
                            </tr>
                            <tr>
                                <th>Category</th>
                                <td><span id="category"></span></td>
                            </tr>
                            <tr>
                                <th>Code Item</th>
                                <td><span id="code"></span></td>
                            </tr>
                            <tr>
                                <th>Name Item</th>
                                <td><span id="name"></span></td>
                            </tr>
                            <tr>
                                <th>Unit </th>
                                <td><span id="satuan"></span></td>
                            </tr>
                            <tr>
                                <th>Qty</th>
                                <td><span id="kty"></span></td>
                            </tr>
                            <tr>
                                <th>Date</th>
                                <td><span id="tgl"></span></td>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div> 
            </div>
        </div>
    </div>
    <!-- End Modal unit -->
    
    <script>
        $(document).ready(function(){
            $('#table').DataTable({
                "order": [],
                "columnDefs":[{
                    "targets": [0,-1],
                    "orderable": false,
                }]
            })

            $('#tabel').DataTable({
                "order": [],
                "columnDefs":[{
                    "targets": -1,
                    "orderable": false,
                }]
            })

            $('#btnAdd').click(function(){
                $('#collapse-new').collapse('toggle');
            })

            $(document).on('click','#select',function(){
                var id_item = $(this).data('id_item');
                var code_item = $(this).data('code_item');
                var name_item = $(this).data('name_item');
                var unit = $(this).data('unit');
                var vendor = $(this).data('vendor');
                $('#id_item').val(id_item);
                $('#code_item').val(code_item);
                $('#name_item').val(name_item);
                $('#unit').val(unit);
                $('#vendor').val(vendor);
                $('#modal-item').modal('close');
            })

            $(document).on('click','#detail_barang',function(){
                var group = $(this).data('group');
                var category = $(this).data('category');
                var code = $(this).data('code');
                var name = $(this).data('name');
                var satuan = $(this).data('satuan');
                var kty = $(this).data('kty');
                var tgl = $(this).data('tgl');
                $('#group').text(group);
                $('#category').text(category);
                $('#code').text(code);
                $('#name').text(name);
                $('#satuan').text(satuan);
                $('#kty').text(kty);
                $('#tgl').text(tgl);
            })
        })
    </script>