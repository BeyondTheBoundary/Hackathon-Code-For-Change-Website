<!DOCTYPE html>

<?php 
    $connect = mysql_connect("mysql.freehosting.io", "u488574653_swf", "code4change") 
            or die("Check your connection!"); 
    mysql_select_db("u488574653_swf");
    
    $query = "SELECT id, username, time, billcode, price, pic1, pic2, pic3, status " . 
                "FROM transaction " .
				"ORDER BY time DESC " . 
				"LIMIT 10";
    
    $results = mysql_query($query) 
            or die(mysql_error());
    
    $screen = "";
?>


<html>
<head>
    <meta charset="UTF-8">
    <title>[DEMO] Food For Change: Discount request log.</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/navbar-login.css" rel="stylesheet">
	<style>
	img.thumb {
		width: 200px;
		height: auto;
	}
	</style>
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
                    <li class="active"><a href="transaction.php"><span class="glyphicon glyphicon-tasks"></span> Giao dịch gần đây</a></li>
                    <li><a href="discount.php"><span class="glyphicon glyphicon-cog"></span> Quản lý Discount</a></li>
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
<h3>Discount request log<small> | Các yêu cầu Discount gửi tới.</small></h3>
<br>
<?php
$screen .=<<<CELL0
	<table class='table table-striped'>
		<tr><th>Info</th><th>Before</th><th>After</th><th>QR</th><th>Status</th></tr>
CELL0;


while($row = mysql_fetch_array($results)){
	extract($row);
	switch($status){
	case "pending":
		$icon = "pushpin";
		break;
	case "approve":
		$icon = "ok";
		break;
	case "refuse":
		$icon = "remove";
		break;
	case "redflag":
		$icon = "flag";
		break;
	}
	$screen .=<<<ECHO1
		<tr><td><span class="glyphicon glyphicon-tag"></span> $id<br><span class="glyphicon glyphicon-qrcode"></span> $billcode<br><span class="glyphicon glyphicon-user"></span> $username<br><span class="glyphicon glyphicon-send"></span> $time</td><td><img class="thumb" src="http://swf.letsgeekaround.com/upload/$pic1"></td><td><img class="thumb" src="http://swf.letsgeekaround.com/upload/$pic2"></td><td><img class="thumb" src="http://swf.letsgeekaround.com/upload/$pic3"></td><td style="text-align: center;"><span class="glyphicon glyphicon-$icon"></span><br>$status</td></tr>
ECHO1;
}


$screen .=<<<CELL3
	</table>
CELL3;
	echo $screen;
?>
<p><br><br><center>Nhóm Hackathon ISC : Trung tâm CHANGE</center><p>
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
                        <a class="btn btn-success btn-lg btn-block" href="transaction.php">Làm mới danh sách<br><span class="glyphicon glyphicon-refresh"></span></a>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p><b>Ghi chú</b></p>
                        <p><span class="glyphicon glyphicon-ok" style="color: blue;"></span> Chấp nhận discount <small>(mặc định)</small></p>
                        <p><span class="glyphicon glyphicon-pushpin" style="color: gray;"></span> Xử lý sau.</p>
                        <p><span class="glyphicon glyphicon-remove" style="color: red;"></span> Không chấp nhận.</p>
                        <p><span class="glyphicon glyphicon-flag" style="color: red;"></span> Gắn nhãn vi phạm.</p>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p><center><strong>Thống kê</strong></center></p>
                        <hr>
                        <p><b>Thời gian:</b> 10/08/2014</p>
                        <p><b>Tổng lượt khách:</b> 1250 <small>lượt</small></p>
                        <p><b>Số discount yêu cầu:</b> 182<small> discounts</small></p>
                        <p><b>Số discount chấp nhận:</b> 173<small> discounts</small></p>
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
