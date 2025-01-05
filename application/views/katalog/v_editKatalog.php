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
						<li class="breadcrumb-item"><a href="<?= base_url('katalog'); ?>">Data Katalog</a></li>
						<li class="breadcrumb-item active">Edit Katalog</li>
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
							<h3 class="card-title">Form Edit Katalog</h3>
						</div>
						<div class="card-body">
							<form action="<?= base_url('katalog/update'); ?>" method="post">
								<input type="hidden" name="id" value="<?php echo $katalog->id; ?>">
								<div class="form-group">
									<label>Nama Katalog</label>
									<input type="text" name="nama_katalog" class="form-control" value="<?php echo $katalog->nama_katalog; ?>">
									<span class="text-danger"><?php echo form_error('nama_katalog'); ?></span>
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