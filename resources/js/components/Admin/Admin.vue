<template>
  <div class="min-h-screen bg-gray-900 text-gray-200 p-6 space-y-8">
    <header class="text-center">
      <h1 class="text-4xl font-bold text-gray-100">Admin Page</h1>
      <p class="text-gray-400">Lester Ag Padul's Portfolio</p>
    </header>

    <!-- About Section -->
    <form @submit.prevent="handleSave">
      <section class="bg-gray-800 shadow-md p-6 rounded-lg">
        <h2 class="text-2xl font-semibold mb-4">ℹ️ About</h2>
        <textarea
          class="w-full p-2 border rounded-lg resize-none bg-gray-700 text-gray-200 border-gray-600"
          rows="4"
          v-model="form.description"
        ></textarea>
        <small style="color: red" v-if="errors?.description">{{ errors.description }}</small>
      </section>

      <!-- Experience Section -->
      <section class="bg-gray-800 shadow-md p-6 rounded-lg">
        <h2 class="text-2xl font-semibold mb-4">💼 Experience</h2>

        <div v-for="(experience, index) in form.experiences" :key="index" class="mb-4">
          <div class="flex flex-col sm:flex-row sm:justify-between items-start sm:items-center gap-2">
            <div class="flex-grow space-y-2">
              <input v-model="experience.position" class="w-full p-2 border rounded-lg bg-gray-700 text-gray-200 border-gray-600" placeholder="Job Title" />
              <input v-model="experience.company" class="w-full p-2 border rounded-lg bg-gray-700 text-gray-200 border-gray-600" placeholder="Company" />

              <div class="flex space-x-4">
                <div class="flex flex-col">
                  <label class="text-gray-400 text-sm">Start Date</label>
                  <div class="flex space-x-2">
                    <!-- Start Month -->
                    <select v-model="experience.start_month" class="p-2 w-32 border rounded-lg bg-gray-700 text-gray-200 border-gray-600">
                      <option value="" disabled>Start Month</option>
                      <option v-for="(month, index) in months" :key="index" :value="index + 1">
                        {{ month }}
                      </option>
                    </select>

                    <!-- Start Year -->
                    <select v-model="experience.start_year" class="p-2 w-24 border rounded-lg bg-gray-700 text-gray-200 border-gray-600">
                      <option value="" disabled>Start Year</option>
                      <option v-for="year in years" :key="year" :value="year">{{ year }}</option>
                    </select>
                  </div>
                </div>

                <div class="flex flex-col">
                  <label class="text-gray-400 text-sm">End Date</label>
                  <div class="flex space-x-2">
                    <!-- End Month -->
                    <select v-model="experience.end_month" class="p-2 w-32 border rounded-lg bg-gray-700 text-gray-200 border-gray-600">
                      <option value="" disabled>End Month</option>
                      <option v-for="(month, index) in months" :key="index" :value="index + 1">
                        {{ month }}
                      </option>
                    </select>

                    <!-- End Year -->
                    <select v-model="experience.end_year" class="p-2 w-24 border rounded-lg bg-gray-700 text-gray-200 border-gray-600">
                      <option value="" disabled>End Year</option>
                      <option v-for="year in years" :key="year" :value="year">{{ year }}</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <button @click="removeExperience(index, experience.id)">Remove</button>
          </div>
        </div>

        <button type="button" class="bg-green-500 text-white px-4 py-2 rounded" @click="addExperience">Add Experience</button>
      </section>

      <section class="bg-gray-800 shadow-md p-6 rounded-lg">
        <h2 class="text-2xl font-semibold mb-4">💡 Skills</h2>
        
        <ul class="flex flex-wrap gap-2">
          <li v-for="(skill, index) in form.skills" :key="index" class="bg-gray-700 px-3 py-1 rounded-full flex items-center">
            <span class="mr-2">{{ skill }}</span>
            <button type="button" class="text-red-400" @click="removeSkill(index)">&times;</button>
          </li>
        </ul>

        <div class="mt-4 flex space-x-2">
          <input v-model="newSkill" class="border p-2 rounded-lg flex-grow bg-gray-700 text-gray-200 border-gray-600" placeholder="Add a skill" />
          <button type="button" class="bg-green-500 text-white px-4 py-2 rounded" @click="addSkill">Add</button>
        </div>
      </section>
      <!-- Awards & Certificates Section -->
      <section class="bg-gray-800 shadow-md p-6 rounded-lg">
        <h2 class="text-2xl font-semibold mb-4">Awards & Certificates</h2>
        
        <ul v-if="awards && awards.length > 0">
          <li v-for="(award, index) in awards" :key="index" class="mb-6 p-4 bg-gray-700 rounded-lg shadow-md flex justify-between items-start">
            <div class="flex-grow">
              <div class="space-y-2">
                <!-- Edit/Save toggle -->
                <div v-if="award.isEditing">
                  <!-- Editable Fields -->
                  <input v-model="award.award_name" class="w-full p-2 mb-2 border rounded-lg bg-gray-600 text-gray-200 border-gray-500" placeholder="Award Name" />
                  <input v-model="award.company" class="w-full p-2 mb-2 border rounded-lg bg-gray-600 text-gray-200 border-gray-500" placeholder="Issuing Company" />
                  <input v-model="award.expiration" type="date" class="w-full p-2 mb-2 border rounded-lg bg-gray-600 text-gray-200 border-gray-500" placeholder="Expiration Date" />
                  <input v-model="award.cert_link" class="w-full p-2 mb-2 border rounded-lg bg-gray-600 text-gray-200 border-gray-500" placeholder="Link to Certificate" />
                </div>

                <!-- Read-only fields when not editing -->
                <div v-else>
                  <p class="text-gray-300 font-bold">{{ award.award_name }}</p>
                  <p class="text-gray-300">Issued by: {{ award.company }}</p>
                  <p v-if="award.expiration" class="text-gray-300">Expires: {{ award.expiration }}</p>
                  <a v-if="award.cert_link" :href="award.cert_link" target="_blank" class="text-blue-400 hover:underline">View Certificate</a>
                </div>

                <!-- Award Image -->
                <div v-if="award.photo" class="mt-2">
                  <img :src="getImageUrl(award.photo)" alt="Award Photo" class="max-w-xs rounded shadow-lg" />
                </div>
              </div>
            </div>

            <!-- Buttons -->
            <div class="flex items-center space-x-3">
              <!-- Edit Button -->
              <button 
                v-if="!award.isEditing" 
                class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600"
                @click="editAward(index)"
              >
                Edit
              </button>

              <!-- Save Button -->
              <button 
                v-if="award.isEditing" 
                class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600"
                @click="saveAward(index)"
              >
                Save
              </button>

              <!-- Delete Button (UI only) -->
              <button 
                type="button" 
                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"
                @click="removeAward(index)"
              >
                Delete
              </button>
            </div>
          </li>
        </ul>

        <p v-else class="text-gray-400 italic">No awards available yet.</p>

        <!-- Add New Award Form -->
        <div class="mt-6">
          <input v-model="newAward.name" class="w-full p-3 mb-4 border rounded-lg bg-gray-700 text-gray-200 border-gray-600" placeholder="Award name" />
          <input v-model="newAward.company" class="w-full p-3 mb-4 border rounded-lg bg-gray-700 text-gray-200 border-gray-600" placeholder="Issuing Company" />
          <input v-model="newAward.expiration" type="date" class="w-full p-3 mb-4 border rounded-lg bg-gray-700 text-gray-200 border-gray-600" placeholder="Expiration Date" />
          <input v-model="newAward.link" class="w-full p-3 mb-4 border rounded-lg bg-gray-700 text-gray-200 border-gray-600" placeholder="Link to certificate" />
          <input type="file" class="w-full p-3 mb-4 border rounded-lg bg-gray-700 text-gray-200 border-gray-600" accept="image/*" @change="handleImageUpload" />
          <button type="button" class="bg-green-500 text-white px-4 py-2 rounded w-full mt-4" @click="addAward">Add Award</button>
        </div>
      </section>

      <!-- Portfolio Section -->
      <section class="bg-gray-800 shadow-md p-6 rounded-lg">
        <h2 class="text-2xl font-semibold text-white mb-4">📂 Portfolio</h2>
        <p v-if="!form.portfolio.length" class="text-gray-400 italic">No projects added yet.</p>

        <ul v-else>
          <li 
            v-for="(project, index) in form.portfolio" 
            :key="index" 
            class="mb-4 p-4 bg-gray-700 rounded-lg shadow-md flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4"
          >
            <div class="flex-grow">
              <p class="text-lg text-white font-semibold">{{ project.project_name }}</p>
              <p class="text-gray-300 text-sm mb-2">{{ project.project_description }}</p>
              <div class="flex flex-wrap gap-2 mt-2">
                <span 
                  v-for="(lang, langIndex) in project.programming_language" 
                  :key="langIndex"
                  class="flex items-center gap-2 px-3 py-1 text-sm font-medium text-gray-900 bg-green-300 rounded-full"
                >
                  {{ lang.trim() }}
                  <button 
                    @click="removeLanguage(index, lang.trim())"
                    class="ml-1 text-red-600 hover:text-red-800"
                  >❌</button>
                </span>
              </div>
              <a 
                v-if="project.link" 
                :href="project.link" 
                target="_blank"
                class="inline-flex items-center gap-2 mt-3 px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white text-sm font-medium rounded-lg shadow-md transition"
              >
                <i class="fas fa-external-link-alt"></i> Visit Project
              </a>

              <!-- Project Image -->
            <div v-if="project.project_image" class="mb-4">
              <p>Rendering project: {{ project.project_name }}</p>
              <img 
                :src="getImageUrl(project.project_image)" 
                alt="Project Image" 
                class="w-full h-48 object-cover object-center rounded-lg shadow-md"
              />
            </div>
              <div v-else class="mb-4">
                <img src="/images/no-image.jpg" alt="No Image" class="w-full h-48 object-cover object-center rounded-lg shadow-md">
              </div>
            </div>

            <!-- Delete Project Button -->
            <button 
              type="button" 
              class="bg-red-500 hover:bg-red-600 transition p-2 rounded text-white flex items-center justify-center"
              @click="removeProject(index, project)"
            > DELETE</button>
          </li>
        </ul>



        <!-- Add New Project Form -->
        <div class="mt-6 bg-gray-700 p-6 rounded-lg shadow-md">
          <h3 class="text-white text-xl font-semibold mb-4">➕ Add New Project</h3>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="text-gray-300 block text-sm font-medium mb-1">Project Name</label>
              <input 
                v-model="newProject.project_name" 
                class="w-full border p-2 rounded-lg bg-gray-600 text-gray-200 border-gray-500 placeholder-gray-400 focus:ring-2 focus:ring-blue-400" 
                placeholder="Enter project name" 
              />
            </div>

            <div>
              <label class="text-gray-300 block text-sm font-medium mb-1">Project Description</label>
              <input 
                v-model="newProject.project_description" 
                class="w-full border p-2 rounded-lg bg-gray-600 text-gray-200 border-gray-500 placeholder-gray-400 focus:ring-2 focus:ring-blue-400" 
                placeholder="Short description" 
              />
            </div>

            <div>
              <label class="text-gray-300 block text-sm font-medium mb-1">Programming Languages</label>
              <input 
                v-model="newProject.programming_language" 
                class="w-full border p-2 rounded-lg bg-gray-600 text-gray-200 border-gray-500 placeholder-gray-400 focus:ring-2 focus:ring-blue-400" 
                placeholder="E.g. JavaScript, Vue, Laravel"
              />
            </div>

            <div>
              <label class="text-gray-300 block text-sm font-medium mb-1">Project Link (optional)</label>
              <input 
                v-model="newProject.link" 
                class="w-full border p-2 rounded-lg bg-gray-600 text-gray-200 border-gray-500 placeholder-gray-400 focus:ring-2 focus:ring-blue-400" 
                placeholder="https://example.com" 
              />
            </div>

            <div>
              <label class="text-gray-300 block text-sm font-medium mb-1">Project Image (optional)</label>
              <input
                type="file" 
                @change="handleImageUpload" 
                class="w-full border p-2 rounded-lg bg-gray-600 text-gray-200 border-gray-500 cursor-pointer file:mr-3 file:py-1 file:px-3 file:rounded-full file:border-none file:bg-blue-500 file:text-white file:font-medium hover:file:bg-blue-400"
              />
            </div>
          </div>

          <p v-if="errorMessage" class="text-red-400 text-sm mt-2">{{ errorMessage }}</p>
          <button 
            type="button" 
            class="mt-4 bg-green-500 hover:bg-green-600 transition px-5 py-2 rounded-lg text-white text-lg font-medium shadow-md w-full md:w-auto"
            @click="addProject"
          > Add Project</button>
        </div>
      </section>
      <button class="bg-green-500 text-white px-4 py-2 rounded w-full mt-6">{{ form.id ? "Update" : "Save" }}</button>
    </form>
  </div>
