<div class="flex w-full relative" x-data="{ activeMenu: 'users', openSidebar: false }">
    <!-- Sidebar, visible only on medium and larger screens -->
    <x-sidebar x-bind:active-menu="activeMenu" />

    <div class="flex flex-col w-full relative">
        <!-- Navbar (Always visible) -->
        <x-navbar />

        <!-- Content Area -->
        <div class="flex-2 px-4 py-2 overflow-clip">
            <!-- Content based on activeMenu -->
            <template x-if="activeMenu === 'home'">
                <x-dashboard />
            </template>
            <template x-if="activeMenu === 'bolt'">
                <x-interventions />
            </template>
            <template x-if="activeMenu === 'landmark'">
                <x-plots />
            </template>
            <template x-if="activeMenu === 'users'">
                <x-agriculteurs />
            </template>
            <template x-if="activeMenu === 'gear'">
                <x-settings />
            </template>
        </div>
    </div>
</div>