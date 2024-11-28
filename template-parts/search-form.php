<div>
    <form id="searchProvidersForm"  class="sm:bg-gray-100 rounded-2xl shadow-xl w-full sm:w-auto" method="post" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <div class="relative sm:flex-row flex-col gap-2 flex sm:pl-3 items-center w-full m-auto serch_form">
            <div class="flex items-center bg-gray-100 w-full border border-gray-300 sm:border-none">
                <svg
                    stroke="currentColor"
                    fill="none"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="absolute text-2xl sm:text-3xl ml-2 sm:ml-1 text-[#6041BB]"
                    height="1em"
                    width="1em"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                    <circle cx="12" cy="10" r="3"></circle>
                </svg>
                <input type="text" placeholder="Enter Zip Code" maxlength="5" id="zip_code" name="zip_code" class="w-full py-3 sm:py-5 pl-10 pr-8 outline-none md:w-80 bg-transparent rounded-l-md" value="" />
            </div>
            <div class="flex sm:flex-row flex-col gap-2 w-full sm:gap-0">
                <div class="flex flex-col justify-center w-full bg-gray-100">
                    <div class="relative sm:max-w-xl sm:mx-auto border border-gray-300 sm:border-none">
                        <div class="w-full sm:w-64">
                            <div class="mt-1 relative sm:border-l-[2px] border-gray-300">
                                <input type="hidden" name="customSelect" id="customSelect" class="bg-transparent" value="internet" />
                                <button type="button" id="dropdownButton" class="transition-all relative w-full bg-transparent rounded-md pl-3 pr-10 pb-[10px] py-1.5 sm:py-3 text-left cursor-pointer sm:text-sm">
                                    <span class="flex items-center">
                                        <span id="dropdownSelected" class="ml-3 block text-lg font-semibold truncate">-- Select Option --</span>
                                    </span>
                                    <span class="ml-3 absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path
                                                fill-rule="evenodd"
                                                d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                clip-rule="evenodd"
                                            ></path>
                                        </svg>
                                    </span>
                                </button>
                                <!-- Dropdown Menu -->
                                <div id="dropdownMenu" class="absolute mt-2 overflow-hidden sm:mt-1 w-full z-10 bg-gray-100 sm:rounded-b-2xl border border-gray-300 sm:border-none hidden">
                                    <ul class="max-h-56 rounded-md py-1 text-base overflow-auto focus:outline-none sm:text-sm">
                                        <li class="text-gray-900 cursor-pointer hover:bg-[#EF9831] hover:text-white select-none relative py-2 pl-3 pr-9" data-value="internet" data-title="Internet">
                                            <div class="flex items-center">
                                                <span class="ml-3 block font-normal truncate">Internet</span>
                                            </div>
                                        </li>
                                        <li class="text-gray-900 cursor-pointer hover:bg-[#EF9831] hover:text-white select-none relative py-2 pl-3 pr-9" data-value="tv" data-title="TV">
                                            <div class="flex items-center">
                                                <span class="ml-3 block font-normal truncate">TV</span>
                                            </div>
                                        </li>
                                        <li class="text-gray-900 cursor-pointer hover:bg-[#EF9831] hover:text-white select-none relative py-2 pl-3 pr-9" data-value="internet-tv" data-title="internet-tv">
                                            <div class="flex items-center">
                                                <span class="ml-3 block font-normal truncate">Internet & TV</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="px-3 md:px-8 py-3 sm:py-[20px] w-full font-semibold text-white bg-[#6041BB] border-[#6041BB] sm:rounded-br-2xl sm:rounded-r-2xl" type="submit">Search</button>
            </div>
        </div>
    </form>
</div>

