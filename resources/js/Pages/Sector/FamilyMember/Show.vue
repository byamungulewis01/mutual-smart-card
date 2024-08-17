<script setup>
import SectorLayout from '@/Layouts/SectorLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});


</script>

<template>
    <SectorLayout>

        <Head title="Family" />
        <div class="main-content max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="block justify-between page-header md:flex">
                <div>
                    <h3
                        class="!text-defaulttextcolor dark:!text-defaulttextcolor/70 dark:text-white dark:hover:text-white text-[1.125rem] font-semibold">
                        Family Header</h3>
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
                        Family Header
                    </li>
                </ol>
            </div>
            <!-- Page Header Close -->

            <!-- Start::row-1 -->
            <div class="grid grid-cols-12 gap-x-6">
                <div class="xl:col-span-4 col-span-12">
                    <div class="box overflow-hidden">
                        <div class="box-body !p-0">
                            <div class="sm:flex items-center p-5 border-b dark:border-defaultborder/10 border-dashed">
                                <div>
                                    <span class="avatar avatar-xl avatar-rounded me-4">
                                        <img src="/assets/images/faces/9.jpg" alt="">
                                    </span>
                                </div>
                                <div class="flex-grow main-profile-info">
                                    <div class="flex items-center !justify-between">
                                        <h6 class="font-semibold mb-1 text-black text-[1rem]">Json Taylor</h6>

                                    </div>
                                    <p class="mb-1 !text-black  opacity-[0.7]"> <strong> </strong>1199227733464466
                                    </p>
                                    <!-- <p class="text-[0.75rem] text-black mb-6 opacity-[0.5]">
                                        <span class="me-4 inline-flex"><i
                                                class="ri-building-line me-1 align-middle"></i>Male</span>

                                    </p> -->

                                </div>
                            </div>

                            <div class="p-5 border-b border-dashed dark:border-defaultborder/10">
                                <p class="text-[.9375rem] mb-2 me-6 font-semibold">Details Information :</p>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <div class="flex flex-wrap items-center">
                                            <div class="me-2 font-semibold">
                                                Gender:
                                            </div>
                                            <span class="text-[0.75rem] text-[#8c9097] dark:text-white/50">Male</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="flex flex-wrap items-center">
                                            <div class="me-2 font-semibold">
                                                Category :
                                            </div>
                                            <span class="text-[0.75rem] text-[#8c9097] dark:text-white/50">A</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="flex flex-wrap items-center">
                                            <div class="me-2 font-semibold">
                                                Phone :
                                            </div>
                                            <span class="text-[0.75rem] text-[#8c9097] dark:text-white/50">+(555)
                                                555-1234</span>
                                        </div>
                                    </li>

                                    <li class="list-group-item">
                                        <div class="flex flex-wrap items-center">
                                            <div class="me-2 font-semibold">
                                                Age :
                                            </div>
                                            <span class="text-[0.75rem] text-[#8c9097] dark:text-white/50">28</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="flex flex-wrap items-center">
                                            <div class="me-2 font-semibold">
                                                Date of Birth :
                                            </div>
                                            <span class="text-[0.75rem] text-[#8c9097] dark:text-white/50">Nov 12,
                                                2020</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="flex flex-wrap items-center">
                                            <div class="me-2 font-semibold">
                                                District :
                                            </div>
                                            <span class="text-[0.75rem] text-[#8c9097] dark:text-white/50">Rubavu</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="flex flex-wrap items-center">
                                            <div class="me-2 font-semibold">
                                                Sector :
                                            </div>
                                            <span
                                                class="text-[0.75rem] text-[#8c9097] dark:text-white/50">Gisenyi</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="flex flex-wrap items-center">
                                            <div class="me-2 font-semibold">
                                                Cell :
                                            </div>
                                            <span class="text-[0.75rem] text-[#8c9097] dark:text-white/50">Kivumu</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="flex flex-wrap items-center">
                                            <div class="me-2 font-semibold">
                                                Village :
                                            </div>
                                            <span
                                                class="text-[0.75rem] text-[#8c9097] dark:text-white/50">Umutekano</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="xl:col-span-8 col-span-12">
                    <div class="xl:col-span-12 col-span-12">
                        <div class="box">
                            <div class="box-header justify-between">
                                <div class="box-title">
                                    All Family Members
                                </div>
                                <div class="flex flex-wrap gap-2">

                                    <Link :href="route('sector.families.create')"
                                        class="ti-btn ti-btn-primary-full !py-1 !px-2 !text-[0.75rem]">
                                    <i class="ri-add-line  align-middle"></i>New member
                                    </Link>

                                </div>
                            </div>
                            <div class="box-body !p-0">
                                <div class="grid grid-cols-12 sm:gap-x-6 m-5">

                                    <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 col-span-12">
                                        <div class="box !shadow-none border dark:border-defaultborder/10">
                                            <div class="box-body p-6">
                                                <div class="text-center">
                                                    <span class="avatar avatar-xl avatar-rounded">
                                                        <img src="/assets/images/faces/2.jpg" alt="">
                                                    </span>
                                                    <div class="mt-2">
                                                        <p class="mb-0 font-semibold">Samantha May</p>

                                                        <p>
                                                            <span class="font-semibold">ID : </span>
                                                            <span
                                                                class="text-[0.75rem] opacity-[0.7] mb-1 text-[#8c9097] dark:text-white/50">119992888883338838</span>
                                                        </p>

                                                        <p>
                                                            <span class="font-semibold">Age : </span>
                                                            <span
                                                                class="text-[0.75rem] opacity-[0.7] mb-1 text-[#8c9097] dark:text-white/50">12</span>
                                                        </p>
                                                        <p class="mt-3">
                                                            <span class="badge bg-info/10 text-info rounded-full">
                                                                Male</span>

                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-footer text-center">
                                                <div class="btn-list">
                                                    <button type="button"
                                                        class="ti-btn btn-sm !py-1 !px-2 !text-[0.75rem] me-1 ti-btn-light">Edit</button>
                                                    <button type="button"
                                                        class="ti-btn btn-sm !py-1 !px-2 !text-[0.75rem] text-white bg-danger">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 col-span-12">
                                        <div class="box !shadow-none border dark:border-defaultborder/10">
                                            <div class="box-body p-6">
                                                <div class="text-center">
                                                    <span class="avatar avatar-xl avatar-rounded">
                                                        <img src="/assets/images/faces/15.jpg" alt="">
                                                    </span>
                                                    <div class="mt-2">
                                                        <p class="mb-0 font-semibold">Andrew Garfield</p>

                                                        <p>
                                                            <span class="font-semibold">ID : </span>
                                                            <span
                                                                class="text-[0.75rem] opacity-[0.7] mb-1 text-[#8c9097] dark:text-white/50">119992888883338838</span>
                                                        </p>

                                                        <p>
                                                            <span class="font-semibold">Age : </span>
                                                            <span
                                                                class="text-[0.75rem] opacity-[0.7] mb-1 text-[#8c9097] dark:text-white/50">32</span>
                                                        </p>
                                                        <p class="mt-3">
                                                            <span class="badge bg-info/10 text-info rounded-full">
                                                                Female</span>

                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-footer text-center">
                                                <div class="btn-list">
                                                    <button type="button"
                                                        class="ti-btn btn-sm !py-1 !px-2 !text-[0.75rem] me-1 ti-btn-light">Edit</button>
                                                    <button type="button"
                                                        class="ti-btn btn-sm !py-1 !px-2 !text-[0.75rem] text-white bg-danger">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 col-span-12">
                                        <div class="box !shadow-none border dark:border-defaultborder/10">
                                            <div class="box-body p-6">
                                                <div class="text-center">
                                                    <span class="avatar avatar-xl avatar-rounded">
                                                        <img src="/assets/images/faces/5.jpg" alt="">
                                                    </span>
                                                    <div class="mt-2">
                                                        <p class="mb-0 font-semibold">Jessica Cashew</p>

                                                        <p>
                                                            <span class="font-semibold">ID : </span>
                                                            <span
                                                                class="text-[0.75rem] opacity-[0.7] mb-1 text-[#8c9097] dark:text-white/50">119992888883338838</span>
                                                        </p>

                                                        <p>
                                                            <span class="font-semibold">Age : </span>
                                                            <span
                                                                class="text-[0.75rem] opacity-[0.7] mb-1 text-[#8c9097] dark:text-white/50">20</span>
                                                        </p>
                                                        <p class="mt-3">
                                                            <span class="badge bg-info/10 text-info rounded-full">
                                                                Male</span>

                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-footer text-center">
                                                <div class="btn-list">
                                                    <button type="button"
                                                        class="ti-btn btn-sm !py-1 !px-2 !text-[0.75rem] me-1 ti-btn-light">Edit</button>
                                                    <button type="button"
                                                        class="ti-btn btn-sm !py-1 !px-2 !text-[0.75rem] text-white bg-danger">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </SectorLayout>
</template>