</template>



<script setup>
import axios from "axios";
import { onMounted, reactive, ref } from "vue";
import { useRouter } from "vue-router";
import Swal from "sweetalert2";


const router = useRouter();
const toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
});


const form = reactive({
  id: null,
  description: "",
  experiences: [],
  skills: [],
  awards: [],
  portfolio: [],
  start_year: [],
  end_year: []
});

const deletedExperiences = ref([]);
const deletedPortfolios = ref([]);
const deletedAwards = ref([]);
const awards = ref([]);
const newSkill = ref("");
const newAward = reactive({
  name: '',
  company: '',
  expiration: '',
  link: '',
  photo: null
});

const newProject = reactive({
  project_name: "",
  project_description: "",
  programming_language: "",
  link: "",
  project_image: null
});

const editAward = (index) => {
  awards.value[index].isEditing = true;
};

const saveAward = async (index) => {
  awards.value[index].isEditing = false;
};

let errors = ref([]);
const errorMessage = ref('');

const getAbout = async () => {
  try {
    let response = await axios.get("/api/abouts");

    if (response.data.abouts.length > 0) {
      form.id = response.data.abouts[0].id;
      form.description = response.data.abouts[0].description;
      form.skills = response.data.abouts[0].skills ? response.data.abouts[0].skills.split(',') : [];
    }

    console.log("Fetched Skills:", response.data.abouts[0].skills);
    console.log("Stored Skills in Form:", form.skills);
  } catch (error) {
    console.error("Error fetching about data:", error);
  }
};



