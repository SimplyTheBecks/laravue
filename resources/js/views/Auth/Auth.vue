<template>
    <v-app
        id="auth"
    >
        <v-app-bar
            app
            color="red"
            dark
        >
            <v-toolbar-title>LaraVue</v-toolbar-title>
        </v-app-bar>
        <v-main>
            <v-container
                class="my-10"
                fluid
            >
                <router-view></router-view>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
export default {
  name: 'Auth',
};
</script>

<style
    scoped
>

</style>
