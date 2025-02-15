<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0"><?= $title; ?></h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('orders'); ?>">Data List Orders</a></li>
						<li class="breadcrumb-item active">Orders</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-6">
					<div class="card card-secondary">
						<div class="card-header">
							<h3 class="card-title">Form Orders</h3>
						</div>
						<div class="card-body">
							<form action="<?= base_url('orders/store'); ?>" method="post">
								<div class="form-group">
									<label>Nama Celana</label>
									<select name="idList_celana" class="form-control" id="idList_celana">
										<option value="">-- Pilih Celana --</option>
										<?php foreach ($list_celana as $lsc) : ?>
											<option value="<?php echo $lsc->id; ?>" ($lsc->jumlahCelana - $lsc->celanaTerjual); ?>"><?php echo $lsc->nama_celana . ' - ' . $lsc->bahan . ' | ' . $lsc->nama_katalog; ?></option>
										<?php endforeach; ?>
									</select>
									<span class="text-danger"><?php echo form_error('idList_celana'); ?></span>


								</div>
								<div class="form-group">
									<label>Jumlah Order</label>
									<input type="number" class="form-control" name="jumlah" id="jumlah">
								</div>
								<div class="form-group">
									<label>Ukuran</label>
									<input type="text" class="form-control" name="ukuran" id="ukuran">
								</div>
								<button type="submit" class="btn btn-success" id="btn_simpan">Simpan</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>

<script>
	$('#idJadwal').change(function() {
		let tanggal = $(this).find(':selected').data('tanggal');
		let kursi = $(this).find(':selected').data('kursi');

		kursi = parseInt(kursi);

		$('#tanggal').val(tanggal);
		$('#kursi').val(kursi);

		$('#jumlah').val('');
		$('#no_kursi').val('');

		if (kursi == 0) {
			$('#btn_simpan').prop('disabled', true);
		} else {
			$('#btn_simpan').prop('disabled', false);
		}
	});

	$('#jumlah').change(function() {
		let jumlah = $(this).val();
		jumlah = parseInt(jumlah);

		let kursiTersedia = $('#kursi').val();
		kursiTersedia = parseInt(kursiTersedia);

		if (kursiTersedia != 0) {
			if (jumlah > kursiTersedia) {
				$('#btn_simpan').prop('disabled', true);

				alert('Jumlah order tidak boleh melebihi kursi tersedia!');
			} else {
				$('#btn_simpan').prop('disabled', false);
			}
		} else {
			$('#btn_simpan').prop('disabled', true);
		}
	});
</script>