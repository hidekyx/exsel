<?php $this->load->view('layouts/header_admin'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-clock"></i> Batch</h1>

	<div>
        <a href="<?= base_url('Batch/create'); ?>" class="btn btn-success"> <i class="fa fa-plus"></i> Tambah Data </a>
	</div>
</div>

<?= $this->session->flashdata('message'); ?>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Daftar Batch</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-success text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>Nama Batch</th>
						<th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Status</th>
						<th width="15%">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$no=1;
						foreach ($batch as $data => $value) {
					?>
					<tr align="center">
						<td><?=$no ?></td>
						<td><?php echo $value->nama_batch ?></td>
						<td><?php echo $value->tanggal_mulai ?></td>
						<td><?php echo $value->tanggal_selesai ?></td>
                        <td><?php echo $value->status ?></td>
						<td>
							<div class="btn-group" role="group">
                                <a data-toggle="tooltip" data-placement="bottom" title="Aktif Batch" href="<?=base_url('Batch/active/'.$value->id_batch)?>" class="btn btn-info btn-sm"><i class="fa fa-check"></i></a>
								<a data-toggle="tooltip" data-placement="bottom" title="Edit Batch" href="<?=base_url('Batch/edit/'.$value->id_batch)?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
								<a data-toggle="tooltip" data-placement="bottom" title="Hapus Batch" href="<?=base_url('Batch/destroy/'.$value->id_batch)?>" onclick="return confirm ('Apakah anda yakin untuk meghapus data ini')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
							</div>
						</td>
					</tr>
					<?php
						$no++;
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div id="matrik"></div>	


<?php $this->load->view('layouts/footer_admin'); ?>