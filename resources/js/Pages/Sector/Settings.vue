<script setup>
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SectorLayout from '@/Layouts/SectorLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    amount: '',
});
const submit = () => {
    form.post(route('sector.mutual-categories.store'),
        {
            onSuccess: () => {
                form.reset();
                const closeButton = document.querySelector('.hs-dropdown-toggle[data-hs-overlay="#addModel"]');
                if (closeButton) {
                    closeButton.click();
                }

            },
            onError: (errors) => {
                console.log('error', errors);
                // Handle error responses or validation errors
            },
        }
    );
};
defineProps({ categories: Object });
</script>

<template>
    <SectorLayout>

        <Head title="Settings" />
        <div class="main-content max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="block justify-between page-header md:flex">
                <div>
                    <h3
                        class="!text-defaulttextcolor dark:!text-defaulttextcolor/70 dark:text-white dark:hover:text-white text-[1.125rem] font-semibold">
                        Setting List</h3>
                </div>
                <ol class="flex items-center whitespace-nowrap min-w-0">
                    <li class="text-[0.813rem] ps-[0.5rem]">
                        <a class="flex items-center text-primary hover:text-primary dark:text-primary truncate"
                            href="javascript:void(0);">
                            Settings
                            <i
                                class="ti ti-chevrons-right flex-shrink-0 text-[#8c9097] dark:text-white/50 px-[0.5rem] overflow-visible rtl:rotate-180"></i>
                        </a>
                    </li>
                    <li class="text-[0.813rem] text-defaulttextcolor font-semibold hover:text-primary dark:text-[#8c9097] dark:text-white/50 "
                        aria-current="page">
                        Setting List
                    </li>
                </ol>
            </div>
            <!-- Page Header Close -->

            <!-- Start::row-1 -->
            <div class="grid grid-cols-12 gap-x-6">
                <div class="xl:col-span-5 col-span-12">
                    <div class="box overflow-hidden">
                        <div class="box-header justify-between">
                            <div class="box-title">
                                Mitual Categories
                            </div>

                            <button data-hs-overlay="#addModel"
                                class="ti-btn ti-btn-primary-full !py-1 !px-2 !text-[0.75rem]">
                                <i class="ri-add-line  align-middle"></i>New
                            </button>

                            <div id="addModel" class="hs-overlay hidden ti-modal">
                                <div
                                    class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out md:!max-w-sm md:w-full m-3 md:mx-auto">
                                    <div class="ti-modal-content">
                                        <div class="ti-modal-header">
                                            <h6 class="modal-title text-[1rem] font-semibold">New Category</h6>
                                            <button type="button"
                                                class="ti-btn !text-[1rem] !font-semibold !text-defaulttextcolor"
                                                data-hs-overlay="#addModel">
                                                <span class="sr-only">Close</span>
                                                <i class="ri-close-line"></i>
                                            </button>
                                        </div>
                                        <form @submit.prevent="submit">
                                            <div class="ti-modal-body">

                                                <div class="grid grid-cols-12 gap-4 px-3">

                                                    <div class="xl:col-span-12 col-span-12">
                                                        <label for="name" class="form-label">Name</label>
                                                        <input type="text" v-model="form.name"
                                                            class="form-control w-full !rounded-md" id="name"
                                                            placeholder="Category Name">
                                                        <InputError class="mt-2" :message="form.errors.name" />

                                                    </div>
                                                    <div class="xl:col-span-12 col-span-12">
                                                        <label for="amount" class="form-label">Amount</label>
                                                        <input type="number" v-model="form.amount"
                                                            class="form-control w-full !rounded-md" id="amount"
                                                            placeholder="Amount">
                                                        <InputError class="mt-2" :message="form.errors.amount" />

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ti-modal-footer">
                                                <button type="button"
                                                    class="hs-dropdown-toggle ti-btn  ti-btn-secondary-full align-middle"
                                                    data-hs-overlay="#addModel">
                                                    Close
                                                </button>
                                                <PrimaryButton :class="{ 'opacity-25': form.processing }"
                                                    :disabled="form.processing">Submit</PrimaryButton>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="box-body !p-0">
                            <div class="table-responsive">
                                <table class="table table-hover whitespace-nowrap min-w-full">
                                    <thead>
                                        <tr>
                                            <th scope="row" class="!ps-6">#</th>
                                            <th scope="col" class="text-start">Category</th>
                                            <th scope="col" class="text-start">Amount</th>
                                            <th scope="col" class="text-start">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in categories" :key="index" class="border-t hover:bg-gray-200 dark:hover:bg-light">
                                            <td class="!ps-6">1</td>
                                            <td>{{ item.name }}</td>
                                            <td>{{ item.amount.toLocaleString() }}</td>
                                            <td>
                                                <a aria-label="anchor" href="javascript:void(0);"
                                                    class="ti-btn ti-btn-icon ti-btn-sm ti-btn-info me-2">
                                                    <i class="ri-edit-line"></i>
                                                </a>
                                                <a aria-label="anchor" href="javascript:void(0);"
                                                    class="ti-btn ti-btn-icon ti-btn-sm ti-btn-danger">
                                                    <i class="ri-delete-bin-line"></i>
                                                </a>
                                            </td>

                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="xl:col-span-8 col-span-12">
                    <div class="xl:col-span-12 col-span-12">
                        <div class="box">

                        </div>
                    </div>
                </div>
            </div>


        </div>




    </SectorLayout>
</template>
