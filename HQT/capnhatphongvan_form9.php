<!DOCTYPE html>
<?php
	include_once 'db_connect.php';
	$get = $_GET;

	if(!isset($get['idhs']) || empty($get)) {
		header('Location: ' . base_path('list_phongvan.php'));
	}

	$hs = db_query_load_data("select * from hoso where id_hoso=" . $get['idhs'] . ";");
	if(empty($hs)) {
		header('Location: ' . base_path('list_phongvan.php'));
	}
	$tns = db_query_load_data("select * from tunghiepsinh where id_tns=" . $hs[0][1] . ";");
	$list_donhang = db_query_load_data("select * from donhang where id_quocgia=" . $tns[0][8] . " AND status=1 AND dh_sltuyen > 0;");
?>
<html>
	<head>
		<title>Đăng ký thông tin</title>
		<?php include 'load_css.php'; ?>
		<script src="js/jquery.min.js"></script>
		<script language="JavaScript" src="js/bootstrap.min.js"/></script>

	</head>
	<body>
		<div class="col-xs-offset-2 col-xs-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Title ở đây</h3>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" action="xulycapnhatphongvan.php" method="post" accept-charset="utf-8">
						<div class="form-group">
							<label class="col-xs-3 control-label">Chọn Đơn hàng: </label>
							<div class="col-xs-5 selectContainer">
								<select class="form-control" name="donhang" required>
									<option value="">Chọn đơn hàng</option>
									<?php foreach($list_donhang as $donhang) : ?>
										<option value="<?php print $donhang[0]; ?>"><?php print $donhang[4]; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12 btn-group" data-toggle="buttons">
								<label class="col-xs-4 btn btn-primary">
									<input type="radio" name="kq" value="1" required>Đậu
								</label>

								<label class="col-xs-4 btn btn-info active">
									<input type="radio" name="kq" value="2" required>Đậu dự bị
								</label>

								<label class="col-xs-4 btn btn-danger active">
									<input type="radio" name="kq" value="0" required>Rớt
								</label>
							</div>
						</div>
						<input type="text" name="id_hs" value="<?php print $get['idhs']; ?>" hidden>
						<div class="form-group">
							<div class="col-xs-4">
								<a href="list_phongvan.php" class="btn btn-info">Huỷ bỏ việc cập nhật</a>
							</div>
							<div class="col-xs-offset-4 col-xs-4">
								<button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
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