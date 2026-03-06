    <!--sidenav -->
    <div class="fixed left-0 top-0 w-64 h-full bg-[#f8f4f3] p-4 z-50 sidebar-menu transition-transform">
        <a href="#" class="flex items-center pb-4 border-b border-b-gray-800">

            <h2 class="font-bold text-2xl">LOREM <span class="bg-[#f84525] text-white px-2 rounded-md">IPSUM</span></h2>
        </a>
        <ul class="mt-4">
            <span class="text-gray-400 font-bold mt-4">ADMIN</span>

            <li class="mb-1 space-y-2">
                <a href="/dashboard"
                class="flex font-semibold items-center py-2 px-4 rounded-md
                {{ request()->is('dashboard') 
                        ? 'bg-gray-950 text-white' 
                        : 'text-gray-900 hover:bg-gray-950 hover:text-gray-100' }}">
                    
                    <i class="fa-sharp fa-solid fa-house-chimney mr-3"></i>
                    <span class="text-sm">Dashboard</span>
                </a>

                <a href="/dashboard/category"
                class="flex font-semibold items-center py-2 px-4 rounded-md
                {{ request()->is('dashboard/category*') 
                        ? 'bg-gray-950 text-white' 
                        : 'text-gray-900 hover:bg-gray-950 hover:text-gray-100' }}">
                    
                    <i class="fa-solid fa-list-dropdown mr-3"></i>
                    <span class="text-sm">Category</span>
                </a>

                <a href="/dashboard/author"
                class="flex font-semibold items-center py-2 px-4 rounded-md
                {{ request()->is('dashboard/author*') 
                        ? 'bg-gray-950 text-white' 
                        : 'text-gray-900 hover:bg-gray-950 hover:text-gray-100' }}">
                    
                    <i class="fa-solid fa-address-book mr-3"></i>
                    <span class="text-sm">Author</span>
                </a>

                <a href="/dashboard/user"
                class="flex font-semibold items-center py-2 px-4 rounded-md
                {{ request()->is('dashboard/user*') 
                        ? 'bg-gray-950 text-white' 
                        : 'text-gray-900 hover:bg-gray-950 hover:text-gray-100' }}">
                    
                    <i class="fa-utility-fill fa-semibold fa-users mr-3"></i>
                    <span class="text-sm">User</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden sidebar-overlay"></div>
    <!-- end sidenav -->