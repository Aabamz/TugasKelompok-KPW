<?php $__env->startSection('title', $film->judul); ?>

<?php $__env->startSection('content_header'); ?>
    <h1><?php echo e($film->judul); ?></h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo e(session('success')); ?>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo e(session('error')); ?>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
<?php endif; ?>

<div class="row">
    
    <div class="col-md-4 mb-3">
        <div class="card bg-dark text-white">
            <img src="<?php echo e(asset('storage/' . $film->poster)); ?>" class="card-img-top" alt="<?php echo e($film->judul); ?>">
        </div>
    </div>

    
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h3><?php echo e($film->judul); ?> <small class="text-muted">(<?php echo e($film->tahun); ?>)</small></h3>
                <p><span class="badge badge-info"><?php echo e($film->genre->nama ?? 'Tanpa Genre'); ?></span></p>

                <?php $jumlahRating = $film->kritik->count(); ?>
                <p>
                    <?php if($jumlahRating > 0): ?>
                        <span class="text-warning">
                            <?php echo e(str_repeat('⭐', round($film->kritik->avg('point')))); ?>

                        </span>
                        <strong><?php echo e(number_format($film->kritik->avg('point'), 1)); ?></strong> / 5
                        <span class="text-muted">(<?php echo e($jumlahRating); ?> rating)</span>
                    <?php else: ?>
                        <span class="text-muted">Belum ada rating dari penonton.</span>
                    <?php endif; ?>
                </p>
                <hr>
                <h5>Ringkasan</h5>
                <p><?php echo e($film->ringkasan); ?></p>

                <hr>
                <h5>Pemeran</h5>
                <?php $__empty_1 = true; $__currentLoopData = $film->peran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $peran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <span class="badge badge-secondary p-2 mb-1">
                        <?php echo e($peran->cast->nama ?? '-'); ?> <em>sebagai</em> <?php echo e($peran->nama); ?>

                    </span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-muted">Belum ada data pemeran untuk film ini.</p>
                <?php endif; ?>

                <hr>
                <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-secondary btn-sm mt-2"><i class="fas fa-arrow-left"></i> Kembali ke Katalog</a>
            </div>
        </div>
    </div>
</div>


<?php if(!Auth::user()->isAdmin()): ?>
<div class="card card-primary mt-3">
    <div class="card-header">
        <h3 class="card-title">Tulis Ulasan / Kritik</h3>
    </div>
    <form action="<?php echo e(route('kritik.store', $film->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="card-body">
            <div class="form-group">
                <label for="point">Rating</label>
                <select name="point" id="point" class="form-control <?php $__errorArgs = ['point'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                    <option value="">-- Pilih Rating --</option>
                    <?php for($i = 5; $i >= 1; $i--): ?>
                        <option value="<?php echo e($i); ?>" <?php if(old('point') == $i): echo 'selected'; endif; ?>><?php echo e($i); ?> - <?php echo e(str_repeat('⭐', $i)); ?></option>
                    <?php endfor; ?>
                </select>
                <?php $__errorArgs = ['point'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group">
                <label for="content">Kritik / Komentar</label>
                <textarea name="content" id="content" class="form-control <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="3" placeholder="Tulis pendapatmu tentang film ini..." required><?php echo e(old('content')); ?></textarea>
                <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane mr-1"></i> Kirim Ulasan</button>
        </div>
    </form>
</div>
<?php else: ?>
<div class="alert alert-secondary mt-3">
    <i class="fas fa-info-circle mr-1"></i> Administrator tidak dapat memberikan ulasan pada film.
</div>
<?php endif; ?>


<div class="card card-dark mt-3">
    <div class="card-header">
        <h3 class="card-title">Ulasan Penonton (<?php echo e($film->kritik->count()); ?>)</h3>
    </div>
    <div class="card-body">
        <?php $__empty_1 = true; $__currentLoopData = $film->kritik->sortByDesc('created_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kritik): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="media mb-3 pb-3 border-bottom">
                <div class="media-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mt-0 mb-1 font-weight-bold">
                            <a href="<?php echo e(route('profile.view', $kritik->user->id ?? 0)); ?>" class="text-light">
                                <?php echo e($kritik->user->name ?? 'Pengguna'); ?>

                            </a>
                        </h6>
                        <span class="text-warning"><?php echo e(str_repeat('⭐', $kritik->point)); ?></span>
                    </div>
                    <p class="mb-0"><?php echo e($kritik->content); ?></p>
                    <small class="text-muted"><?php echo e($kritik->created_at->diffForHumans()); ?></small>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-muted mb-0">Belum ada ulasan untuk film ini. Jadilah yang pertama memberi ulasan!</p>
        <?php endif; ?>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\zabran\Downloads\TugasKelompok-KPW-updated (1)\TugasKelompok-KPW\resources\views/user/katalog/show.blade.php ENDPATH**/ ?>