<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem, Project } from '@/types';
import { Head } from '@inertiajs/vue3';
import { trans } from 'laravel-vue-i18n';

const { project } = defineProps<{
    project: Project;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: trans('Projects'),
        href: route('project.index'),
    },
    {
        title: project.title,
        href: route('project.show', { project: project.id }),
    },
    {
        title: trans('Edit project'),
        href: route('project.edit', { project: project.id }),
    },
];
</script>
<template>
    <Head title="Edit project" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">Edit project</div>
    </AppLayout>
</template>
