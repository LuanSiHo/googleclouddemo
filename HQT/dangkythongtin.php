<?php
	include 'db_connect.php';
	$data_thanhpho = db_query_load_data("select * from quocgia");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Đăng ký thông tin</title>
		<?php include 'load_css.php'; ?>
		<script src="js/jquery.min.js"></script>
		<script language="JavaScript" src="js/bootstrap.min.js"/></script>
	</head>
	<body>
		<div class = "example">
			<div class="container">
				<div class="row">
					<div class="text-center">
						<h2>Đăng ký thông tin xuất khẩu lao động</h2>
					</div>
					<form action="xulydangkythongtin.php" method="post" accept-charset="utf-8" class="form-horizontal">
						<div class="form-group">
							<label class="col-xs-3 control-label">Chọn Quốc Gia: </label>
							<div class="col-xs-5 selectContainer">
								<select class="form-control" name="quocgia" required>
									<option value="">Chọn quốc gia tu nghiệp</option>
									<?php foreach ($data_thanhpho as $thanhpho) :?>
										<option value="<?php print $thanhpho[0] ?>"><?php print $thanhpho[1] ?></option>
									<?php endforeach ; ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-3 control-label">Họ và tên: </label>
							<div class="col-xs-5">
                <input type="text" class="form-control" placeholder="Họ và tên" name="hoten" required/>
              </div>
						</div>

						<div class="form-group">
							<label class="col-xs-3 control-label">Ngày tháng năm sinh: </label>
							<div class='col-xs-5 input-group'>
								<input type='date' class="form-control" name="ngaysinh" required/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-3 control-label">Giới tính: </label>
							<label class="radio-inline"><input type="radio" name="gioitinh" required value="1">Nam</label>
							<label class="radio-inline"><input type="radio" name="gioitinh" value="2">Nữ</label>
							<label class="radio-inline"><input type="radio" name="gioitinh" value="0">Không xác định được</label>
						</div>

						<div class="form-group">
							<label class="col-xs-3 control-label">Chứng minh thư: </label>
							<div class="col-xs-5">
                <input type="text" class="form-control" placeholder="Chứng minh thư" name="cmnd" required/>
              </div>
						</div>

						<div class="form-group">
							<label class="col-xs-3 control-label">E-mail: </label>
							<div class="col-xs-5">
                <input type="email" class="form-control" placeholder="E-mail" name="email" required/>
              </div>
						</div>

						<div class="form-group">
							<label class="col-xs-3 control-label">Số điện thoại: </label>
							<div class="col-xs-5">
                <input type="text" class="form-control" placeholder="Số điện thoại" name="sdt" required/>
              </div>
						</div>

						<div class="panel panel-info">
              <div class="panel-heading">
                  <h3 class="panel-title">Quy định và điều lệ đăng ký</h3>
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
              				<input type="checkbox" value="xn1" name="xacnhan" required>Tôi đã đọc các điều lệ
              			</label>
              		</div>
              		<div class="checkbox col-xs-12">
              			<label>
              				<input type="checkbox" value="xn2" name="xacnhan" required>Tôi chấp nhận các điều lệ trên
              			</label>
              		</div>
              		<div class="checkbox col-xs-12">
              			<label>
              				<input type="checkbox" value="xn3" name="xacnhan" required>Tôi sẽ chịu trách nhiệm cho bất cứ thông tin khai bao ở trên (nếu có sai sót)
              			</label>
              		</div>
								</div>
								<div class="form-group col-xs-9">
									<button type="submit" class="btn btn-primary pull-right">Đăng ký</button>
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