<?php include 'include/header.php';?>
<?php include 'include/sidebar.php';
function getstatus($status){
	if($status==1)
		return "<div class='badge badge-success'>Active</div>";
	else
		return "<div class='badge badge-warning'>Deactive</div>";
}
function stloandata()
{
		include 'include/db_con.php';
	$sql="SELECT `member_info`.`name`,`loan_application`.`loanamount`,`loan_application`.`date`,`loan_application`.`status`,`loan_application`.`portfolioid`,`loan_application`.`acountNo`
FROM `loan_application` INNER JOIN `member_info` on `loan_application`.`portfolioid`=`member_info`.`Auto` WHERE `loan_application`.`loantype`='ST' && `loan_application`.`status`='1'";
$result=mysqli_query($conn,$sql);
$data='';
while($row=mysqli_fetch_array($result)){
	$data.= "<tr data-target='#largeModal' data-toggle='modal' onclick='getloandetails(this.id)' id='$row[5]' acno='$row[5]'>
		<td>$row[0]</td>
		<td>$row[1]</td>
		<td>".date('d/m/Y',strtotime($row[2]))."</td>
		<td>".getstatus($row[3])."</td>
	</tr>";
}
return $data;
}
function mtloandata()
{
		include 'include/db_con.php';
	$sql="SELECT `member_info`.`name`,`loan_application`.`loanamount`,`loan_application`.`date`,`loan_application`.`status`,`loan_application`.`portfolioid`,`loan_application`.`acountNo`
FROM `loan_application` INNER JOIN `member_info` on `loan_application`.`portfolioid`=`member_info`.`Auto` WHERE `loan_application`.`loantype`='MT' && `loan_application`.`status`='1'";
$result=mysqli_query($conn,$sql);
$data='';
while($row=mysqli_fetch_array($result)){
	$data.= "<tr data-target='#largeModal' data-toggle='modal' onclick='getloandetails(this.id)' id='$row[5]' acno='$row[5]'>
		<td>$row[0]</td>
		<td>$row[1]</td>
		<td>".date('d/m/Y',strtotime($row[2]))."</td>
		<td>".getstatus($row[3])."</td>
	</tr>";
}
return $data;
}
function hblloandata()
{
		include 'include/db_con.php';
	$sql="SELECT `member_info`.`name`,`loan_application`.`loanamount`,`loan_application`.`date`,`loan_application`.`status`,`loan_application`.`portfolioid`,`loan_application`.`acountNo`
FROM `loan_application` INNER JOIN `member_info` on `loan_application`.`portfolioid`=`member_info`.`Auto` WHERE `loan_application`.`loantype`='HBL' && `loan_application`.`status`='1'";
$result=mysqli_query($conn,$sql);
$data='';
while($row=mysqli_fetch_array($result)){
	$data.= "<tr data-target='#largeModal' data-toggle='modal' onclick='getloandetails(this.id)' id='$row[5]' acno='$row[5]'>
		<td>$row[0]</td>
		<td>$row[1]</td>
		<td>".date('d/m/Y',strtotime($row[2]))."</td>
		<td>".getstatus($row[3])."</td>
	</tr>";
}
return $data;
}
function savingdata()
{
	include 'include/db_con.php';
	$sql="SELECT `member_info`.`name`,SUM(`D_Amount`),SUM(`W_Amount`),`saving`.`status`,`Account_no` FROM `saving` INNER JOIN `member_info` on `saving`.`memberid`=`member_info`.`Auto` GROUP BY `Account_no` order by`Account_no`";
$result=mysqli_query($conn,$sql);
$data='';
$i=1;
while($row=mysqli_fetch_array($result)){
	$data.= "<tr data-target='#largeModal' data-toggle='modal' onclick='getsavingdetails(this.id)' id='$row[1]'>
		<td>$i</td>
		<td>$row[0]</td>
		<td>$row[1]</td>
		<td>".date('d/m/Y',strtotime($row[2]))."</td>
		<td>".($row[1]-$row[2])."</td>
	</tr>";
	$i++;
}
return $data;
}
function rdData()
{
	include 'include/db_con.php';
	$sql="SELECT `member_info`.`name`,`rdamount`,`returnAmt`,`savings_rd`.`status`,`NoOfMonth`,`account` FROM `savings_rd` INNER JOIN `member_info` ON `member_info`.`Auto`=`savings_rd`.`userid` where `savings_rd`.`status`='1' GROUP BY `account` ORDER BY `account`";
$result=mysqli_query($conn,$sql);
$data='';
$i=1;
while($row=mysqli_fetch_array($result)){
	$data.= "<tr data-target='#largeModal' data-toggle='modal' onclick='getrddetails(this.id)' id='$row[5]'>
		<td>$i</td>
		<td>$row[0]</td>
		<td>$row[1]</td>
		<td>$row[2]</td>
		<td>$row[4]</td>
		<td>".getstatus($row[3])."</td>
	</tr>";
	$i++;
}
return $data;
}
function tfData()
{
	include 'include/db_con.php';
	$sql="SELECT `member_info`.`name`,`savedemand`.`Tfamt`,count(`savedemand`.`UserId`),`member_info`.`status`,`savedemand`.`UserId`
FROM `savedemand` INNER JOIN `member_info` on `member_info`.`Auto`=`savedemand`.`UserId` where `member_info`.`status`='1' group by `savedemand`.`UserId` order by `savedemand`.`UserId` ASC";
$result=mysqli_query($conn,$sql);
$data='';
$i=1;
while($row=mysqli_fetch_array($result)){
	// $data.= "<tr data-target='#largeModal' data-toggle='modal' onclick='getsavingdetails(this.id)' id='$row[1]'>
	$data.= "<a href='usertheftamount.php?id=".$row[4]."'><tr>
		<td>$i</td>
		<td>$row[0]</td>
		<td>$row[1]</td>
		<td>$row[2]</td>
		<td>".getstatus($row[3])."</td>
	</tr></a>";
	$i++;
}
return $data;
}
function FdData()
{
	include 'include/db_con.php';
	$sql="SELECT `member_info`.`name`,`fixed_deposit`.`FD_amount`,`fixed_deposit`.`DOFD`,`fixed_deposit`.`FD_Period`,`fixed_deposit`.`status` FROM `fixed_deposit` INNER JOIN `member_info` on `fixed_deposit`.`userid`=`member_info`.`Auto` ORDER BY `fixed_deposit`.`userid`";
$result=mysqli_query($conn,$sql);
$data='';
$i=1;
while($row=mysqli_fetch_array($result)){
	$data.= "<tr data-target='#largeModal' data-toggle='modal' onclick='getsavingdetails(this.id)' id='$row[1]'>
		<td>$i</td>
		<td>$row[0]</td>
		<td>$row[1]</td>
		<td>".date('d/m/Y',strtotime($row[2]))."</td>
		<td>".getstatus($row[3])."</td>
	</tr>";
	$i++;
}
return $data;
}
function member()
{
	include 'include/db_con.php';
$sql="SELECT COUNT(`Auto`)as total FROM `member_info` ";
$res=mysqli_query($conn,$sql);
$result=mysqli_fetch_array($res);
return $result[0];
}

