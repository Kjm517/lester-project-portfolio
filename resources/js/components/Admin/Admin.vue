<template>
    <div class="min-h-screen bg-gray-900 text-gray-200 p-6 space-y-8">
      <header class="text-center">
        <h1 class="text-4xl font-bold text-gray-100">Admin Page</h1>
        <p class="text-gray-400">Lester Ag Padul's Portfolio</p>
      </header>
  
      <section class="bg-gray-800 shadow-md p-6 rounded-lg">
        <h2 class="text-2xl font-semibold mb-4">About</h2>
        <textarea
          class="w-full p-2 border rounded-lg resize-none bg-gray-700 text-gray-200 border-gray-600"
          rows="4"
          v-model="form.description"
        ></textarea>
        <small style="color: red" v-if="errors?.description">{{
          errors.description
        }}</small>
      </section>
  
      <section class="bg-gray-800 shadow-md p-6 rounded-lg">
        <h2 class="text-2xl font-semibold mb-4">Experience</h2>

        <textarea class="w-full p-2 border rounded-lg resize-none bg-gray-700 text-gray-200 border-gray-600" rows="4">A Performance-driven Developer possessing 5 years of extensive industry experience in Web and iOS development. Adept in developing products for web design, mobile apps, user experience, best practices, and speed.</textarea>
        <ul>
            <li class="mb-4">
                <div class="flex flex-col sm:flex-row sm:justify-between items-start sm:items-center">
                <ul>
                    <span class="text-gray-300">
                        <strong>Senior Web Developer</strong> at
                        <em>Forty Degrees Celsius</em> (2018 - 2022)
                    </span>
                </ul>
                <ul>
                  <input
                    class="w-full p-2 border rounded-lg resize-none bg-gray-700 text-gray-200 border-gray-600"
                    rows="4"
                    v-model="form.description"
                  ></input>
                </ul>
                <div class="mt-2 sm:mt-0 flex space-x-2">
                    <button class="bg-blue-500 text-white px-3 py-1 rounded">Edit</button>
                    <button class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                </div>
                </div>
            </li>
            <li class="mb-4">
                <div class="flex flex-col sm:flex-row sm:justify-between items-start sm:items-center">
                <ul>
                    <span class="text-gray-300">
                        <strong>Senior Web Developer</strong> at
                        <em>Forty Degrees Celsius</em> (2018 - 2022)
                    </span>
                </ul>
                <div class="mt-2 sm:mt-0 flex space-x-2">
                    <button class="bg-blue-500 text-white px-3 py-1 rounded">Edit</button>
                    <button class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                </div>
                </div>
            </li>
        </ul>
        <button class="bg-green-500 text-white px-4 py-2 rounded">Add Experience</button>
      </section>
  
      <section class="bg-gray-800 shadow-md p-6 rounded-lg">
        <h2 class="text-2xl font-semibold mb-4">Skills</h2>
        <ul class="flex flex-wrap gap-2">
          <li class="bg-gray-700 px-3 py-1 rounded-full flex items-center">
            <span class="mr-2">JavaScript</span>
            <button class="text-red-400">&times;</button>
          </li>
        </ul>
        <div class="mt-4 flex space-x-2">
          <input class="border p-2 rounded-lg flex-grow bg-gray-700 text-gray-200 border-gray-600" placeholder="Add a skill" readonly />
          <button class="bg-green-500 text-white px-4 py-2 rounded">Add</button>
        </div>
      </section>

      <section class="bg-gray-800 shadow-md p-6 rounded-lg">
        <h2 class="text-2xl font-semibold mb-4">Awards & Certificates</h2>
        <ul>
          <li class="mb-4">
            <div class="flex justify-between items-center">
              <span class="text-gray-300">Award 1</span>
              <button class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
            </div>
          </li>
          <li class="mb-4">
            <div class="flex justify-between items-center">
              <span class="text-gray-300">Award 2</span>
              <button class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
            </div>
          </li>
        </ul>
        <div class="mt-4 flex space-x-2">
          <input class="border p-2 rounded-lg flex-grow bg-gray-700 text-gray-200 border-gray-600" placeholder="Add award" readonly/>
          <button class="bg-green-500 text-white px-4 py-2 rounded">Add</button>
        </div>
      </section>

      <section class="bg-gray-800 shadow-md p-6 rounded-lg">
        <h2 class="text-2xl font-semibold mb-4">Portfolio</h2>
        <ul>
          <li class="mb-4">
            <div class="flex flex-col sm:flex-row sm:justify-between items-start sm:items-center">
              <span class="text-gray-300">
                <strong>MACHETALK WEB / IOS</strong>: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
              </span>
              <button class="bg-red-500 text-white px-3 py-1 rounded mt-2 sm:mt-0">Delete</button>
            </div>
          </li>
        </ul>
        <div class="mt-4 flex flex-col sm:flex-row gap-4">
          <input class="border p-2 rounded-lg flex-grow bg-gray-700 text-gray-200 border-gray-600" placeholder="Project Name" readonly/>
          <input class="border p-2 rounded-lg flex-grow bg-gray-700 text-gray-200 border-gray-600" placeholder="Project Description" readonly/>
          <button class="bg-green-500 text-white px-4 py-2 rounded">Add Project</button>
        </div>

        <div class="mt-4 flex flex-col sm:flex-row gap-4">
          <button class="bg-green-500 text-white px-4 py-2 rounded" @click="handleSave"> {{ form.id ? "Update" : "Save" }}</button>
        </div>
      </section>
    </div>
  </template>



