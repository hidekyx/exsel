<?php
echo '<span class="badge badge-info">'.$namakriteria.'</span><br/><br/>';
$irdata=array(
1=>0.00,
2=>0.00,
3=>0.58,
4=>0.90,
5=>1.12,
6=>1.24,
7=>1.32,
8=>1.41,
9=>1.45,
10=>1.49,
11=>1.51,
12=>1.48,
13=>1.56,
14=>1.57,
15=>1.59,
);

if(!empty($arr))
{
	


$jumlah=count($arr);

$ir=0.00;
foreach($irdata as $irk=>$irv)
{
	if($irk==$jumlah)
	{
		$ir=$irv;
	}
}
?>
<script type="text/javascript">

var maksprio;
$(document).ready(function () {
		
<?php
if(!empty($arr))
{
?>
hitung();
<?php
}
?>

$("#formentri").submit(function(e){
	e.preventDefault();
	$.ajax({
		type:'post',
		dataType:'json',
		url:"<?=base_url();?>Aspek_kriteria/updatesub",
		data:$(this).serialize(),
		error:function(){
			shownotice('danger','Gagal menyimpan data');
			$("#formentri select").removeAttr("disabled");
			$("#formentri button").removeAttr("disabled");
		},
		beforeSend:function(){
			$("#formentri select").attr('disabled','disabled');
			$("#formentri button").attr('disabled','disabled');
			shownotice('info','Tunggu sebentar,lagi menyimpan data');
		},
		success:function(x){
			if(x.status=="ok")
			{
				shownotice('success',x.msg);
			}else{
				shownotice('danger',x.msg);
			}
			$("#formentri select").removeAttr("disabled");
			$("#formentri button").removeAttr("disabled");
		},
	});
});

$(".inputnumber").each(function(){
	$(this).change(function(){		
		hitung();
	});
});
	
});

function shownotice(tipe,pesan)
{
	$("#respon").html('<div class="alert alert-'+tipe+'">'+pesan+'</div>');
	$("#respon").show('fadeIn');
	if($("#respon").is(":visible"))
	{
		setTimeout(function(){
			$("#respon").hide('fadeOut');
		},3000);
	}	
}

function contoh()
{
	$("#k1b2").val(9);
	$("#k1b3").val(9);
	$("#k1b4").val(9);
	$("#k1b5").val(9);
	$("#k2b4").val(9);
	$("#k2b5").val(9);
	$("#k3b4").val(9);
	$("#k3b5").val(9);
	$("#k4b5").val(9);
	
}

function hitung()
{
	//contoh();
	
	$(".inputnumber").each(function(){
	//	$(this).change(function(){		
			var dtarget=$(this).attr('data-target');
			var dkolom=$(this).attr('data-kolom');
			var jumlah=$(this).val();
			var rumus=1/parseFloat(jumlah);
			var fx=rumus;
			$("#"+dtarget).val(fx);
			total();			
			mnk();
			mptb();
			rk();
			//alert(dkolom);
	//	});
	});	
}

function showmatrix()
{
	$("#matrikdiv").toggle('fade');
}

function total()
{
	for(i=1;i<=<?=$jumlah;?>;i++)
	{
		var sum=0;
		$(".kolom"+i).each(function(){
			sum+=parseFloat($(this).val());
		});
		var fx=sum;
		$("#total"+i).val(fx);
	}	
}

function mnk()
{
	var mm=[];
	for(i=1;i<=<?=$jumlah;?>;i++)
	{
		var jml=0;
		for(x=1;x<=<?=$jumlah;?>;x++)
		{			
			var vtarget=$("#k"+i+"b"+x).val();
			var vkolom=$("#total"+x).val();
			var rumus=parseFloat(vtarget)/parseFloat(vkolom);
			var fx=rumus;			
			jml+=parseFloat(rumus);
			$("#mn-k"+i+"b"+x).val(fx);
			//$("#mn-k"+i+"b"+x).val(i+" "+x);						
		}
		var jumlahmnk=jml;
		var prio=parseFloat(jml)/parseFloat(<?=$jumlah;?>);
		var totprio=prio;
		$("#jml-b"+i).val(jumlahmnk);
		$("#pri-b"+i).val(totprio);
		mm.push(totprio);
	}
	maksprio=arrayMax(mm);
	mnk2();
}

function arrayMax(arr) {
  var len = arr.length, max = -Infinity;
  while (len--) {
    if (arr[len] > max) {
      max = arr[len];
    }
  }
  return max;
};

function mnk2()
{
	var i=[];
	for(i=1;i<=<?=$jumlah;?>;i++)
	{
		var prio=$("#pri-b"+i).val();
		var rumus=parseFloat(prio)/parseFloat(maksprio);
		$("#prisub-b"+i).val(rumus);
		$("#prismp-b"+i).val(rumus);
		$("#prisubnilai-b"+i).val(rumus);
		$("#prisub-bhasil"+i).val(rumus);
	}
}


function mptb()
{	
	for(i=1;i<=<?=$jumlah;?>;i++)
	{
		var jml=0;
		for(x=1;x<=<?=$jumlah;?>;x++)
		{			
			var prio=$("#pri-b"+x).val();
			var nilai=$("#k"+i+"b"+x).val();
			var rumus=parseFloat(nilai)*parseFloat(prio);
			var fx=rumus;
			jml+=parseFloat(rumus);
			//$("#mptb-k"+i+"b"+x).val(prio+"*"+nilai);
			$("#mptb-k"+i+"b"+x).val(fx);
		}
		var jumlahmnk=jml;
		$("#jmlmptb-b"+i).val(jumlahmnk);
	}
}

function rk()
{
	var total=0;	
	for(i=1;i<=<?=$jumlah;?>;i++)
	{
		var prio=$("#pri-b"+i).val();
		var jml=$("#jmlmptb-b"+i).val();
		var hasil=parseFloat(jml);
		var fx=hasil;
		total+=hasil;
		
		$("#jmlrk-b"+i).val(jml);
		$("#priork-b"+i).val(prio);
		$("#prioritas-b"+i).val(prio);
	}
	var lambda_maks=total;
	$("#lambda_maks").val(lambda_maks);
	var ci = (lambda_maks - parseFloat(<?=$jumlah;?>)) / (parseFloat(<?=$jumlah;?>) - 1);
	$("#ci").val(ci);
	var cr = parseFloat(ci)/parseFloat(<?=$ir;?>);
	$("#cr").val(cr);
	$("#crvalue").val(cr);
}

</script>

<div id="respon"></div>

<div class="alert alert-info">
	Setelah mengisi nilai matrik perbandingan silahkan klik tombol <b>SIMPAN NILAI ASPEK KRITERIA</b> untuk meyimpan nilai matrik. Selanjutnya menekan tombol <b>SIMPAN NILAI PRIORITAS</b> untuk menyimpan nilai prioritas yang telah dihasilkan.
</div>

<div id="entri">
<?php
echo validation_errors();
echo form_open('#',array('class'=>'form-horizontal','id'=>'formentri'));
?>

<h3>Matrik Perbandingan Berpasangan Aspek Kriteria</h3>
<hr/>
<input type="hidden" name="crvalue" id="crvalue"/>
<input type="hidden" name="kriteriaid" value="<?=$kriteriaid;?>"/>
<div class="table-responsive">
<table class="table table-bordered">
<thead align="center" class="bg-success text-white">
	<th>Aspek Kriteria</th>
	<?php
	foreach($arr as $k=>$v)
	{
	?>
	<th><?=$v;?></th>
	<?php
	}
	?>	
</thead>
<tbody>
	<?php
	$noUtama=0;	
	foreach($arr as $k2=>$v2)
	{		
		$noUtama+=1;				
		//array_shift($xxx);
		echo '<tr>';
		echo '<th class="text-center bg-success text-white">'.$v2.'</th>';
		$noSub=0;				
		$xxx='';				
		for($i=1;$i<=$jumlah;$i++)
		{
			$keys = array_keys($arr);
			$xxx=$keys[array_search("gsda",$keys)+($i-1)];
			$newname=$k2."[".$xxx."]";
			$noSub+=1;
			if($noSub==$noUtama)
			{
				echo '<td><input type="number" id="k'.$noUtama.'b'.$noSub.'" class="form-control kolom'.$noSub.'" value="1" readonly="" title="kolom'.$noSub.'"/></td>';
			}else{
				
				if($noUtama > $noSub)
				{									
					echo '<td><input type="text" id="k'.$noUtama.'b'.$noSub.'" class="form-control kolom'.$noSub.'" value="0" readonly="" title="kolom'.$noSub.'"/></td>';
				}else{
					echo '<td>';
					echo '<select name="'.$newname.'" id="k'.$noUtama.'b'.$noSub.'" data-target="k'.$noSub.'b'.$noUtama.'" data-kolom="'.$noSub.'" class="form-control inputnumber kolom'.$noSub.'" title="kolom'.$noSub.'">';
					$nilai=ambil_nilai_aspek_kriteria($kriteriaid,$k2,$xxx);
					?>
					<option value="9" <?php if($nilai=="9") {echo "selected";} ?>>9</option>
					<option value="8" <?php if($nilai=="8") {echo "selected";} ?>>8</option>
					<option value="7" <?php if($nilai=="7") {echo "selected";} ?>>7</option>
					<option value="6" <?php if($nilai=="6") {echo "selected";} ?>>6</option>
					<option value="5" <?php if($nilai=="5") {echo "selected";} ?>>5</option>
					<option value="4" <?php if($nilai=="4") {echo "selected";} ?>>4</option>
					<option value="3" <?php if($nilai=="3") {echo "selected";} ?>>3</option>
					<option value="2" <?php if($nilai=="2") {echo "selected";} ?>>2</option>
					<option value="1" <?php if($nilai=="1") {echo "selected";} ?>>1</option>
					<option value="0.5" <?php if($nilai=="0.5") {echo "selected";} ?>>0.5</option>
					<option value="0.33" <?php if($nilai=="0.33") {echo "selected";} ?>>0.33</option>
					<option value="0.25" <?php if($nilai=="0.25") {echo "selected";} ?>>0.25</option>
					<option value="0.2" <?php if($nilai=="0.2") {echo "selected";} ?>>0.2</option>
					<option value="0.17" <?php if($nilai=="0.17") {echo "selected";} ?>>0.17</option>
					<option value="0.14" <?php if($nilai=="0.14") {echo "selected";} ?>>0.14</option>
					<option value="0.13" <?php if($nilai=="0.13") {echo "selected";} ?>>0.13</option>
					<option value="0.11" <?php if($nilai=="0.11") {echo "selected";} ?>>0.11</option>
					<?php
					echo '</select>';
				}				
			}
		}
		echo '</tr>';
	}
	?>	
</tbody>
<tfoot>
	<tr>
		<th class="text-center bg-success text-white">Jumlah</th>
		<?php
		for($h=1;$h<=$jumlah;$h++)
		{
		?>
		<td><input type="text" id="total<?=$h;?>" class="form-control" value="0" title="total<?=$h;?>"  readonly=""/></td>
		<?php
		}
		?>
	</tr>
</tfoot>
</table>
</div>

<div class="pull-left">
	<!-- <a href="javascript:;" onclick="hitung();" class="btn btn-primary">Hitung</a>  -->
	<a href="javascript:;" onclick="showmatrix();" class="btn btn-info"><i class="fa fa-eye"></i> Lihat Matriks</a>	
	<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan Nilai Aspek Kriteria</button>

	<?php
	echo form_close();
	?>
	
	<form style="display:inline-block" action="<?=base_url("")?>Aspek_kriteria/simpan_prioritas" method="post" accept-charset="utf-8">
		<?php
			$noUtama4=0;	
			foreach($arrs as $k4=>$v4)
			{
				$noUtama4+=1;	
				echo '<input type="hidden" class="form-control" name="id_kriteria[]" value="'.$v4['id_kriteria'].'"/>';
				echo '<input type="hidden" class="form-control" name="id_krit" value="'.$v4['id_kriteria'].'"/>';
				echo '<input type="hidden" class="form-control" name="id_aspek_kriteria[]" value="'.$v4['id_aspek_kriteria'].'"/>';
				echo '<input type="hidden" class="form-control" name="perioritas[]" id="prismp-b'.$noUtama4.'"/>';
			}
		?>
		<button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Nilai Prioritas</button>	
	</form>
</div>
</div>

<br><br>
<div id="matrikdiv" style="display: none">

<h3>Matrik Normalisasi</h3>
<hr/>

<div class="table-responsive">
<?php echo form_open('#',array('id'=>'prioform'));?>
<input type="hidden" name="kriteriaid" value="<?=$kriteriaid;?>"/>
<table class="table table-bordered">
<thead align="center" class="bg-success text-white">
	<th>Aspek Kriteria</th>
	<?php
	foreach($arr as $k=>$v)
	{
	?>
	<th><?=$v;?></th>
	<?php
	}
	?>
	<th>Jumlah</th>
	<th>Prioritas</th>
	<th>Prioritas <br> Aspek Kriteria</th>
	<!--<th>Jumlah</th>-->
</thead>
<tbody>
	<?php
	$noUtama2=0;	
	foreach($arr as $k2=>$v2)
	{
		$noUtama2+=1;
		echo '<tr>';
		echo '<th class="text-center bg-success text-white">'.$v2.'</th>';
		$noSub2=0;
		for($i=1;$i<=$jumlah;$i++)
		{
			$noSub2+=1;
			echo '<td><input type="text" id="mn-k'.$noUtama2.'b'.$noSub2.'" class="form-control" value="0" readonly=""/></td>';
		}
		echo '<td><input type="text" class="form-control" id="jml-b'.$noUtama2.'" value="0" readonly=""/></td>';
		echo '<td><input type="text" class="form-control" id="pri-b'.$noUtama2.'" value="0" readonly=""/></td>';
		echo '<td><input type="text" class="form-control" id="prisub-b'.$noUtama2.'" value="0" readonly=""/></td>';		
		echo '</tr>';
	}	
	?>	
</tbody>
</table>
<?php echo '<button type="submit" class="btn btn-success" style="display:none;">Simpan Prioritas</button>';
echo form_close();
?>
</div>

<h3>Matrik Penjumlahan Tiap Baris</h3>
<hr/>

<div class="table-responsive">
<table class="table table-bordered">
<thead align="center" class="bg-success text-white">
	<th>Aspek Kriteria</th>
	<?php
	foreach($arr as $k=>$v)
	{
	?>
	<th><?=$v;?></th>
	<?php
	}
	?>
	<th>Jumlah</th>
</thead>
<tbody>
	<?php
	$noUtama3=0;	
	foreach($arr as $k3=>$v3)
	{
		$noUtama3+=1;
		echo '<tr>';
		echo '<th class="text-center bg-success text-white">'.$v3.'</th>';
		$noSub3=0;
		for($i=1;$i<=$jumlah;$i++)
		{
			$noSub3+=1;
			echo '<td><input type="text" id="mptb-k'.$noUtama3.'b'.$noSub3.'" class="form-control" value="0" readonly=""/></td>';
		}
		echo '<td><input type="text" class="form-control" id="jmlmptb-b'.$noUtama3.'" value="0" readonly=""/></td>';
		echo '</tr>';
	}
	?>	
</tbody>
</table>
</div>


<h3>Rasio Konsistensi</h3>
<hr/>

<div class="table-responsive">
<table class="table table-bordered">
<thead align="center" class="bg-success text-white">
	<th>Sub Kriteria</th>	
	<th>Jumlah Per Baris</th>
	<th>Prioritas</th>
</thead>
<tbody>
	<?php
	$noUtama4=0;	
	foreach($arr as $k4=>$v4)
	{
		$noUtama4+=1;
		echo '<tr>';
		echo '<td>'.$v4.'</td>';		
		echo '<td><input type="text" class="form-control" id="jmlrk-b'.$noUtama4.'" value="0" readonly=""/></td>';
		echo '<td><input type="text" class="form-control" id="priork-b'.$noUtama4.'" value="0" readonly=""/></td>';
		echo '</tr>';
	}
	?>	
</tbody>
</table>
</div>

<h3>Hasil Perhitungan</h3>
<hr/>

<div class="table-responsive">
<table class="table table-bordered">
<thead align="center" class="bg-success text-white">
	<th>Keterangan</th>
	<th>Nilai</th>
</thead>
<tbody>
	<tr>
		<td>n (Jumlah)</td>
		<td>
			<input type="text" class="form-control" id="sumkriteria" value="<?=$jumlah;?>"  readonly=""/>
		</td>
	</tr>
	<tr>
		<td>λ maks</td>
		<td>
			<input type="text" class="form-control" id="lambda_maks" value="0" readonly=""/>
		</td>
	</tr>
	<tr>
		<td>CI</td>
		<td>
			<input type="text" class="form-control" id="ci" value="0"  readonly=""/>
		</td>
	</tr>
	<tr>
		<td>CR</td>
		<td>
			<input type="text" class="form-control" id="cr" value="0" readonly=""/>
		</td>
	</tr>
</tbody>
</table>
</div>

</div>

<?php
}else{
?>
<div class="alert alert-danger">Parameter belum dibuat. Silahkan buat terlebih dahulu</div>
<?php
}
?>