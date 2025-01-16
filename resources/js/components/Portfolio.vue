<template>
    <div class="w-full h-[320vw] md:h-[63vw] bg-black p-6 md:p-20 overflow-hidden">
      <div class="text-4xl md:text-7xl font-bold text-white">My Portfolio</div>
  
      <div class="mt-10 md:mt-20 flex flex-col md:flex-row">
        <div class="relative md:w-1/2 p-2">
          <div class="absolute left-[31px] md:left-[36px] top-[30px] w-0.5 h-full bg-gray-700"></div>
          <div class="space-y-10 md:space-y-20 overflow-y-auto" style="max-height: calc(3 * 250px);">
            <div v-for="(project, index) in projects" :key="index" class="relative flex items-start group pb-10 md:pb-20 cursor-pointer" @click="selectProject(index)">
              <div class="relative z-10 flex h-[50px] w-[50px] md:h-[60px] md:w-[60px] items-center justify-center rounded-full":class="index === selectedProject ? 'bg-emerald-400' : 'bg-emerald-900'">
                <span class="text-xl md:text-2xl font-bold text-white">{{ index + 1 }}</span>
              </div>
              <div class="ml-6 md:ml-16 flex-1">
                <h2 :class="index === selectedProject ? 'text-white' : 'text-gray-600'" class="text-2xl md:text-4xl font-bold"> {{ project.title }} </h2>
                <div :class="index === selectedProject ? 'text-white' : 'text-gray-600'" class="text-base md:text-xl mt-2 md:mt-4 whitespace-pre-line">
                  {{ project.description }}
                </div>
              </div>
            </div>
          </div>
        </div>
  
        <div class="relative mt-10 md:mt-0 md:w-1/2">
          <div class="absolute md:top-[67vh] top-[34vh] z-20 flex justify-center md:justify-start">
            <div class="flex flex-row gap-2 md:gap-4">
              <div v-for="(hex, index) in projects[selectedProject].hexes" :key="index" class="text-center">
                <img src="hexW.svg" alt="hex" class="w-[20vw] md:w-[10vw]">
                <span class="text-white text-sm md:text-base mt-1 block">{{ hex }}</span>
              </div>
            </div>
          </div>
          <transition name="fade" mode="out-in">
            <div class="absolute top-0 w-[90vw] md:w-[45vw] z-10 mx-auto md:mx-0" :key="selectedProject">
              <img :src="projects[selectedProject].image" alt="Project Image" class="rounded-2xl">
            </div>
          </transition>
          <div class="absolute top-[10vw] left-[5vw] md:top-[5vw] md:left-[5vw]">
            <div class="w-[90vw] h-[90vw] md:w-[45vw] md:h-[45vw] bg-teal-300"></div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        selectedProject: 0,
        projects: [
          {
            title: "NATIVECAMP. WEB / IOS",
            description: " Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.",
            image: "dummy1.png",
            hexes: ["Vue.js", "Tailwind CSS", "Node.js"]
          },
          {
            title: "NATIVECAMP. WEB / IOS",
            description: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.",
            image: "dummy1.png",
            hexes: ["React", "Bootstrap", "HTML"]
          },
          {
            title: "NATIVECAMP. WEB / IOS",
            description: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.",
            image: "dummy1.png",
            hexes: ["C++", "Javascript", "MySQL"]
          },
          {
            title: "NATIVECAMP. WEB / IOS",
            description: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.",
            image: "dummy1.png",
            hexes: ["PHP", "Tailwind CSS", "Laravel"]
          },
          {
            title: "NATIVECAMP. WEB / IOS",
            description: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.",
            image: "dummy1.png",
            hexes: ["HTML", "Bootstrap", "Python"]
          }
        ]
      };
    },
    methods: {
      selectProject(index) {
        this.selectedProject = index;
      }
    }
  };
  </script>
  
  <style>
  .fade-enter-active, .fade-leave-active {
    transition: opacity 0.5s;
  }
  .fade-enter, .fade-leave-to {
    opacity: 0;
  }
  </style>
  