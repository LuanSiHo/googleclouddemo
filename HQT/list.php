<!DOCTYPE html>
<?php
	include_once 'db_connect.php';
?>
<?php if(isset($_SESSION['user_info'][1]) && filter_var($_SESSION['user_info'][1], FILTER_VALIDATE_EMAIL)) : ?>
<?php $data_tsn_dk = db_query_load_data("select * from dangky_tns;"); ?>
	<html>
		<head>
			<title>Danh sách đăng ký xuất khẩu lao động</title>
			<?php include 'load_css.php'; ?>
			<script src="js/jquery.min.js"></script>
			<script language="JavaScript" src="js/bootstrap.min.js"/></script>
		</head>
		<body>
			<div class = "example">
				<div class="container">
					<div class="row">
						<div class="col-xs-3">
							<?php include 'menu_left.php'; ?>
						</div>

						<div class="col-xs-9">
							<div class="panel panel-success">
								<div class="panel-heading">
									<h3 class="panel-title">Danh sách đăng ký xuất khẩu lao động</h3>
								</div>
								<div class="panel-body">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>STT</th>
												<th>Họ Tên</th>
												<th>Giới tính</th>
												<th>Email</th>
												<th>Số đt</th>
												<th>Tiếp nhận Hồ sơ</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($data_tsn_dk as $key => $tns) :  ?>
											<?php
												//Xu ly gioi tinh.
												$gioitinh = ($tns[3] == 1) ? "Nam" : (($tns[3] == 2) ? "Nữ" : "Không xác định");
											?>
												<tr>
													<td><?php print $key+1 ; ?></td>
													<td><?php print $tns[1] ?></td>
													<td><?php print $gioitinh ?></td>
													<td><?php print $tns[5] ?></td>
													<td><?php print $tns[6] ?></td>
													<td class="text-center"><a href="<?php print base_path('xacnhandangky.php?id=' . $tns[0]); ?>">Xử lý</a></td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<script language="JavaScript" src="js/npm.js"/></script>
			<script language="JavaScript" src="js/bootstrap-datepicker.js"/></script>
			<script language="JavaScript" src="js/custom.js"/></script>
		</body>
	</html>
<?php else : ?>
	<?php header('Location: ' . base_path('login.php')); ?>
<?php endif ; ?>