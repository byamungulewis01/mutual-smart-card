<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
defineProps({
    cards: Object,
    numbers: Object,
});
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="main-content max-w-6xl mx-auto sm:px-6 lg:px-8">

            <!-- Start::page-header -->
            <div class="md:flex block items-center justify-between my-[1.5rem] page-header-breadcrumb">
                <div>
                    <p class="font-semibold text-[1.125rem] text-defaulttextcolor dark:text-defaulttextcolor/70 !mb-0 ">
                        Welcome back, {{ $page.props.auth.user.name }} !</p>
                    <p class="font-normal text-[#8c9097] dark:text-white/50 text-[0.813rem]">There is the latest update
                        for the last 7 days. chech now</p>
                </div>

            </div>
            <!-- End::page-header -->
            <div class="grid grid-cols-12 gap-x-6">

                <div class="xxl:col-span-12  xl:col-span-12  col-span-12">
                    <div class="grid grid-cols-12 gap-x-6">
                        <div class="xl:col-span-4 col-span-6">
                            <div class="box overflow-hidden">
                                <div class="box-body">
                                    <div class="flex items-top justify-between">
                                        <div>
                                            <span
                                                class="!text-[0.8rem]  !w-[2.5rem] !h-[2.5rem] !leading-[2.5rem] !rounded-full inline-flex items-center justify-center bg-primary">
                                                <i class="ti ti-users text-[1rem] text-white"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow ms-4">
                                            <div class="flex items-center justify-between flex-wrap">
                                                <div>
                                                    <p class="text-[#8c9097] dark:text-white/50 text-[0.813rem] mb-0">
                                                        Total Staff</p>
                                                    <h4 class="font-semibold  text-[1.5rem] !mb-2 ">{{ numbers.users }}</h4>
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-between !mt-1">
                                                <div>
                                                    <Link :href="route('users.index')" class="text-primary text-[0.813rem]">View All<i
                                                            class="ti ti-arrow-narrow-right ms-2 font-semibold inline-block"></i></Link>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="xl:col-span-4 col-span-6">
                            <div class="box overflow-hidden">
                                <div class="box-body">
                                    <div class="flex items-top justify-between">
                                        <div>
                                            <span
                                                class="!text-[0.8rem]  !w-[2.5rem] !h-[2.5rem] !leading-[2.5rem] !rounded-full inline-flex items-center justify-center bg-secondary">
                                                <i class="ti ti-wallet text-[1rem] text-white"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow ms-4">
                                            <div class="flex items-center justify-between flex-wrap">
                                                <div>
                                                    <p class="text-[#8c9097] dark:text-white/50 text-[0.813rem] mb-0">
                                                        Total Cards</p>
                                                    <h4 class="font-semibold text-[1.5rem] !mb-2 ">{{ numbers.cards }}</h4>
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-between mt-1">
                                                <div>
                                                    <Link class="text-secondary text-[0.813rem]"
                                                        :href="route('cards.index')">View All<i
                                                            class="ti ti-arrow-narrow-right ms-2 font-semibold inline-block"></i></Link>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="xl:col-span-4 col-span-6">
                            <div class="box overflow-hidden">
                                <div class="box-body">
                                    <div class="flex items-top justify-between">
                                        <div>
                                            <span
                                                class="!text-[0.8rem]  !w-[2.5rem] !h-[2.5rem] !leading-[2.5rem] !rounded-full inline-flex items-center justify-center bg-success">
                                                <i class="ti ti-wave-square text-[1rem] text-white"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow ms-4">
                                            <div class="flex items-center justify-between flex-wrap">
                                                <div>
                                                    <p class="text-[#8c9097] dark:text-white/50 text-[0.813rem] mb-0">
                                                        Total Admissions</p>
                                                    <h4 class="font-semibold text-[1.5rem] !mb-2 ">{{ numbers.admissions }}</h4>
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-between mt-1">
                                                <div>
                                                    <a class="text-success text-[0.813rem]"
                                                        href="javascript:void(0);">View All<i
                                                            class="ti ti-arrow-narrow-right ms-2 font-semibold inline-block"></i></a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="xl:col-span-12 col-span-12">
                            <div class="box custom-card">
                                <div class="box-header justify-between">
                                    <div class="box-title">
                                        Patients with card
                                    </div>

                                </div>
                                <div class="box-body">
                                    <div class="overflow-x-auto">
                                        <table class="table min-w-full whitespace-nowrap table-hover border table-bordered">
                                    <thead>
                                        <tr class="border border-inherit border-solid dark:border-defaultborder/10">
                                            <th scope="row" class="!ps-4 !pe-5">#</th>
                                            <th scope="col" class="!text-start !text-[0.85rem] min-w-[200px]">Patient
                                            </th>
                                            <th scope="col" class="!text-start !text-[0.85rem]">Card Number</th>
                                            <th scope="col" class="!text-start !text-[0.85rem]">Phone Number</th>
                                            <th scope="col" class="!text-start !text-[0.85rem]">Status</th>
                                            <th scope="col" class="!text-start !text-[0.85rem]">Recieved Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(card, index) in cards.data" :key="index"
                                            class="border border-inherit border-solid hover:bg-gray-100 dark:border-defaultborder/10 dark:hover:bg-light">
                                            <td class="!ps-6">{{ index + 1 }}</td>
                                            <td>
                                                <div class="flex items-center font-semibold">
                                                    <span class="!me-2 inline-flex justify-center items-center">
                                                        <img :src="$page.props.asset_url + '/storage/' + card.image" alt="img"
                                                            class="w-[1.75rem] h-[1.75rem] leading-[1.75rem] text-[0.65rem]  rounded-full">
                                                    </span>{{ card.first_name }} {{ card.last_name }}
                                                </div>
                                            </td>
                                            <td>{{ card.card_number }}</td>
                                            <td>{{ card.phone }}</td>
                                            <td>
                                                <span v-if="card.status"
                                                    class="inline-flex text-warning !py-[0.15rem] !px-[0.45rem] rounded-sm !font-semibold !text-[0.75em] bg-warning/10">Disabled </span>
                                                <span v-else
                                                    class="inline-flex text-info !py-[0.15rem] !px-[0.45rem] rounded-sm !font-semibold !text-[0.75em] bg-info/10">Active </span>
                                            </td>
                                            <td>{{ card.created_at }}</td>

                                        </tr>
                                    </tbody>
                                </table>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </AuthenticatedLayout>
</template>
