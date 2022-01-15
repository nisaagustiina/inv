<div class="panel panel-headline">
		<div class="panel-heading">
			<h3 class="panel-title">Data Unit</h3>
		</div>
		<div class="panel-body">
            <div class="pull-left">
                <button class="btn btn-success btn-xs" onclick="add_unit()"><i class="fa fa-plus"></i> Add new unit</button>
                <button class="btn btn-xs" onclick="reload()"><i class="fa fa-refresh"></i> Refresh</button>
            </div>
            <!-- <div class="pull-right">
                <a href="" class="btn btn-default btn-sm"><i class="fa fa-file"></i > Import</a>
                <a class="btn btn-info btn-sm"><i class="fa fa-print"></i > Print</a>
            </div>-->
            <br><br>
			<table class="table table-bordered" id="tableunit">
			    <thead>
                    <tr>
                        <th style="width:5%">No</th>
                        <th style="width:100px">Unit Name</th>
                        <th style="width:50px">Action</th>
                    </tr>
                </thead>
				<tbody>
                </tbody>							
			</table>
		</div>
    </div>

    <!-- Modal unit -->
        <div class="modal fade" id="modalunit" role="dialog">
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
                        <input type="hidden" value="" name="id_unit"/> 
                        <div class="form-unit">
                            <label for="name_unit">Name unit</label>
                            <input name="name_unit" id="name_unit" type="text" class="form-control"  >
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
    <!-- End Modal unit -->
    
        <script>
            $(document).ready(function(){
                table = $('#tableunit').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "order": [],
                    "ajax": {
                        "type": 'POST',
                        "url": '<?=site_url('unit/ajax_list')?>'
                    },
                    "columnDefs":[{
                        "targets": [0,-1],
                        "orderable": false,
                    }]
                })
            })

            $("input").change(function(){
                $(this).parent().parent().removeClass('has-error');
                $(this).next().empty()
            })

            function add_unit(){
                save_method = 'add';
                $('#form')[0].reset();
                $('.form-unit').removeClass('has-error');
                $('.help-block').empty();
                $('#modalunit').modal('show');
                $('.modal-title').text('Add new unit');
            }

            function edit_unit(id){
                save_method = 'update';
                $('#form')[0].reset();
                $('.form-unit').removeClass('has-error');
                $('.help-block').empty();

                $.ajax({
                    type: "POST",
                    url: "<?=site_url('unit/ajax_edit/')?>/"+id,
                    dataType: "JSON",
                    success: function(data){
                        $('[name="id_unit"]').val(data.id_unit);
                        $('[name="name_unit"]').val(data.name_unit);
                        $('#modalunit').modal('show');
                        $('.modal-title').text('Edit unit');
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
                $('#btnSave').text('saving..');
                $('#btnSave').attr('disabled',true);
                var url;
                if(save_method == 'add'){
                    url = "<?=site_url('unit/ajax_add')?>";
                }else{
                    url = "<?=site_url('unit/ajax_update')?>";
                }

                $.ajax({
                    type: "POST",
                    url: url,
                    data: $('#form').serialize(),
                    dataType: "JSON",
                    success: function(data){
                        if(data.status){
                            $('#modalunit').modal('hide');
                            reload();
                        }else{
                            for(var i=0; i < data.inputerror.length; i++){
                                $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
                                $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                            }
                        }
                        $('#btnSave').text('save');
                        $('#btnSave').attr('disabled',false);
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        alert('Error add/update data');
                        $('#btnSave').text('save');
                        $('#btnSave').attr('disabled',false);
                    }
                })
            }

            function delete_unit(id){
                if(confirm('Are you sure delete this data?')){
                    $.ajax({
                        type: "POST",
                        url: "<?=site_url('unit/ajax_delete')?>/"+id,
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