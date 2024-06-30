<?php $this->load->view('layouts/header_admin'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-clock"></i> Batch</h1>

	<a href="<?= base_url('Batch'); ?>" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
		<span class="text">Kembali</span>
	</a>
</div>

<?= $this->session->flashdata('message'); ?> 

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fas fa-fw fa-plus"></i> Edit Batch</h6>
    </div>
	
	<?php echo form_open('Batch/update/'.$batch->id_batch); ?>
		<div class="card-body">
			<div class="row">
                <?php echo form_hidden('id_batch', $batch->id_batch) ?>
				<div class="form-group col-md-3">
					<label class="font-weight-bold">Nama Batch</label>
					<input autocomplete="off" type="text" name="nama_batch" value="<?php echo $batch->nama_batch ?>" required class="form-control"/>
				</div>

                <div class="form-group col-md-3">
					<label class="font-weight-bold">Tanggal Mulai</label>
					<input autocomplete="off" type="date" name="tanggal_mulai" value="<?php echo $batch->tanggal_mulai ?>" required class="form-control"/>
				</div>

                <div class="form-group col-md-3">
					<label class="font-weight-bold">Tanggal Selesai</label>
					<input autocomplete="off" type="date" name="tanggal_selesai" value="<?php echo $batch->tanggal_selesai ?>" required class="form-control"/>
				</div>

				<div class="form-group col-md-3">
					<label class="font-weight-bold">Status</label>
					<select name="status" class="form-control" required>
						<option value="">--Pilih Status--</option>
                        <option value="<?php echo $batch->status ?>" selected hidden><?php echo $batch->status ?></option>
						<option value="Aktif">Aktif</option>
						<option value="Selesai">Selesai</option>
					</select>
				</div>
			</div>
		</div>
		<div class="card-footer text-right">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
            <button type="reset" class="btn btn-info"><i class="fa fa-sync-alt"></i> Reset</button>
        </div>
	<?php echo form_close() ?>
</div>

<?php $this->load->view('layouts/footer_admin'); ?>