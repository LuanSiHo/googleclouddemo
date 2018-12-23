<!DOCTYPE html>
<?php
	include_once 'db_connect.php';
?>
<?php if(isset($_SESSION['user_info'][1]) && filter_var($_SESSION['user_info'][1], FILTER_VALIDATE_EMAIL)) : ?>
<?php 
	//Load ra danh sach nhung tu nghiep sinh NAM TRONG (danh sach nhung nguoi da cam ket) VA ( CHUA hoan thanh kham suc khoe)
	$data_tsn = db_query_load_data("select * from tunghiepsinh where id_tns in (select id_tns from tns_camket_khamsk where dacamket=1 AND status=0);");
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
									<h3 class="panel-title">Danh sách chờ khám sức khoẻ</h3>
								</div>
								<div class="panel-body">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>STT</th>
												<th>Họ Tên</th>
												<th>Giới tính</th>
												<th>Địa chỉ</th>
												<th>Xử lý</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($data_tsn as $key => $tns) :  ?>
											<?php
												//Xu ly gioi tinh.
												$gioitinh = ($tns[3] == 1) ? "Nam" : (($tns[3] == 2) ? "Nữ" : "Không xác định");
											?>
												<tr>
													<td><?php print $key+1 ; ?></td>
													<td><a href="#"><?php print $tns[1] ; ?></a></td>
													<td><?php print $gioitinh ; ?></td>
													<td><?php print $tns[7] ; ?></td>
													<td class="text-center"><a href="khamsuckhoe_form4.php?id=<?php print $tns[0]; ?>">Xử lý</a></td>
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