<script setup>
import axios from "axios";
import { onMounted, reactive, ref } from "vue";
import { useRouter } from "vue-router";
import Swal from "sweetalert2";

// ✅ Toast Notification Setup
const toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
});

const router = useRouter();
let errors = ref([]);

// ✅ Form State
const form = reactive({
  id: null, // Store ID for updates
  description: "",
});

// ✅ Fetch Data (Read)
const getAbout = async () => {
  try {
    let response = await axios.get("/api/abouts");
    if (response.data.abouts.length > 0) {
      form.id = response.data.abouts[0].id; // Store ID for update/delete
      form.description = response.data.abouts[0].description;
    }
  } catch (error) {
    console.error("Error fetching about data:", error);
  }
};

// ✅ Create or Update Data
const handleSave = () => {
  const formData = {
    description: form.description ? form.description.substring(0, 255) : null,
  };

  if (form.id) {
    axios
      .put(`/api/abouts/${form.id}`, formData)
      .then((response) => {
        console.log("Update Success:", response.data);
        toast.fire({ icon: "success", title: "Updated successfully" });
      })
      .catch(handleAxiosError); 
  } else {
    axios
      .post("/api/abouts", formData)
      .then((response) => {
        form.id = response.data.id;
        toast.fire({ icon: "success", title: "Created successfully" });
      })
      .catch(handleAxiosError);
  }
};


// ❌ DELETE DATA
const handleDelete = () => {
  if (!form.id) return;

  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      axios
        .delete(`/api/abouts/${form.id}`)
        .then(() => {
          form.id = null;
          form.description = "";
          toast.fire({ icon: "success", title: "Deleted successfully" });
        })
        .catch((error) => handleAxiosError(error));
    }
  });
};

// ✅ Error Handling
const handleAxiosError = (error) => {
  console.error("Axios error:", error);

  if (error.response) {
    console.log("Full Server Response:", error.response.data); // ✅ Log full response

    if (error.response.status === 422) {
      errors.value = error.response.data.errors;
    } else {
      console.log("Server error:", error.response.data.message || "No message available");
    }
  } else if (error.request) {
    console.log("No response received:", error.request);
  } else {
    console.log("Error setting up request:", error.message);
  }
};


onMounted(() => {
  getAbout();
});
</script>