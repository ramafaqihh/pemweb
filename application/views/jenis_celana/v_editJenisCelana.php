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
						<li class="breadcrumb-item"><a href="<?= base_url('jenis_celana'); ?>">Data Celana</a></li>
						<li class="breadcrumb-item active">Edit Celana</li>
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
				<div class="col-xl-12">
					<div class="card card-secondary">
						<div class="card-header">
							<h3 class="card-title">Form Edit Celana</h3>
						</div>
						<div class="card-body">
							<form action="<?= base_url('jenis_celana/update'); ?>" method="post" enctype="multipart/form-data">
								<input type="hidden" name="id" value="<?php echo $jenis_celana->id; ?>">
								<div class="form-group">
									<label>Nama Celana</label>
									<input type="text" name="nama_celana" class="form-control" value="<?php echo $jenis_celana->nama_celana; ?>">
									<span class="text-danger"><?php echo form_error('nama_celana'); ?></span>
								</div>
								<div class="form-group">
									<label>Bahan</label>
									<input type="text" name="bahan" class="form-control" value="<?php echo $jenis_celana->bahan; ?>">
									<span class="text-danger"><?php echo form_error('bahan'); ?></span>

								</div>
								<div class="form-group">
									<label>Detail</label>
									<textarea name="detail" class="form-control" rows="7"><?php echo $jenis_celana->detail; ?></textarea>
									<span class="text-danger"><?php echo form_error('detail'); ?></span>
								</div>
								<div class="form-group">
									<label>Gambar</label>
									<input type="file" name="gambar" class="form-control" accept=".png,.jpg,.jpeg">
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