<?php $__env->startSection('title', 'Data User'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Daftar Pengguna Terdaftar</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>
<?php if(session('error')): ?>
    <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
<?php endif; ?>

<div class="card card-dark">
    <div class="card-body p-0">
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Umur</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($key + 1); ?></td>
                        <td><a href="<?php echo e(route('profile.view', $user->id)); ?>"><?php echo e($user->name); ?></a></td>
                        <td><?php echo e($user->email); ?></td>
                        <td><?php echo e($user->profile->umur ?? '-'); ?></td>
                        <td><?php echo e($user->profile->alamat ?? '-'); ?></td>
                        <td>
                            <form action="<?php echo e(route('admin.users.destroy', $user->id)); ?>" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus user <?php echo e($user->name); ?>? Data ulasan dan profilnya juga akan ikut terhapus.');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="6" class="text-center">Belum ada user registered.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\zabran\Downloads\TugasKelompok-KPW-updated (1)\TugasKelompok-KPW\resources\views/admin/user/index.blade.php ENDPATH**/ ?>