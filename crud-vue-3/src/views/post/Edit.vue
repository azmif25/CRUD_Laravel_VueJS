<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>Edit Post</h4>
                        <hr>

                        <form @submit.prevent="update">
                            <div class="form-group">
                                <label for="nik" class="font-weight-bold"><b>NIK</b></label>
                                <input type="text" class="form-control" v-model="post.nik" placeholder="Masukkan NIK..">
                                <!-- validation -->
                                <div v-if="validation.nik" class="mt-2 alert alert-danger">
                                    {{ validation.nik[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="font-weigth-bold"><b>Name</b></label>
                                <input type="text" class="form-control" v-model="post.name" placeholder="Masukkan Nama..">
                                <!-- validation -->
                                <div v-if="validation.name" class="mt-2 alert alert-danger">
                                    {{ validation.name[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="gender" class="font-weigth-bold"><b>Gender</b></label><br>
                                <input type="radio" class="form-check-input" v-model="post.gender" value="Male"> Male &ensp;
                                <input type="radio" class="form-check-input" v-model="post.gender" value="Female"> Female
                                <!-- validation -->
                                <div v-if="validation.gender" class="mt-2 alert alert-danger">
                                    {{ validation.gender[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address" class="font-weight-bold"><b>Adress</b></label>
                                <textarea rows="5" class="form-control" v-model="post.address" placeholder="Masukan Alamat.."></textarea>
                                <!-- validation -->
                                <div v-if="validation.address" class="mt-2 alert alert-danger">
                                    {{ validation.address[0] }}
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { reactive, ref, onMounted } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import axios from 'axios'

export default {
    
    setup() {

        // State Posts
        const post = reactive({
            nik: '',
            name: '',
            gender: '',
            address: ''
        })

        // State Validation
        const validation = ref([])

        // State Router
        const router = useRouter()

        // Vue Router
        const route = useRoute()

        // Mounted
        onMounted(() => {

            // Get API from Laravel Backend
            axios.get(`http://localhost:8000/api/post/${route.params.id}`)
            .then(response => {

                // Assign state posts with response data
                post.nik  =   response.data.data.nik
                post.name =  response.data.data.name
                post.gender = response.data.data.gender
                post.address = response.data.data.address

            }).catch(error => {
                console.log(error.response.data)
            })
        })

        // Method Update
        function update(){

            let nik = post.nik
            let name = post.name
            let gender = post.gender
            let address = post.address

            axios.put(`http://localhost:8000/api/post/${route.params.id}`, {
                nik: nik,
                name: name,
                gender: gender,
                address: address
            }).then(() => {

                // Redirect to Post Index
                router.push({
                    name: 'post.index'
                })
            }).catch(error => {

                // Assign State Validation with Error
                validation.value = error.response.data

            })
        }

        // Return
        return {
            post,
            validation,
            router,
            update
        }
    }
}
</script>

<style>
    body {
        background: lightgrey;
    }
</style>