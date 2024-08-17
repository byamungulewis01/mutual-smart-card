<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
const props = defineProps({
    user: Object
});
const form = useForm({
    name: props.user.name,
    email: props.user.email,
    phone: props.user.phone,
    role: props.user.role,
    department: props.user.department,
});

const submit = () => {
    form.put(route('users.update', props.user.id),
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
    <AuthenticatedLayout>

        <Head title="Create User" />
        <div class="main-content max-w-5xl mx-auto sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="block justify-between page-header md:flex">
                <div>
                    <h3
                        class="!text-defaulttextcolor dark:!text-defaulttextcolor/70 dark:text-white dark:hover:text-white text-[1.125rem] font-semibold">
                        Update User</h3>
                </div>
                <ol class="flex items-center whitespace-nowrap min-w-0">
                    <li class="text-[0.813rem] ps-[0.5rem]">
                        <a class="flex items-center text-primary hover:text-primary dark:text-primary truncate"
                            href="javascript:void(0);">
                            Users
                            <i
                                class="ti ti-chevrons-right flex-shrink-0 text-[#8c9097] dark:text-white/50 px-[0.5rem] overflow-visible rtl:rotate-180"></i>
                        </a>
                    </li>
                    <li class="text-[0.813rem] text-defaulttextcolor font-semibold hover:text-primary dark:text-[#8c9097] dark:text-white/50 "
                        aria-current="page">
                        Update User
                    </li>
                </ol>
            </div>
            <!-- Page Header Close -->

            <div class="grid grid-cols-12 gap-6 mb-[3rem]">
                <div class="xl:col-span-12 col-span-12">
                    <div class="box">
                        <div class="box-body">
                            <div class="tab-content">
                                <div class="tab-pane show active dark:border-defaultborder/10" id="personal-info"
                                    aria-labelledby="Personal-item">
                                    <form @submit.prevent="submit">
                                        <div class="sm:p-4 p-0">

                                            <div class="sm:grid grid-cols-12 gap-6 mb-6">
                                                <div class="xl:col-span-6 col-span-12">
                                                    <label for="name" class="form-label">Name</label>
                                                    <input v-model="form.name" type="text"
                                                        class="form-control w-full !rounded-md" id="name"
                                                        placeholder="Enter names">
                                                    <InputError class="mt-1" :message="form.errors.name" />

                                                </div>
                                                <div class="xl:col-span-6 col-span-12">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input v-model="form.email" type="email"
                                                        class="form-control w-full !rounded-md" id="email"
                                                        placeholder="Enter email">
                                                    <InputError class="mt-1" :message="form.errors.email" />

                                                </div>
                                                <div class="xl:col-span-4 col-span-12">
                                                    <label for="phone" class="form-label">Phone Number</label>
                                                    <input v-model="form.phone" type="text"
                                                        class="form-control w-full !rounded-md" id="phone"
                                                        placeholder="Phone number">
                                                    <InputError class="mt-1" :message="form.errors.phone" />

                                                </div>
                                                <div class="xl:col-span-4 col-span-12">
                                                    <label for="role" class="form-label">Role</label>
                                                    <select v-model="form.role"
                                                        class="ti-form-select rounded-sm !py-2 !px-3">
                                                        <option selected="" value=""> -- select -- </option>
                                                        <option value="admin">Administrator</option>
                                                        <option value="hospital-user">Hospital User</option>
                                                        <option value="doctor">Doctor</option>
                                                    </select>
                                                    <InputError class="mt-1" :message="form.errors.role" />

                                                </div>
                                                <div class="xl:col-span-4 col-span-12">
                                                    <label for="department" class="form-label">Department</label>
                                                    <select :disabled="form.role != 'doctor'" v-model="form.department"
                                                        class="ti-form-select rounded-sm !py-2 !px-3">
                                                        <option selected="" value=""> -- select -- </option>
                                                        <option value="surgery">Surgery</option>
                                                        <option value="internal-medecine">Internal Medecine</option>
                                                        <option value="maternity">Maternity</option>
                                                        <option value="pediatrics">Pediatrics</option>
                                                    </select>
                                                    <InputError class="mt-1" :message="form.errors.status" />

                                                </div>



                                            </div>

                                            <div class="sm:grid grid-cols-12 gap-6">
                                                <div class="xl:col-span-12 col-span-12">
                                                    <button
                                                        class="ti-btn ti-btn-primary btn-wave ms-auto float-right">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </AuthenticatedLayout>
</template>
