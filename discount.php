<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>Snowdrop - Not just for Code4Change</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/navbar-login.css" rel="stylesheet">
</head>

<body>
    
    <!-- NAVBAR -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="account.html"><span class="glyphicon glyphicon-user"></span> Tài khoản</a></li>
                    <li><a href="index.php"><span class="glyphicon glyphicon-ok-circle"></span> Kiểm duyệt</a></li>
                    <li><a href="customer.php"><span class="glyphicon glyphicon-th"></span> Khách hàng</a></li>
                    <li><a href="transaction.php"><span class="glyphicon glyphicon-tasks"></span> Giao dịch gần đây</a></li>
                    <li class="active"><a href="discount.php"><span class="glyphicon glyphicon-cog"></span> Quản lý Discount</a></li>
                </ul>
                
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <form class="navbar-search navbar-form" method="get" action="">
                            <span class="input-group">
                            <input class="form-control" placeholder="Search" name="search" type="text">
                            <span class="input-group-btn"><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button></span>
                            </span>
                        </form>
                    </li>
                    
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-user"></span> 
                        <strong>Hoàng Yến</strong>
                        <span class="glyphicon glyphicon-chevron-down"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="navbar-login">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <p class="text-center">
                                            <img src="img/hoangyen.png">
                                        </p>
                                    </div>
                                    <div class="col-lg-8">
                                        <p class="text-left"><strong>Nhà hàng Hoàng Yến</strong></p>
                                        <p class="text-left">
                                            <a href="#" class="btn btn-primary btn-block btn-sm">Thông tin tài khoản</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="navbar-login navbar-login-session">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p>
                                            <a href="#" class="btn btn-danger btn-block">Đăng xuất</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END NAVBAR -->
    <!--- USER Widget--->
    
    <!--- END USER Widget--->
    
    <div class="container">
        <div class="row">
            <div class="col-md-9" style=" height: auto;">
                <!--Map-->
<!--------------------------------------------------->
<h3>Cài đặt chính sách Discount</h3>
<hr>
<div>
<p><input type="radio" name="discounttype" value="allthesame" checked> <b>Tất cả các mã discount có lượng giảm giá bằng nhau: </b></p>
	<div class="col-md-11 col-md-offset-1">
		Nhập tỉ lệ: <input type="text" value="5" style="width: 10%; text-align: right;"> %
	</div>
	<br>
<input type="radio" name="discounttype" value="depend"> <b>Các mã discount có tỉ lệ giảm giá khác nhau: </b><br>
<div class="col-md-11 col-md-offset-1">
<table class='table table-striped'>
<tr>
	<th>ID</th>
	<th>Discount Code</th>
	<th>Discount Amount</th>
	<th>Min bill for discount</th>
	<th>Edit</th>
</tr>
<tr>
	<td>1</td>
	<td>FC</td>
	<td>17%</td>
	<td>None</td>
	<td><input type="text" value="17%" style="width: 80%; text-align: right;"></td>
</tr>
<tr>
	<td>2</td>
	<td>IO</td>
	<td>20%</td>
	<td>None</td>
	<td><input type="text" value="20%" style="width: 80%; text-align: right;"></td>
</tr>
<tr>
	<td>3</td>
	<td>WS</td>
	<td>18%</td>
	<td>None</td>
	<td><input type="text" value="18%" style="width: 80%; text-align: right;"></td>
</tr>
<tr>
	<td>4</td>
	<td>PL</td>
	<td>25%</td>
	<td>None</td>
	<td><input type="text" value="25%" style="width: 80%; text-align: right;"></td>
</tr>
<tr>
	<td>5</td>
	<td>XV</td>
	<td>24%</td>
	<td>None</td>
	<td><input type="text" value="24%" style="width: 80%; text-align: right;"></td>
</tr>
</table>
<center><button class="btn btn-success">Submit!</button></center>
</div>
</div>


<!--------------------------------------------------->
                <!--END Map-->
            </div>
            <div class="col-md-3">
                 <div class="panel panel-default">
                    <div class="panel-thumbnail">
                        <img class="img-responsive" src="img/hoangyen.png"> 
                    </div>
                    <div class="panel-body">
                        <p><b>Hoàng Yến Restaurant</b></p>
                        <a class="btn btn-success btn-lg btn-block" href="discount.php">Làm mới danh sách<br><span class="glyphicon glyphicon-refresh"></span></a>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p><center><strong>Thống kê</strong></center></p>
                        <hr>
                        <p><b>Thời gian:</b> 10/08/2014</p>
                        <p><b>Tổng lượt khách:</b> 1250 <small>lượt</small></p>
                        <p><b>Số discount yêu cầu:</b> 182<small> discounts</small></p>
                        <p><b>Số discount đã tặng:</b> 173<small> discounts</small></p>
                        <p><center><b>Tỉ lệ:</b> 95%</center></p>
                        <div class="progress">
                        <div class="progress-bar progress-bar-striped active"  role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%">
                            <span class="sr-only" style="color: red;">95%</span>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <!--footer-->
    <div>
        <p></p>   
    </div>
    
    
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
