<!DOCTYPE html>
<?php
	include_once 'db_connect.php';
?>
<?php if(isset($_SESSION['user_info'][1]) && filter_var($_SESSION['user_info'][1], FILTER_VALIDATE_EMAIL)) : ?>
<?php
	if(isset($_GET['mess']) && $_GET['mess'] == 'failed') {
		show_alert("người dùng đã tồn tại !!!");
	}

	$accs = db_query_load_data("select * from taikhoan;");
?>
	<html>
		<head>
			<title>Danh sách đăng ký tu nghiệp sinh</title>
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
									<h3 class="panel-title">Tạo người dùng mới</h3>
								</div>
								<div class="panel-body">
									<div class="col-xs-6">
										<div class="panel panel-default">
											<div class="panel-heading">
												<h3 class="panel-title">Danh sách Người dùng hiện có</h3>
											</div>
											<div class="panel-body">
												<table class="table table-striped">
													<thead>
														<tr>
															<th>STT</th>
															<th>E-mail</th>
															<th>Xoá</th>
														</tr>
													</thead>
													<tbody>
														<?php foreach($accs as $key => $acc) : ?>
															<tr>
																<td><?php print $key + 1; ?></td>
																<td><?php print $acc[1]; ?></td>
																<td><a href="xulyxoanguoidung.php?id=<?php print $acc[0]; ?>">Xoá</a></td>
															</tr>
														<?php endforeach; ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<div class="col-xs-6">
										<div class="panel panel-default">
											<div class="panel-heading">
												<h3 class="panel-title">Tạo mới một người dùng</h3>
											</div>
											<div class="panel-body">
												<form class="form-horizontal" action="xulytaonguoidung.php" method="post" accept-charset="utf-8">
													<div class="form-group">
														<label class="control-label col-xs-3">Email</label>
														<div class="col-xs-9">
															<input type="email" class="form-control" placeholder="Email" name="email">
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-xs-3">Password</label>
														<div class="col-xs-9">
															<input type="password" class="form-control" placeholder="Email" name="password">
														</div>
													</div>
													<div class="form-group">
														<div class="col-xs-offset-6">    
		                          <button type="submit" class="btn btn-primary">Tạo người dùng này</button>
		                        </div>
													</div>
												</form>
											</div>
										</div>
									</div>
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