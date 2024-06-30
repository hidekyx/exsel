<?php $this->load->view('layouts/header_admin'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-calculator"></i> Tabel Perhitungan</h1>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Matrik Nilai Prioritas Kriteria</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-success text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th width="15%">Kode Kriteria</th>
						<th>Nama Kriteria</th>
						<th>Nilai Prioritas</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$no =1;
						foreach ($kriteria as $key): ?>
					<tr align="center">
						<td><?= $no; ?></td>
						<td><?= $key->kode_kriteria; ?></td>
						<td><?= $key->nama_kriteria; ?></td>
						<td><?= $key->nilai; ?></td>
					</tr>
					<?php
						$no++;
						endforeach
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>



<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Matrik Nilai Prioritas Sub Kriteria</h6>
    </div>

    <div class="card-body">
		<div class="row">
			<?php
				foreach ($kriteria as $key):
			?>
			<div class="col-md-6">
				<span class="badge badge-info"><?= $key->nama_kriteria; ?></span>
				<div class="table-responsive">
					<table class="table table-bordered" width="100%" cellspacing="0">
						<thead class="bg-success text-white">
							<tr align="center">
								<th>Nama Sub Kriteria</th>
								<th>Nilai</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$sub_kriteria = $this->Perhitungan_model->get_aspek_kriteria($key->id_kriteria);
							foreach ($sub_kriteria as $keys): ?>
							<tr align="center">
								<td><?= $keys->nama_aspek; ?></td>
								<td>
								<?php
									$data_nilai_sub = $this->Perhitungan_model->data_nilai_aspek($key->id_kriteria,$keys->id_aspek_kriteria);
									echo $data_nilai_sub['nilai'];
								?>
								</td>
							</tr>
							<?php
								endforeach;
							?>
						</tbody>
					</table>
				</div>
			</div>
			<?php
			endforeach;
			?>
		</div>
	</div>
</div>
					
<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Data Penilaian Alternatif</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-success text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>Nama</th>
						<?php foreach ($kriteria as $key): ?>
						<th><?= $key->nama_kriteria ?></th>
						<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
					<?php 
						$no=1;
						foreach ($alternatif as $keys): ?>
					<tr align="center">
						<td><?= $no; ?></td>
						<td align="left"><?= $keys->nama ?></td>
						<?php foreach ($kriteria as $key): ?>
						<td>
						<?php 
							$data_pencocokan = $this->Perhitungan_model->data_nilai($keys->id_alternatif,$key->id_kriteria);
							if($data_pencocokan) {
								echo $data_pencocokan['nilai_mentah'];
							}
							else {
								echo '-';
							}
						?>
						</td>
						<?php endforeach ?>
					</tr>
					<?php
						$no++;
						endforeach
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Matrik Keputusan (X)</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-success text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>Nama</th>
						<?php foreach ($kriteria as $key): ?>
						<th><?= $key->nama_kriteria ?></th>
						<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
					<?php 
						$no=1;
						foreach ($alternatif as $keys): ?>
					<tr align="center">
						<td><?= $no; ?></td>
						<td align="left"><?= $keys->nama ?></td>
						<?php foreach ($kriteria as $key): ?>
						<td>
						<?php 
							$data_pencocokan = $this->Perhitungan_model->data_nilai($keys->id_alternatif,$key->id_kriteria);
							if($data_pencocokan) {
								echo $data_pencocokan['nilai'];
							}
							else {
								echo '-';
							}
						?>
						</td>
						<?php endforeach ?>
					</tr>
					<?php
						$no++;
						endforeach
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Data Perhitungan Nilai Artribut</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-success text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>Nama</th>
						<?php foreach ($kriteria as $key): ?>
						<th><?= $key->nama_kriteria ?></th>
						<?php endforeach ?>
						<th>Total Nilai</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$this->Perhitungan_model->hapus_hasil();
						$no=1;
						foreach ($alternatif as $keys): ?>
					<tr align="center">
						<td><?= $no; ?></td>
						<td align="left"><?= $keys->nama ?></td>
						<?php 
						$t_a = 0;
						foreach ($kriteria as $key): ?>
						<td>
						<?php 
							$data_pencocokan = $this->Perhitungan_model->data_nilai($keys->id_alternatif,$key->id_kriteria);
							if($data_pencocokan) {
								$a = $data_pencocokan['nilai']*$key->nilai;
								$t_a += $a;
								echo $a;
							}
							else {
								echo '-';
							}
						?>
						</td>
						<?php endforeach ?>
						<td><?= $t_a; ?></td>
					</tr>
					<?php
						$hasil_akhir = [
							'id_alternatif' => $keys->id_alternatif,
							'nilai' => $t_a
						];
						$this->Perhitungan_model->insert_hasil($hasil_akhir);
						$no++;
						endforeach
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php
$this->load->view('layouts/footer_admin');
?>