<template>
  <div>
    <h1>Autá</h1>

    <div class="row mb-4 ">
      <div class="col-md-4">
        <input v-model="search" @input="fetch" placeholder="Hľadať..." class="form-control " />
      </div>
      <div class="col-md-3">
        <select v-model="registered" @change="fetch" class="form-control">
          <option :value="null">Všetky</option>
          <option :value="true">Registrované</option>
          <option :value="false">Neregistrované</option>
        </select>
      </div>
    </div>

    <div class="card mb-4">
      <div class="card-body">
        <h5>{{ editId ? 'Upraviť auto' : 'Nové auto' }}</h5>
        <form @submit.prevent="save">
          <div class="row">
            <div class="col-md-4 mb-2">
              <input v-model="form.name" placeholder="Názov *" required class="form-control" />
            </div>
            <div class="col-md-3 mb-2">
              <input v-model="form.registration_number" :required="form.is_registered" placeholder="ŠPZ" class="form-control" />
            </div>
            <div class="col-md-2 mb-2 d-flex align-items-center">
              <div class="form-check">
                <input v-model="form.is_registered" type="checkbox" class="form-check-input" />
                <label class="form-check-label">Registrované</label>
              </div>
            </div>
            <div class="col-md-3 mb-2">
              <button type="submit" class="btn btn-success me-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-plus mb-1" viewBox="0 0 16 16">
                  <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z"/>
                  <path d="M8 4a.5.5 0 0 1 .5.5V6H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V7H6a.5.5 0 0 1 0-1h1.5V4.5A.5.5 0 0 1 8 4"/>
                </svg>
              </button>
              <button v-if="editId" @click="cancel" type="button" class="btn btn-warning">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle mb-1" viewBox="0 0 16 16">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                </svg>
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="row">
      <CarCard
        v-for="car in cars"
        :key="car.id"
        :car="car"
        @edit="edit"
        @remove="remove"
      />
    </div>
  </div>
</template>

<style></style>

<script setup>
  import { ref, onMounted } from 'vue';
  import axios from 'axios';

  //vars
  const cars = ref([]);
  const search = ref('');
  const registered = ref(null);
  const form = ref({ name: '', registration_number: '', is_registered: false });
  const editId = ref(null);

  const fetch = async () => {
    const params = {};
    if (search.value) params.search = search.value;
    if (registered.value !== null) params.registered = registered.value;

    const res = await axios.get('/api/cars', { params });
    cars.value = res.data;
  };

  const save = async () => {
    if (editId.value) {
      await axios.put(`/api/cars/${editId.value}`, form.value);
    } else {
      await axios.post('/api/cars', form.value);
    }
    reset();
    fetch();
  };

  const edit = (car) => {
    form.value = { ...car };
    editId.value = car.id;
  };

  const remove = async (id) => {
    if (confirm('Odstrániť auto?')) {
      await axios.delete(`/api/cars/${id}`);
      fetch();
    }
  };

  const cancel = () => reset();
  const reset = () => {
    form.value = { name: '', registration_number: '', is_registered: false };
    editId.value = null;
  };

  onMounted(fetch);
</script>