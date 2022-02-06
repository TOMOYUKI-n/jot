<template>
    <div>
        <div class="flex justify-between">
            <a href="#" class="text-blue-400" @click="$router.back()">
                < Back
            </a>
        </div>

        <form @submit.prevent="submitForm">
            <InputField name="name" label="Contact Name" placeholder="Contact Name" @update:field="form.name = $event" :errors="errors" :editData="form.name"/>
            <InputField name="email" label="Contact Email" placeholder="Contact Email" @update:field="form.email = $event" :errors="errors" :editData="form.email"/>
            <InputField name="company" label="company" placeholder="company" @update:field="form.company = $event" :errors="errors" :editData="form.company"/>
            <InputField name="birthday" label="birthday" placeholder="MM/DD/YYYY" @update:field="form.birthday = $event" :errors="errors" :editData="form.birthday"/>

            <div class="flex justify-end">
                <button class="py-2 px-4 rounded border text-red-700 mr-5 hover:border-red-700">Cancel</button>
                <button class="bg-blue-500 py-2 px-4 rounded text-white hover:bg-blue-400">Save</button>
            </div>
            
        </form>
    </div>
</template>

<script>
import InputField from '../components/InputField';
export default {
    name: "ContactsEdit",

    components: {
        InputField
    },

    data: function() {
        return {
            form: {
                'name': '',
                'email': '',
                'company': '',
                'birthday': '',
            },
            
            errors: null,
            loading: false,
        }
    },

    mounted() {
        axios.get('/api/contacts/' + this.$route.params.id)
            .then(response => {
                this.form = response.data.data;

                this.loading = false;
            })
            .catch(error => {
                this.loading = false;

                if (error.response.status === 404) {
                    this.$router.push('/contacts');
                }
            });
    },

    methods: {
        submitForm: function () {
            axios.patch('/api/contacts/' + this.$route.params.id, this.form)
                .then(response => {
                    this.$router.push(response.data.links.self)
                })
                .catch(errors => {
                    this.errors = errors.response.data.errors;
                });
        }
    }
}
</script>

<style scoped>

</style>