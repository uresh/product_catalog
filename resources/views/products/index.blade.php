<!DOCTYPE html>
<html>
 <head>
    
  <title>Simple Login System in Laravel</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  
    <script>
    $(document).ready(function(){
    $("#logout").click(function(){
        $.ajax({
            type:"POST",
            data: $("#frmlogout").serialize(), // serializes the form's elements.
            url: "/api/logout", 
            
            success: function(result){
                console.log(result);
                window.location = "/";
            }
        });
    });
    $("#addproduct").click(function(){
        window.location = "/products/create";
    });
    $("form#frmeditproduct").submit(function(e) {
        
            e.preventDefault();
            const form = $("#frmeditproduct");
            let dbid = $('#frmeditproduct #id').val();
            var formData = new FormData(form[0]);  
            console.log('update');  
            // var token = $("input[name=_token]").val();
            // formData.append("_token", token);
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                type:"PUT",
                data: formData, // serializes the form's elements.
                url: "/api/products/"+dbid, 
                cache:false,
                processData:false,
                contentType:false,
                success: function(result){
                    console.log(result);
                    //window.location = "/";
                }
            });
         });
    
    });
    </script>
  <style type="text/css">
   .box{
    width:600px;
    margin:0 auto;
    border:1px solid #ccc;
   }
  </style>
 </head>
 <body>
    
    <div class="row">
    <form id="frmlogout" method="post" >
    {{ csrf_field() }}
        <div class="col-md-12 text-right"><button id="logout" type="button" class="btn btn-default navbar-btn">Logout</button></div>
    </form>
    </div>
    <div class="row">
    <form id="frmaddproduct" method="post" >
    {{ csrf_field() }}
        <div class="col-md-12 text-right"><button id="addproduct" type="button" class="btn btn-default navbar-btn">Add Product</button></div>
    </form>
    </div>
  <div class="container ">
   <h3 align="center">Product List</h3>
   <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>code</th>
                <th>category</th>
                <th>name</th>
                <th>description</th>
                <th>selling_price</th>
                <th>status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                
            </tr>
        </tfoot>
    </table>
  
    <div class="modal fade" id="mdlshow" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <form >
            <div class="form-group">
                <label for="code" class="col-sm-2 control-label">Code</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="code" name="code" placeholder="Code" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="category" class="col-sm-2 control-label">Category</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="category" name="category" placeholder="Category" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" placeholder="Name" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="description" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="description" name="description" placeholder="Description" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="selling_price" class="col-sm-2 control-label">Selling Price</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="selling_price" name="selling_price" placeholder="Selling Price" readonly>
                </div>
            </div>
            
            <div class="form-group">
                <label for="special_price" class="col-sm-2 control-label">Special Price</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="special_price" name="special_price" placeholder="Special Price" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="status" class="col-sm-2 control-label">Status</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="status" name="status" placeholder="Status" readonly>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                        <label>
                    <input  type="checkbox" id="is_delivery_available" name="is_delivery_available" value="1" disabled="disabled" > Is Delivery Available
                        </label>
                </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                <img id="image" src="" alt="..." class="img-rounded" style="width: auto; height: 195px;">
                </div>
            </div>

            
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="mdledit" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="frmeditproduct" enctype="multipart/form-data" >
        {{ csrf_field() }}
        <input type="hidden" class="form-control" id="id" name="id" placeholder="" >
            <div class="form-group">
                <label for="code" class="col-sm-2 control-label">Code</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="code" name="code" placeholder="Code" >
                </div>
            </div>
            <div class="form-group">
                <label for="category" class="col-sm-2 control-label">Category</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="category" name="category" placeholder="Category" >
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" placeholder="Name" >
                </div>
            </div>
            <div class="form-group">
                <label for="description" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="description" name="description" placeholder="Description" >
                </div>
            </div>
            <div class="form-group">
                <label for="selling_price" class="col-sm-2 control-label">Selling Price</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="selling_price" name="selling_price" placeholder="Selling Price" >
                </div>
            </div>
            
            <div class="form-group">
                <label for="special_price" class="col-sm-2 control-label">Special Price</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="special_price" name="special_price" placeholder="Special Price" >
                </div>
            </div>
            <div class="form-group">
                <label for="status" class="col-sm-2 control-label">Status</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="status" name="status" placeholder="Status" >
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                        <label>
                    <input  type="checkbox" id="is_delivery_available" name="is_delivery_available" value="1" > Is Delivery Available
                        </label>
                </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="file" id="image" name="image" accept=".jpg,.png">
                </div>
            </div>

            <button type="submit" id="btnedit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
  </div>
  <script>
    let currentDraw = 1;
    new DataTable('#example', {
        scrollX: true,
        paging: true,
        ajax: 
        {
            url: "api/products",
            type: "GET",
            data: function (d) {
                d.page = d.start / d.length + 1;
            },
            dataSrc: function (response) {
                let data = {
                    draw: currentDraw,
                    recordsTotal: response.total,
                    recordsFiltered: response.total,
                    data: response.data,
                };

                currentDraw++;

                return data.data;
            },
        },
    
        columns: [
            { data: 'code' },
            { data: 'category' },
            { data: 'name' },
            { data: 'description' },
            { data: 'selling_price' },
            { data: 'status' },
            { data: 'actions' },
            
        ],
        processing: true,
        serverSide: true
    });
   
    $('#example').on('click', '.show', function() {
        let dbid = $(this).data('id');
        console.log(dbid);
        $.ajax({
            type:"GET",
            url: "/api/products/"+dbid, 
            
            success: function(result){
                console.log(result.data);
                $('#mdlshow #code').val(result.data.code);
                $('#mdlshow #category').val(result.data.category);
                $('#mdlshow #name').val(result.data.name);
                $('#mdlshow #description').val(result.data.description);
                $('#mdlshow #selling_price').val(result.data.selling_price);
                $('#mdlshow #special_price').val(result.data.special_price);
                $('#mdlshow #status').val(result.data.status);
                if(result.data.is_delivery_available){
                    $('#mdlshow #is_delivery_available').prop( "checked", true );
                }else{
                    $('#mdlshow #is_delivery_available').prop( "checked", false );
                }
                
                $('#mdlshow #image').attr("src", result.data.image);
                //window.location = "/";
            }
        });
        $('#mdlshow').modal('show');
        
        //window.location = "/products/show";
    });
    $('#example').on('click', '.edit', function() {
        let dbid = $(this).data('id');
        console.log(dbid);
        $.ajax({
            type:"GET",
            url: "/api/products/"+dbid, 
            
            success: function(result){
                console.log(result.data);
                $('#mdledit #code').val(result.data.code);
                $('#mdledit #category').val(result.data.category);
                $('#mdledit #name').val(result.data.name);
                $('#mdledit #description').val(result.data.description);
                $('#mdledit #selling_price').val(result.data.selling_price);
                $('#mdledit #special_price').val(result.data.special_price);
                $('#mdledit #status').val(result.data.status);
                if(result.data.is_delivery_available){
                    $('#mdledit #is_delivery_available').prop( "checked", true );
                }else{
                    $('#mdledit #is_delivery_available').prop( "checked", false );
                }
                $('#mdledit #image').val("");
                $('#id').val(dbid);
                //window.location = "/";
            }
        });
        $('#mdledit').modal('show');
        
        //window.location = "/products/show";
    });
    $('#example').on('click', '.delete', function() {
        let dbid = $(this).data('id');
        console.log(dbid);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
            type:"DELETE",
            url: "/api/products/"+dbid, 
            
            success: function(result){
                
                
                location.reload();
            }
        });
        
        
        //window.location = "/products/show";
    });
    </script>
 </body>
</html>