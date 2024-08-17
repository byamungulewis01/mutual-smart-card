<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    links: Object,
});
</script>

<template>
    <div class="box-footer border-t-0">
        <div class="flex items-center flex-wrap overflow-auto">
            <div class="mb-2 sm:mb-0">
                Showing <b>{{ links.from }}</b> to <b>{{ links.to }}</b> of <b>{{ links.total }}</b>
                entries
                <i class="bi bi-arrow-right ms-2 font-semibold"></i>
            </div>
            <div class="ms-auto">
                <nav aria-label="Page navigation">
                    <ul class="ti-pagination mb-0">
                        <!-- <li :class="['page-item', !links.prev ? 'disabled' : '']">
                            <Link :href="links.prev || 'javascript:void(0);'" class="page-link px-3 py-[0.375rem]">
                            Previous
                            </Link>
                        </li> -->
                        <li v-for="(link, index) in links.links" :key="index"
                            :class="['page-item', link.active ? 'active' : '']">
                            <Link v-if="link.url" :href="link.url" class="page-link px-3 py-[0.375rem]"
                                v-html="link.label">
                            </Link>
                            <span v-else class="page-link px-3 py-[0.375rem]" v-html="link.label"></span>
                        </li>
                        <!-- <li :class="['page-item', !links.next ? 'disabled' : '']">
                            <Link :href="links.next || 'javascript:void(0);'" class="page-link px-3 py-[0.375rem]">
                            Next
                            </Link>
                        </li> -->
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>
