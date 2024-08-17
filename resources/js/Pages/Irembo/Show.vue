<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import IremboLayout from '@/Layouts/IremboLayout.vue';

const props = defineProps({
    family: Object,
    amount: Number,
});
const family = props.family.data;

const form = useForm({
    national_id: family.national_id,
    family_id: family.id,
    amount: props.amount,
    phone: '',

});

const submit = () => {
    form.post(route('irembo.mutuelleChechout'),
        {
            onSuccess: () => {
                form.reset();
            },
            onError: (errors) => {
                console.log('error', errors);
                // Handle error responses or validation errors
            },
        }
    );
};

</script>

<template>
    <IremboLayout>

        <Head title="Irembo Mutuelle" />

        <form @submit.prevent="submit">
            <div class="box overflow-hidden terms-box">
                <div class="box-body !p-0">
                    <div class="p-2 terms-heading-cover flex items-center text-white bg-primary h5 font-semibold mb-0">
                        <span class="avatar avatar-md me-4">
                            <img :src="$page.props.asset_url + '/assets/images/irembo.png'" alt="">
                        </span>
                        <span>Community Based Health Insurance (Mutuelle) </span>

                    </div>

                    <div class="sm:p-4 p-2">
                        <div class="alert alert-warning flex items-center" role="alert">
                            <svg class="sm:flex-shrink-0 me-2 fill-warning" xmlns="http://www.w3.org/2000/svg"
                                enable-background="new 0 0 24 24" height="1.5rem" viewBox="0 0 24 24" width="1.5rem"
                                fill="#000000">
                                <g>
                                    <rect fill="none" height="24" width="24" />
                                </g>
                                <g>
                                    <g>
                                        <g>
                                            <path d="M12,5.99L19.53,19H4.47L12,5.99 M12,2L1,21h22L12,2L12,2z" />
                                            <polygon points="13,16 11,16 11,18 13,18" />
                                            <polygon points="13,10 11,10 11,15 13,15" />
                                        </g>
                                    </g>
                                </g>
                            </svg>
                            <div>
                                Insurance Period <strong>2024 - 2025 </strong>
                            </div>
                        </div>
                        <div class="sm:grid grid-cols-12 gap-4">
                            <div class="xl:col-span-6 col-span-12">
                                <label for="amount" class="form-label">Identification document number</label>
                                <input disabled type="text" v-model="form.national_id"
                                    class="form-control w-full !rounded-md" id="amount" placeholder="Enter national ID">
                            </div>
                            <div class="xl:col-span-6 col-span-12">
                                <label for="phone" class="form-label">Total amount to be paid</label>
                                <input disabled type="text" v-model="form.amount"
                                    class="form-control w-full !rounded-md" id="phone" placeholder="Total Amount">
                            </div>

                        </div>
                    </div>

                    <div class="p-5 dark:border-defaultborder/10">
                        <p class="text-[.9375rem] mb-2 me-6 font-semibold">Applicant Details :</p>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="flex flex-wrap justify-start gap-6">
                                    <div class="flex flex-wrap items-center">
                                        <div class="me-2 font-semibold">
                                            Full Name:
                                        </div>
                                        <span class="text-[0.75rem] text-[#8c9097] dark:text-white/50">{{
                                            family.first_name }} {{ family.last_name }}</span>
                                    </div>
                                    <div class="flex flex-wrap items-center">
                                        <div class="me-2 font-semibold">
                                            Notional ID:
                                        </div>
                                        <span class="text-[0.75rem] text-[#8c9097] dark:text-white/50">{{
                                            family.national_id }}</span>
                                    </div>

                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="flex flex-wrap justify-start gap-6">

                                    <div class="flex flex-wrap items-center">
                                        <div class="me-2 font-semibold">
                                            Address :
                                        </div>
                                        <span class="text-[0.75rem] text-[#8c9097] dark:text-white/50">{{
                                            family.district }} / {{ family.sector }}</span>
                                    </div>
                                </div>

                            </li>
                        </ul>
                    </div>
                    <div class="sm:p-4 p-2">

                        <div class="sm:grid grid-cols-12 gap-4">
                            <div class="xl:col-span-6 col-span-12">
                                <label for="amount" class="form-label">Phone Number</label>
                                <input type="text" v-model="form.phone" required class="form-control w-full !rounded-md"
                                    id="amount" placeholder="078xxxxxxx">
                                <InputError class="mt-1" :message="form.errors.phone" />

                            </div>
                        </div>

                    </div>


                </div>
                <div class="box-footer shadow-lg !border-t-0">
                    <button class="ti-btn ti-btn-danger-full float-end">Checkout</button>
                </div>

            </div>
        </form>


    </IremboLayout>
</template>
