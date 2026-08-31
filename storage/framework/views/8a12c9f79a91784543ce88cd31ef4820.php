<?php $__env->startSection('title', 'Kelola Film'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Daftar Film</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="card card-dark">
    <div class="card-header">
        <a href="<?php echo e(route('admin.film.create')); ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Film</a>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped table-dark align-middle">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Poster</th>
                    <th>Judul</th>
                    <th>Tahun</th>
                    <th>Genre</th>
                    <th>Rating</th>
                    <th style="width: 150px" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $films; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $film): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($key + 1); ?></td>
                        <td>
                            <img src="<?php echo e(asset('storage/' . $film->poster)); ?>" alt="Poster" width="50" class="rounded">
                        </td>
                        <td><?php echo e($film->judul); ?></td>
                        <td><?php echo e($film->tahun); ?></td>
                        <td><span class="badge badge-info"><?php echo e($film->genre->nama ?? '-'); ?></span></td>
                        <td>
                            <?php if($film->kritik_count > 0): ?>
                                <span class="text-warning"><i class="fas fa-star"></i> <?php echo e(number_format($film->kritik_avg_point, 1)); ?></span>
                                <small class="text-muted">(<?php echo e($film->kritik_count); ?>)</small>
                            <?php else: ?>
                                <small class="text-muted">-</small>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <form action="<?php echo e(route('admin.film.destroy', $film->id)); ?>" method="POST">
                                <a href="<?php echo e(route('admin.film.edit', $film->id)); ?>" class="btn btn-warning btn-xs"><i class="fas fa-edit"></i></a>
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Yakin hapus film ini?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="7" class="text-center">Belum ada data film.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\zabran\Downloads\TugasKelompok-KPW-updated (1)\TugasKelompok-KPW\resources\views/admin/film/index.blade.php ENDPATH**/ ?>