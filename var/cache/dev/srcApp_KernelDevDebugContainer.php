<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerPT3GFxx\srcApp_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerPT3GFxx/srcApp_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerPT3GFxx.legacy');

    return;
}

if (!\class_exists(srcApp_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerPT3GFxx\srcApp_KernelDevDebugContainer::class, srcApp_KernelDevDebugContainer::class, false);
}

return new \ContainerPT3GFxx\srcApp_KernelDevDebugContainer([
    'container.build_hash' => 'PT3GFxx',
    'container.build_id' => 'ec7bd5d9',
    'container.build_time' => 1559834517,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerPT3GFxx');