function mtloan()
{
	include 'include/db_con.php';
$sql="SELECT SUM(`loanamount`)AS MT FROM `loan_application` WHERE `loantype`='MT'";
$res=mysqli_query($conn,$sql);
$result=mysqli_fetch_array($res);
return $result[0];
}

function Stloan()
{
	include 'include/db_con.php';
$sql="SELECT SUM(`loanamount`)AS ST FROM `loan_application` WHERE `loantype`='ST'";
$res=mysqli_query($conn,$sql);
$result=mysqli_fetch_array($res);
return $result[0];
}
function hblloan()
{
	include 'include/db_con.php';
$sql="SELECT SUM(`loanamount`)AS ST FROM `loan_application` WHERE `loantype`='HBL'";
$res=mysqli_query($conn,$sql);
$result=mysqli_fetch_array($res);
return $result[0];
}
function rd()
{
	include 'include/db_con.php';
$sql="SELECT SUM(`rdamount`)as total FROM `savings_rd` ";
$res=mysqli_query($conn,$sql);
$result=mysqli_fetch_array($res);
return $result[0];
}
function fd()
{
	include 'include/db_con.php';
$sql="SELECT SUM( `FD_amount`)as total FROM `fixed_deposit` ";
$res=mysqli_query($conn,$sql);
$result=mysqli_fetch_array($res);
return $result[0];
}

