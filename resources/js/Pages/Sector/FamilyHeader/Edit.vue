<script setup>
import { ref, watch, computed } from 'vue';
import { Inertia } from "@inertiajs/inertia";
import { usePage } from '@inertiajs/vue3';



import SectorLayout from '@/Layouts/SectorLayout.vue';
import { Head, useForm } from '@inertiajs/vue3'
import InputError from '@/Components/InputError.vue';
import axios from 'axios';

const page = usePage();
const shared = computed(() => page.props);

const props = defineProps({
    districts: Object,
    sectors: Object,
    cells: Object,
    villages: Object,
    categories: Object,
    family: Object,

});
const family = props.family;

const imageUrl = ref(shared.value.asset_url + '/storage/' + family.image); // Default image URL
const imageFile = ref(null);

function onFileChange(event) {
    const file = event.target.files[0];
    if (file && file.type.startsWith('image/')) {
        imageFile.value = file;
        const reader = new FileReader();
        reader.onload = (e) => {
            imageUrl.value = e.target.result;
        };
        reader.readAsDataURL(file);
    } else {
        alert('Please select a valid image file.');
    }
}

function removeImage() {
    imageFile.value = null;
    imageUrl.value = shared.value.asset_url + '/storage/' + family.image; // Reset to default image
}




const form = useForm({
    first_name: family.first_name,
    last_name: family.last_name,
    national_id: family.national_id,
    dateOfBirth: family.dateOfBirth,
    gender: family.gender,
    photo: '',
    phone: family.phone,
    matialStatus: family.matialStatus,
    mutual_category: family.mutual_category,
    district: family.district,
    sector: family.sector,
    cell: family.cell,
    village: family.village,
});

const submit = () => {
    Inertia.post(route('sector.families.update', family.id),
        {
            _method: "put",
            first_name: form.first_name,
            last_name: form.last_name,
            national_id: form.national_id,
            dateOfBirth: form.dateOfBirth,
            gender: form.gender,
            photo: form.photo,
            phone: form.phone,
            matialStatus: form.matialStatus,
            mutual_category: form.mutual_category,
            district: form.district,
            sector: form.sector,
            cell: form.cell,
            village: form.village,
        }
    );
};



const sectors = ref(props.sectors);
const cells = ref(props.cells);
const villages = ref(props.villages);
watch(() => form.district, (district) => {
    axios.get(route('sector.families.getSectors', district))
        .then((response) => {
            sectors.value = response.data;
            form.sector = '';
            form.cell = '';
            form.village = '';

        }).catch((error) => {
            log.error('error', error);
        });
});
watch(() => form.sector, (sector) => {
    axios.get(route('sector.families.getCells', sector))
        .then((response) => {
            cells.value = response.data;
            form.cell = '';
            form.village = '';

        }).catch((error) => {
            log.error('error', error);
        });
});
watch(() => form.cell, (cell) => {
    axios.get(route('sector.families.getVillages', cell))
        .then((response) => {
            villages.value = response.data;
            form.village = '';
        }).catch((error) => {
            log.error('error', error);
        });
});




</script>

