<template>
    <div class="min-h-screen bg-gray-900 text-gray-200 p-6 space-y-8">
      <header class="text-center">
        <h1 class="text-4xl font-bold text-gray-100">Admin Page</h1>
        <p class="text-gray-400">Lester Ag Padul's Portfolio</p>
      </header>
  
      <section class="bg-gray-800 shadow-md p-6 rounded-lg">
        <h2 class="text-2xl font-semibold mb-4">About</h2>
        <textarea class="w-full p-2 border rounded-lg resize-none bg-gray-700 text-gray-200 border-gray-600" rows="4" readonly>A Performance-driven Developer possessing 5 years of extensive industry experience in Web and iOS development. Adept in developing products for web design, mobile apps, user experience, best practices, and speed.</textarea>
      </section>
  
      <section class="bg-gray-800 shadow-md p-6 rounded-lg">
        <h2 class="text-2xl font-semibold mb-4">Experience</h2>

        <textarea class="w-full p-2 border rounded-lg resize-none bg-gray-700 text-gray-200 border-gray-600" rows="4" readonly>A Performance-driven Developer possessing 5 years of extensive industry experience in Web and iOS development. Adept in developing products for web design, mobile apps, user experience, best practices, and speed.</textarea>
        <ul>
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
          <li class="bg-gray-700 px-3 py-1 rounded-full flex items-center">
            <span class="mr-2">PHP</span>
            <button class="text-red-400">&times;</button>
          </li>
          <li class="bg-gray-700 px-3 py-1 rounded-full flex items-center">
            <span class="mr-2">HTML</span>
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
      </section>
    </div>
  </template>
  