function saving()
{
	include 'include/db_con.php';
$sql="SELECT SUM(`Sbalance`)as total FROM `saving` ";
$res=mysqli_query($conn,$sql);
$result=mysqli_fetch_array($res);
return $result[0];
}
?>
				<div class="app-content">
					<section class="section">
						<div class="row">
							<div class="col-sm-12 col-lg-6 col-md-6 col-xl-4">
								<div class="card">
									<div class="card-body p-4">
										<div class="row">
											<div class="col-5 text-center">
												<span class="mini-stat-icon bg-bitbucket"><i class="fa fa-user"></i></span>
											</div>
											<div class="col-7">
												<a href="memberlist.php">
													<div class="numbers">
														<div class="font-13 text-muted">Total Member Register</div>
														<h3 class="font-weight-bold"><?php echo member();?></h3>
													</div>
												</a>
											</div>
										</div>
                                    </div>
							    </div>
							</div>
							<div class="col-sm-12 col-lg-6 col-md-6 col-xl-4">
								<div class="card">
									<div class="card-body p-4">
										<div class="row">
											<div class="col-5 text-center">
												<span class="mini-stat-icon bg-bitbucket"><i class="fa fa-sort-amount-asc"></i></span>
											</div>
											<div class="col-7">
												<a href="loandetails.php?id=MT">
													<div class="numbers">
														<div class="font-13 text-muted">Total MT loan Disbrushment</div>
														<h3 class="font-weight-bold"><?php echo mtloan();?></h3>
													</div>
												</a>
											</div>
										</div>
                                    </div>
							    </div>
							</div>
							<div class="col-sm-12 col-lg-6 col-md-6 col-xl-4">
								<div class="card">
									<div class="card-body p-4">
										<div class="row">
											<div class="col-5 text-center">
												<span class="mini-stat-icon bg-bitbucket "><i class="fa fa-sort-amount-desc"></i></span>
											</div>
											<div class="col-7">
												<a href="loandetails.php?id=ST">
													<div class="numbers">
														<div class="font-13 text-muted">Total ST Loan Disbrushment Amount</div>
														<h3 class="font-weight-bold"><?php echo Stloan();?></h3>
													</div>
												</a>
											</div>
										</div>
                                    </div>
							    </div>
							</div>
							<div class="col-sm-12 col-lg-6 col-md-6 col-xl-4">
								<div class="card">
									<div class="card-body p-4">
										<div class="row">
											<div class="col-5 text-center">
												<span class="mini-stat-icon bg-bitbucket"><i class="fa fa-dollar"></i></span>
											</div>
											<div class="col-7">
												<a href="loandetails.php?id=HBL">
													<div class="numbers">
														<div class="font-13 text-muted">Total HBL Disbrushment Amount</div>
														<h3 class="font-weight-bold"><?php echo hblloan();?></h3>
													</div>
												</a>
											</div>
										</div>
                                    </div>
							    </div>
							</div>
							<div class="col-sm-12 col-lg-6 col-md-6 col-xl-4">
								<div class="card">
									<div class="card-body p-4">
										<div class="row">
											<div class="col-5 text-center">
												<span class="mini-stat-icon bg-bitbucket"><i class="fa fa-inr "></i></span>
											</div>
											<div class="col-7">
												<a href="allRdDetails.php">
												<div class="numbers">
												    <div class="font-13 text-muted">Total RD Amount</div>
													<h3 class="font-weight-bold"><?php echo rd();?></h3>
												</div>
												</a>
											</div>
										</div>
                                    </div>
							    </div>
							</div>
							<div class="col-sm-12 col-lg-6 col-md-6 col-xl-4">
								<div class="card">
									<div class="card-body p-4">
										<div class="row">
											<div class="col-5 text-center">
												<span class="mini-stat-icon bg-bitbucket"><i class="fa fa-bitbucket "></i></span>
											</div>
											<div class="col-7">
												<a href="fddetails.php">
												<div class="numbers">
												    <div class="font-13 text-muted">Total FD Amount</div>
													<h3 class="font-weight-bold"><?php echo fd();?></h3>
												</div>
												</a>
											</div>
										</div>
                                    </div>
							    </div>
							</div>
							<div class="col-sm-12 col-lg-6 col-md-6 col-xl-4">
								<div class="card">
									<div class="card-body p-4">
										<div class="row">
											<div class="col-5 text-center">
												<span class="mini-stat-icon bg-bitbucket"><i class="fa fa-google-wallet "></i></span>
											</div>
											<div class="col-7">
												<a href="savingsDetails.php">
												<div class="numbers">
												    <div class="font-13 text-muted">Total Saving Amount</div>
													<h3 class="font-weight-bold"><?php echo saving();?></h3>
												</div>
												</a>
											</div>
										</div>
                                    </div>
							    </div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12 col-lg-12 col-xl-6">
								<div class="card">
									<div class="card-header">
										<div class="row">
											<div class="col-md-12 col-lg-12 col-xl-6">
												<h4 class="card-title">SHORT TERM LOAN</h4>
											</div>
											<div class="col-md-12 col-lg-12 col-xl-6">
												<input class="form-control" id="myInputStLoan" onkeyup="myInputStLoan()" type="text" placeholder="Search..">
											</div>
										</div>
									</div>
									
									<div class="card-body">
										<div class="table-responsive border-top">
											<table  class="table card-table table-striped table-vcenter text-nowrap mb-0">
												<thead>
													<tr>
														<th>User Name</th>
														<th>Amount</th>
														<th>Date</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody id="tableStLoan">
