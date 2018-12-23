<!DOCTYPE html>
<?php
	include_once 'db_connect.php';
	$get = $_GET;

	//kiem tra url co ton tai parameter id hay ko.
	if(!isset($get['id']) || empty($get)) {
		header('Location: ' . base_path('list_dauvao.php'));
	}

	//kiem tra database co ton tai id user dang ky nay hay ko.
	$acc = db_query_load_data("select * from hoso where id_tns=" . $get['id'] . ";");
	if(empty($acc)) {
		header('Location: ' . base_path('list_dauvao.php'));
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
					<h3 class="panel-title">Thông tin đóng tiền cọc và hoàn hoàn training (1 Tuần)</h3>
				</div>
				<div class="panel-body">
					<h2 class="panel-title">Họ và tên: <?php print $get['tns']; ?></h2>
					<form class="form-horizontal" action="xulyxacnhandongcocvatraining.php" method="post" accept-charset="utf-8">
						<div class="form-group">
          		<div class="checkbox col-xs-12">
          			<label>
          				<input type="checkbox" value="1" name="coc" <?php print ($acc[0][2] == 1) ? 'checked disabled' : ''; ?>>Đóng tiền cọc
          			</label>
          		</div>
          		<div class="checkbox col-xs-12">
          			<label>
          				<input type="checkbox" value="1" name="training" <?php print ($acc[0][3] == 1) ? 'checked disabled' : ''; ?>>Hoàn thành training
          			</label>
          		</div>
						</div>

						<input type="text" name="id_hs" value="<?php print $acc[0][0]; ?>" hidden>

						<div class="form-group">
							<div class="col-xs-4">
								<a href="list_dauvao.php" class="btn btn-info">Huỷ việc cập nhật</a>
							</div>
							<div class="col-xs-offset-4 col-xs-4">
								<button type="submit" class="btn btn-primary">Xác nhận thông tin</button>
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