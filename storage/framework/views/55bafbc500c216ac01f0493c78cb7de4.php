<?php $__env->startSection('title', 'Kelola Cast'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Daftar Cast / Aktor</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="card card-dark">
    <div class="card-header">
        <a href="<?php echo e(route('admin.cast.create')); ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Cast</a>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Nama</th>
                    <th style="width: 100px">Umur</th>
                    <th>Bio</th>
                    <th style="width: 150px" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $casts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cast): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($key + 1); ?></td>
                        <td><?php echo e($cast->nama); ?></td>
                        <td><?php echo e($cast->umur); ?></td>
                        <td><?php echo e(Str::limit($cast->bio, 80)); ?></td>
                        <td class="text-center">
                            <form action="<?php echo e(route('admin.cast.destroy', $cast->id)); ?>" method="POST">
                                <a href="<?php echo e(route('admin.cast.edit', $cast->id)); ?>" class="btn btn-warning btn-xs"><i class="fas fa-edit"></i></a>
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Yakin hapus data?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="5" class="text-center">Belum ada data cast.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\zabran\Downloads\TugasKelompok-KPW-updated (1)\TugasKelompok-KPW\resources\views/admin/cast/index.blade.php ENDPATH**/ ?>