<?php
echo stloandata();
?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12 col-lg-12 col-xl-6">
								<div class="card">
									<div class="card-header">
										<div class="row">
											<div class="col-md-12 col-lg-12 col-xl-6">
												<h4 class="card-title">MIDDLE TERM LOAN</h4>
											</div>
											<div class="col-md-12 col-lg-12 col-xl-6">
												<input class="form-control" id="myInputMtLoan" onkeyup="myInputMtLoan()" type="text" placeholder="Search..">
											</div>
										</div>
									</div>
									<div class="card-body">
										<div class="table-responsive border-top">
											<table class="table card-table table-striped table-vcenter text-nowrap mb-0">
												<thead>
													<tr>
														<th>User Name</th>
														<th>Amount</th>
														<th>Date</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody id="tableMtLoan">
<?php
echo mtloandata();
?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12 col-lg-12 col-xl-6">
								<div class="card">
									<div class="card-header">
										<div class="row">
											<div class="col-md-12 col-lg-12 col-xl-6">
												<h4 class="card-title">HBL LOAN</h4>
											</div>
											<div class="col-md-12 col-lg-12 col-xl-6">
												<input class="form-control" onkeyup="myInputHblLoan()" id="myInputHblLoan" type="text" placeholder="Search..">
											</div>
										</div>
									</div>
									<div class="card-body">
										<div class="table-responsive border-top">
											<table class="table card-table table-striped table-vcenter text-nowrap mb-0">
												<thead>
													<tr>
														<th>User Name</th>
														<th>Amount</th>
														<th>Date</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody id="tableHblLoan">
