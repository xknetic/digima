<script setup>
import { useRoute } from "vue-router";
// Layout
definePageMeta({
  layout: "guest-layout",
});

const route = useRoute();

// Fetching the API
const { data: items } = await useFetch("http://127.0.0.1:8000/api/Items");
const { data: slots } = await useFetch("http://127.0.0.1:8000/api/Slots");

const getItem = items.value.filter((item) => item.item_id == route.params.id);

const handleError = ref(null);

const slotName = computed(() => {
  return (
    slots.value?.find((slot) => !slot.slot_username.includes("-"))?.slot_id ||
    null
  );
});

// console.log(slotName.value);

const form = ref({
  item_id: getItem[0].item_id,
  cart_quantity: 1,
  slot_id: slotName.value,
});

const submitForm = async (event) => {
  event.preventDefault();

  const cart = JSON.parse(localStorage.getItem("cart")) || [];

  try {
    const itemInCart = cart.find((item) => item.item_id == form.value.item_id);

    if (itemInCart) {
      itemInCart.cart_quantity += form.value.cart_quantity;

      const result = await $fetch("http://127.0.0.1:8000/api/Carts/28", {
        method: "PUT",
        body: {cart_quantity: itemInCart.cart_quantity},
      });
    } else {
      cart.push({
        item_id: form.value.item_id,
        cart_quantity: form.value.cart_quantity,
        slot_id: form.value.slot_id,
      });

      const result = await $fetch("http://127.0.0.1:8000/api/Carts", {
        method: "POST",
        body: {
          item_id: form.value.item_id,
          cart_quantity: form.value.cart_quantity,
          slot_id: form.value.slot_id,
        },
      });
    }

    localStorage.setItem("cart", JSON.stringify(cart));

    console.log("Form data saved to localStorage:", form.value);
  } catch (error) {
    handleError.value = "Error saving data to localStorage.";
    console.error("Error:", error);
  }
};
</script>

<template>
  <div class="flex flex-col space-y-20">
    <div
      class="flex justify-center items-center space-x-10"
      v-for="item in getItem"
      :key="item.id"
    >
      <div class="bg-white shadow-md rounded-lg p-4">
        <Logo />
      </div>
      <div class="flex flex-col space-y-10 w-lg">
        <div class="flex flex-col space-y-2">
          <a href="" class="text-base font-semibold">{{ item.item_type }}</a>
          <div>
            <p class="text-2xl font-bold">{{ item.item_sku }}</p>
            <!-- <p class="text-sm font-bold">1 Capsule</p> -->
          </div>
          <div class="flex flex-end text-lg justify-between">
            <p>₱ {{ item.item_price }}</p>
            <p>★★★★★</p>
          </div>
        </div>

        <div>
          <!-- <p class="text-base font-bold">{{ item_description }}</p> -->
          <hr class="h-px w-full my-2 bg-slate-200 border-0" />
          <p class="text-sm font-medium">
            {{ item.item_thumbnail }}
          </p>
        </div>

        <PrimaryButton> Add to Cart</PrimaryButton>
        <button @click="submitForm">Add to Cart</button>
      </div>
    </div>

    <!-- You Might Also Like -->
    <div class="">
      <p class="text-2xl font-medium">You Might Also Like</p>
      <div class="flex space-x-4">
        <NuxtLink>
          <Card>
            <div class="flex flex-col space-y-4">
              <Logo class="w-auto h-50" />
              <div>
                <p class="text-lg font-bold">Pharma Zinc</p>
                <p class="text-md font-base text-gray-500">Trial Package</p>
                <p class="text-md font-medium">₱ 500.00</p>
              </div>
            </div>
          </Card>
        </NuxtLink>
      </div>
    </div>
  </div>
</template>
