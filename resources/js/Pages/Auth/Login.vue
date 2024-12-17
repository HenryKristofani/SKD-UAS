<template>
  <main class="flex flex-col text-base rounded-none max-w-[400px] mx-auto">
    <h1 class="z-10 self-center mt-0 text-3xl font-semibold text-center text-neutral-900">
      Login
    </h1>
    <form @submit.prevent="handleSubmit">
      <div class="mt-12">
        <label for="email" class="block text-sm font-medium tracking-wide leading-snug text-neutral-900">
          Email address
        </label>
        <input
          id="email"
          type="email"
          v-model="email"
          required
          class="w-full gap-2.5 self-stretch px-3 pt-3 pb-3 mt-1 tracking-wide leading-snug rounded bg-zinc-100 text-neutral-900"
          placeholder="Email address"
        />
      </div>
      <div class="mt-5">
        <label for="password" class="block text-sm font-medium tracking-wide leading-snug text-neutral-900">
          Password
        </label>
        <input
          id="password"
          type="password"
          v-model="password"
          required
          class="w-full gap-2.5 self-stretch px-3 pt-3 pb-3 mt-1 tracking-wide leading-snug rounded bg-zinc-100 text-neutral-900"
          placeholder="Password"
        />
      </div>
      
      <!-- Add reCAPTCHA with explicit sitekey -->
      <div class="mt-5 flex justify-center">
        <div 
          class="g-recaptcha" 
          :data-sitekey="recaptchaSiteKey"
          ref="recaptcha"
        ></div>
      </div>
      
      <button 
        type="submit" 
        class="w-full gap-2.5 self-stretch px-5 py-3 mt-5 font-medium tracking-wide leading-none text-white bg-cyan-700 rounded-md"
      >
        Login
      </button>
    </form>
  </main>
</template>

<script>
export default {
  props: {
    recaptchaSiteKey: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      email: '',
      password: '',
    };
  },
  mounted() {
    // Load reCAPTCHA script
    const script = document.createElement('script');
    script.src = 'https://www.google.com/recaptcha/api.js';
    script.async = true;
    script.defer = true;
    document.head.appendChild(script);
  },
  methods: {
    async handleSubmit() {
      // Get reCAPTCHA response
      const recaptchaResponse = window.grecaptcha.getResponse();
      
      if (!recaptchaResponse) {
        alert('Please complete the reCAPTCHA');
        return;
      }
      
      try {
        const response = await fetch('/login', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify({
            email: this.email,
            password: this.password,
            'g-recaptcha-response': recaptchaResponse
          })
        });

        const data = await response.json();

        if (response.ok && data.success) {
          // Redirect based on role
          window.location.href = data.redirect;
        } else {
          alert(data.message || 'Login failed');
        }
        
        // Reset reCAPTCHA
        window.grecaptcha.reset();
      } catch (error) {
        console.error(error);
        alert('An error occurred while trying to log in.');
        
        // Reset reCAPTCHA
        window.grecaptcha.reset();
      }
    }
  }
};
</script>