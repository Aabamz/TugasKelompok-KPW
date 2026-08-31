<?php $__env->startSection('title', $user->name . ' - Profil'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1><?php echo e($isOwner ? 'Profil Saya' : $user->name . ' - Profil'); ?></h1>
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
    
    <div class="col-md-4">
        <div class="card card-primary card-outline bg-dark text-center">
            <div class="card-body box-profile">
                <img class="profile-user-img img-fluid img-circle mb-3" src="https://i.pravatar.cc/150?u=<?php echo e($user->id); ?>" alt="User profile picture">

                <h3 class="profile-username font-weight-bold mb-0"><?php echo e($user->name); ?></h3>
                <p class="text-muted"><?php echo e($user->email); ?></p>
                <span class="badge badge-success px-3 py-1 mb-3"><?php echo e(strtoupper($user->role)); ?></span>

                
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item bg-transparent">
                        <b>Followers</b> <span class="float-right"><?php echo e($user->followers()->count()); ?></span>
                    </li>
                    <li class="list-group-item bg-transparent">
                        <b>Following</b> <span class="float-right"><?php echo e($user->following()->count()); ?></span>
                    </li>
                </ul>

                <?php if($isOwner): ?>
                    <a href="<?php echo e(route('profile.edit')); ?>" class="btn btn-primary btn-block">
                        <i class="fas fa-user-edit mr-1"></i> Edit Profil
                    </a>
                <?php else: ?>
                    <form action="<?php echo e(route('profile.follow', $user->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php if(auth()->user()->isFollowing($user)): ?>
                            <button type="submit" class="btn btn-outline-light btn-block">
                                <i class="fas fa-user-check mr-1"></i> Following
                            </button>
                        <?php else: ?>
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-user-plus mr-1"></i> Follow
                            </button>
                        <?php endif; ?>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>

    
    <div class="col-md-8">
        <div class="card card-dark">
            <div class="card-header border-bottom border-secondary">
                <h3 class="card-title font-weight-bold">About</h3>
            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-sm-3"><i class="fas fa-birthday-cake mr-1"></i> Umur</div>
                    <div class="col-sm-9 text-muted"><?php echo e($user->profile->umur ?? '-'); ?> tahun</div>
                </div>
                <hr>
                <div class="row mb-2">
                    <div class="col-sm-3"><i class="fas fa-quote-left mr-1"></i> Bio</div>
                    <div class="col-sm-9 text-muted"><?php echo e($user->profile->bio ?? 'Belum ada bio.'); ?></div>
                </div>
                <hr>
                <div class="row mb-2">
                    <div class="col-sm-3"><i class="fas fa-map-marker-alt mr-1"></i> Alamat</div>
                    <div class="col-sm-9 text-muted"><?php echo e($user->profile->alamat ?? '-'); ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\zabran\Downloads\TugasKelompok-KPW-updated (1)\TugasKelompok-KPW\resources\views/user/profile/show.blade.php ENDPATH**/ ?>