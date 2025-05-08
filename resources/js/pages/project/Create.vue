<script setup lang="ts">
import ProjectForm from '@/components/forms/ProjectForm.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem, Project } from '@/types';
import { Head } from '@inertiajs/vue3';
import { trans } from 'laravel-vue-i18n';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: trans('Projects'),
        href: route('project.index'),
    },
    {
        title: trans('Create new project'),
        href: route('project.create'),
    },
];

const { project = {} as Project } = defineProps<{
    project?: Project;
}>();
</script>
<template>
    <Head title="Create project" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <ProjectForm :project="project" />
        </div>
    </AppLayout>
</template>
