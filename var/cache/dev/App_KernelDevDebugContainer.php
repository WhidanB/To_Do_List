<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerTzMYm6N\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerTzMYm6N/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerTzMYm6N.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerTzMYm6N\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerTzMYm6N\App_KernelDevDebugContainer([
    'container.build_hash' => 'TzMYm6N',
    'container.build_id' => 'feab08f8',
    'container.build_time' => 1691072247,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerTzMYm6N');
