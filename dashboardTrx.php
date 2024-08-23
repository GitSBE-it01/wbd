<?php
	include('checklogin.php');
	include('connection.php');
	//TWD ASSY-TWD 86160-BZ320
?>

<html>
<head>
<script src="plugin/jquery.js"></script> 
<script src="plugin/bootstrap/js/bootstrap.js"></script> 
<link rel="stylesheet" href="plugin/jquery-ui.css">
<link rel="stylesheet" href="plugin/bootstrap/css/bootstrap.css" />
<link rel="stylesheet" href="plugin/Font-Awesome/css/font-awesome.css">
<script src="plugin/multiselect/docsupport/jquery-3.2.1.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="thm/style.css">
<link rel="stylesheet" type="text/css" href="thm/popup.css">
<link rel="stylesheet" href="plugin/chosen/chosen.min.css" />
<link rel="stylesheet" type="text/css" href="thm/fxhdr.css">
<script src="plugin/datepicker/jquery-ui.js"></script>
<script> $(function() {$( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();}); </script>
<style>
	a:focus {
		outline: none;
		outline: none;
		outline-offset: none;
	}
</style>
<script>
		function getGluePosition(val) {
			$("#loader1").show();
			$.ajax({
			type: "POST",
			url: "ajax/get-glue-position.php",
			data:'speakertype='+val,
			success: function(data){
				$("#glueposition").html(data);
				$("#loader1").hide();
			}
			});
		}
		function getGlueType(val) {
			$("#loader2").show();
			$.ajax({
			type: "POST",
			url: "ajax/get-glue-type.php",
			data:'glueposition='+val,
			success: function(data){
				$("#gluetype").html(data);
				$("#loader2").hide();
			}
			});
		}
	</script>
<title></title>
</head>
	<form name="form1" method="post" action="index.php?page=dashboardTrx" enctype="multipart/form-data">
		<div class="wrap">
			<label class="labels">Speaker Type</label>
			<div class="colon">:</div>
			<div class="input">
				<select name="speakertype" id="speakertype" size="1" class="form-control chzn-select" style="width: 400px" onchange="getGluePosition(this.value)" required>
					<option value="" disabled selected>- Choose -</option>
					<?php if(!empty($_POST["speakertype"])){?> <option value="<?php echo $_POST["speakertype"]?>" selected>- <?php echo $_POST["speakertype"]?> -</option> <?php }?>
					<?php $no=1; $querySpk = mysqli_query($connect, "select distinct speakertype from ebomglue order by speakertype asc");
						while ($dataSpk = mysqli_fetch_array($querySpk)){;?>
						<option value="<?php echo $dataSpk['speakertype']?>"><?php echo $dataSpk['speakertype'];?></option>
					<?php }?>
				</select>
			</div>
		</div>
		<div class="wrap">
			<label class="labels">Glue Position</label>
			<div class="colon">:</div>
			<div class="input">
				<select name="glueposition" id="glueposition" size="1" style="width: 400px" required onchange="getGlueType(this.value)" >
					<option value="" disabled selected>- Choose -</option>
					<?php if(!empty($_POST["glueposition"])){?> <option value="<?php echo $_POST["glueposition"]?>" selected>- <?php echo $_POST["glueposition"]?> -</option> <?php }?>	
					<?php if(!empty($_POST["speakertype"])){?> 
						<?php $queryGluePos = mysqli_query($connect, "select distinct glueposition from ebomglue where speakertype='".$_POST["speakertype"]."'");
							while ($dataGluePos = mysqli_fetch_array($queryGluePos)){?> 
							<option value="<?php echo $dataGluePos['glueposition']?>"><?php echo $dataGluePos['glueposition']?></option> 
						<?php }?>
					<?php }?>					
				</select>
				<img id="loader1" src="thm/loadersmall.gif" height="20px"/>
			</div>
		</div>
		<div class="wrap">
			<label class="labels">Glue Type</label>
			<div class="colon">:</div>
			<div class="input">
				<select name="gluetype" id="gluetype" size="1" style="width: 400px" required>
					<option value="" disabled selected>- Choose -</option>
					<?php if(!empty($_POST["gluetype"])){?> <option value="<?php echo $_POST["gluetype"]?>" selected>- <?php echo $_POST["gluetype"]?> -</option> <?php }?>
					<?php if(!empty($_POST["glueposition"])){?> 
						<?php $queryGlueType = mysqli_query($connect, "select distinct gluetype from ebomglue where glueposition='".$_POST["glueposition"]."'");
							while ($dataGlueType = mysqli_fetch_array($queryGlueType)){?> 
							<option value="<?php echo $dataGlueType['gluetype']?>"><?php echo $dataGlueType['gluetype']?></option> 
						<?php }?>
					<?php }?>					
				</select>
				<img id="loader2" src="thm/loadersmall.gif" height="20px"/>
			</div>
		</div>
		<div class="wrap">
			<label class="labels">Date</label>
			<div class="colon">:</div>
			<div class="input">
				<input type="text" name="date1" size="19" max="10" class="datepicker" value="<?php echo $_POST['date1']?>"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; To : <input type="text" name="date2" size="19" max="10" class="datepicker" value="<?php echo $_POST['date2']?>">
			</div>
		</div>
		<div class="wrap" style="margin-top: 5px;">
			<label class="labels"><input type="submit" name="submit" value="Generate" class="btn btn-success"/></label>
		</div>
	</form>
		<?php if(!empty($_POST["speakertype"]) and !empty($_POST["glueposition"]) and !empty($_POST["gluetype"]) and !empty($_POST["date1"]) and !empty($_POST["date2"])){?>
			<table align="center" style="border-collapse: collapse; margin-top: 20px" width="99%" id="dataTables" data-act="actMsg">
				<tr bgcolor="#3399FF"> 
					<td style="border:thin solid #000;text-align:center;" bgcolor="#3399FF"><font size="2" face="Arial, Helvetica, sans-serif">No</font></td>
					<td style="border:thin solid #000;text-align:center;" bgcolor="#3399FF"><font size="2" face="Arial, Helvetica, sans-serif">Date</font></td>
					<td style="border:thin solid #000;text-align:center;" bgcolor="#3399FF"><font size="2" face="Arial, Helvetica, sans-serif">Speaker Type</font></td>
					<td style="border:thin solid #000;text-align:center;" bgcolor="#3399FF"><font size="2" face="Arial, Helvetica, sans-serif">Glue Position</font></td>
					<td style="border:thin solid #000;text-align:center;" bgcolor="#3399FF"><font size="2" face="Arial, Helvetica, sans-serif">Glue Type</font></td>
					<td style="border:thin solid #000;text-align:center;" bgcolor="#3399FF"><font size="2" face="Arial, Helvetica, sans-serif">Part Number</font></td>
					<td style="border:thin solid #000;text-align:center;" bgcolor="#3399FF"><font size="2" face="Arial, Helvetica, sans-serif">Ratio</font></td>
					<td style="border:thin solid #000;text-align:center;" bgcolor="#3399FF"><font size="2" face="Arial, Helvetica, sans-serif">Remarks</font></td>
					<td style="border:thin solid #000;text-align:center;" bgcolor="#3399FF"><font size="2" face="Arial, Helvetica, sans-serif">Standard</font></td>
					<td style="border:thin solid #000;text-align:center;" bgcolor="#3399FF"><font size="2" face="Arial, Helvetica, sans-serif">Tolerance</font></td>
					<td style="border:thin solid #000;text-align:center;" bgcolor="#3399FF"><font size="2" face="Arial, Helvetica, sans-serif">Min</font></td>
					<td style="border:thin solid #000;text-align:center;" bgcolor="#3399FF"><font size="2" face="Arial, Helvetica, sans-serif">Max</font></td>
					<td style="border:thin solid #000;text-align:center;" bgcolor="#3399FF"><font size="2" face="Arial, Helvetica, sans-serif">Needle</font></td>
					<td style="border:thin solid #000;text-align:center;" bgcolor="#3399FF"><font size="2" face="Arial, Helvetica, sans-serif">Wkctr</font></td>
					<td style="border:thin solid #000;text-align:center;" bgcolor="#3399FF"><font size="2" face="Arial, Helvetica, sans-serif">Notes Ebom</font></td>
					<td style="border:thin solid #000;text-align:center;" bgcolor="#3399FF"><font size="2" face="Arial, Helvetica, sans-serif">Weight 1</font></td>
					<td style="border:thin solid #000;text-align:center;" bgcolor="#3399FF"><font size="2" face="Arial, Helvetica, sans-serif">Weight 2</font></td>
					<td style="border:thin solid #000;text-align:center;" bgcolor="#3399FF"><font size="2" face="Arial, Helvetica, sans-serif">Weight 3</font></td>
					<td style="border:thin solid #000;text-align:center;" bgcolor="#3399FF"><font size="2" face="Arial, Helvetica, sans-serif">Weight 4</font></td>
					<td style="border:thin solid #000;text-align:center;" bgcolor="#3399FF"><font size="2" face="Arial, Helvetica, sans-serif">Weight 5</font></td>
					<td style="border:thin solid #000;text-align:center;" bgcolor="#3399FF"><font size="2" face="Arial, Helvetica, sans-serif">Notes</font></td>
				</tr>
				<?php $query = mysqli_query($connect, "select * from weight_main where speakertype='".$_POST['speakertype']."' and ('".$_POST['date1']."'<=date or date<='".$_POST['date2']."')");
					$no=1; $totalBerat = $jumlahData = $xi = 0;
					while($data = mysqli_fetch_array($query)){
						$queryDtl = mysqli_query($connect, "select * from weight_detail where idmain='".$data['id']."' and  glueposition='".$_POST['glueposition']."' and gluetype='".$_POST['gluetype']."' order by templateno, id asc");
						while($dataDtl = mysqli_fetch_array($queryDtl)){
							$maximum = $dataDtl['maximum']; $minimum = $dataDtl['minimum']; $standard = $dataDtl['standard'];
							$ucl = $standard + ($standard*3/100);
							$lcl = $standard - ($standard*3/100);
							if($dataDtl['weight_a']!='' and $dataDtl['weight_a']!=0){$label1=$data['date'].'-W1'; $dataBerat[]  = array("label"=> $label1, "y"=> $dataDtl['weight_a']); $totalBerat = $totalBerat+$dataDtl['weight_a']; $jumlahData++;}
							if($dataDtl['weight_b']!='' and $dataDtl['weight_b']!=0){$label2=$data['date'].'-W2'; $dataBerat[]  = array("label"=> $label2, "y"=> $dataDtl['weight_b']); $totalBerat = $totalBerat+$dataDtl['weight_b']; $jumlahData++;}
							if($dataDtl['weight_c']!='' and $dataDtl['weight_c']!=0){$label3=$data['date'].'-W3'; $dataBerat[]  = array("label"=> $label3, "y"=> $dataDtl['weight_c']); $totalBerat = $totalBerat+$dataDtl['weight_c']; $jumlahData++;}
							if($dataDtl['weight_d']!='' and $dataDtl['weight_d']!=0){$label4=$data['date'].'-W4'; $dataBerat[]  = array("label"=> $label4, "y"=> $dataDtl['weight_d']); $totalBerat = $totalBerat+$dataDtl['weight_d']; $jumlahData++;}
							if($dataDtl['weight_e']!='' and $dataDtl['weight_e']!=0){$label5=$data['date'].'-W5'; $dataBerat[]  = array("label"=> $label5, "y"=> $dataDtl['weight_e']); $totalBerat = $totalBerat+$dataDtl['weight_e']; $jumlahData++;}
							
						?>
							<tr> 
								<td style="border:thin solid #000; text-align: center"><font size="1" face="Arial, Helvetica, sans-serif"><?php echo $data['id'];?></font></td>
								<td style="border:thin solid #000; text-align: center"><font size="1" face="Arial, Helvetica, sans-serif"><?php echo $data['date'];?></font></td>
								<td style="border:thin solid #000; text-align: center"><font size="1" face="Arial, Helvetica, sans-serif"><?php echo $data['speakertype'];?></font></td>
								<td style="border:thin solid #000;"><font size="2" face="Arial, Helvetica, sans-serif"><?php echo $dataDtl['glueposition'];?></font></td>
								<td style="border:thin solid #000;"><font size="2" face="Arial, Helvetica, sans-serif"><?php echo $dataDtl['gluetype'];?></font></td>
								<td style="border:thin solid #000;"><font size="2" face="Arial, Helvetica, sans-serif"><?php echo $dataDtl['partnumber'];?></font></td>
								<td style="border:thin solid #000;"><font size="2" face="Arial, Helvetica, sans-serif"><?php echo $dataDtl['ratio'];?></font></td>
								<td style="border:thin solid #000;"><font size="2" face="Arial, Helvetica, sans-serif"><?php echo $dataDtl['remarks'];?></font></td>
								<td style="border:thin solid #000;" align="right"><font size="2" face="Arial, Helvetica, sans-serif"><?php echo $dataDtl['standard'];?></font></td>
								<td style="border:thin solid #000;" align="right"><font size="2" face="Arial, Helvetica, sans-serif"><?php echo $dataDtl['tolerance'];?></font></td>
								<td style="border:thin solid #000;" align="right"><font size="2" face="Arial, Helvetica, sans-serif"><?php echo $dataDtl['minimum'];?></font></td>
								<td style="border:thin solid #000;" align="right"><font size="2" face="Arial, Helvetica, sans-serif"><?php echo $dataDtl['maximum'];?></font></td>
								<td style="border:thin solid #000;"><font size="2" face="Arial, Helvetica, sans-serif"><?php echo $dataDtl['needletype'];?></font></td>
								<td style="border:thin solid #000;"><font size="2" face="Arial, Helvetica, sans-serif"><?php echo $dataDtl['workcenter'];?></font></td>
								<td style="border:thin solid #000;"><font size="2" face="Arial, Helvetica, sans-serif"><?php echo $dataDtl['notesebom'];?></font></td>
								<td style="border:thin solid #000;" align="right"><font size="2" face="Arial, Helvetica, sans-serif" <?php if(($dataDtl['weight_a']<$dataDtl['minimum']) or ($dataDtl['maximum']<$dataDtl['weight_a'])){echo "color='red'";}?>><?php if($dataDtl['weight_a']!=0){echo $dataDtl['weight_a'];}?></font></td>
								<td style="border:thin solid #000;" align="right"><font size="2" face="Arial, Helvetica, sans-serif" <?php if(($dataDtl['weight_b']<$dataDtl['minimum']) or ($dataDtl['maximum']<$dataDtl['weight_b'])){echo "color='red'";}?>><?php if($dataDtl['weight_b']!=0){echo $dataDtl['weight_b'];}?></font></td>
								<td style="border:thin solid #000;" align="right"><font size="2" face="Arial, Helvetica, sans-serif" <?php if(($dataDtl['weight_c']<$dataDtl['minimum']) or ($dataDtl['maximum']<$dataDtl['weight_c'])){echo "color='red'";}?>><?php if($dataDtl['weight_c']!=0){echo $dataDtl['weight_c'];}?></font></td>
								<td style="border:thin solid #000;" align="right"><font size="2" face="Arial, Helvetica, sans-serif" <?php if(($dataDtl['weight_d']<$dataDtl['minimum']) or ($dataDtl['maximum']<$dataDtl['weight_d'])){echo "color='red'";}?>><?php if($dataDtl['weight_d']!=0){echo $dataDtl['weight_d'];}?></font></td>
								<td style="border:thin solid #000;" align="right"><font size="2" face="Arial, Helvetica, sans-serif" <?php if(($dataDtl['weight_e']<$dataDtl['minimum']) or ($dataDtl['maximum']<$dataDtl['weight_e'])){echo "color='red'";}?>><?php if($dataDtl['weight_e']!=0){echo $dataDtl['weight_e'];}?></font></td>
								<td style="border:thin solid #000;"><font size="2" face="Arial, Helvetica, sans-serif"><?php echo $dataDtl['notes'];?></font></td>
							</tr>
					<?php }?>
				<?php }?>
			</table>
		<?php }?>
		<?php 
			$mean = round(($totalBerat/$jumlahData), 6);
			$query = mysqli_query($connect, "select * from weight_main where speakertype='".$_POST['speakertype']."' and ('".$_POST['date1']."'<=date or date<='".$_POST['date2']."')");
			while($data = mysqli_fetch_array($query)){
				$queryDtl = mysqli_query($connect, "select * from weight_detail where idmain='".$data['id']."' and  glueposition='".$_POST['glueposition']."' and gluetype='".$_POST['gluetype']."' order by templateno, id asc");
				while($dataDtl = mysqli_fetch_array($queryDtl)){
					if($dataDtl['weight_a']!='' and $dataDtl['weight_a']!=0){$xi = $xi + pow(($dataDtl['weight_a']-$mean),2);}
					if($dataDtl['weight_b']!='' and $dataDtl['weight_b']!=0){$xi = $xi + pow(($dataDtl['weight_b']-$mean),2);}
					if($dataDtl['weight_c']!='' and $dataDtl['weight_c']!=0){$xi = $xi + pow(($dataDtl['weight_c']-$mean),2);}
					if($dataDtl['weight_d']!='' and $dataDtl['weight_d']!=0){$xi = $xi + pow(($dataDtl['weight_d']-$mean),2);}
					if($dataDtl['weight_e']!='' and $dataDtl['weight_e']!=0){$xi = $xi + pow(($dataDtl['weight_e']-$mean),2);}
				}
			}
			$xi = round($xi, 10);
			$xin = $xi/$jumlahData;
			$stddev = sqrt($xin);
			$l_mean = ($mean - $minimum)/(3*$stddev);
			$u_mean = ($maximum - $mean)/(3*$stddev);
			$cp = ($maximum - $minimum)/(6*$stddev);
			$cpk = min($l_mean, $u_mean);
		?>
<body>
	<div style="margin-bottom: 50px">
		<div id="chartContainerA" style="height: 250px; width: 100%; margin-top: 50px"></div>
	</div>
	<?php if(!empty($_POST["speakertype"]) and !empty($_POST["glueposition"]) and !empty($_POST["gluetype"]) and !empty($_POST["date1"]) and !empty($_POST["date2"])){?>
		<table align="center" style="border-collapse: collapse; margin-top: 20px" width="99%" id="dataTables">
			<tr bgcolor="#3399FF"> 
				<td style="border:thin solid #000;text-align:center;" bgcolor="#3399FF"><font size="2" face="Arial, Helvetica, sans-serif">n</font></td>
				<td style="border:thin solid #000;text-align:center;" bgcolor="#3399FF"><font size="2" face="Arial, Helvetica, sans-serif">Mean</font></td>
				<td style="border:thin solid #000;text-align:center;" bgcolor="#3399FF"><font size="2" face="Arial, Helvetica, sans-serif">Minimum</font></td>
				<td style="border:thin solid #000;text-align:center;" bgcolor="#3399FF"><font size="2" face="Arial, Helvetica, sans-serif">Maximum</font></td>
				<td style="border:thin solid #000;text-align:center;" bgcolor="#3399FF"><font size="2" face="Arial, Helvetica, sans-serif">xi</font></td>
				<td style="border:thin solid #000;text-align:center;" bgcolor="#3399FF"><font size="2" face="Arial, Helvetica, sans-serif">xi/n</font></td>
				<td style="border:thin solid #000;text-align:center;" bgcolor="#3399FF"><font size="2" face="Arial, Helvetica, sans-serif">StdDev</font></td>
				<td style="border:thin solid #000;text-align:center;" bgcolor="#3399FF"><font size="2" face="Arial, Helvetica, sans-serif">l-mean</font></td>
				<td style="border:thin solid #000;text-align:center;" bgcolor="#3399FF"><font size="2" face="Arial, Helvetica, sans-serif">u-mean</font></td>
				<td style="border:thin solid #000;text-align:center;" bgcolor="#3399FF"><font size="2" face="Arial, Helvetica, sans-serif">CP</font></td>
				<td style="border:thin solid #000;text-align:center;" bgcolor="#3399FF"><font size="2" face="Arial, Helvetica, sans-serif">CPK</font></td>
			</tr> 
			<tr> 
				<td style="border:thin solid #000; text-align: center"><font size="1" face="Arial, Helvetica, sans-serif"><?php echo $jumlahData;?></font></td>
				<td style="border:thin solid #000; text-align: center"><font size="1" face="Arial, Helvetica, sans-serif"><?php echo $mean;?></font></td>
				<td style="border:thin solid #000; text-align: center"><font size="1" face="Arial, Helvetica, sans-serif"><?php echo $minimum;?></font></td>
				<td style="border:thin solid #000; text-align: center"><font size="1" face="Arial, Helvetica, sans-serif"><?php echo $maximum;?></font></td>
				<td style="border:thin solid #000; text-align: center"><font size="1" face="Arial, Helvetica, sans-serif"><?php echo $xi;?></font></td>
				<td style="border:thin solid #000; text-align: center"><font size="1" face="Arial, Helvetica, sans-serif"><?php echo $xin;?></font></td>
				<td style="border:thin solid #000; text-align: center"><font size="1" face="Arial, Helvetica, sans-serif"><?php echo $stddev;?></font></td>
				<td style="border:thin solid #000; text-align: center"><font size="1" face="Arial, Helvetica, sans-serif"><?php echo $l_mean;?></font></td>
				<td style="border:thin solid #000; text-align: center"><font size="1" face="Arial, Helvetica, sans-serif"><?php echo $u_mean;?></font></td>
				<td style="border:thin solid #000; text-align: center"><font size="1" face="Arial, Helvetica, sans-serif"><?php echo $cp;?></font></td>
				<td style="border:thin solid #000; text-align: center"><font size="1" face="Arial, Helvetica, sans-serif"><?php echo $cpk;?></font></td>
			</tr> 
		</table>
		<table align="center" style="border-collapse: collapse; margin-top: 20px" width="99%" id="dataTables">
			<tr> 
				<td style="border:thin solid #000;text-align:center;" bgcolor="#3399FF" width="150px"><font size="2" face="Arial, Helvetica, sans-serif">x</font></td>
				<td style="border:thin solid #000;text-align:center;" bgcolor="#3399FF" width="150px"><font size="2" face="Arial, Helvetica, sans-serif">Normal Distribution</font></td>
				<td style="border:thin solid #000;text-align:center;" rowspan="21">
					<div style="margin-bottom: 50px">
						<div id="chartContainerB" style="height: 250px; width: 100%; margin-top: 50px"></div>
					</div>
				</td>
			</tr> 
			<?php $d=1; $temp = $max_normal_distribution = 0;
					while($d<=20){
						if($d==1){
							$temp = $mean - ($stddev * 3.5);
						}
						else{
							$temp = $temp + 7 * $stddev / 20;
						}
						$v1 = $stddev * sqrt(2 * 3.1416);
						if($v1==0){
							$normal_distribution = 0;
						}
						else{
							$normal_distribution = pow(2.7183, -1 * pow($temp - $mean, 2) / (2 * pow($stddev, 2))) / ($stddev * sqrt(2 * 3.1416));
						}
						if ($normal_distribution > $max_normal_distribution) {
							$max_normal_distribution = $normal_distribution;
						}
						$dataCpk[] = array("x"=> $temp, "y"=> $normal_distribution);
						
			?>
				<tr> 
					<td style="border:thin solid #000; text-align: center"><font size="1" face="Arial, Helvetica, sans-serif"><?php echo $temp;?></font></td>
					<td style="border:thin solid #000; text-align: center"><font size="1" face="Arial, Helvetica, sans-serif"><?php echo $normal_distribution;?></font></td>
				</tr> 
			<?php
				$d++;}
				$dataMin1 = array(array("x" => $minimum, "y" => 0), array("x" => $minimum, "y" => $max_normal_distribution));
				$dataMax1 = array(array("x" => $maximum, "y" => 0), array("x" => $maximum, "y" => $max_normal_distribution));
				$dataMean1 = array(array("x" => $standard, "y" => 0), array("x" => $standard, "y" => $max_normal_distribution));
			?>
		</table>
	<?php }?>
</body>
</html>
	<script src="./plugin/bootstrap/js/bootstrap.min.js"></script>
	<script src="./js/jquery.inputlimiter.1.3.1.min.js"></script>
	<script src="./js/jquery.tagsinput.min.js"></script>
	<script src="./js/jquery.autosize.min.js"></script>
	<script src="./js/bootstrap-inputmask.js"></script>
	<script src="./plugin/chosen/chosen.jquery.min.js"></script>
    <script src="./js/formsInit.js"></script>
	<script>
		$(function () { formInit();	});
		$(".readonly").keydown(function(e){e.preventDefault();});
		document.getElementById('loader1').style.display = 'none';
		document.getElementById('loader2').style.display = 'none';
	</script>
	<script src="js/canvasjs.min.js"></script>
	<script>
		window.onload = function () {
			var chart = new CanvasJS.Chart("chartContainerA",  {
				animationEnabled: true,
				title:{
					text: "Data Timbang Lem"
				},
				axisY: {		
					stripLines: [
					{
						value: <?php echo $maximum?>,
						lineDashType: "line",
						label: "Maximum",
						thickness:1,
						color:"red",
					},{
						value: <?php echo $standard?>,
						lineDashType: "line",
						label: "Standard",
						thickness:1,
						color:"green",
					},{
						value: <?php echo $minimum?>,
						lineDashType: "line",
						label: " Minimum",
						thickness:1,
						color:"red",
					},{
						value: <?php echo $ucl?>,
						lineDashType: "line",
						label: " UCL",
						thickness:1,
						color:"orange",
					},{
						value: <?php echo $lcl?>,
						lineDashType: "line",
						label: " LCL",
						thickness:1,
						color:"orange",
					}]
				},
				axisX:{
					interval: 1,
				},
				data: [{
					type: "spline",
					indexLabelFormatter: function(e){			
					return e.dataPoint.y;},
					indexLabelFontWeight:"bold",
					indexLabelBackgroundColor:"lightblue",
					markerSize:5,
					dataPoints: <?php echo json_encode($dataBerat, JSON_NUMERIC_CHECK); ?>
				}]
			});
			chart.render();
			
			var chartB = new CanvasJS.Chart("chartContainerB",  {
				animationEnabled: true,
					title:{
						text: ""
					},
					axisY: {
						title: "SPC Chart"
					},
					data: 
					[
					  {
						type: "spline",
						markerSize: 5,
						dataPoints: <?php echo json_encode($dataCpk, JSON_NUMERIC_CHECK); ?>
					  },{
						type: "spline",
						markerSize: 5,
						lineColor:"red",
						markerColor: "red",
						dataPoints: <?php echo json_encode($dataMax1, JSON_NUMERIC_CHECK); ?>
					  },{
						type: "spline",
						markerSize: 5,
						lineColor:"red",
						markerColor: "red",
						dataPoints: <?php echo json_encode($dataMin1, JSON_NUMERIC_CHECK); ?>
					  },{
						type: "spline",
						markerSize: 5,
						lineColor:"red",
						markerColor: "red",
						lineDashType: "dash",
						dataPoints: <?php echo json_encode($dataMean1, JSON_NUMERIC_CHECK); ?>
					  }
					]
			});
			chartB.render();
			
			function toggleDataSeries(e){
				if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
					e.dataSeries.visible = false;
				}
				else{
					e.dataSeries.visible = true;
				}
				chart.render();
			}
		}
		alert('<?php echo json_encode($dataMax1, JSON_NUMERIC_CHECK); ?>');
	</script>


