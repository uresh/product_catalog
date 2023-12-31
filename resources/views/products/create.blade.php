<!DOCTYPE html>
<html>
 <head>
  <title>Product</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
        $("#productlist").click(function(){
            window.location = "/";
        });
       
        $("form#frmaddproduct").submit(function(e) {
            
            e.preventDefault();
            const form = $("#frmaddproduct");
            var attributePairs = [];
            $('.attribute-group').each(function() {
                var name = $(this).find('.attribute-name').val();
                var value = $(this).find('.attribute-value').val();

                // Add key-value pair to the array
                attributePairs.push({ name: name, value: value });
            });
            console.log($('.attribute-group').length);
            var jsonString = JSON.stringify(attributePairs)
            var formData = new FormData(form[0]);  
            formData.append('attributes', jsonString);
            console.log(formData);  
            // var token = $("input[name=_token]").val();
            // formData.append("_token", token);
            $.ajax({
                type:"POST",
                data: formData, // serializes the form's elements.
                url: "/api/products", 
                cache:false,
                processData:false,
                contentType:false,
                success: function(result){
                    console.log(result);
                    window.location = "/";
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

        <div class="col-md-12 text-right"><button id="productlist" type="button" class="btn btn-default navbar-btn"> Product List</button></div>
 
    </div>
  <div class="container ">
   <h3 align="center">Product Add</h3>
   
   <form class="form-horizontal" id="frmaddproduct" enctype="multipart/form-data">
   {{ csrf_field() }}
   <div class="form-group">
    <label for="code" class="col-sm-2 control-label">Code</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="code" name="code" placeholder="Code">
    </div>
  </div>
  <div class="form-group">
    <label for="category" class="col-sm-2 control-label">Category</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="category" name="category" placeholder="Category">
    </div>
  </div>
  <div class="form-group">
    <label for="name" class="col-sm-2 control-label">Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="name" name="name" placeholder="Name">
    </div>
  </div>
  <div class="form-group">
    <label for="description" class="col-sm-2 control-label">Description</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="description" name="description" placeholder="Description">
    </div>
  </div>
  <div class="form-group">
    <label for="selling_price" class="col-sm-2 control-label">Selling Price</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="selling_price" name="selling_price" placeholder="Selling Price">
    </div>
  </div>
  
  <div class="form-group">
    <label for="special_price" class="col-sm-2 control-label">Special Price</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="special_price" name="special_price" placeholder="Special Price">
    </div>
  </div>
  <div class="form-group">
    <label for="status" class="col-sm-2 control-label">Status</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="status" name="status" placeholder="Status">
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
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
    <button class="add_field_button">Add More Attribute</button>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <div class="input_attribute_wrap">
            
            <div class="attribute-group">Name: <input type="text" class="attribute-name"  name="attributes_name[]"> value:  <input type="text" class="attribute-value" name="attributes_value[]"></div>
        </div>
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" id="btnsave" class="btn btn-default">Save</button>
    </div>
  </div>

</form>

 
  </div>
  <script>
$(document).ready(function() {
    var max_fields      = 10; 
    var wrapper         = $(".input_attribute_wrap"); 
    var add_button      = $(".add_field_button"); 

    var x = 1; 
    $(add_button).click(function(e){ 
        
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="attribute-group">Name: <input type="text" class="attribute-name" name="attributes_name[]"/> Value: <input type="text" class="attribute-value" name="attributes_value[]"/><a href="#" class="remove_field">Remove</a></div>');
        }
    });

    $(wrapper).on("click",".remove_field", function(e){ 
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
    </script>
 </body>
</html>