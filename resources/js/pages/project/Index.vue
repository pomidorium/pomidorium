<script setup lang="ts">
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem, Paginated, Project } from '@/types';
import { Head, Link, router } from '@inertiajs/vue3';
import { trans } from 'laravel-vue-i18n';

import { Button } from '@/components/ui/button';

import { Input } from '@/components/ui/input';

import { ChevronLeft, ChevronRight, Files, Grid2X2Plus, ListFilter, RotateCw, Search } from 'lucide-vue-next';

import DeleteProjectDialog from '@/components/DeleteProjectDialog.vue';

import { Card, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';

import { Pagination, PaginationContent, PaginationEllipsis, PaginationItem, PaginationNext, PaginationPrevious } from '@/components/ui/pagination';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: trans('Projects'),
        href: route('project.index'),
    },
];

interface Props {
    project: Paginated<Project>;
}

const { project } = defineProps<Props>();

function updatePage(page: number) {
    router.visit(route('project.index'), {
        method: 'get',
        data: {
            page,
        },
    });
}
</script>

<template>
    <Head :title="$t('List of projects')" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-row items-center justify-between gap-4 border-b p-4">
            <div class="flex gap-2">
                <div class="relative w-full max-w-sm items-center">
                    <Input id="search" type="text" :placeholder="$t('Search...')" class="pl-10" />

                    <span class="absolute inset-y-0 start-0 flex items-center justify-center px-2">
                        <Search class="text-muted-foreground size-6" />
                    </span>
                </div>

                <Link :href="route('project.create')">
                    <Button>
                        <RotateCw />
                    </Button>
                </Link>

                <Link :href="route('project.create')">
                    <Button>
                        <Grid2X2Plus />
                    </Button>
                </Link>

                <Link :href="route('project.create')">
                    <Button>
                        <Files />
                    </Button>
                </Link>

                <DeleteProjectDialog />

                <Link :href="route('project.create')">
                    <Button>
                        <ListFilter />
                    </Button>
                </Link>
            </div>
        </div>
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <template v-if="project.total && project.total > 0">
                <Card v-for="item in project.data" :key="item.id">
                    <CardHeader>
                        <CardTitle>
                            <Link :href="route('project.show', { project: item.id })">{{ item.title }}</Link>
                        </CardTitle>
                        <CardDescription>{{ item.description }}</CardDescription>
                    </CardHeader>
                </Card>

                <Pagination
                    v-slot="{ page }"
                    @update:page="updatePage"
                    :items-per-page="project.per_page"
                    :total="project.total"
                    :default-page="project.current_page"
                >
                    <PaginationContent v-slot="{ items }">
                        <PaginationPrevious>
                            <ChevronLeft />
                        </PaginationPrevious>

                        <template v-for="(item, index) in items" :key="index">
                            <PaginationItem v-if="item.type === 'page'" :value="item.value" :is-active="item.value === page">
                                {{ item.value }}
                            </PaginationItem>
                        </template>

                        <PaginationEllipsis :index="4" />

                        <PaginationNext>
                            <ChevronRight />
                        </PaginationNext>
                    </PaginationContent>
                </Pagination>
            </template>
            <template v-else>
                <Alert>
                    <AlertTitle>No projects found.</AlertTitle>
                    <AlertDescription> You can create a new project by clicking the button below. </AlertDescription>
                </Alert>
            </template>
        </div>
    </AppLayout>
</template>