const getExperience = async () => {
  try {
    let response = await axios.get("/api/experiences");

    console.log("Raw API Response:", response.data);

    if (!Array.isArray(response.data.experiences)) {
      console.error("Expected 'experiences' to be an array but got:", response.data);
      return;
    }

    form.experiences = response.data.experiences.map(exp => {
      console.log("Raw Experience:", exp); // Debug each item

      return {
        id: exp.id,
        position: exp.position,
        company: exp.company,
        start_month: exp.start_month || "",
        start_year: exp.start_year || "",
        end_month: exp.end_month || "",
        end_year: exp.end_year || ""
      };
    });


    console.log("Mapped Experiences:", form.experiences);
  } catch (error) {
    console.error("Error fetching experience data:", error);
  }
};

const getPortfolio = async () => {
  try {
    let response = await axios.get("/api/portfolios");

    console.log("API Response:", response.data); // Debugging

    if (!Array.isArray(response.data.portfolio)) {
      console.error("Expected 'portfolio' to be an array but got:", response.data);
      return;
    }
    
    console.log("Project Image Path:", response.data.portfolio.project_image);
    form.portfolio = response.data.portfolio.map(portfolio => ({
      id: portfolio.id,
      project_name: portfolio.project_name,
      project_description: portfolio.project_description,
      programming_language: portfolio.programming_language,
      link: portfolio.link,
      project_image: portfolio.project_image,
    }));

    console.log("Updated Portfolio Data:", form.portfolio);
  } catch (error) {
    console.error("Error fetching portfolio data:", error);
  }
};

