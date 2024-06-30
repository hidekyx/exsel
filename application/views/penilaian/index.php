<?php

use phpDocumentor\Reflection\DocBlock\Tags\Var_;

$this->load->view('layouts/header_admin'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-edit"></i> Penilaian Peserta</h1>
</div>

<?= $this->session->flashdata('message'); ?>

<div class="card shadow mb-4">
	<!-- /.card-header -->
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Daftar Penilaian Peserta</h6>
	</div>

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-success text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>Alternatif</th>
						<th width="15%">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					foreach ($alternatif as $keys) : ?>
						<tr align="center">
							<td><?= $no ?></td>
							<td align="left"><?= $keys->nama ?></td>
							<?php $cek_tombol = $this->Penilaian_model->untuk_tombol($keys->id_alternatif); ?>

							<td>
								<?php if ($cek_tombol == 0) { ?>
									<a data-toggle="modal" href="#set<?= $keys->id_alternatif ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Input</a>
									<!-- Modal -->
									<div class="modal fade text-left" id="set<?= $keys->id_alternatif ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Input Penilaian</h5>
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												</div>
												<?= form_open('Penilaian/tambah_penilaian') ?>
												<div class="modal-body">
													<?php foreach ($kriteria as $key) : ?>
														<?php
														$sub_kriteria = $this->Penilaian_model->data_sub_kriteria($key->id_kriteria);
														?>
														<?php if ($sub_kriteria != NULL) : ?>
															<input type="text" name="id_alternatif" value="<?= $keys->id_alternatif ?>" hidden>
															<input type="text" name="id_kriteria[]" value="<?= $key->id_kriteria ?>" hidden>
															<div class="form-group">
																<label class="font-weight-bold" for="<?= $key->id_kriteria ?>"><?= $key->nama_kriteria ?></label>
																<?php if ($key->tipe_kriteria == "Alphabetic") : ?>
																	<input type="text" name="value_type[]" value="select" hidden>
																	<select name="id_sub_kriteria[]" class="form-control" required>
																		<option value="">--Pilih--</option>
																		<?php foreach ($sub_kriteria as $subs_kriteria) : ?>
																			<option value="<?= $subs_kriteria['id_sub_kriteria'] ?>"><?= $subs_kriteria['nama_sub_kriteria'] ?> </option>
																		<?php endforeach ?>
																	</select>
																<?php else :
																	$range_atas = $this->Sub_Kriteria_model->get_range_atas($key->id_kriteria);
																	$range_bawah = $this->Sub_Kriteria_model->get_range_bawah($key->id_kriteria);
																?>
																	<input type="text" name="value_type[]" value="number" hidden>
																	<input name="id_sub_kriteria[]" type="number" max="<?= $range_atas ?>" min="<?= $range_bawah ?>" class="form-control" id="<?= $key->id_kriteria ?>" required>
																<?php endif ?>
															</div>
														<?php endif ?>
													<?php endforeach ?>
													<div class="form-group">
														<label class="font-weight-bold" for="catatan">Catatan</label>
														<textarea name="catatan" class="form-control"  placeholder="Karakteristik Peserta" required></textarea>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
													<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
												</div>
												</form>
											</div>
										</div>
									</div>
								<?php } else { ?>
									<a data-toggle="modal" href="#edit<?= $keys->id_alternatif ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
									<!-- Modal -->
									<div class="modal fade text-left" id="edit<?= $keys->id_alternatif ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Edit Penilaian</h5>
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												</div>
												<?= form_open('Penilaian/update_penilaian') ?>
												<div class="modal-body">
													<?php foreach ($kriteria as $key) : ?>
														<?php
														$sub_kriteria = $this->Penilaian_model->data_sub_kriteria($key->id_kriteria);
														?>
														<?php if ($sub_kriteria != NULL) : ?>
															<input type="text" name="id_alternatif" value="<?= $keys->id_alternatif ?>" hidden>
															<input type="text" name="id_kriteria[]" value="<?= $key->id_kriteria ?>" hidden>
															<div class="form-group">
																<label class="font-weight-bold" for="<?= $key->id_kriteria ?>"><?= $key->nama_kriteria ?></label>
																<?php if ($key->tipe_kriteria == "Alphabetic") : ?>
																	<input type="text" name="value_type[]" value="select" hidden>
																	<select name="id_sub_kriteria[]" class="form-control" id="<?= $key->id_kriteria ?>" required>
																		<option value="">--Pilih--</option>
																		<?php foreach ($sub_kriteria as $subs_kriteria) : ?>
																			<?php $s_option = $this->Penilaian_model->data_penilaian($keys->id_alternatif, $subs_kriteria['id_kriteria']); ?>
																			<option value="<?= $subs_kriteria['id_sub_kriteria'] ?>" <?php if ($subs_kriteria['id_sub_kriteria'] == $s_option['id_sub_kriteria']) {
																																			echo "selected";
																																		} ?>><?= $subs_kriteria['nama_sub_kriteria'] ?> </option>
																		<?php endforeach ?>
																	</select>
																<?php else :
																	$range_atas = $this->Sub_Kriteria_model->get_range_atas($key->id_kriteria);
																	$range_bawah = $this->Sub_Kriteria_model->get_range_bawah($key->id_kriteria);
																?>
																	<input type="text" name="value_type[]" value="number" hidden>
																	<input name="id_sub_kriteria[]" step=".01" value="<?= $this->Penilaian_model->data_nilai($keys->id_alternatif, $key->id_kriteria) ?>" type="number" max="<?= $range_atas ?>" min="<?= $range_bawah ?>" class="form-control" id="<?= $key->id_kriteria ?>" required>
																<?php endif ?>
															</div>
														<?php endif ?>
													<?php endforeach ?>
													<div class="form-group">
														<label class="font-weight-bold" for="catatan">Catatan</label>
														<textarea name="catatan" class="form-control" placeholder="Karakteristik Peserta" required><?=$keys->catatan ?></textarea>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
													<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
												</div>
												</form>
											</div>
										</div>
									</div>
								<?php } ?>
							</td>
						</tr>
					<?php
						$no++;
					endforeach
					?>
				</tbody>
			</table>
		</div>
	</div>

	<?php $this->load->view('layouts/footer_admin'); ?>