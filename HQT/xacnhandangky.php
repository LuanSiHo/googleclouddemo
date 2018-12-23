<!DOCTYPE html>
<?php
	include_once 'db_connect.php';
	$get = $_GET;
	//kiem tra url co ton tai parameter id hay ko.
	if(!isset($get['id']) || empty($get)) {
		header('Location: ' . base_path('list.php'));
	}

	//kiem tra database co ton tai id user dang ky nay hay ko.
	$acc = db_query_load_data("select * from dangky_tns where id_dk=" . $get['id'] . ";");
	if(empty($acc)) {
		header('Location: ' . base_path('list.php'));
	} else {
		$data_thanhpho = db_query_load_data("select * from quocgia");
	}
?>
<html>
	<head>
		<title>Xác nhận đăng ký thông tin</title>
		<?php include 'load_css.php'; ?>
		<script src="js/jquery.min.js"></script>
		<script language="JavaScript" src="js/bootstrap.min.js"/></script>

	</head>
	<body>
		<div class = "example">
			<div class="container">
				<div class="row">
					<div class="text-center">
						<h2>Thông tin đã đăng ký của tu nghiệp sinh</h2>
					</div>
					<form action="xulyxacnhanthongtindangky.php" method="post" accept-charset="utf-8" class="form-horizontal">
						<div class="form-group">
							<label class="col-xs-3 control-label">Chọn Quốc Gia: </label>
							<div class="col-xs-5 selectContainer">
								<select class="form-control" name="quocgia" required>
									<option value="">Chọn quốc gia tu nghiệp</option>
									<?php foreach ($data_thanhpho as $thanhpho) :?>
										<option value="<?php print $thanhpho[0] ?>" <?php print ($thanhpho[0] == $acc[0][7]) ? "selected" : ''; ?>><?php print $thanhpho[1] ?></option>
									<?php endforeach ; ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-3 control-label">Họ và tên: </label>
							<div class="col-xs-5">
                <input type="text" class="form-control" placeholder="Họ và tên" name="hoten" required value="<?php print $acc[0][1]; ?>" />
              </div>
						</div>
						<div class="form-group">
							<label class="col-xs-3 control-label">Ngày tháng năm sinh: </label>
							<div class='col-xs-5 input-group'>
								<input type='date' class="form-control" id='txtFromDay' runat="server" name="ngaysinh" required value="<?php print IntToDate($acc[0][2]); ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-3 control-label">Giới tính: </label>
							<label class="radio-inline"><input type="radio" name="gioitinh" value="1" <?php print ($acc[0][3] == 1) ? 'checked' : ''; ?>>Nam</label>
							<label class="radio-inline"><input type="radio" name="gioitinh" value="2" <?php print ($acc[0][3] == 2) ? 'checked' : ''; ?>>Nữ</label>
							<label class="radio-inline"><input type="radio" name="gioitinh" value="0" <?php print ($acc[0][3] == 0) ? 'checked' : ''; ?>>Không xác định được</label>
						</div>

						<div class="form-group">
							<label class="col-xs-3 control-label">Chứng minh thư: </label>
							<div class="col-xs-5">
                <input type="text" class="form-control" placeholder="Chứng minh thư" name="cmnd" required value="<?php print $acc[0][4]; ?>" />
              </div>
						</div>

						<div class="form-group">
							<label class="col-xs-3 control-label">E-mail: </label>
							<div class="col-xs-5">
                <input type="email" class="form-control" placeholder="E-mail" name="email" required value="<?php print $acc[0][5]; ?>" />
              </div>
						</div>

						<div class="form-group">
							<label class="col-xs-3 control-label">Số điện thoại: </label>
							<div class="col-xs-5">
                <input type="text" class="form-control" placeholder="Số điện thoại" name="sdt" required value="<?php print $acc[0][6]; ?>" />
              </div>
						</div>

						<div class="form-group">
							<label class="col-xs-3 control-label">Điuạ chỉ thường trú: </label>
							<div class="col-xs-5">
                <input type="text" class="form-control" placeholder="Địa chỉ" name="diachi" required value="" />
              </div>
						</div>

						<input type="text" name="id_dk" value="<?php print $acc[0][0]; ?>" hidden/>

						<div class="panel panel-info">
              <div class="panel-heading">
                  <h3 class="panel-title">Quy định và điều lệ đăng ký Xuất Nhập Khẩu lao động</h3>
              </div>
              <div class="panel-body">
              	nội dung panel được ghi ở trong này
              	<ul>
              		<li>Điều lệ 1</li>
              		<li>Điều lệ 2</li>
              		<li>Điều lệ 3</li>
              		<li>Điều lệ 4</li>
              	</ul>

              	<div class="form-group">
              		<div class="checkbox col-xs-12">
              			<label>
              				<input type="checkbox" value="xn1" name="xacnhan" required>TNS đã đọc các điều lệ
              			</label>
              		</div>
              		<div class="checkbox col-xs-12">
              			<label>
              				<input type="checkbox" value="xn2" name="xacnhan" required>TNS chấp nhận các điều lệ trên
              			</label>
              		</div>
              		<div class="checkbox col-xs-12">
              			<label>
              				<input type="checkbox" value="xn3" name="xacnhan" required>TNS sẽ chịu trách nhiệm cho bất cứ thông tin khai bao ở trên (nếu có sai sót)
              			</label>
              		</div>
								</div>
								<div class="form-group col-xs-12">
									<a href="<?php print base_path('list.php'); ?>" class="btn btn-info">Huỷ bỏ việc xác nhận</a>
									<button type="submit" class="btn btn-primary pull-right" name="xacnhanthongtin">Xác nhận thông tin</button>
									<a href="xulyhuythongtindangky.php?id=<?php print $acc[0][0]; ?>" class="btn btn-warning pull-right">Huỷ toàn bộ thông tin</a>
								</div>
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