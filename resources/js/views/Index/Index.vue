<template>
    <v-app
        id="index"
    >
        <v-app-bar
            app
            color="red"
            dark
        >
            <v-toolbar-title>LaraVue</v-toolbar-title>
            <template
                v-slot:extension
            >
                <v-tabs
                    align-with-title
                >
                    <v-tab
                        link
                        to="/employees"
                    >
                        Сотрудники
                    </v-tab>
                </v-tabs>
            </template>
            <v-spacer></v-spacer>
            {{ userName }}
            <v-avatar
                class="ml-4"
                color="white"
                size="55"
            >
            </v-avatar>
            <v-menu
                offset-y
            >
                <template
                    v-slot:activator="{ on }"
                >
                    <v-btn
                        v-on="on"
                        icon
                    >
                        <v-icon>mdi-chevron-down</v-icon>
                    </v-btn>
                </template>
                <v-list>
                    <v-list-item
                        link
                        @click="logout"
                    >
                        <v-list-item-title>Выйти</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>
        </v-app-bar>
        <v-main>
            <v-container
                fluid
            >
                <router-view></router-view>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Index',
  methods: {
    logout() {
      axios.post('/logout').then(() => {
        window.location = '/';
      });
    },
  },
  computed: {
    userName() {
      const userName = document.head.querySelector('meta[name="user-name"]');
      return userName.content;
    },
  },
};
</script>

<style
    scoped
>

</style>