// const getPortfolio = async () => {
//   try {
//     let response = await axios.get("/api/portfolios");

//     console.log("API Response:", response.data);

//     if (!Array.isArray(response.data.portfolio)) {
//       console.error("Expected 'portfolio' to be an array but got:", response.data);
//       return;
//     }

//     form.portfolio = response.data.portfolio.map(portfolio => ({
//       id: portfolio.id,
//       project_name: portfolio.project_name || "Unnamed Project",
//       project_description: portfolio.project_description || "No Description",
//       programming_language: portfolio.programming_language ? String(portfolio.programming_language).split(',') : [],
//       link: portfolio.link || null,
//       project_image: portfolio.project_image || "/images/no-image.jpg",
//     }));

//     form.portfolio = [...form.portfolio];

//     console.log("Updated Portfolio Data:", form.portfolio);
//   } catch (error) {
//     console.error("Error fetching portfolio data:", error);
//   }
// };

const getAwards = async () => {
  try {
    const response = await axios.get('/api/awards');
    console.log("API Response:", response.data);
    awards.value = response.data.awards.map(award => ({
        ...award,
        isEditing: false, // Add the property isEditing
        photo: award.photo // Add the photo url
    }));
    console.log("Fetched awards:", awards.value);
  } catch (error) {
    console.error("Error fetching awards:", error);
  }
};


