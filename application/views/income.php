<div class="panel panel-headline">
		<div class="panel-heading">
			<h3 class="panel-title">Data Incoming</h3>
		</div>
		<div class="panel-body">
            <div class="row">
                <div class="pull-left">
                <button id="btnAdd"  class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Add Incoming</button>
                <button class="btn btn-xs" onclick="reload()"><i class="fa fa-refresh"></i> Refresh</button>
            </div>
        </div>
        <div class="row">
            <div class="collapse" id="collapse-new">
                <div class="card card-header text-right">
                    <button class="btn btn-info btn-xs" id="btnItem" data-toggle="modal" data-target="#modalItem">Pilih Item</button>
                </div>
                <div class="card card-body">
                    <form action="">
                        <div class="container-fluid">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="">No. PO</label>
                                <input type="text" name="" id="" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="">ID Material</label>
                                <input type="text" name="" id="" class="form-control" disabled>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">Material Name</label>
                                <input type="text" name="" id="" class="form-control" disabled>
                            </div>
                            
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="">Qty</label>
                                <input type="number" name="" id="" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-2">
                                <label for="">Unit</label>
                                <input type="text" name="" id="" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="">Date</label>
                                <input type="date" name="" id="" value="<?=date('Y-m-d')?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="">Note</label>
                                <textarea name="" id="" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
                <div class="card card-footer text-right">
                    <button id=save class="btn btn-success btn-xs">Save Incoming</button>
                </div>
            </div>
        </div>
            <br><br>
			<table class="table table-bordered" id="tableIn">
			    <thead>
                    <tr>
                        <th style="width:5%">No</th>
                        <th>No. PO</th>
                        <th>ID Material</th>
                        <th>Qty</th>
                        <th>Date</th>
                        <th>PIC</th>
                        <th>Note</th>
                        <!-- <th style="width:50px">Action</th> -->
                    </tr>
                </thead>
				<tbody>
                </tbody>							
			</table>
		</div>
    </div>

    <!-- Modal in -->
        <div class="modal fade" id="modalItem" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title"> Data Material </h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered" id="tableItem" >
                            <thead>
                                <th>Group</th>
                                <th>Category</th>
                                <th>Material Code</th>
                                <th>Material Name</th>
                                <th>Unit</th>
                                <th>Vendor</th>
                                <th>Action</th>
                            </thead>
                        </table>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <!-- End Modal in -->
    
        <script>
            $(document).ready(function(){
                table = $('#tableIn').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "order": [],
                    "ajax": {
                        "type": 'POST',
                        "url": '<?=site_url('stock/ajax_list')?>'
                    },
                    "columnDefs":[{
                        "targets": 0,
                        "orderable": false,
                    }]
                })
                
                $('#tableItem').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "order": [],
                    "ajax": {
                        "type": 'POST',
                        "url": '<?=site_url('warehouse/get')?>'
                    },
                    "columnDefs":[{
                        "targets": 0,
                        "orderable": false,
                    }]
                })

            })


            $('#btnAdd').click(function(){
                $('#btnItem').show();
                $('#collapse-new').collapse('toggle');
                
            })

            // $("input").change(function(){
            //     $(this).parent().parent().removeClass('has-error');
            //     $(this).next().empty()
            // })

            // function add_in(){
            //     save_method = 'add';
            //     $('#form')[0].reset();
            //     $('.form-in').removeClass('has-error');
            //     $('.help-block').empty();
            //     $('#modalIn').modal('show');
            //     $('.modal-title').text('Add new in');
            // }

            // function edit_in(id){
            //     save_method = 'update';
            //     $('#form')[0].reset();
            //     $('.form-in').removeClass('has-error');
            //     $('.help-block').empty();

            //     $.ajax({
            //         type: "POST",
            //         url: "<?=site_url('in/ajax_edit/')?>/"+id,
            //         dataType: "JSON",
            //         success: function(data){
            //             $('[name="id_in"]').val(data.id_in);
            //             $('[name="name_in"]').val(data.name_in);
            //             $('#modalIn').modal('show');
            //             $('.modal-title').text('Edit in');
            //         },
            //         error:function(jqXHR, textStatus, errorThrown){
            //             alert('Error get data from ajax');
            //         }
            //     })
            // }

            // function reload(){
            //     table.ajax.reload(null,false);
            // }

            // function save(){
            //     $('#btnSave').text('saving..');
            //     $('#btnSave').attr('disabled',true);
            //     var url;
            //     if(save_method == 'add'){
            //         url = "<?=site_url('in/ajax_add')?>";
            //     }else{
            //         url = "<?=site_url('in/ajax_update')?>";
            //     }

            //     $.ajax({
            //         type: "POST",
            //         url: url,
            //         data: $('#form').serialize(),
            //         dataType: "JSON",
            //         success: function(data){
            //             if(data.status){
            //                 $('#modalIn').modal('hide');
            //                 reload();
            //             }else{
            //                 for(var i=0; i < data.inputerror.length; i++){
            //                     $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
            //                     $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
            //                 }
            //             }
            //             $('#btnSave').text('save');
            //             $('#btnSave').attr('disabled',false);
            //         },
            //         error: function(jqXHR, textStatus, errorThrown){
            //             alert('Error add/update data');
            //             $('#btnSave').text('save');
            //             $('#btnSave').attr('disabled',false);
            //         }
            //     })
            // }

            // function delete_in(id){
            //     if(confirm('Are you sure delete this data?')){
            //         $.ajax({
            //             type: "POST",
            //             url: "<?=site_url('in/ajax_delete')?>/"+id,
            //             dataType: "JSON",
            //             success: function(data){
            //                 alert('Data already deleted');
            //                 reload();
            //             },
            //             error: function (jqXHR, textStatus, errorThrown){
            //                 alert('Error deleting data');
            //             }
            //         })
            //     }
            // }
        </script>