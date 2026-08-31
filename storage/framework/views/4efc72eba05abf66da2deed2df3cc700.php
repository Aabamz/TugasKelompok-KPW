<?php $__env->startSection('title', 'Katalog Film'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <h1>Katalog Film</h1>
        <form action="<?php echo e(route('dashboard')); ?>" method="GET" class="form-inline">
            <div class="input-group">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari film..." value="<?php echo e(request('search')); ?>">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-sm btn-default"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <?php $__empty_1 = true; $__currentLoopData = $films; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $film): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <img src="<?php echo e(asset('storage/' . $film->poster)); ?>" class="card-img-top" alt="<?php echo e($film->judul); ?>" style="height: 300px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge badge-info"><?php echo e($film->genre->nama ?? 'Umum'); ?></span>
                        <small class="text-muted"><i class="fas fa-calendar"></i> <?php echo e($film->tahun); ?></small>
                    </div>
                    <div class="mb-2">
                        <?php if($film->kritik_count > 0): ?>
                            <span class="text-warning">
                                <i class="fas fa-star"></i> <?php echo e(number_format($film->kritik_avg_point, 1)); ?>

                            </span>
                            <small class="text-muted">(<?php echo e($film->kritik_count); ?> ulasan)</small>
                        <?php else: ?>
                            <small class="text-muted"><i class="far fa-star"></i> Belum ada rating</small>
                        <?php endif; ?>
                    </div>
                    <h5 class="card-title font-weight-bold text-truncate"><?php echo e($film->judul); ?></h5>
                    <p class="card-text text-muted small flex-grow-1" style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                        <?php echo e($film->ringkasan); ?>

                    </p>
                    <a href="<?php echo e(route('film.detail', $film->id)); ?>" class="btn btn-primary btn-block btn-sm mt-2">
                        <i class="fas fa-eye"></i> Lihat Detail
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-12 text-center py-5">
            <i class="fas fa-film fa-3x text-muted mb-3"></i>
            <p class="text-muted">Film tidak ditemukan atau belum ada data film di database.</p>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\zabran\Downloads\TugasKelompok-KPW-updated (1)\TugasKelompok-KPW\resources\views/dashboard.blade.php ENDPATH**/ ?>