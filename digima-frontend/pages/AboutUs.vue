<script setup>
// Layout
definePageMeta({
  layout: "guest-layout",
});
</script>

<template>
  <div class="space-y-20">
    <div class="flex justify-center items-center space-x-10">
      <div class="flex flex-col space-y-8">
        <p class="text-7xl font-bold">ABOUT US</p>
        <p class="font-medium">
          LiveWell Marketing Corporation is a dynamic and innovative company
          dedicated to connecting individuals through the power of effective
          marketing. Our mission is to educate communities about health and
          wellness, providing access to quality products that enrich lives.
          Through our vibrant and supportive community, we foster an environment
          where members can thrive, gain valuable insights, and benefit from a
          myriad of resources.
        </p>
      </div>
      <!-- <Logo /> -->
      <Logo class="" />
    </div>

    <div class="grid grid-cols-2 gap-5">
      <Card>
        <div class="flex flex-col items-center justify-center space-y-4">
          <p class="text-2xl font-bold">MISSION</p>
          <p class="font-base ">
            For the time to come that LiveWell community will be known to be a
            community of entrepreneurs who are empowered to succeed, inspired to
            innovate, and committed to making a difference.
            Our mission is to connect individuals and empower them through
            education about health and wellness. We are dedicated to providing
            quality products that enhance the lives of our consumers while
            fostering a supportive community for entrepreneurs and youth.
            Together, we strive to inspire healthier lifestyles and create a
            network of support that uplifts and motivates everyone on their
            journey to well-being.
          </p>
        </div>
      </Card>
      <Card>
        <div class="flex flex-col items-center justify-center space-y-4">
          <p class="text-2xl font-bold">Vision</p>
          <p class="font-base">
            For the time to come that LiveWell community will be known to be a
            community of entrepreneurs who are empowered to succeed, inspired to
            innovate, and committed to making a difference.
          </p>
        </div>
      </Card>
    </div>
  </div>
</template>
