<script setup>
import TablePagination from '@/Components/TablePagination.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router, Link } from '@inertiajs/vue3';
import { debounce } from 'lodash';
import { ref, watch } from 'vue';

const props = defineProps({
    families: Object,
    family_number: String,
});

const family_number = ref(props.family_number);

watch(
    family_number,
    debounce((q) => router.get(route('manualSearch'), { family_number: q }, { preserveState: true }), 500)
);

</script>

<template>
    <AuthenticatedLayout>

        <Head title="Manual Search" />
        <div class="main-content max-w-5xl mx-auto sm:px-6 lg:px-8">

            <!-- Start::row-1 -->
            <div class="grid grid-cols-12 gap-x-6">
                <div class="xl:col-span-12 col-span-12">
                    <div class="box mt-6">
                        <div class="box-body">
                            <div class="contact-header">
                                <div class="flex flex-row block items-center justify-start">
                                    <div class="h5 font-semibold mb-0 basis-1/2">Search Family</div>

                                    <div class="basis-1/2 flex sm:mt-0 mt-2 items-center">
                                        <div class="input-group">
                                            <input type="number" v-model="family_number"
                                                class="form-control !rounded-s-sm w-full !bg-light !border-0"
                                                placeholder="Search Family number"
                                                aria-describedby="search-family-member">
                                            <button aria-label="button" type="button"
                                                class="ti-btn ti-btn-light  !rounded-s-none !mb-0"
                                                id="search-family-member"><i
                                                    class="ri-search-line text-[#8c9097] dark:text-white/50"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div v-for="(item, index) in families.data" :key="index"
                    class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
                    <div class="box">
                        <div class="box-body contact-action">
                            <div class="contact-overlay"></div>
                            <div class="flex items-start ">
                                <div class="flex flex-grow flex-wrap gap-2">
                                    <div class="avatar avatar-xl avatar-rounded me-3">
                                        <img :src="$page.props.asset_url + '/storage/' + item.image" alt="">
                                    </div>
                                    <div>
                                        <h6 class=" mb-1 font-semibold text-[1rem]">
                                            {{ item.first_name }} {{ item.last_name }}
                                        </h6>
                                        <p class="mb-1 text-[#8c9097] dark:text-white/50 contact-mail text-truncate">
                                            {{ item.district }} - {{ item.sector }}</p>
                                        <p class="font-semibold text-[0.6875rem] mb-0 !text-primary">
                                            {{ item.national_id }}
                                        </p>
                                    </div>
                                </div>

                            </div>
                            <div class="flex items-center justify-center gap-2 contact-hover-buttons">
                                <Link :href="route('showFamily', item)" type="button"
                                    class="ti-btn btn-sm ti-btn-light contact-hover-btn !py-1 !px-2 !text-[0.75rem] !font-medium">
                                View Details
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <TablePagination v-if="families.meta.total > 10" :links="families.meta" />

        </div>

    </AuthenticatedLayout>
</template>
