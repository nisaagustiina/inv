<div class="panel panel-headline">
		<div class="panel-heading">
			<h3 class="panel-title">Data User</h3>
		</div>
		<div class="panel-body">
            <div class="pull-left">
                <button class="btn btn-success btn-xs" onclick="add_user()"><i class="fa fa-plus"></i> Add new user</button>
                <button class="btn btn-xs" onclick="reload()"><i class="fa fa-refresh"></i> Refresh</button>
            </div>
            <!-- <div class="pull-right">
                <a href="" class="btn btn-default btn-sm"><i class="fa fa-file"></i > Import</a>
                <a class="btn btn-info btn-sm"><i class="fa fa-print"></i > Print</a>
            </div>-->
            <br><br>
			<table class="table table-bordered" id="tableuser">
			    <thead>
                    <tr>
                        <th style="width:5%">No</th>
                        <th >Name</th>
                        <th >Username</th>
                        <th >Role</th>
                        <th style="width:50px">Action</th>
                    </tr>
                </thead>
				<tbody>
                </tbody>							
			</table>
		</div>
    </div>

    <!-- Modal user -->
        <div class="modal fade" id="modaluser" role="dialog">
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
                        <input type="hidden" value="" name="id_user"/> 
                        <div class="form-user">
                            <label for="name">Name</label>
                            <input name="name" id="name" type="text" class="form-control"  >
                            <span class="help-block"></span>
                        </div>
                        <div class="form-user">
                            <label for="user">Username</label>
                            <input name="user" id="user" type="text" class="form-control"  >
                            <span class="help-block"></span>
                        </div>
                        <div class="form-user">
                            <label for="pass">Password</label>
                            <input name="pass" id="pass" type="password" class="form-control"  >
                            <span class="help-block"></span>
                        </div>
                        <div class="form-user">
                            <label for="level">Role</label>
                            <select name="level" id="level"  class="form-control">
                                <option value="">Pilih</option>
                                <option value="1">Admin</option>
                                <option value="2">Staff</option>
                            </select>
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
    <!-- End Modal user -->
    
        <script>
            $(document).ready(function(){
                table = $('#tableuser').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "order": [],
                    "ajax": {
                        "type": 'POST',
                        "url": '<?=site_url('user/ajax_list')?>'
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

            function add_user(){
                save_method = 'add';
                $('#form')[0].reset();
                $('.form-user').removeClass('has-error');
                $('.help-block').empty();
                $('#modaluser').modal('show');
                $('.modal-title').text('Add new user');
            }

            function edit_user(id){
                save_method = 'update';
                $('#form')[0].reset();
                $('.form-user').removeClass('has-error');
                $('.help-block').empty();

                $.ajax({
                    type: "POST",
                    url: "<?=site_url('user/ajax_edit/')?>/"+id,
                    dataType: "JSON",
                    success: function(data){
                        $('[name="id_user"]').val(data.id_user);
                        $('[name="name"]').val(data.name);
                        $('[name="user"]').val(data.username);
                        $('[name="pass"]').val(data.password);
                        $('[name="level"]').val(data.level);
                        $('#modaluser').modal('show');
                        $('.modal-title').text('Edit user');
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
                    url = "<?=site_url('user/ajax_add')?>";
                }else{
                    url = "<?=site_url('user/ajax_update')?>";
                }

                $.ajax({
                    type: "POST",
                    url: url,
                    data: $('#form').serialize(),
                    dataType: "JSON",
                    success: function(data){
                        if(data.status){
                            $('#modaluser').modal('hide');
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

            function delete_user(id){
                if(confirm('Are you sure delete this data?')){
                    $.ajax({
                        type: "POST",
                        url: "<?=site_url('user/ajax_delete')?>/"+id,
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