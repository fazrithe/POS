<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="utf-8" http-equiv="encoding">
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>

</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<body>	
	<input type="text" id="search" name="search">
</body>
</html>


<script type="text/javascript">
    $(document).ready(function(){           
        $("#search").keypress(function() {
        	search = $("#search").val();                    
  			$.ajax({
				// url: "http://localhost:8382/api/searchElastic",
				url:"<?php echo base_url()?>admin/Sales/searchEngine",
				type: "POST",
                data: {search:search},
                dataType: "json",
				success: function(data) {
					var data = $.parseJSON(data);
					console.log(data.status);
					for (i=0; i<data.data.length; i++){
						console.log(data.data[i][1]);
					}
				},
			});
		});
    })    
</script>