const getImageUrl = (imagePath) => {
  console.log("Raw Image Path:", imagePath, "Type:", typeof imagePath);
  if (!imagePath || typeof imagePath !== 'string' || imagePath.trim() === "" || imagePath === "null") {
    return "/images/no-image.jpg";
  }

  if (imagePath.startsWith("portfolio-images/")) {
    return `/storage/${imagePath}`;
  }
  if (imagePath.startsWith("/storage")) {
    return imagePath;
  }
  return "/images/no-image.jpg";
};

const addExperience = () => {
  form.experiences.push({ position: "", company: "", start_month: "", start_year: "", end_month: "", end_year: "" });
};

const addSkill = () => { if (newSkill.value) { form.skills.push(newSkill.value); newSkill.value = ""; }};

const addAward = () => {
  if (!newAward.name.trim() || !newAward.company.trim()) {
    toast.fire({ icon: "error", title: "Award Name and Company are required!" });
    return;
  }
  awards.value.push({
    ...newAward,
    id: null, // When is a new award it doesn't have an id
    isEditing: false, // Initially not in editing mode
    photo: newAward.photo,
    award_name: newAward.name, // ✅ Add the correct parameter
    cert_link: newAward.link, // ✅ Add the correct parameter
  });
  newAward.name = '';
  newAward.company = '';
  newAward.expiration = '';
  newAward.link = '';
  newAward.photo = null;
  toast.fire({ icon: 'success', title: 'Award added to UI (not yet saved in DB).' });
};