<?php
echo hblloandata();
?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						<div class="col-md-12 col-lg-12 col-xl-6">
								<div class="card">
									<div class="card-header">
										<div class="row">
											<div class="col-md-12 col-lg-12 col-xl-6">
												<h4 class="card-title">SAVING DETAILS</h4>
											</div>
											<div class="col-md-12 col-lg-12 col-xl-6">
												<input class="form-control" onkeyup="myInputSaving()" id="myInputSaving" type="text" placeholder="Search..">
											</div>
										</div>
									</div>
									<div class="card-body">
										<div class="table-responsive border-top">
											<table class="table card-table table-striped table-vcenter text-nowrap mb-0">
												<thead>
													<tr>
														<th>#</th>
														<th>User Name</th>
														<th>Deposit</th>
														<th>Withdrawl</th>
														<th>Balance</th>
													</tr>
												</thead>
												<tbody id="tableSaving">
<?php
echo savingdata();
?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						<div class="col-md-12 col-lg-12 col-xl-6">
								<div class="card">
									<div class="card-header">
										<div class="row">
											<div class="col-md-12 col-lg-12 col-xl-6">
												<h4 class="card-title">RD DETAILS</h4>
											</div>
											<div class="col-md-12 col-lg-12 col-xl-6">
												<input class="form-control" onkeyup="myInputRdDetails()" id="myInputRdDetails" type="text" placeholder="Search..">
											</div>
										</div>
									</div>
									<div class="card-body">
										<div class="table-responsive border-top">
											<table class="table card-table table-striped table-vcenter text-nowrap mb-0">
												<thead>
													<tr>
														<th>#</th>
														<th>User Name</th>
														<th>RD Amount</th>
														<th>Return Amount</th>
														<th>No Of Month</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody id="tableRdDetails">
<?php
echo rdData();
?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						<div class="col-md-12 col-lg-12 col-xl-6">
								<div class="card">
									<div class="card-header">
										<div class="row">
											<div class="col-md-12 col-lg-12 col-xl-6">
												<h4 class="card-title">FD DETAILS</h4>
											</div>
											<div class="col-md-12 col-lg-12 col-xl-6">
												<input class="form-control" onkeyup="myInputFdDetails()" id="myInputFdDetails" type="text" placeholder="Search..">
											</div>
										</div>
									</div>
									<div class="card-body">
										<div class="table-responsive border-top">
											<table class="table card-table table-striped table-vcenter text-nowrap mb-0">
												<thead>
													<tr>
														<th>#</th>
														<th>User Name</th>
														<th>Amount</th>
														<th>Date</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody id="tableFdDetails">
<?php
echo FdData();
?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						<div class="col-md-12 col-lg-12 col-xl-6">
								<div class="card">
									<div class="card-header">
										<div class="row">
											<div class="col-md-12 col-lg-12 col-xl-6">
												<h4 class="card-title">TF DETAILS</h4>
											</div>
											<div class="col-md-12 col-lg-12 col-xl-6">
												<input class="form-control" onkeyup="myInputTfDetails()" id="myInputTfDetails" type="text" placeholder="Search..">
											</div>
										</div>
									</div>
									<div class="card-body">
										<div class="table-responsive border-top">
											<table class="table card-table table-striped table-vcenter text-nowrap mb-0">
												<thead>
													<tr>
														<th>#</th>
														<th>User Name</th>
														<th>Amount</th>
														<th>No Of Installment</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody id="tableTfDetails">
<?php
echo tfData();
?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						
						
						</div>				
					</section>
<div id="largeModal" class="modal fade">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content ">
			<div class="modal-header pd-x-20">
				<h6 class="modal-title">Customer Details</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pd-20">
				<div class="card-body" align="center">
				<button class="btn btn-success"  onclick="exportdata()">Export To Excel</button>
				<button class="btn btn-primary" onclick="printdata()">Print</button>
					<div class="table-responsive border-top">
						<table class="table card-table table-striped table-vcenter text-nowrap mb-0" id="example">
							<thead>
								<tr id="loaninformation">
								<th colspan='4'></th>
								</tr>
								<tr>
									<th>#</th>									
									<th>Date</th>
									<th>Amount</th>
									<th>Intrest</th>
								</tr>
							</thead>
							<tbody id="loandata">
							</tbody>
						</table>
					</div>			
				</div>			
			</div>
		</div>
	</div>
