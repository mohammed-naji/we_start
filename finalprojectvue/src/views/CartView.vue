<template>
  <div class="container py-4 flex items-center gap-3">
    <a href="../index.html" class="text-primary text-base">
      <i class="fa-solid fa-house"></i>
    </a>
    <span class="text-sm text-gray-400">
      <i class="fa-solid fa-chevron-right"></i>
    </span>
    <p class="text-gray-600 font-medium">Profile</p>
  </div>

  <div class="container grid grid-cols-12 items-start gap-6 pt-4 pb-16">


    <!-- wishlist -->
    <div class="col-span-12 space-y-4">
      <div
        class="
          flex
          items-center
          justify-between
          border
          gap-6
          p-4
          border-gray-200
          rounded
        "
      >
        <div class="w-28">
          <img
            src="../assets/images/products/product6.jpg"
            alt="product 6"
            class="w-full"
          />
        </div>
        <div class="w-1/3">
          <h2 class="text-gray-800 text-xl font-medium uppercase">
            Italian L shape
          </h2>
          <p class="text-gray-500 text-sm">
            Availability: <span class="text-green-600">In Stock</span>
          </p>
        </div>
        <div class="text-primary text-lg font-semibold">$320.00</div>
        <a
          href="#"
          class="
            px-6
            py-2
            text-center text-sm text-white
            bg-primary
            border border-primary
            rounded
            hover:bg-transparent hover:text-primary
            transition
            uppercase
            font-roboto font-medium
          "
          >add to cart</a
        >

        <div class="text-gray-600 cursor-pointer hover:text-primary">
          <i class="fa-solid fa-trash"></i>
        </div>
      </div>

      <div
        class="
          flex
          items-center
          justify-between
          border
          gap-6
          p-4
          border-gray-200
          rounded
        "
      >
        <div class="w-28">
          <img
            src="../assets/images/products/product5.jpg"
            alt="product 6"
            class="w-full"
          />
        </div>
        <div class="w-1/3">
          <h2 class="text-gray-800 text-xl font-medium uppercase">
            Dining Table
          </h2>
          <p class="text-gray-500 text-sm">
            Availability: <span class="text-green-600">In Stock</span>
          </p>
        </div>
        <div class="text-primary text-lg font-semibold">$320.00</div>
        <a
          href="#"
          class="
            px-6
            py-2
            text-center text-sm text-white
            bg-primary
            border border-primary
            rounded
            hover:bg-transparent hover:text-primary
            transition
            uppercase
            font-roboto font-medium
          "
          >add to cart</a
        >

        <div class="text-gray-600 cursor-pointer hover:text-primary">
          <i class="fa-solid fa-trash"></i>
        </div>
      </div>

      <div
        class="
          flex
          items-center
          justify-between
          border
          gap-6
          p-4
          border-gray-200
          rounded
        "
      >
        <div class="w-28">
          <img
            src="../assets/images/products/product10.jpg"
            alt="product 6"
            class="w-full"
          />
        </div>
        <div class="w-1/3">
          <h2 class="text-gray-800 text-xl font-medium uppercase">Sofa</h2>
          <p class="text-gray-500 text-sm">
            Availability: <span class="text-red-600">Out of Stock</span>
          </p>
        </div>
        <div class="text-primary text-lg font-semibold">$320.00</div>
        <a
          href="#"
          class="
            cursor-not-allowed
            px-6
            py-2
            text-center text-sm text-white
            bg-red-400
            border border-red-400
            rounded
            transition
            uppercase
            font-roboto font-medium
          "
          >add to cart</a
        >

        <div class="text-gray-600 cursor-pointer hover:text-primary">
          <i class="fa-solid fa-trash"></i>
        </div>
      </div>
    </div>
    <!-- ./wishlist -->
  </div>
</template>
