<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerYbJvzYA\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerYbJvzYA/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerYbJvzYA.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerYbJvzYA\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerYbJvzYA\App_KernelDevDebugContainer([
    'container.build_hash' => 'YbJvzYA',
    'container.build_id' => '9bd9f01a',
    'container.build_time' => 1690977564,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerYbJvzYA');
