<template>
    <div class="w-full h-[260vw] md:h-[63vw] bg-black p-6 md:p-20 overflow-hidden">
        <div class="text-4xl md:text-7xl font-bold text-white">My Portfolio</div>
        <div class="mt-10 md:mt-20 flex flex-col md:flex-row">
            <div class="relative md:w-1/2">
                <div class="absolute left-[15px] md:left-[30px] top-[30px] w-0.5 h-[calc(90%-60px)] bg-gray-700"></div>
                <div class="space-y-10 md:space-y-20">
                    <div class="relative flex items-start group pb-10 md:pb-20">
                        <div class="relative z-10 flex h-[50px] w-[50px] md:h-[60px] md:w-[60px] items-center justify-center rounded-full bg-emerald-900">
                            <span class="text-xl md:text-2xl font-bold text-white">1</span>
                        </div>
                        <div class="ml-6 md:ml-16 flex-1">
                            <h2 class="text-2xl md:text-4xl font-bold text-gray-600">NATIVECAMP. WEB / IOS</h2>
                            <div class="text-base md:text-xl mt-2 md:mt-4 text-gray-600 whitespace-pre-line">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                            </div>
                        </div>
                    </div>

                    <div class="relative flex items-start group pb-10 md:pb-20">
                        <div class="relative z-10 flex h-[50px] w-[50px] md:h-[60px] md:w-[60px] items-center justify-center rounded-full bg-emerald-400">
                            <span class="text-xl md:text-2xl font-bold text-white">2</span>
                        </div>
                        <div class="ml-6 md:ml-16   flex-1">
                            <h2 class="text-2xl md:text-4xl font-bold text-white">MACHETALK WEB / IOS</h2>
                            <div class="text-base md:text-xl mt-2 md:mt-4 text-white whitespace-pre-line">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                            </div>
                        </div>
                    </div>

                    <div class="relative flex items-start group">
                        <div class="relative z-10 flex h-[50px] w-[50px] md:h-[60px] md:w-[60px] items-center justify-center rounded-full bg-emerald-900">
                            <span class="text-xl md:text-2xl font-bold text-white">3</span>
                        </div>
                        <div class="ml-6 md:ml-16 flex-1">
                            <h2 class="text-2xl md:text-4xl font-bold text-gray-600">NATIVECAMP. WEB / IOS</h2>
                            <div class="text-base md:text-xl mt-2 md:mt-4 text-gray-600 whitespace-pre-line">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="relative mt-10 md:mt-0 md:w-1/2">
                <div class="absolute md:top-[67vh] top-[34vh] z-20 flex justify-center md:justify-start">
                    <div class="flex flex-row gap-2 md:gap-4">
                        <div>
                            <img src="hexW.svg" alt="hex" class="w-[20vw] md:w-[10vw]">
                        </div>
                        <div>
                            <img src="hexW.svg" alt="hex" class="w-[20vw] md:w-[10vw]">
                        </div>
                        <div>
                            <img src="hexW.svg" alt="hex" class="w-[20vw] md:w-[10vw]">
                        </div>
                    </div>
                </div>
                <div class="absolute top-[0vw] w-[90vw] md:w-[45vw] z-10 mx-auto md:mx-0">
                    <img src="dummy1.png" alt="t" class="rounded-2xl">
                </div>
                <div class="absolute top-[10vw] left-[5vw] md:top-[5vw] md:left-[5vw]">
                    <div class="w-[90vw] h-[90vw] md:w-[45vw] md:h-[45vw] bg-teal-300"></div>
                </div>
            </div>
        </div>
    </div>
</template>
