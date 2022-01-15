<div class="panel panel-headline">
		<div class="panel-heading">
			<h3 class="panel-title">Data Warehouse</h3>
		</div>
		<div class="panel-body">
            <div class="pull-left">
                <button class="btn btn-success btn-xs" onclick="add_wh()"><i class="fa fa-plus"></i> Add new material</button>
                <button class="btn btn-xs" onclick="reload()"><i class="fa fa-refresh"></i> Refresh</button>
            </div>
            <!-- <div class="pull-right">
                <a href="" class="btn btn-default btn-sm"><i class="fa fa-file"></i > Import</a>
                <a class="btn btn-info btn-sm"><i class="fa fa-print"></i > Print</a>
            </div>-->
            <br><br>
			<table class="table table-bordered" id="tableVendor">
			    <thead>
                    <tr>
                        <th>No</th>
                        <th>Group</th>
                        <th>Category</th>
                        <th>Material Code</th>
                        <th>Material Name</th>
                        <th>Unit</th>
                        <th>Stock</th>
                        <th>Vendor</th>
                        <th style="width:125px">Action</th>
                    </tr>
                </thead>
				<tbody>
                </tbody>							
			</table>
		</div>
    </div>

    <!-- Modal Vendor -->
        <div class="modal fade" id="modalWh" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title"> </h4>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="form">
                        <input type="hidden" value="" name="id_item"/> 
                        <div class="form-group">
                            <label for="group">Group</label>
                            <select name="group" id="group" class="form-control">
                                <option value=""> Pilih </option>
                                 <?php foreach($group as $row) { ?>
                                    <option value="<?=$row->id_group?>"> <?=$row->name_group?> </option>
                                 <?php } ?>
                            </select>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="category" id="category" class="form-control">
                                <option value=""> Pilih  </option>
                                <?php foreach($category as $row) { ?>
                                    <option value="<?=$row->id_category?> "> <?=$row->name_category?> </option>
                                 <?php } ?>
                            </select>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="codeItem">Material Code</label>
                            <input name="codeItem" id="codeItem" type="text" class="form-control" >
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="nameItem">Material Name</label>
                            <textarea name="nameItem" id="nameItem" cols="30" rows="3" class="form-control"></textarea>
                            <span class="help-block"></span>

                        </div>
                        <div class="form-group">
                            <label for="unit">Unit</label>
                            <select name="unit" id="unit" class="form-control">
                                <option value=""> Pilih  </option>
                                <?php foreach($unit as $row) { ?>
                                    <option value="<?=$row->id_unit?>  "> <?=$row->name_unit?> </option>
                                 <?php } ?>
                            </select>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="vendor">Vendor</label>
                            <select name="vendor" id="vendor" class="form-control">
                                <option value=""> Pilih  </option>
                                <?php foreach($vendor as $row) { ?>
                                    <option value="<?=$row->id_vendor?> "> <?=$row->name_vendor?> </option>
                                 <?php } ?>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-xs" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-xs"  id="btnSave" onclick="save()">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <!-- End Modal Vendor -->
    
        <script>
            $(document).ready(function(){
                table = $('#tableVendor').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "order": [],
                    "ajax": {
                        "type": 'POST',
                        "url": '<?=site_url('warehouse/ajax_list')?>'
                    },
                    "columnDefs":[{
                        "targets": [0,-1],
                        "orderable": false,
                    }]
                })
            })

            // $("input").change(function(){
            //     $(this).parent().parent().removeClass('has-error');
            //     $(this).next().empty()
            // })

            // $("textarea").change(function(){
            //     $(this).parent().parent().removeClass('has-error');
            //     $(this).next().empty()
            // })

            // $("select").change(function(){
            //     $(this).parent().parent().removeClass('has-error');
            //     $(this).next().empty()
            // })

            function add_wh(){
                save_method = 'add';
                $('#form')[0].reset();
                // $('.form-group').removeClass('has-error');
                // $('.help-block').empty();
                $('#modalWh').modal('show');
                $('.modal-title').text('Add new material');
            }

            function edit_wh(id){
                save_method = 'update';
                $('#form')[0].reset();
                // $('.form-group').removeClass('has-error');
                // $('.help-block').empty();

                $.ajax({
                    type: "POST",
                    url: "<?=site_url('warehouse/ajax_edit/')?>/"+id,
                    dataType: "JSON",
                    success: function(data){
                        $('[name="id_item"]').val(data.id_item);
                        $('[name="group"]').val(data.id_group);
                        $('[name="category"]').val(data.id_category);
                        $('[name="codeItem"]').val(data.code_item);
                        $('[name="nameItem"]').val(data.name_item);
                        $('[name="unit"]').val(data.id_unit);
                        $('[name="vendor"]').val(data.id_vendor);
                        $('#modalWh').modal('show');
                        $('.modal-title').text('Edit Material');
                    },
                    error:function(jqXHR, textStatus, errorThrown){
                        alert('Error get data from ajax');
                    }
                })
            }

            function reload(){
                table.ajax.reload(null,false);
            }

            function save(){
                // $('#btnSave').text('saving..');
                // $('#btnSave').attr('disabled',true);
                var url;
                if(save_method == 'add'){
                    url = "<?=site_url('warehouse/ajax_add')?>";
                }else{
                    url = "<?=site_url('warehouse/ajax_update')?>";
                }

                $.ajax({
                    type: "POST",
                    url: url,
                    data: $('#form').serialize(),
                    dataType: "JSON",
                    success: function(data){
                        if(data.status){
                            $('#modalWh').modal('hide');
                            reload();
                        }
                        // else{
                        //     for(var i=0; i < data.inputerror.length; i++){
                        //         $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
                        //         $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                        //     }
                        // }
                        // $('#btnSave').text('save');
                        // $('#btnSave').attr('disabled',false);
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        alert('Error add/update data');
                        $('#btnSave').text('save');
                        $('#btnSave').attr('disabled',false);
                    }
                })
            }

            function delete_wh(id){
                if(confirm('Are you sure delete this data?')){
                    $.ajax({
                        type: "POST",
                        url: "<?=site_url('warehouse/ajax_delete')?>/"+id,
                        dataType: "JSON",
                        success: function(data){
                            alert('Data already deleted');
                            reload();
                        },
                        error: function (jqXHR, textStatus, errorThrown){
                            alert('Error deleting data');
                        }
                    })
                }
            }
        </script>