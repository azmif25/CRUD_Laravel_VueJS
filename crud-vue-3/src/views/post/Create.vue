<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>Tambah Post</h4>
                        <hr>

                        <form @submit.prevent="store">
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
import {reactive, ref} from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'

export default {

    setup() {

        // State posts
        const post = reactive({
            nik: '',
            name: '',
            gender: '',
            address: ''
        })

        // State validation
        const validation = ref([])

        // Vue Router
        const router = useRouter()

        // Method Store
        function store() {

            let nik = post.nik
            let name = post.name
            let gender = post.gender
            let address = post.address

        axios.post('http://localhost:8000/api/post', {
            nik: nik,
            name: name,
            gender: gender,
            address: address
        }).then(() => {

            // Redirect ke Post index
            router.push({
                name: 'post.index'
            })

        }).catch(error => {

            // Assign state validation with error
            validation.value = error.response.data

        })
        }
        // Return
        return {
            post,
            validation,
            router,
            store
        }   

    }

}

</script>

<style>
    body {
        background: lightgray;
        }
</style>