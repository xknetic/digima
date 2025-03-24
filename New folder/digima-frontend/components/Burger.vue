<style scoped>
  /* Hide the default checkbox */
  .container input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
  }

  .container {
    display: block;
    position: relative;
    cursor: pointer;
    font-size: 16px;

    user-select: none;
  }

    .checkmark {
        position: relative;
        top: 0;
        left: 0;
        height: 1em;
        width: 1em;

  }

    .checkmark span {
        width: 24px;
        height: 2px;

    background-color: black;
    position: absolute;
    transition: all 0.3s ease-in-out;
    -webkit-transition: all 0.3s ease-in-out;
    -moz-transition: all 0.3s ease-in-out;
    -ms-transition: all 0.3s ease-in-out;
    -o-transition: all 0.3s ease-in-out;
  }

  .checkmark span:nth-child(1) {
    top: 10%;
  }

  .checkmark span:nth-child(2) {
    top: 50%;
  }

  .checkmark span:nth-child(3) {
    top: 90%;
  }

  .container input:checked + .checkmark span:nth-child(1) {
    top: 50%;
    transform: translateY(-50%) rotate(45deg);
    -webkit-transform: translateY(-50%) rotate(45deg);
    -moz-transform: translateY(-50%) rotate(45deg);
    -ms-transform: translateY(-50%) rotate(45deg);
    -o-transform: translateY(-50%) rotate(45deg);
  }

  .container input:checked + .checkmark span:nth-child(2) {
    top: 50%;
    transform: translateY(-50%) rotate(-45deg);
    -webkit-transform: translateY(-50%) rotate(-45deg);
    -moz-transform: translateY(-50%) rotate(-45deg);
    -ms-transform: translateY(-50%) rotate(-45deg);
    -o-transform: translateY(-50%) rotate(-45deg);
  }

  .container input:checked + .checkmark span:nth-child(3) {
    transform: translateX(-50px);
    -webkit-transform: translateX(-50px);
    -moz-transform: translateX(-50px);
    -ms-transform: translateX(-50px);
    -o-transform: translateX(-50px);
    opacity: 0;
  }
</style>

<template>
  <label class="container w-6">
    <input type="checkbox">
    <div class="checkmark">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </label>
</template>
