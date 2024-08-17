<script setup>
import { ref } from 'vue';
import SectorLayout from '@/Layouts/SectorLayout.vue';
import TablePagination from '@/Components/TablePagination.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    families: {
        type: Object,
    },

});

const selectedId = ref(null);

const deleteFamily = (family_id) => {
    selectedId.value = family_id;
};
const destroyFamily = (family_id) => {
    // Assuming selectedContract contains the data of the user being updated
    const form = useForm({});
    form.delete(route('sector.families.destroy', family_id), {
        onSuccess: () => {
            const closeButton = document.querySelector('.ti-btn[data-hs-overlay="#deleteModel"]');
            if (closeButton) {
                closeButton.click();
            }
        },
        onError: (errors) => {
            console.log('error', errors);
            // Handle error responses or validation errors
        },
    });
};


</script>

<template>
    <SectorLayout>

        <Head title="Families" />
        <div class="main-content max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="block justify-between page-header md:flex">
                <div>
                    <h3
                        class="!text-defaulttextcolor dark:!text-defaulttextcolor/70 dark:text-white dark:hover:text-white text-[1.125rem] font-semibold">
                        Family Headers</h3>
                </div>
                <ol class="flex items-center whitespace-nowrap min-w-0">
                    <li class="text-[0.813rem] ps-[0.5rem]">
                        <a class="flex items-center text-primary hover:text-primary dark:text-primary truncate"
                            href="javascript:void(0);">
                            Family
                            <i
                                class="ti ti-chevrons-right flex-shrink-0 text-[#8c9097] dark:text-white/50 px-[0.5rem] overflow-visible rtl:rotate-180"></i>
                        </a>
                    </li>
                    <li class="text-[0.813rem] text-defaulttextcolor font-semibold hover:text-primary dark:text-[#8c9097] dark:text-white/50 "
                        aria-current="page">
                        Family Headers
                    </li>
                </ol>
            </div>
            <!-- Page Header Close -->

            <!-- Start::row-1 -->
            <div class="grid grid-cols-12">
                <div class="xl:col-span-12 col-span-12">
                    <div class="box  overflow-hidden">
                        <div class="box-header justify-between">
                            <div class="box-title">
                                All Family Headers
                            </div>
                            <div class="flex flex-wrap gap-2">
                                <div>
                                    <input class="form-control form-control-sm" type="text" placeholder="Search Here"
                                        aria-label=".form-control-sm example">
                                </div>
                                <Link :href="route('sector.families.create')"
                                    class="ti-btn ti-btn-primary-full !py-1 !px-2 !text-[0.75rem]">
                                <i class="ri-add-line  align-middle"></i>New family
                                </Link>

                            </div>
                        </div>
                        <div class="box-body !p-0">
                            <div class="table-responsive">

                                <table class="table table-hover whitespace-nowrap min-w-full">
                                    <thead>
                                        <tr>
                                            <th scope="row" class="!ps-6">#</th>
                                            <th scope="col" class="text-start">Names</th>
                                            <th scope="col" class="text-start">Gender</th>
                                            <th scope="col" class="text-start">National ID</th>
                                            <th scope="col" class="text-start">Date of Birth</th>
                                            <th scope="col" class="text-start">Members</th>
                                            <th scope="col" class="text-start">Category</th>
                                            <th scope="col" class="text-start">District</th>
                                            <th scope="col" class="text-start">Sector</th>
                                            <th scope="col" class="text-start">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="border-t hover:bg-gray-200 dark:hover:bg-light"
                                            v-for="(item, index) in families.data" :key="index">
                                            <td class="!ps-6"> {{ (families.meta.current_page - 1) *
                                                families.meta.per_page + index + 1 }}</td>
                                            <td>
                                                <div class="flex items-center">
                                                    <span class="avatar avatar-xs me-2 avatar-rounded">
                                                        <img :src="$page.props.asset_url + '/storage/' + item.image"
                                                            alt="img">
                                                    </span>{{ item.first_name }} {{ item.last_name }}
                                                </div>
                                            </td>


                                            <td><strong>{{ item.gender }}</strong></td>
                                            <td>{{ item.national_id }}</td>
                                            <td><span class="badge bg-black/10 text-black"><i
                                                        class="bi bi-clock me-1"></i>{{ item.dateOfBirth }}</span></td>

                                            <td>{{ item.members }}</td>
                                            <td>{{ item.category }}</td>
                                            <td>{{ item.district }}</td>
                                            <td>{{ item.sector }}</td>
                                            <td>
                                                <Link :href="route('sector.families.show', item.id)"
                                                    class="ti-btn ti-btn-icon ti-btn-sm ti-btn-primary me-2">
                                                <i class="ri-eye-line"></i>
                                                </Link>
                                                <Link :href="route('sector.families.edit', item.id)"
                                                    class="ti-btn ti-btn-icon ti-btn-sm ti-btn-info me-2">
                                                <i class="ri-edit-line"></i>
                                                </Link>
                                                <a @click="deleteFamily(item.id)" aria-label="anchor"
                                                    data-hs-overlay="#deleteModel" href="javascript:void(0);"
                                                    class="ti-btn ti-btn-icon ti-btn-sm ti-btn-danger">
                                                    <i class="ri-delete-bin-line"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <TablePagination :links="families.meta" />
                    </div>
                </div>
            </div>
            <!--End::row-1 -->

        </div>

        <div id="deleteModel" class="hs-overlay hidden ti-modal">
            <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out min-h-[calc(100%-3.5rem)] flex items-center">
                <div class="ti-modal-content w-full">

                    <div class="ti-modal-body text-center">
                        <form @submit.prevent="destroyFamily(selectedId)">
                            <div class="text-center px-5 pb-0">
                                <svg class="custom-alert-icon fill-warning inline-flex"
                                    xmlns="http://www.w3.org/2000/svg" height="5rem" viewBox="0 0 24 24" width="5rem"
                                    fill="#000000">
                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z">
                                    </path>
                                </svg>
                                <h4 class="text-[1.85rem] !font-medium">Are you sure to remove?</h4>
                                <p class="text-muted">This alert is warn you that action cannot be
                                    undone.
                                </p>
                                <div class="mt-4">
                                    <button type="button" data-hs-overlay="#deleteModel"
                                        class="ti-btn !py-2 !px-3 !text-[0.75rem] !font-medium ti-btn-outline-secondary m-1">Back</button>

                                    <button
                                        class="ti-btn !py-2 !px-3 !text-[0.75rem] !font-medium ti-btn-outline-warning m-1">Continue</button>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>


    </SectorLayout>
</template>
