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
						<li class="breadcrumb-item"><a href="<?= base_url('list_celana'); ?>">Data Celana</a></li>
						<li class="breadcrumb-item active">Tambah Celana yang mau dibeli</li>
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
							<h3 class="card-title">Form Tambah Celana</h3>
						</div>
						<div class="card-body">
							<form action="<?= base_url('list_celana/store'); ?>" method="post">
								<div class="form-group">
									<label>Nama Katalog</label>
									<select name="idKatalog" class="form-control">
										<option value="">-- Pilih Katalog --</option>
										<?php foreach ($katalog as $ktg) : ?>
											<option value="<?php echo $ktg->id; ?>" <?php echo (set_value('idKatalog') == $ktg->id) ? 'selected' : ''; ?>><?php echo $ktg->nama_katalog; ?></option>
										<?php endforeach; ?>
									</select>
									<span class="text-danger"><?php echo form_error('idKatalog'); ?></span>
								</div>

								<!-- $cek = (1 < 2) ? 'benar' : 'salah'; -->

								<div class="form-group">
									<label>Nama Celana</label>
									<select name="idJenis_celana" class="form-control">
										<option value="">-- Pilih Celana --</option>
										<?php foreach ($jenis_celana as $fil) : ?>
											<option value="<?php echo $fil->id; ?>" <?php echo (set_value('idJenis_celana') == $fil->id) ? 'selected' : ''; ?>><?php echo $fil->nama_celana . ' - ' . $fil->bahan; ?></option>
										<?php endforeach; ?>
									</select>
									<span class="text-danger"><?php echo form_error('idJenis_celana'); ?></span>


								</div>
								<div class="form-group">
									<label>Jumlah Celana</label>
									<input type="number" name="jumlahCelana" class="form-control" value="<?php echo set_value('jumlahCelana'); ?>">
									<span class="text-danger"><?php echo form_error('jumlahCelana'); ?></span>
								</div>
								<button type="submit" class="btn btn-success">Simpan</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>