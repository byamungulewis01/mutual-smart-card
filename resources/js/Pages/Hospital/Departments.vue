<script setup>
import PatientLayout from '@/Layouts/PatientLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/vue3';
const props = defineProps({ patient: Number })
// Function to initiate payment
const submit = (department) => {
    Inertia.post(route('consultanceSubmit'),
        {
            department: department,
            patient: props.patient,
        }
    );
};


</script>

<template>
    <PatientLayout>

        <Head title="Department" />
        <div class="main-content max-w-5xl mx-auto sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="block justify-between page-header md:flex"></div>
            <!-- Page Header Close -->

            <div class="about-container mb-6">
                <div class="!max-w-[35rem] !justify-center !mx-auto !items-center mb-[3rem]">
                    <div class="box text-default shadow border dark:border-defaulttextcolor/10">
                        <h5 class="text-[1.25rem] !font-medium text-center m-4">Select Department </h5>
                    </div>

                    <div class="box-body !p-0">
                        <div class="grid grid-cols-12 gap-x-6">
                            <div class="xl:col-span-6 col-span-12">
                                <a href="javascript:void(0);" @click="submit('maternity')">
                                    <div class="box border border-info">
                                        <a aria-label="anchor" href="javascript:void(0);" class="card-anchor"></a>
                                        <div class="box-body">
                                            <div class="flex align-center">
                                                <div class="me-3">
                                                    <span class="avatar avatar-xl">
                                                        <img :src="$page.props.asset_url + '/assets/hospitalImage/maternity.jpg'"
                                                            alt="img">
                                                    </span>
                                                </div>
                                                <div>
                                                    <p class="card-text text-info mb-1 text-[.875rem] font-semibold">
                                                        Maternity</p>
                                                    <div class=" text-[.75rem] mb-1">Maternity Department </div>
                                                    <div
                                                        class=" text-[#8c9097] dark:text-white/50 text-[.6875rem] mb-0">
                                                        Obstetrics, Family planning ..</div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="xl:col-span-6 col-span-12">
                                <a href="javascript:void(0);" @click="submit('surgery')">
                                    <div class="box border border-primary">
                                        <a aria-label="anchor" href="javascript:void(0);" class="card-anchor"></a>
                                        <div class="box-body">
                                            <div class="flex align-center">
                                                <div class="me-3">
                                                    <span class="avatar avatar-xl">
                                                        <img :src="$page.props.asset_url + '/assets/hospitalImage/surgery.jpg'"
                                                            alt="img">
                                                    </span>
                                                </div>
                                                <div>
                                                    <p class="card-text text-primary mb-1 text-[.875rem] font-semibold">
                                                        Surgery</p>
                                                    <div class=" text-[.75rem] mb-1">Surgery Department </div>
                                                    <div
                                                        class=" text-[#8c9097] dark:text-white/50 text-[.6875rem] mb-0">
                                                        Burn & Plastic surgery ..</div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="xl:col-span-6 col-span-12">
                                <a href="javascript:void(0);" @click="submit('internal-medecine')">
                                    <div class="box border border-warning">
                                        <a aria-label="anchor" href="javascript:void(0);" class="card-anchor"></a>
                                        <div class="box-body">
                                            <div class="flex align-center">
                                                <div class="me-3">
                                                    <span class="avatar avatar-xl">
                                                        <img :src="$page.props.asset_url + '/assets/hospitalImage/internal-medecine.png'"
                                                            alt="img">
                                                    </span>
                                                </div>
                                                <div>
                                                    <p class="card-text text-warning mb-1 text-[.875rem] font-semibold">
                                                        Internal Medecine</p>
                                                    <div class=" text-[.75rem] mb-1">Internal Medecine Depart
                                                    </div>
                                                    <div
                                                        class=" text-[#8c9097] dark:text-white/50 text-[.6875rem] mb-0">
                                                        Pre-Admission ..</div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="xl:col-span-6 col-span-12">
                                <a href="javascript:void(0);" @click="submit('pediatrics')">
                                    <div class="box border border-success">
                                        <a aria-label="anchor" href="javascript:void(0);" class="card-anchor"></a>
                                        <div class="box-body">
                                            <div class="flex align-center">
                                                <div class="me-3">
                                                    <span class="avatar avatar-xl">
                                                        <img :src="$page.props.asset_url + '/assets/hospitalImage/pediatrics.jpg'"
                                                            alt="img">
                                                    </span>
                                                </div>
                                                <div>
                                                    <p class="card-text text-success mb-1 text-[.875rem] font-semibold">
                                                        Pediatrics</p>
                                                    <div class=" text-[.75rem] mb-1">Pediatrics Department</div>
                                                    <div
                                                        class=" text-[#8c9097] dark:text-white/50 text-[.6875rem] mb-0">
                                                        Neonatal Surgery, NICU ..</div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>

    </PatientLayout>
</template>
