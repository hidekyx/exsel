<?php $this->load->view('layouts/header_admin'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-chart-area"></i> Ranking </h1>
	<a href="<?= base_url('Laporan'); ?>" class="btn btn-primary"> <i class="fa fa-print"></i> Cetak Data </a>
</div>

<!-- Content Row -->
<div class="alert alert-success">
	<?php if (isset($hasil[0])) : ?>
		<h2><b>Selamat Kepada <?= $hasil[0]->nama ?>, Peserta Terpilih Sebagai Peserta Terbaik Pada Track UI/UX Design!</b></h2>
		<b><span><?= $hasil[0]->nama ?></span> terpilih sebagai peserta terbaik, dikarenakan memenuhi persyaratan penilaian kriteria</b>
	<?php else : ?>
		<h2><b>Belum ada peserta yang terpilih sebagai peserta terbaik pada Track UI/UX Design.</b></h2>
		<b>Data peserta terbaik belum tersedia.</b>
	<?php endif; ?>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Hasil Perankingan</h6>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" width="100%" cellspacing="0">
						<thead class="bg-success text-white">
							<tr align="center">
								<th>Peserta</th>
								<th>Nilai</th>
								<th width="15%">Rank</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							foreach ($hasil as $keys) : ?>
								<?php if($keys->nilai) : ?>
								<tr align="center">
									<td align="left">
										<a href="#" class="open-modal" data-nama="<?= $keys->nama ?>" data-catatan="<?= $keys->catatan ?>" 
											<?php foreach ($kriteria as $key) : ?> 
												<?php $nilai_mentah = $this->Perhitungan_model->data_nilai($keys->id_alternatif, $key->id_kriteria)['nilai_mentah']; ?>
												data-<?= str_replace(' ', '', strtolower($key->nama_kriteria)) ?>="<?= $nilai_mentah ?>" 
											<?php endforeach; ?>>
											<?= $keys->nama ?>
										</a>
									</td>
									<td><?= $keys->nilai ?></td>
									<td><?= $no; ?></td>
								</tr>
								<?php endif; ?>
							<?php
								$no++;
							endforeach ?>

							<tr align="center" class="bg-light">
								<td colspan="3">Data Peserta di bawah ini belum di nilai. <a href="<?= base_url('Penilaian'); ?>">Silahkan nilai terlebih dahulu</a></td>
							</tr>
							
							<?php
							foreach ($hasil as $keys) : ?>
								<?php if(!$keys->nilai) : ?>
								<tr align="center">
									<td align="left"><?= $keys->nama ?></td>
									<td>-</td>
									<td>-</td>
								</tr>
								<?php endif; ?>
							<?php
							endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Keterangan Penilaian</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form>
					<?php foreach ($kriteria as $k) : ?>
						<div class="form-group">
							<label for="<?= str_replace(' ', '', strtolower($k->nama_kriteria)) ?>"><?= $k->nama_kriteria ?></label>
							<input type="text" class="form-control" id="<?= str_replace(' ', '', strtolower($k->nama_kriteria)) ?>" readonly>
						</div>
					<?php endforeach ?>
					<div class="form-group">
						<label for="catatan">Catatan</label>
						<textarea class="form-control" readonly id="catatan" rows="6"></textarea>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('layouts/footer_admin'); ?>

<script>
	$(document).ready(function() {
		$('.open-modal').click(function() {
			<?php foreach ($kriteria as $k) : ?>
				var <?= str_replace(' ', '', strtolower($k->nama_kriteria)) ?> = $(this).data('<?= str_replace(' ', '', strtolower($k->nama_kriteria)) ?>');
				$('#<?= str_replace(' ', '', strtolower($k->nama_kriteria)) ?>').val(<?= str_replace(' ', '', strtolower($k->nama_kriteria)) ?>);
			<?php endforeach; ?>

			var catatan = $(this).data('catatan');
			$('#catatan').val(catatan);

			$('#detailModal').modal('show');
		});
	});
</script>