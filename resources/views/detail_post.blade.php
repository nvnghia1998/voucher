<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Bootstrap icons-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
<!-- Core theme CSS (includes Bootstrap)-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
body {
  font-family: Arial;
}

.coupon {
  border: 5px dotted #bbb;
  width: 80%;
  border-radius: 15px;
  margin: 0 auto;
  max-width: 600px;
}

.container {
  padding: 2px 16px;
  background-color: #f1f1f1;
}

.promo {
  background: #ccc;
  padding: 3px;
}

.expire {
  color: red;
}
</style>
</head>
<body>

<div class="coupon">
  <div class="container">
    <h3>{{$post->title}}</h3>
  </div>
  <img src="/w3images/hamburger.jpg" alt="Avatar" style="width:100%;">
  <div class="container" style="background-color:white">
    <h2><b>20% OFF YOUR PURCHASE</b></h2> 
    <p>Lorem ipsum dolor sit amet, et nam pertinax gloriatur. Sea te minim soleat senserit, ex quo luptatum tacimates voluptatum, salutandi delicatissimi eam ea. In sed nullam laboramus appellantur, mei ei omnis dolorem mnesarchum.</p>
  </div>
  <form  action="/voucher/public/posts/{{$post->post_id}}" id="create_voucher_code" method="POST">
	{{ csrf_field() }}
	<div class="container">
		<button type="button" class="btn btn-primary" id="create_code1">Create code</button>
		<input type="text" class="code_voucher" value=""  disabled>
		<p class="expire">Expires: Jan 03, 2021</p>
	</div>
  </form>
</div>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function(){
	$('#create_code1').click(function (){
        var form = $('#create_voucher_code');
        $.ajax({
            url: form.attr('action'),
            type: 'post',
            dataType: 'json',
            data: form.serialize(),
            success: function(data) {
				if(data.success) {
					form.find('input.code_voucher').val(data.code);
					Swal.fire("Create voucher is success", data.message+': '+data.code, "success");
				} else {
					Swal.fire('Create voucher is failed',data.message,'error');
				}
            },
            errors: function(){
                alert('Yêu cầu của bạn không được đáp ứng');
            }
        });
    });
});
	    
</script>

</body>
</html> 
