<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
const props = defineProps({
    family: Object,
    family_members: Object,
});
const item = props.family.data;
const isCardTaped = ref(false);

const cardNumber = ref('');
const selectedId = ref('');
const selectedType = ref('');
const selectedName = ref('');

Echo.channel("read-card").listen("ReadCardNumber", (e) => {
    cardNumber.value = e.cardNumber;
    isCardTaped.value = true;
});

const modelTriggle = (type, person) => {

    selectedType.value = type;
    selectedId.value = person.id;
    selectedName.value = person.first_name + " " + person.last_name;

};

const submit = () => {
    Inertia.post(route('saveCardNumber'),
        {
            person_id: selectedId.value,
            type: selectedType.value,
            cardNumber: cardNumber.value,
        }
    );
};


</script>

<template>
    <AuthenticatedLayout>

        <Head title="Family" />
        <div class="main-content max-w-6xl mx-auto sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="block justify-between page-header md:flex"></div>
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
                                    <button data-hs-overlay="#add-card-model" @click="modelTriggle('header', item)"
                                        class="ti-btn ti-btn-ghost-primary ti-btn-wave">Add card</button>

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

                            <div class="box-footer">
                                <div class="flex items-center justify-between gap-2 flex-wrap">
                                    <div>
                                        <span class="block text-[#8c9097] dark:text-white/50 text-[0.75rem]">Pay
                                            Status</span>
                                        <span v-if="item.payment"
                                            class="block text-[1rem] p-2 font-semibold dark:text-defaulttextcolor/70"><span
                                                class="badge bg-success text-white">Payed </span></span>
                                        <span v-else
                                            class="block text-[1rem] p-2 font-semibold dark:text-defaulttextcolor/70"><span
                                                class="badge bg-danger text-white">Not Payed </span></span>
                                    </div>
                                    <div>
                                        <span class="block text-[#8c9097] dark:text-white/50 text-[0.75rem]">Last pay
                                            date</span>
                                        <span v-if="item.payment"
                                            class="block text-[.875rem] font-semibold dark:text-defaulttextcolor/70">{{ new
                                                Date(item.payment.created_at).toLocaleDateString('en-US', {
                                                    month: 'short', day:
                                                        '2-digit', year: 'numeric'
                                                }) }}</span>
                                        <span v-else
                                            class="block text-[.875rem] font-semibold dark:text-defaulttextcolor/70">Date not available</span>
                                    </div>
                                    <div class="task-details-progress">
                                        <span class="block text-[#8c9097] dark:text-white/50 text-[0.75rem] mb-1">Mutual
                                            year</span>
                                        <span v-if="item.payment"
                                            class="block text-[.875rem] font-semibold dark:text-defaulttextcolor/70">{{ item.payment.year }}</span>
                                        <span v-else
                                            class="block text-[.875rem] font-semibold dark:text-defaulttextcolor/70">2023 - 2024</span>
                                    </div>
                                    <div>
                                        <span class="block text-[#8c9097] dark:text-white/50 text-[0.75rem]">Amount
                                            Paid</span>
                                        <span v-if="item.payment"
                                            class="block text-[.875rem]  dark:text-defaulttextcolor/70 font-semibold">{{ item.payment.amount.toLocaleString() }}
                                            Rfw</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box">
                            <div class="box-header justify-between">
                                <div class="box-title">
                                    All Family Members
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
                                                            <span
                                                                class="badge bg-info/10 text-info rounded-full me-2">{{
                                                                    item.gender }}</span>
                                                            <span class="font-semibold">Age : </span>
                                                            <span
                                                                class="text-[0.75rem] opacity-[0.7] mb-1 text-[#8c9097] dark:text-white/50">{{
                                                                    item.age }}</span>
                                                        </p>
                                                        <button data-hs-overlay="#add-card-model"
                                                            @click="modelTriggle('member', item)"
                                                            class="ti-btn ti-btn-ghost-primary ti-btn-wave mt-2 mb-0">
                                                            Add card</button>

                                                        <!-- <p class="mt-3">
                                                            <span class="badge bg-info/10 text-info rounded-full">{{ item.gender }}</span>

                                                        </p> -->
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


        </div>

        <div id="add-card-model" class="hs-overlay hidden ti-modal">
            <div class="hs-overlay-open:mt-5 ti-modal-box mt-0 ease-out min-h-[calc(100%-3.5rem)] flex items-center">
                <div class="ti-modal-content">
                    <div class="ti-modal-header">
                        <h6 class="modal-title" id="staticBackdropLabel2">Add Card to {{ selectedName }}
                        </h6>
                        <button type="button" class="hs-dropdown-toggle ti-modal-close-btn"
                            data-hs-overlay="#add-card-model">
                            <span class="sr-only">Close</span>
                            <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z"
                                    fill="currentColor" />
                            </svg>
                        </button>
                    </div>
                    <div class="ti-modal-body mb-5">
                        <div v-if="!isCardTaped">
                            <h5 class="text-[1.25rem] !font-medium text-center mt-4">Tap card to continue </h5>

                            <div class="space-x-6 space-y-4 rtl:space-x-reverse">

                                <div class="ti-spinner !animate-ping !border-transparent  bg-gray-400" role="status"
                                    aria-label="loading">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <div class="ti-spinner !animate-ping !border-transparent  bg-black/20 dark:!bg-light dark:animate-ping "
                                    role="status" aria-label="loading">
                                    <span class="sr-only">Loading...</span>
                                </div>

                                <div class="ti-spinner !animate-ping !border-transparent  bg-gray-400" role="status"
                                    aria-label="loading">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <div class="ti-spinner !animate-ping !border-transparent  bg-black/20 dark:!bg-light dark:animate-ping "
                                    role="status" aria-label="loading">
                                    <span class="sr-only">Loading...</span>
                                </div>

                                <div class="ti-spinner !animate-ping !border-transparent  bg-gray-400" role="status"
                                    aria-label="loading">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <div class="ti-spinner !animate-ping !border-transparent  bg-black/20 dark:!bg-light dark:animate-ping "
                                    role="status" aria-label="loading">
                                    <span class="sr-only">Loading...</span>
                                </div>

                                <div class="ti-spinner !animate-ping !border-transparent  bg-gray-400" role="status"
                                    aria-label="loading">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <div class="ti-spinner !animate-ping !border-transparent  bg-black/20 dark:!bg-light dark:animate-ping "
                                    role="status" aria-label="loading">
                                    <span class="sr-only">Loading...</span>
                                </div>

                                <div class="ti-spinner !animate-ping !border-transparent  bg-gray-400" role="status"
                                    aria-label="loading">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <div class="ti-spinner !animate-ping !border-transparent  bg-black/20 dark:!bg-light dark:animate-ping "
                                    role="status" aria-label="loading">
                                    <span class="sr-only">Loading...</span>
                                </div>


                            </div>
                        </div>

                        <div v-if="isCardTaped" class="alert custom-alert1" id="dismiss-alert70">

                            <div class="text-center px-3 pb-0">
                                <svg class="custom-alert-icon fill-secondary inline-flex"
                                    xmlns="http://www.w3.org/2000/svg" height="1.0rem" viewBox="0 0 24 24"
                                    width="1.0rem" fill="#000000">
                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                    <path
                                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z">
                                    </path>
                                </svg>
                                <h5 class="text-[1.25rem] !font-medium">Card found</h5>
                                <p>You are about registering card <strong>{{ cardNumber }}</strong> to {{ selectedName
                                    }}.
                                </p>
                                <div class="mt-0">
                                    <button type="button" @click="submit"
                                        class="ti-btn !py-1 !px-2 !text-[0.75rem] !font-medium bg-secondary text-white m-1">Register</button>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
