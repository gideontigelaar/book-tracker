import { createRouter, createWebHistory } from "vue-router";
import Overview from "../components/Overview.vue";
import Add from "../components/Add.vue";
import Edit from "../components/Edit.vue";
import About from "../components/About.vue";
import NotFound from "../components/NotFound.vue";

const routes = [
    { path: "/", component: Overview },
    { path: "/add", component: Add },
    { path: "/edit/:id", component: Edit },
    { path: "/about", component: About },
    { path: "/:pathMatch(.*)*", component: NotFound },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;