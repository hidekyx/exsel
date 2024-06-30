<?php $this->load->view('layouts/header_admin'); ?>

<script type="text/javascript">
function showsubdata(kriteria)
{
	$.ajax({
			type:'get',
			dataType:'html',
			url:"<?=base_url('Aspek_kriteria/getsub');?>",
			data:"kriteria="+kriteria,
			error:function(){
				$("#matriksub").html('Gagal mengambil data matrik');
			},
			beforeSend:function(){
				$("#matriksub").html('Mengambil data matrik. Tunggu sebentar');
			},
			success:function(x){
				$("#matriksub").html(x);
			},
		});
}
	
function showsubkriteria()
{
	$.ajax({
			type:'get',
			dataType:'html',
			url:"<?=base_url('Aspek_kriteria/getsubcontainer');?>",
			data:"",
			error:function(){
				$("#matrik").html('Gagal mengambil data matrik aspek kriteria');
			},
			beforeSend:function(){
				$("#matrik").html('Mengambil data matrik sub kriteria. Tunggu sebentar');
			},
			success:function(x){
				$("#matrik").html(x);
			},
		});
}
</script>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-tags"></i> Aspek Kriteria</h1>
	
	<a href="javascript:;" onclick="showsubkriteria();" class="btn btn-info"><i class="fa fa-eye"></i> Perbandingan Aspek Kriteria</a>
</div>

<?= $this->session->flashdata('message'); ?>

<?php if ($kriteria==NULL): ?>
<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Daftar Aspek Kriteria</h6>
    </div>

    <div class="card-body">
		<div class="alert alert-info">
			Data masih kosong.
		</div>
	</div>
</div>
<?php endif ?>

<?php foreach ($kriteria as $key): ?>
<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <div class="d-sm-flex align-items-center justify-content-between">
			<h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> <?= $key->nama_kriteria." (".$key->kode_kriteria.")" ?></h6>
			
			<a href="#tambah<?= $key->id_kriteria ?>" data-toggle="modal" class="btn btn-sm btn-success"> <i class="fa fa-plus"></i> Tambah Data </a>
		</div>
    </div>
	
	<div class="modal fade" id="tambah<?= $key->id_kriteria ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Tambah <?= $key->nama_kriteria ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<?= form_open('Aspek_kriteria/store') ?>
					<div class="modal-body">
						<input type="text" name="id_kriteria" value="<?= $key->id_kriteria ?>" hidden>
						<div class="form-group">
							<label for="nama_aspek" class="font-weight-bold">Nama Aspek Kriteria</label>
							<input autocomplete="off" type="text" id="nama_aspek" class="form-control" name="nama_aspek" required>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
						<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
					</div>
				<?php echo form_close() ?>
			</div>
		</div>
	</div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-success text-white">
					<tr align="center">						
						<th width="5%">No</th>
						<th>Nama Aspek Kriteria</th>
						<th width="15%">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$sub_kriteria1 = $this->Aspek_Kriteria_model->data_aspek_kriteria($key->id_kriteria);
						$no=1;
						foreach ($sub_kriteria1 as $key):
					?>
					<tr align="center">
						<td><?=$no ?></td>
						<td align="left"><?= $key['nama_aspek'] ?></td>
						<td>
							<div class="btn-group" role="group">
								<a data-toggle="modal" title="Edit Data" href="#editsk<?= $key['id_aspek_kriteria'] ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
								<a  data-toggle="tooltip" data-placement="bottom" title="Hapus Data" href="<?= base_url('Aspek_kriteria/destroy/'.$key['id_aspek_kriteria']) ?>" onclick="return confirm ('Apakah anda yakin untuk meghapus data ini')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
							</div>
						</td>
					</tr>

					<!-- Modal -->
					<div class="modal fade" id="editsk<?= $key['id_aspek_kriteria'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Edit <?= $key['nama_aspek'] ?></h5>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								</div>
								<?= form_open('Aspek_kriteria/update/'.$key['id_aspek_kriteria']) ?>
									<?= form_hidden('id_aspek_kriteria', $key['id_aspek_kriteria']) ?>
									<div class="modal-body">
										<input type="text" name="id_kriteria" value="<?= $key['id_kriteria'] ?>" hidden>
										<div class="form-group">
											<label for="nama_aspek" class="font-weight-bold">Nama Aspek Kriteria</label>
											<input type="text" id="nama_aspek" autocomplete="off" class="form-control" value="<?= $key['nama_aspek'] ?>" name="nama_aspek" required>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
										<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
									</div>
								<?php echo form_close() ?>
							</div>
						</div>
					</div>
                <?php
					$no++;
					endforeach
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php endforeach ?>	  

<div id="matrik"></div>	

<?php $this->load->view('layouts/footer_admin'); ?>