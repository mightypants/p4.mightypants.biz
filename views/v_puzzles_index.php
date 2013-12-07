<label for='name'>Enter your name:</label><br>
    <input type='text' id='name' name='name'>
    <br><br>

    <input type='button' id='process-btn' value='Reverse it!'>

    <div id='results'></div>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>
	    $('#process-btn').click(function() {
		    $.ajax({
		        type: 'POST',
		        url: 'process.php',
		        success: function(response) { 

		            // Enject the results received from process.php into the results div
		            $('#results').html(response);
		        },
		        data: {
		            name: $('#name').val(),
		        },
		    }); // end ajax setup
		});
    </script>