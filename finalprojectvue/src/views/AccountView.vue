<template>
  <div class="container py-4 flex items-center gap-3">
        <a href="../index.html" class="text-primary text-base">
            <i class="fa-solid fa-house"></i>
        </a>
        <span class="text-sm text-gray-400">
            <i class="fa-solid fa-chevron-right"></i>
        </span>
        <p class="text-gray-600 font-medium">Account</p>
    </div>
    <div class="container grid grid-cols-12 items-start gap-6 pt-4 pb-16">

<!-- sidebar -->
<div class="col-span-3">
    <div class="px-4 py-3 shadow flex items-center gap-4">
        <div class="flex-shrink-0">
            <img src="../assets/images/avatar.png" alt="profile" class="rounded-full w-14 h-14 border border-gray-200 p-1 object-cover">
        </div>
        <div class="flex-grow">
            <p class="text-gray-600">Hello,</p>
            <h4 class="text-gray-800 font-medium">John Doe</h4>
        </div>
    </div>

    <div class="mt-6 bg-white shadow rounded p-4 divide-y divide-gray-200 space-y-4 text-gray-600">
        <div class="space-y-1 pl-8">
            <a href="#" class="relative text-primary block font-medium capitalize transition">
                <span class="absolute -left-8 top-0 text-base">
                    <i class="fa-regular fa-address-card"></i>
                </span>
                Manage account
            </a>
            <a href="#" class="relative hover:text-primary block capitalize transition">
                Profile information
            </a>
            <a href="#" class="relative hover:text-primary block capitalize transition">
                Manage addresses
            </a>
            <a href="#" class="relative hover:text-primary block capitalize transition">
                Change password
            </a>
        </div>

        <div class="space-y-1 pl-8 pt-4">
            <a href="#" class="relative hover:text-primary block font-medium capitalize transition">
                <span class="absolute -left-8 top-0 text-base">
                    <i class="fa-solid fa-box-archive"></i>
                </span>
                My order history
            </a>
            <a href="#" class="relative hover:text-primary block capitalize transition">
                My returns
            </a>
            <a href="#" class="relative hover:text-primary block capitalize transition">
                My Cancellations
            </a>
            <a href="#" class="relative hover:text-primary block capitalize transition">
                My reviews
            </a>
        </div>

        <div class="space-y-1 pl-8 pt-4">
            <a href="#" class="relative hover:text-primary block font-medium capitalize transition">
                <span class="absolute -left-8 top-0 text-base">
                    <i class="fa-regular fa-credit-card"></i>
                </span>
                Payment methods
            </a>
            <a href="#" class="relative hover:text-primary block capitalize transition">
                voucher
            </a>
        </div>

        <div class="space-y-1 pl-8 pt-4">
            <a href="#" class="relative hover:text-primary block font-medium capitalize transition">
                <span class="absolute -left-8 top-0 text-base">
                    <i class="fa-regular fa-heart"></i>
                </span>
                My wishlist
            </a>
        </div>

        <div class="space-y-1 pl-8 pt-4">
            <a href="#" class="relative hover:text-primary block font-medium capitalize transition">
                <span class="absolute -left-8 top-0 text-base">
                    <i class="fa-regular fa-arrow-right-from-bracket"></i>
                </span>
                Logout
            </a>
        </div>

    </div>
</div>
<!-- ./sidebar -->

<!-- info -->
<div class="col-span-9 grid grid-cols-3 gap-4">

    <div class="shadow rounded bg-white px-4 pt-6 pb-8">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-medium text-gray-800 text-lg">Personal Profile</h3>
            <a href="#" class="text-primary">Edit</a>
        </div>
        <div class="space-y-1">
            <h4 class="text-gray-700 font-medium">John Doe</h4>
            <p class="text-gray-800">example@mail.com</p>
            <p class="text-gray-800">0811 8877 988</p>
        </div>
    </div>

    <div class="shadow rounded bg-white px-4 pt-6 pb-8">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-medium text-gray-800 text-lg">Shipping address</h3>
            <a href="#" class="text-primary">Edit</a>
        </div>
        <div class="space-y-1">
            <h4 class="text-gray-700 font-medium">John Doe</h4>
            <p class="text-gray-800">Medan, North Sumatera</p>
            <p class="text-gray-800">20371</p>
            <p class="text-gray-800">0811 8877 988</p>
        </div>
    </div>

    <div class="shadow rounded bg-white px-4 pt-6 pb-8">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-medium text-gray-800 text-lg">Billing address</h3>
            <a href="#" class="text-primary">Edit</a>
        </div>
        <div class="space-y-1">
            <h4 class="text-gray-700 font-medium">John Doe</h4>
            <p class="text-gray-800">Medan, North Sumatera</p>
            <p class="text-gray-800">20317</p>
            <p class="text-gray-800">0811 8877 988</p>
        </div>
    </div>

</div>
<!-- ./info -->

</div>
</template>
