<script setup>
import { Head, Link } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import IremboLayout from '@/Layouts/IremboLayout.vue';


</script>

<template>
    <IremboLayout>

        <Head title="Irembo Mutuelle" />

        <div class="box overflow-hidden terms-box">
            <div class="box-body !p-0">
                <div class="p-2 terms-heading-cover flex items-center text-white bg-primary h5 font-semibold mb-0">
                    <span class="avatar avatar-md me-4">
                        <img :src="$page.props.asset_url + '/assets/images/irembo.png'" alt="">
                    </span>
                    <span>Community Based Health Insurance (Mutuelle) </span>

                </div>

                <div class="sm:p-4 p-2">
                    <div class="alert custom-alert1 !bg-white dark:!bg-bodybg" id="dismiss-alert69">

                        <div class="text-center px-[3rem] pb-0">
                            <svg class="custom-alert-icon svg-primary inline-flex" xmlns="http://www.w3.org/2000/svg"
                                height="1.5rem" viewBox="0 0 24 24" width="1.5rem" fill="#000000">
                                <path d="M0 0h24v24H0z" fill="none"></path>
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z">
                                </path>
                            </svg>
                            <h5 class="text-[1.25rem] !font-medium">Payment Prompt will be expired in 5 five minutes?</h5>
                            <p class="">Check <strong>*182*7*1*PIN</strong> if you don't have see push prompt in your phone number </p>
                            <div class="">

                                <Link :href="route('irembo.mutuelle')"
                                    class="ti-btn !py-1 !px-2 !text-[0.75rem] !font-medium bg-primary text-white m-1">
                                Back Home</Link>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </IremboLayout>
</template>
