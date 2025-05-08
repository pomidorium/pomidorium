<script setup lang="ts">
import type { HTMLAttributes } from 'vue';

defineOptions({
    inheritAttrs: false,
});

interface Props {
    className?: HTMLAttributes['class'];
}

defineProps<Props>();
</script>

<template>
    <div :class="className" v-bind="$attrs">
        <div class="text-center font-bold">P</div>
    </div>
</template>
