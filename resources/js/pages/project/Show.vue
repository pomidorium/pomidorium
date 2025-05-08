<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem, Project } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import { trans } from 'laravel-vue-i18n';

import { SquarePen } from 'lucide-vue-next';

import { Button } from '@/components/ui/button';

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
];
</script>

<template>
    <Head title="Show project" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-row items-center justify-between gap-4 border-b p-4">
            <div>
                {{ project.title }}
            </div>
            <div>
                <Button>
                    <Link :href="route('project.edit', { project: project.id })">
                        <SquarePen />
                    </Link>
                </Button>
            </div>
        </div>
    </AppLayout>
</template>
