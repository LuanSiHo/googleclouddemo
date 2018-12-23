<!DOCTYPE html>
<?php
	include_once 'db_connect.php';
	$get = $_GET;

	//kiem tra url co ton tai parameter id hay ko.
	if(!isset($get['id']) || empty($get)) {
		header('Location: ' . base_path('list_daxacnhan.php'));
	}

	//kiem tra database co ton tai id user dang ky nay hay ko.
	$acc = db_query_load_data("select * from tunghiepsinh where id_tns=" . $get['id'] . ";");
	if(empty($acc)) {
		header('Location: ' . base_path('list_daxacnhan.php'));
	} else {
		$nuoc = db_query_load_data("select * from quocgia where id_quocgia=" . $acc[0][8] . ";");
	}
?>
<html>
	<head>
		<title>Đăng ký thông tin</title>
		<?php include 'load_css.php'; ?>
		<script src="js/jquery.min.js"></script>
		<script language="JavaScript" src="js/bootstrap.min.js"/></script>

	</head>
	<body>
		<div class="col-xs-offset-3 col-xs-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Cam kết TNS (bước 3)</h3>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" action="xulycamket_form3.php" method="post" accept-charset="utf-8">
						<div class="form-group">
							<div class="checkbox col-xs-12">
          			<h1>
          				<label>
	          				Tu nghiệp sinh sẽ chịu trách nhiệm cho tất cả mọi thông tin mà Tu nghiệp sinh đăng ký và cam kết dưới đây.
	          			</label>
          			</h1>
          		</div>
          		<div class="checkbox col-xs-12">
          			<label>
          				<input type="checkbox" value="xn1" name="xacnhan" required>Tu nghiệp sinh cam kết chưa từng đi du học tại nước <?php print $nuoc[0][1]; ?>
          			</label>
          		</div>
          		<div class="checkbox col-xs-12">
          			<label>
          				<input type="checkbox" value="xn2" name="xacnhan" required>Tu nghiệp sinh cam kết chưa từng đi diện tu nghiệp tại nước <?php print $nuoc[0][1]; ?>
          			</label>
          		</div>
          		<div class="checkbox col-xs-12">
          			<label>
          				<input type="checkbox" value="xn3" name="xacnhan" required>Tu nghiệp sinh cam kết chưa từng phỏng vấn tại bất cứ đâu cho việc xuất ngoại nước <?php print $nuoc[0][1]; ?>
          			</label>
          		</div>
						</div>

						<input type="text" name="id_tns" value="<?php print $get['id']; ?>" hidden>
						<input type="text" name="id_quocgia" value="<?php print $nuoc[0][0]; ?>" hidden>

						<div class="form-group">
							<div class="col-xs-4">
								<a href="list_daxacnhan.php" class="btn btn-info">Huỷ bỏ việc cam kết</a>
							</div>
							<div class="col-xs-offset-4 col-xs-4">
								<button type="submit" class="btn btn-primary">Xác nhận đã cam kết</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<script language="JavaScript" src="js/npm.js"/></script>
		<script language="JavaScript" src="js/bootstrap-datepicker.js"/></script>
		<script language="JavaScript" src="js/custom.js"/></script>
	</body>
</html>