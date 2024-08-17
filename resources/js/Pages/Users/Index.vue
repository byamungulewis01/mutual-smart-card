<script setup>
import TablePagination from '@/Components/TablePagination.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    users: Object
});
const depart = {
    'surgery': {
        title: "Surgery",
    },
    'internal-medecine': {
        title: "Internal Medecine",
    },
    'maternity': {
        title: "Maternity",
    },
    'pediatrics': {
        title: "Pediatrics",
    },
};
const status = {
    active: {
        title: "Active",
        class: "badge !rounded-full bg-primary/10 text-primary"
    },
    inactive: {
        title: "Inactive",
        class: "badge !rounded-full bg-danger/10 text-danger"
    },
};
const selectedId = ref(null);

const deleteUser = (user_id) => {
    selectedId.value = user_id;
};
const destroyUser = (user_id) => {
    // Assuming selectedContract contains the data of the user being updated
    const form = useForm({});
    form.delete(route('users.destroy', user_id), {
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
    <AuthenticatedLayout>

        <Head title="Users" />
        <div class="main-content max-w-6xl mx-auto sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="block justify-between page-header md:flex">
                <div>
                    <h3
                        class="!text-defaulttextcolor dark:!text-defaulttextcolor/70 dark:text-white dark:hover:text-white text-[1.125rem] font-semibold">
                        Users List</h3>
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
                        Users List
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
                                All Users
                            </div>
                            <div class="flex flex-wrap gap-2">
                                <div>
                                    <input class="form-control form-control-sm" type="text" placeholder="Search Here"
                                        aria-label=".form-control-sm example">
                                </div>
                                <Link :href="route('users.create')"
                                    class="ti-btn ti-btn-primary-full !py-1 !px-2 !text-[0.75rem]">
                                <i class="ri-add-line  align-middle"></i>New user
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
                                            <th scope="col" class="text-start">Email</th>
                                            <th scope="col" class="text-start">Phone Number</th>
                                            <th scope="col" class="text-start">Role</th>
                                            <th scope="col" class="text-start">Department</th>
                                            <th scope="col" class="text-start">Status</th>
                                            <th scope="col" class="text-start">Join Date</th>
                                            <th scope="col" class="text-start">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(user, index) in users.data" :key="index"
                                            class="border-t hover:bg-gray-200 dark:hover:bg-light">
                                            <td class="!ps-6">{{ (users.current_page - 1) *
                                                users.per_page + index + 1 }}</td>

                                            <td><strong>{{ user.name }}</strong></td>
                                            <td>{{ user.email }}</td>
                                            <td>{{ user.phone }}</td>
                                            <td>{{ user.role }}</td>
                                            <td>{{ depart[user.department]?.title }}</td>
                                            <td><span :class="status[user.status].class">{{ status[user.status].title
                                                    }}</span>
                                            </td>
                                            <td><i class="bi bi-clock me-1"></i>{{ new
                                                Date(user.created_at).toLocaleDateString('en-US', {
                                                    month: 'short', day:
                                                        '2-digit', year: 'numeric'
                                                }) }}</td>
                                            <td>
                                                <Link :href="route('users.edit', user)"
                                                    class="ti-btn ti-btn-icon ti-btn-sm ti-btn-info me-2">
                                                <i class="ri-edit-line"></i>
                                                </Link>
                                                <a @click="deleteUser(user.id)" aria-label="anchor"
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
                        <TablePagination :links="users" />

                    </div>
                </div>
            </div>
            <!--End::row-1 -->

        </div>

        <div id="deleteModel" class="hs-overlay hidden ti-modal">
            <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out min-h-[calc(100%-3.5rem)] flex items-center">
                <div class="ti-modal-content w-full">

                    <div class="ti-modal-body text-center">
                        <form @submit.prevent="destroyUser(selectedId)">
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


    </AuthenticatedLayout>
</template>
