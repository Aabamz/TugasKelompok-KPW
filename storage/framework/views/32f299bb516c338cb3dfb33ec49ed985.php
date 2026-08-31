<?php $__env->startSection('title', 'Kelola Genre'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Daftar Genre</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="card card-dark">
    <div class="card-header">
        <a href="<?php echo e(route('admin.genre.create')); ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Genre</a>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Nama Genre</th>
                    <th style="width: 150px" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $genres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($key + 1); ?></td>
                        <td><?php echo e($genre->nama); ?></td>
                        <td class="text-center">
                            <form action="<?php echo e(route('admin.genre.destroy', $genre->id)); ?>" method="POST">
                                <a href="<?php echo e(route('admin.genre.edit', $genre->id)); ?>" class="btn btn-warning btn-xs"><i class="fas fa-edit"></i></a>
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Yakin hapus data?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="3" class="text-center">Belum ada data genre.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\zabran\Downloads\TugasKelompok-KPW-updated (1)\TugasKelompok-KPW\resources\views/admin/genre/index.blade.php ENDPATH**/ ?>