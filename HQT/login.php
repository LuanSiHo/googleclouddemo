<!DOCTYPE html>
<html>
	<head>
		<title>Đăng Nhập</title>
		<?php include 'load_css.php'; ?>
		<script src="js/jquery.min.js"></script>
		<script language="JavaScript" src="js/bootstrap.min.js"/></script>
	</head>
	<body>
			<div class="container">
				<div class="row">
					<br><br><br><br><br><br>
					<form action="xulydangnhap.php" method="post" accept-charset="utf-8" class="col-xs-5 col-centered form-horizontal">
						<div class="panel panel-info">
              <div class="text-center panel-heading">
                  <h3 class="panel-title">Đăng nhập nhân viên</h3>
              </div>
              <div class="panel-body">
              	<div class="form-group">
									<label class="col-xs-3 control-label">E-mail: </label>
									<div class="col-xs-9">
		                <input type="email" class="form-control" placeholder="E-mail" name="email" required/>
		              </div>
								</div>
								<div class="form-group">
									<label class="col-xs-3 control-label">Password: </label>
									<div class="col-xs-9">
		                <input type="password" class="form-control" placeholder="Password" name="password" required/>
		              </div>
								</div>
								<div class="col-xs-12 form-group">
									<button type="submit" class="btn btn-primary pull-right">Đăng nhập</button>
								</div>
              </div>
            </div>
					</form>
				</div>
			</div>
		<script language="JavaScript" src="js/npm.js"/></script>
		<script language="JavaScript" src="js/bootstrap-datepicker.js"/></script>
		<script language="JavaScript" src="js/custom.js"/></script>
	</body>
</html>