<template>
    <SectorLayout>

        <Head title="Edit Family" />
        <div class="main-content max-w-6xl mx-auto sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="block justify-between page-header md:flex">
                <div>
                    <h3
                        class="!text-defaulttextcolor dark:!text-defaulttextcolor/70 dark:text-white dark:hover:text-white text-[1.125rem] font-semibold">
                        Edit Family</h3>
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
                        Create Family
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
                                            <h6 class="font-semibold mb-4 text-[1rem]">
                                                Photo :
                                            </h6>
                                            <div class="mb-6 sm:flex items-center">
                                                <div class="mb-0 me-[3rem]">
                                                    <span class="avatar avatar-xxl avatar-rounded">
                                                        <img :src="imageUrl" alt="" id="profile-img">
                                                        <a aria-label="anchor" href="javascript:void(0);"
                                                            class="badge rounded-full bg-primary avatar-badge">
                                                            <input type="file" name="photo"
                                                                @input="form.photo = $event.target.files[0]"
                                                                class="absolute w-full h-full opacity-0"
                                                                @change="onFileChange" accept="image/*"
                                                                id="profile-image">
                                                            <i class="fe fe-camera !text-[0.65rem]"></i>
                                                        </a>
                                                    </span>
                                                </div>
                                                <div class="inline-flex">
                                                    <button type="button"
                                                        class="ti-btn bg-primary text-white !rounded-e-none !font-medium">Change</button>
                                                    <button type="button"
                                                        class="ti-btn ti-btn-light !font-medium !rounded-s-none"
                                                        @click="removeImage">Remove</button>
                                                </div>

                                            </div>
                                            <InputError class="mt-1" :message="$page.props.errors.photo" />
                                            <h6 class="font-semibold mb-4 text-[1rem]">
                                                Profile :
                                            </h6>
                                            <div class="sm:grid grid-cols-12 gap-6 mb-6">
                                                <div class="xl:col-span-6 col-span-12">
                                                    <label for="first_name" class="form-label">First Name</label>
                                                    <input type="text" v-model="form.first_name"
                                                        class="form-control w-full !rounded-md" id="first_name"
                                                        placeholder="First Name">
                                                    <InputError class="mt-1" :message="$page.props.errors.first_name" />
                                                </div>
                                                <div class="xl:col-span-6 col-span-12">
                                                    <label for="last_name" class="form-label">Last Name</label>
                                                    <input type="text" v-model="form.last_name"
                                                        class="form-control w-full !rounded-md" id="last_name"
                                                        placeholder="Last Name">
                                                    <InputError class="mt-1" :message="$page.props.errors.last_name" />
                                                </div>
                                                <div class="xl:col-span-6 col-span-12">
                                                    <label for="national_id" class="form-label">National ID </label>
                                                    <input type="number" v-model="form.national_id"
                                                        class="form-control w-full !rounded-md" id="national_id"
                                                        placeholder="National ID">
                                                    <InputError class="mt-1"
                                                        :message="$page.props.errors.national_id" />
                                                </div>
                                                <div class="xl:col-span-4 col-span-12">
                                                    <label for="dateOfBirth" class="form-label">Date of Birth</label>
                                                    <VueDatePicker placeholder="Select Date"
                                                        class="form-control w-full !rounded-md"
                                                        v-model="form.dateOfBirth" :max-date="new Date()"
                                                        teleport-center :enable-time-picker="false" />
                                                    <InputError class="mt-1"
                                                        :message="$page.props.errors.dateOfBirth" />
                                                </div>
                                                <div class="xl:col-span-2 col-span-12">
                                                    <label for="last-name" class="form-label">Gender</label>
                                                    <div class="flex gap-4 mt-2">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                id="inlineRadio1" v-model="form.gender" value="male">
                                                            <label class="form-check-label"
                                                                for="inlineRadio1">Male</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                v-model="form.gender" id="inlineRadio2" value="female">
                                                            <label class="form-check-label"
                                                                for="inlineRadio2">Female</label>
                                                        </div>
                                                        <InputError class="mt-1" :message="$page.props.errors.gender" />
                                                    </div>
                                                </div>
                                                <div class="xl:col-span-4 col-span-12">
                                                    <label for="mutual_category " class="form-label">Category</label>
                                                    <select v-model="form.mutual_category"
                                                        class="ti-form-select rounded-sm !py-2 !px-3">
                                                        <option selected="" value=""> -- select -- </option>
                                                        <option v-for="(item, index) in categories" :value="item.id"
                                                            :key="index">Category {{ item.name }}</option>

                                                    </select>
                                                    <InputError class="mt-1"
                                                        :message="$page.props.errors.mutual_category" />
                                                </div>


                                                <div class="xl:col-span-4 col-span-12">
                                                    <label for="matialStatus" class="form-label">Matial Status</label>
                                                    <select v-model="form.matialStatus"
                                                        class="ti-form-select rounded-sm !py-2 !px-3">
                                                        <option selected="" value=""> -- select -- </option>
                                                        <option value="single">Single</option>
                                                        <option value="married">Married</option>
                                                        <option value="divorced">Divorced</option>
                                                        <option value="widowed">Widowed</option>

                                                    </select>
                                                    <InputError class="mt-1"
                                                        :message="$page.props.errors.matialStatus" />
                                                </div>
                                                <div class="xl:col-span-4 col-span-12">
                                                    <label for="phone" class="form-label">Phone Number &nbsp; <span
                                                            class="text-black-100"> (Optional)</span></label>
                                                    <input v-model="form.phone" type="text"
                                                        class="form-control w-full !rounded-md" id="phone"
                                                        placeholder="Phone Number">
                                                    <InputError class="mt-1" :message="$page.props.errors.phone" />
                                                </div>

                                            </div>
                                            <h6 class="font-semibold mb-4 text-[1rem]">
                                                Address information :
                                            </h6>
                                            <div class="sm:grid grid-cols-12 gap-6 mb-6">
                                                <div class="xl:col-span-3 col-span-12">
                                                    <label for="district" class="form-label">District</label>
                                                    <select v-model="form.district"
                                                        class="ti-form-select rounded-sm !py-2 !px-3">
                                                        <option selected="" value=""> -- select -- </option>
                                                        <option v-for="(item, index) in districts" :key="index"
                                                            :value="item.dist_id">{{ item.district }}</option>

                                                    </select>
                                                    <InputError class="mt-1" :message="$page.props.errors.district" />
                                                </div>
                                                <div class="xl:col-span-3 col-span-12">
                                                    <label for="sector" class="form-label">Sector</label>
                                                    <select v-model="form.sector"
                                                        class="ti-form-select rounded-sm !py-2 !px-3">
                                                        <option selected="" value=""> -- select -- </option>
                                                        <option v-for="item in sectors" :key="item.sect_id"
                                                            :value="item.sect_id">{{
                                                                item.sector }}</option>
                                                    </select>
                                                    <InputError class="mt-1" :message="$page.props.errors.sector" />
                                                </div>
                                                <div class="xl:col-span-3 col-span-12">
                                                    <label for="cell" class="form-label">Cell</label>
                                                    <select v-model="form.cell"
                                                        class="ti-form-select rounded-sm !py-2 !px-3">
                                                        <option selected="" value=""> -- select -- </option>
                                                        <option v-for="item in cells" :key="item.cell_id"
                                                            :value="item.cell_id">{{
                                                                item.cell }}</option>
                                                    </select>
                                                    <InputError class="mt-1" :message="$page.props.errors.cell" />
                                                </div>
                                                <div class="xl:col-span-3 col-span-12">
                                                    <label for="village" class="form-label">Village</label>
                                                    <select v-model="form.village"
                                                        class="ti-form-select rounded-sm !py-2 !px-3">
                                                        <option selected="" value=""> -- select -- </option>
                                                        <option v-for="item in villages" :key="item.vill_id"
                                                            :value="item.vill_id">{{
                                                                item.village }}</option>
                                                    </select>
                                                    <InputError class="mt-1" :message="$page.props.errors.village" />
                                                </div>
                                            </div>
                                            <div class="sm:grid grid-cols-12 gap-6">
                                                <div class="xl:col-span-12 col-span-12">
                                                    <button
                                                        class="ti-btn ti-btn-primary btn-wave ms-auto float-right">Submit</button>
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

    </SectorLayout>
</template>
