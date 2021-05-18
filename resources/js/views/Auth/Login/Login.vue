<template>
    <v-form
        class="mx-auto"
        ref="loginForm"
        style="max-width: 500px;"
        @keyup.enter.native="submit"
    >
        <h3
            class="mb-10 text-center"
            style="color: #f44336;"
        >
            Вход
        </h3>
        <v-text-field
            v-model="loginFormData.email"
            append-icon="mdi-account"
            color="red"
            dense
            :error-messages="loginFormErrors.email"
            label="Почта"
            outlined
        ></v-text-field>
        <v-text-field
            v-model="loginFormData.password"
            :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
            color="red"
            dense
            :error-messages="loginFormErrors.password"
            label="Пароль"
            outlined
            :type="showPassword ? 'text' : 'password'"
            @click:append="showPassword = !showPassword"
        ></v-text-field>
        <v-btn
            block
            class="text-capitalize"
            color="red"
            dark
            :loading="submitLoading"
            rounded
            @click="submit"
        >
            Войти
        </v-btn>
    </v-form>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Login',
  data() {
    return {
      showPassword: false,
      loginFormData: {
        email: '',
        password: '',
      },
      loginFormErrors: {
        email: '',
        password: '',
      },
      submitLoading: false,
    };
  },
  methods: {
    submit() {
      this.submitLoading = true;
      axios.post('/login', this.loginFormData).then(() => {
        window.location.href = '/';
      }).catch((error) => {
        if (error.response.status === 422) {
          this.loginFormErrors.email = error.response.data.errors.email;
          this.loginFormErrors.password = error.response.data.errors.password;
        } else {
          console.log(error.response);
        }
      }).finally(() => {
        this.submitLoading = false;
      });
    },
  },
};
</script>

<style scoped>

</style>
