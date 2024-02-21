<script setup>
import Swal from "sweetalert2";
import { ref, onMounted, computed } from "vue";
import axios from "axios";
import VueDatePicker from "@vuepic/vue-datepicker";
import VueMultiselect from "vue-multiselect";

const reqskills = ref([]);
const reqjobs = ref([]);
const err = ref({});
const form = ref({});
const isloading = ref(false);

const succesAlert = () => {
    Swal.fire({
        icon: "success",
        title: "Berhasil",
        text: "Data Berhasil Ditambahkan",
    });
};

const requestSkills = async () => {
    try {
        const response = await axios.get("/api/skills");
        reqskills.value = response.data;
    } catch (error) {
        console.error(error);
    }
};

const requestJobs = async () => {
    try {
        const response = await axios.get("/api/jobs");
        reqjobs.value = response.data;
    } catch (error) {
        console.error(error);
    }
};

const store = async () => {
    const id = form.value.jobs ? form.value.jobs.id : "";
    err.value = {};
    isloading.value = true;
    try {
        const response = await axios.post("/api/store", {
            name: form.value.name,
            email: form.value.email,
            job_id: id,
            phone: form.value.phone,
            year: form.value.year,
            skillset: form.value.skillset,
        });
        // console.log(response.data);
        succesAlert();
        form.value = {};
    } catch (error) {
        err.value = error.response.data.errors;
    } finally {
        isloading.value = false;
    }
};

onMounted(() => {
    requestSkills();
    requestJobs();
});
</script>
<template>
    <div class="register-box">
        <div class="register-logo my-5">
            <img src="/img/energeek2.png" alt="" class="w-50" />
        </div>
        <div class="card rd mb-5">
            <div class="card-body register-card-body rd">
                <h3 class="login-box-msg font-weight-bolder">Apply Lamaran</h3>
                <form @submit.prevent="store">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input
                            v-model="form.name"
                            type="text"
                            class="form-control"
                            :class="{ 'border-danger': err.name }"
                            autocomplete="name"
                            placeholder="Cth: Jonathan Akbar"
                        />
                        <small v-if="err.name" class="text-danger">{{
                            err.name[0]
                        }}</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jabatan</label>
                        <VueMultiselect
                            v-model="form.jobs"
                            :class="{ 'border-danger': err.job_id }"
                            label="name"
                            :options="reqjobs"
                            :searchable="true"
                            placeholder="Pilih Jabatan"
                        >
                        </VueMultiselect>
                        <small v-if="err.job_id" class="text-danger">{{
                            err.job_id[0]
                        }}</small>
                    </div>
                    <div class="form-group">
                        <label>Telepon</label>
                        <input
                            v-model="form.phone"
                            type="text"
                            class="form-control"
                            :class="{ 'border-danger': err.phone }"
                            autocomplete="tel"
                            placeholder="Cth: 0893239851289"
                        />
                        <small v-if="err.phone" class="text-danger">{{
                            err.phone[0]
                        }}</small>
                    </div>

                    <div class="form-group">
                        <label>Email address</label>
                        <input
                            v-model="form.email"
                            type="email"
                            class="form-control"
                            :class="{ 'border-danger': err.email }"
                            autocomplete="email"
                            placeholder="Enter email"
                        />
                        <small v-if="err.email" class="text-danger">{{
                            err.email[0]
                        }}</small>
                    </div>
                    <div class="form-group">
                        <label>Tahun Lahir</label>
                        <VueDatePicker
                            :class="{ 'border-danger': err.year }"
                            v-model="form.year"
                            placeholder="Pilih Tahun"
                            year-picker
                        />
                        <small v-if="err.year" class="text-danger">{{
                            err.year[0]
                        }}</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Skill Set</label>
                        <VueMultiselect
                            v-model="form.skillset"
                            label="name"
                            :class="{ 'border-danger': err.skillset }"
                            :options="reqskills"
                            :searchable="true"
                            placeholder="Pilih Jabatan"
                            :multiple="true"
                        />
                        <small v-if="err.skillset" class="text-danger">{{
                            err.skillset[0]
                        }}</small>
                    </div>
                    <div class="social-auth-links text-center mt-4">
                        <button
                            type="submit"
                            class="btn btn-block btn-lg btn-pink text-light"
                        >
                            <span
                                v-if="isloading"
                                class="spinner-border text-light"
                            ></span>
                            <span v-else="!isloading">Apply</span>
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.form-box -->
        </div>
        <!-- /.card -->
    </div>
</template>

<style scoped>
.register-box {
    width: 560px;
}

.border-danger {
    border: 0.2px solid red;
    border-radius: 5px;
}

.rd {
    border-radius: 15px;
}

.btn-pink {
    background-color: rgb(199, 155, 162);
}

.btn-pink:hover {
    background-color: palevioletred;
}

@media (max-width: 576px) {
    .register-box {
        margin-top: 0.5rem;
        width: 90%;
    }
}
</style>