const addProject = () => {
  const urlRegex = /^(ftp|http|https):\/\/[^ "]+$/; // Regex to check if it is a url

  if (!newProject.project_name.trim() && !newProject.project_description.trim()) {
    toast.fire({ icon: "error", title: "Please fill in all required project details." });
    return;
  }

  if (newProject.link && !urlRegex.test(newProject.link)) {
    toast.fire({ icon: "error", title: "Invalid URL format in link field!" });
    return;
  }

  form.portfolio.push({
    project_name: newProject.project_name,
    project_description: newProject.project_description,
    programming_language: newProject.programming_language || "", 
    link: newProject.link || null, 
    project_image: newProject.project_image || null, 
    id: null,
  });

  console.log("Project added successfully!");
};



const removeExperience = (index, experienceId) => {
  console.log("Marking experience for deletion:", experienceId);

  if (experienceId) {
    deletedExperiences.value.push(experienceId);
  }

  form.experiences.splice(index, 1);
};

const removeLanguage = (projectIndex, language) => {
  let project = form.portfolio[projectIndex];

  let updatedLanguages = project.programming_language
    ? project.programming_language.split(',')
        .map(lang => lang.trim())
        .filter(lang => lang !== language)
        .join(',')
    : '';

  form.portfolio[projectIndex].programming_language = updatedLanguages;
  
  toast.fire({ icon: "success", title: "Language removed (Save to apply changes)" });
};


const removeSkill = (index) => form.skills.splice(index, 1);


const removeAward = (index) => {
  if (awards.value[index].id) {
    deletedAwards.value.push(awards.value[index].id);
    console.log("Award marked for deletion:", awards.value[index].id);  // Log the ID
  }
  awards.value.splice(index, 1);
  toast.fire({ icon: 'success', title: 'Award removed from UI (not deleted from DB).' });
};


const removeProject = (index, project) => {
  console.log("Marking project for deletion:", project.id);

  if (project.id) {
    deletedPortfolios.value.push(project.id);
  }

  form.portfolio.splice(index, 1);

  toast.fire({ icon: "success", title: "Portfolio removed (Save to apply changes)" });
};

const months = [
  "January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];

const years = Array.from({ length: 101 }, (_, i) => 2025 - i);

const handleImageUpload = (event) => {
  const file = event.target.files[0];
  const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

  if (file && allowedTypes.includes(file.type)) {
    newAward.photo = file; // Save the file
    console.log("Award Image selected:", file);
  } else if(file){
    toast.fire({ icon: 'error', title: 'Invalid file type. Please select a JPG, PNG, or GIF image.' });
  }
};


const handleSave = async () => {
  try {
    const skillsString = form.skills.join(",");

    if (form.id) {
      await axios.put(`/api/abouts/${form.id}`, {
        description: form.description,
        skills: skillsString,
      });
      toast.fire({ icon: "success", title: "About updated successfully" });
    } else {
      const aboutResponse = await axios.post("/api/abouts", {
        description: form.description,
        skills: skillsString,
      });
      form.id = aboutResponse.data.id;
      toast.fire({ icon: "success", title: "About created successfully" });
    }

    if (deletedExperiences.value.length > 0) {
      await Promise.all(
        deletedExperiences.value.map((id) => axios.delete(`/api/experiences/${id}`))
      );
      deletedExperiences.value = [];
      toast.fire({ icon: "success", title: "Experiences deleted successfully" });
    }

    await Promise.all(
      form.experiences.map(async (exp) => {
        if (!exp.start_year || !exp.start_month || !exp.end_year || !exp.end_month) {
          toast.fire({ icon: "error", title: "Start and End Date are required!" });
          return;
        }

        const requestData = {
          position: exp.position,
          company: exp.company,
          start_year: exp.start_year,
          start_month: exp.start_month,
          end_year: exp.end_year,
          end_month: exp.end_month,
        };

        if (exp.id) {
          await axios.put(`/api/experiences/${exp.id}`, requestData);
        } else {
          await axios.post("/api/experiences", requestData);
        }
      })
    );

    toast.fire({ icon: "success", title: "Experiences saved successfully!" });

    await Promise.all(
      form.portfolio.map(async (proj) => {
        const formData = new FormData();
        formData.append("project_name", proj.project_name);
        formData.append("project_description", proj.project_description);
        formData.append("programming_language", proj.programming_language || "");

        if (proj.link) {
          formData.append("link", proj.link);
        }

        if (proj.project_image && typeof proj.project_image !== "string") {
          formData.append("project_image", proj.project_image);
        }

        await axios({
          method: proj.id ? "PUT" : "POST",
          url: proj.id ? `/api/portfolios/${proj.id}` : `/api/portfolios`,
          data: formData,
          headers: { "Content-Type": "multipart/form-data" },
        });
      })
    );

    toast.fire({ icon: "success", title: "Portfolio updated successfully!" });

    if (deletedPortfolios.value.length > 0) {
      await Promise.all(
        deletedPortfolios.value.map((id) => axios.delete(`/api/portfolios/${id}`))
      );
      deletedPortfolios.value = [];
      toast.fire({ icon: "success", title: "Portfolios deleted successfully" });
    }

    await Promise.all(
      awards.value
        .filter((award) => award.award_name && award.company) // Ensure required fields exist
        .map(async (award) => {
          const formData = new FormData();
          formData.append("award_name", award.award_name);
          formData.append("company", award.company);

          if (award.expiration) {
            formData.append("expiration", award.expiration);
          }

          if (award.cert_link) {
            formData.append("cert_link", award.cert_link);
          }

          if (award.photo && typeof award.photo !== "string") {
            formData.append("photo", award.photo);
          }

          if (award.id) {
            await axios.put(`/api/awards/${award.id}`, formData, {
              headers: { "Content-Type": "multipart/form-data" },
            });
          } else {
            const response = await axios.post("/api/awards", formData, {
              headers: { "Content-Type": "multipart/form-data" },
            });
            award.id = response.data.id;
          }
        })
    );


    toast.fire({ icon: "success", title: "Awards updated successfully!" });

  } catch (error) {
    handleAxiosError(error);
  }
};



const handleAxiosError = (error) => {
  console.error("Axios error:", error);

  if (error.response) {
    console.log("Full Server Response:", error.response.data);

    if (error.response.status === 422) {
      errors.value = error.response.data.errors;

      if(error.response.data.errors.link) {
        toast.fire({ icon: "error", title: "Invalid URL format in link field!" });
      }

      if(error.response.data.errors.project_name) {
        errorMessage.value = "Project name is required!";
      } else if(error.response.data.errors.project_description) {
        errorMessage.value = "Project description is required!";
      } 
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
  getExperience();
  getPortfolio();
  getAwards();
});
</script>