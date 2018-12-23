<!DOCTYPE html>
<?php
	include_once 'db_connect.php';
	$get = $_GET;

	//kiem tra url co ton tai parameter id hay ko.
	if(!isset($get['id']) || empty($get)) {
		header('Location: ' . base_path('list_cankhamsk.php'));
	}

	//kiem tra database co ton tai id user dang ky nay hay ko.
	$acc = db_query_load_data("select * from tunghiepsinh where id_tns=" . $get['id'] . ";");
	if(empty($acc)) {
		header('Location: ' . base_path('list_cankhamsk.php'));
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
					<h3 class="panel-title">Cập nhật hồ sơ khám sức khoẻ.</h3>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" action="xulykhamsuckhoe.php" method="post" accept-charset="utf-8">
						<div class="form-group">
							<div class="col-xs-12 btn-group" data-toggle="buttons">
								<label class="col-xs-6 btn btn-primary">
									<input type="radio" name="kq_khamsk" value="1" >Đạt
								</label>
								<label class="col-xs-6 btn btn-danger active">
									<input type="radio" name="kq_khamsk" value="0" checked>Không đạt
								</label>
							</div>
						</div>

						<div class="collapse form-group">
							<div class="checkbox col-xs-12">
          			<label>
          				<input class="tt-input" id="cb" type="checkbox" name="cb">Đã nhận hồ sơ sức khoẻ ngày: <?php print date('d/m/Y'); ?>
          			</label>
          		</div>
						</div>

						<input type="text" name="id_tns" value="<?php print $get['id']; ?>" hidden>

						<div class="form-group">
							<div class="col-xs-4">
								<a href="list_cankhamsk.php" class="btn btn-info">Huỷ bỏ việc cập nhật</a>
							</div>
							<div class="col-xs-offset-4 col-xs-4">
								<button type="submit" class="btn btn-primary">Xác nhận Đạt sức khoẻ</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

		<script>
			$(document).ready(function(){
					$(".btn-danger").click(function(){
						$(".collapse").collapse('hide');
					});
					$(".btn-primary").click(function(){
						$(".collapse").collapse('show');
					});
					$(".collapse").on('shown.bs.collapse', function(){
			      $(".tt-input").attr('required','required');
			    });
			    $(".collapse").on('hidden.bs.collapse', function(){
			      $(".tt-input").removeAttr('required');
			    });
				});
		</script>

		<script language="JavaScript" src="js/npm.js"/></script>
		<script language="JavaScript" src="js/bootstrap-datepicker.js"/></script>
		<script language="JavaScript" src="js/custom.js"/></script>
	</body>
</html>