</div>

				</div>

				<footer class="main-footer">
					<div class="text-center">
						Design By<a href="https://nsmsonline.in"> Niharika Software</a>
					</div>
				</footer>
			</div>
		</div>
<script>
function myInputStLoan(){
	var value = $("#myInputStLoan").val().toLowerCase();
    $("#tableStLoan tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });	
}function myInputMtLoan(){
	var value = $("#myInputMtLoan").val().toLowerCase();
    $("#tableMtLoan tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });	
}function myInputHblLoan(){
	var value = $("#myInputHblLoan").val().toLowerCase();
    $("#tableHblLoan tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });	
}function myInputSaving(){
	var value = $("#myInputSaving").val().toLowerCase();
    $("#tableSaving tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });	
}function myInputRdDetails(){
	var value = $("#myInputRdDetails").val().toLowerCase();
    $("#tableRdDetails tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });	
}function myInputFdDetails(){
	var value = $("#myInputFdDetails").val().toLowerCase();
    $("#tableFdDetails tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });	
}function myInputTfDetails(){
	var value = $("#myInputTfDetails").val().toLowerCase();
    $("#tableTfDetails tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });	
}
function getloandetails(id){
	var acno=$('#'+id).attr('acno');
	//alert(id);
	$.post('js/getloan.php',{acno:id},function(data){
	//	alert(data);
		$("#loandata").html(data);
	}); 
}
function getsavingdetails(id){
	//alert(id);
	$.post('js/getloan.php',{savingId:id},function(data){
	//	alert(data);
		$("#example").html(data);
	}); 
}
function printdata(){
	 var divToPrint=document.getElementById("example");
 newWin= window.open("");
 newWin.document.write("<center><h1></h1><p></p> </center>");
 newWin.document.write(divToPrint.outerHTML);
 newWin.document.write("<style> th:nth-child(18){display:none;} </style>");
 newWin.document.write("<style> td:nth-child(18){display:none;} </style>");
 newWin.print();
 newWin.close();	
}
function exportdata(){
	       var htmltable= document.getElementById('example');
       var html = htmltable.outerHTML;
       window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
}
</script>
		<!--Jquery.min js-->
		<script src="../assets/js/jquery.min.js"></script>
		<!--popper js-->
		<script src="../assets/js/popper.js"></script>
		<!--Tooltip js-->
		<script src="../assets/js/tooltip.js"></script>
		<!--Bootstrap.min js-->
		<script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
		<!--Jquery.nicescroll.min js-->
		<script src="../assets/plugins/nicescroll/jquery.nicescroll.min.js"></script>
		<!--Scroll-up-bar.min js-->
		<script src="../assets/plugins/scroll-up-bar/dist/scroll-up-bar.min.js"></script>
		<!--mCustomScrollbar js-->
		<script src="../assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>
		<!--Sidemenu js-->
		<script src="../assets/plugins/toggle-menu/sidemenu.js"></script>
		<!--Jquery.knob js-->
		<script src="../assets/plugins/othercharts/jquery.knob.js"></script>
		<!--Jquery.sparkline js-->
		<script src="../assets/plugins/othercharts/jquery.sparkline.min.js"></script>
		<!--othercharts js-->
		<script src="../assets/js/othercharts.js"></script>

		<!-- Chart.js -->
		<script src="../assets/plugins/Chart.js/dist/Chart.bundle.js"></script>

		<!--Morris js-->
		<script src="../assets/plugins/morris/morris.min.js"></script>
		<script src="../assets/plugins/morris/raphael.min.js"></script>

		<!-- ECharts -->
		<script src="../assets/plugins/echarts/echarts.js"></script>

		<!-- Chartist.js -->
		<script src="../assets/plugins/chartist/chartist.js"></script>

		<!--Scripts js-->
		<script src="../assets/js/scripts.js"></script>
		<script src="../assets/js/dashboard5.js"></script>
		<script src="../assets/js/sparkline.js"></script>

	</body>

<!-- Mirrored from spruko.com/demo/asta/Leftmenu-Fullwidth-Lightsidebar/index5.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 20 Jan 2019 12:24:19 GMT -->
</html>