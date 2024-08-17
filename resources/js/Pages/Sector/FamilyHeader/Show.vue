<script setup>
import SectorLayout from '@/Layouts/SectorLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    family: Object,
    family_members: Object,
});
const item = props.family.data;

const selectedId = ref(null);

const deleteMember = (member_id) => {
    selectedId.value = member_id;
};
const destroyMember = (member_id) => {
    // Assuming selectedContract contains the data of the user being updated
    const form = useForm({});
    form.delete(route('sector.family-members.destroy', member_id), {
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
                                        <img :src="$page.props.asset_url + '/storage/' + item.image" alt="">
                                    </span>
                                </div>
                                <div class="flex-grow main-profile-info">
                                    <div class="flex items-center !justify-between">
                                        <h6 class="font-semibold mb-1 text-black text-[1rem]">{{ item.first_name }} {{
                                            item.last_name }}</h6>

                                    </div>
                                    <p class="mb-1 !text-black  opacity-[0.7]"> {{ item.national_id }}
                                    </p>

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
                                            <span class="text-[0.75rem] text-[#8c9097] dark:text-white/50">{{
                                                item.gender }}</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="flex flex-wrap items-center">
                                            <div class="me-2 font-semibold">
                                                Category :
                                            </div>
                                            <span class="text-[0.75rem] text-[#8c9097] dark:text-white/50">{{
                                                item.category }}</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="flex flex-wrap items-center">
                                            <div class="me-2 font-semibold">
                                                Phone :
                                            </div>
                                            <span class="text-[0.75rem] text-[#8c9097] dark:text-white/50">{{ item.phone
                                                }}</span>
                                        </div>
                                    </li>

                                    <li class="list-group-item">
                                        <div class="flex flex-wrap items-center">
                                            <div class="me-2 font-semibold">
                                                Age :
                                            </div>
                                            <span class="text-[0.75rem] text-[#8c9097] dark:text-white/50">{{ item.age
                                                }}</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="flex flex-wrap items-center">
                                            <div class="me-2 font-semibold">
                                                Date of Birth :
                                            </div>
                                            <span class="text-[0.75rem] text-[#8c9097] dark:text-white/50">{{
                                                item.dateOfBirth }}</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="flex flex-wrap items-center">
                                            <div class="me-2 font-semibold">
                                                District :
                                            </div>
                                            <span class="text-[0.75rem] text-[#8c9097] dark:text-white/50">{{
                                                item.district }}</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="flex flex-wrap items-center">
                                            <div class="me-2 font-semibold">
                                                Sector :
                                            </div>
                                            <span class="text-[0.75rem] text-[#8c9097] dark:text-white/50">{{
                                                item.sector }}</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="flex flex-wrap items-center">
                                            <div class="me-2 font-semibold">
                                                Cell :
                                            </div>
                                            <span class="text-[0.75rem] text-[#8c9097] dark:text-white/50">{{ item.cell
                                                }}</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="flex flex-wrap items-center">
                                            <div class="me-2 font-semibold">
                                                Village :
                                            </div>
                                            <span class="text-[0.75rem] text-[#8c9097] dark:text-white/50">{{
                                                item.village }}</span>
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

                                    <Link :href="route('sector.family-members.create', { family: item.id })"
                                        class="ti-btn ti-btn-primary-full !py-1 !px-2 !text-[0.75rem]">
                                    <i class="ri-add-line  align-middle"></i>New member
                                    </Link>

                                </div>
                            </div>
                            <div class="box-body !p-0">
                                <div class="grid grid-cols-12 sm:gap-x-6 m-5">

                                    <div v-for="(item, index) in family_members.data" :key="index"
                                        class="xl:col-span-4 lg:col-span-6 md:col-span-6 col-span-12">
                                        <div class="box !shadow-none border dark:border-defaultborder/10">
                                            <div class="box-body p-6">
                                                <div class="text-center">
                                                    <span class="avatar avatar-xl avatar-rounded">
                                                        <img :src="$page.props.asset_url + '/storage/' + item.image"
                                                            alt="">
                                                    </span>
                                                    <div class="mt-2">
                                                        <p class="mb-0 font-semibold">{{ item.first_name }} {{
                                                            item.last_name }}</p>

                                                        <p>
                                                            <span class="font-semibold">ID : </span>
                                                            <span
                                                                class="text-[0.75rem] opacity-[0.7] mb-1 text-[#8c9097] dark:text-white/50">{{
                                                                item.national_id ?? 'not available' }}</span>
                                                        </p>

                                                        <p>
                                                            <span class="font-semibold">Age : </span>
                                                            <span
                                                                class="text-[0.75rem] opacity-[0.7] mb-1 text-[#8c9097] dark:text-white/50">{{
                                                                item.age }}</span>
                                                        </p>
                                                        <p class="mt-3">
                                                            <span class="badge bg-info/10 text-info rounded-full">{{
                                                                item.gender }}</span>

                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-footer text-center">
                                                <div class="btn-list">
                                                    <Link :href="route('sector.family-members.edit',item)"
                                                        class="ti-btn btn-sm !py-1 !px-2 !text-[0.75rem] me-1 ti-btn-light">Edit</Link>
                                                    <button type="button" @click="deleteMember(item.id)" aria-label="anchor"
                                                    data-hs-overlay="#deleteModel"
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
        <div id="deleteModel" class="hs-overlay hidden ti-modal">
            <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out min-h-[calc(100%-3.5rem)] flex items-center">
                <div class="ti-modal-content w-full">

                    <div class="ti-modal-body text-center">
                        <form @submit.prevent="destroyMember(selectedId)">
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
