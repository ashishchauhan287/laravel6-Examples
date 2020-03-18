<!DOCTYPE html>
<html>
 <head>
  <title>Insert Update Delete in Laravel6 using Ajax jQuery</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
  <br />
  <div class="container box">
   <h3 align="center">Insert Update Delete in Laravel using Ajax jQuery</h3><br />
   <div class="panel panel-default">
    <div class="panel-heading">Sample Data</div>
    <div class="panel-body">
     <div id="message"></div>
     <div class="table-responsive">
      <table class="table table-striped table-bordered">
       <thead>
        <tr>
         <th>First Name</th>
         <th>Last Name</th>
         <th>Email</th>
         <th>Phone</th>
         <th>Delete</th>
        </tr>
       </thead>
       <tbody>
       
       </tbody>
      </table>
      {{ csrf_field() }}
     </div>
    </div>
   </div>
  </div>
 </body>
</html>

<script>
$(document).ready(function(){
	fetch_data();

	function fetch_data()
	{
		// Show Data
		$.ajax({
			url:"ajaxtable/fetch_data",
			datatype:"json",
			success:function(data)
			{
				console.log(data);
				var html = '';
				html += '<tr>';
    html += '<td contenteditable id="first_name"></td>';
    html += '<td contenteditable id="last_name"></td>';
    html += '<td contenteditable id="email"></td>';
    html += '<td contenteditable id="phone"></td>';
    html += '<td><button type="button" class="btn btn-success btn-xs" id="add">Add</button></td></tr>';
    $.each(JSON.parse(data), function(i, item) {
     html +='<tr>';
     html +='<td contenteditable class="column_name" data-column_name="first_name" data-id="'+item.id+'">'+item.first_name+'</td>';
     html += '<td contenteditable class="column_name" data-column_name="last_name" data-id="'+item.id+'">'+item.last_name+'</td>';
     html += '<td contenteditable class="column_name" data-column_name="email" data-id="'+item.id+'">'+item.email+'</td>';
     html += '<td contenteditable class="column_name" data-column_name="phone" data-id="'+item.id+'">'+item.phone+'</td>';
     html += '<td><button type="button" class="btn btn-danger btn-xs delete" id="'+item.id+'">Delete</button></td></tr>';
    });
    $('tbody').html(html);

			}
		});
	}

	// Add Data
	var _token = $('input[name="_token"]').val();
	$(document).on('click', '#add', function(){
		var first_name = $('#first_name').text();
  		var last_name = $('#last_name').text();
  		var email = $('#email').text();
  		var phone = $('#phone').text();
  		if(first_name != '' && last_name != '' && email != '' && phone != '')
  		{
  			$.ajax({
  				url:"{{ route('ajaxtable.add_data') }}",
  				method:"POST",
  				data:{first_name:first_name, last_name:last_name, email:email, phone:phone, _token:_token},
  				success:function()
  				{
  					$('#message').html('<div class="alert alert-success">Data Insert Succesfully</div>');
  					fetch_data();
  				}
  			})
  		}
  		else
  		{
  			   $('#message').html("<div class='alert alert-danger'>All Fields are required</div>");
  		}
	});

	// Update Data
 $(document).on('blur', '.column_name', function(){
  var column_name = $(this).data("column_name");
  var column_value = $(this).text();
  var id = $(this).data("id");
  
  if(column_value != '')
  {
   $.ajax({
    url:"{{ route('ajaxtable.update_data') }}",
    method:"POST",
    data:{column_name:column_name, column_value:column_value, id:id, _token:_token},
    success:function(data)
    {
     $('#message').html(data);
    }
   })
  }
  else
  {
   $('#message').html("<div class='alert alert-danger'>Enter some value</div>");
  }
 });

 // Delete Data
 $(document).on('click','.delete',function(){
 	var id = $(this).attr('id');
 	if(confirm("Are you sure you want to delete this records?"))
 	{
 		$.ajax({
 			url:"{{ route('ajaxtable.delete_data') }}",
 			method:"POST",
 			data:{id:id, _token:_token},
 			success:function(data)
 			{
 				$('#message').html(data);
 				fetch_data();
 			}
 		});
 	}
 });

});
</script>