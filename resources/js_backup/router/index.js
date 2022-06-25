import { createRouter, createWebHistory } from 'vue-router'
import SignUp from '../views/SignUp.vue'
import Home from '../views/Home.vue';
import Success from '../views/Success.vue';
import EmployeeList from '../views/EmployeeList.vue';
import Login from '../views/Login.vue';
import EmployeeLandingPage from '../views/EmployeeLandingPage.vue';
import { VueCookieNext } from 'vue-cookie-next'
const routes = [{
    path: '/',
    name: 'home',
    component: Home
}, {
    path: '/sign-up',
    name: 'SignUp',
    component: SignUp
}, {
    path: '/login',
    name: 'login',
    component: Login
}, {
    path: '/success',
    name: 'Success',
    component: Success
}, {
    path: '/employee-list',
    name: 'EmployeeList',
    component: EmployeeList
}, {
    path: '/employee-landing',
    name: 'EmployeeLandingPage',
    component: EmployeeLandingPage
}];



const router = createRouter({
    history: createWebHistory(),
    routes
})


router.beforeEach((to, from, next) => {

    if (to.name === 'login') {
        if (VueCookieNext.getCookie("token")) {
            router.push('/')

        } else {

            next()
        }
    } else if (to.name !== 'login' && to.name !== "SignUp" && to.name !== "Success" && to.name !== "EmployeeList") {
        if (!VueCookieNext.getCookie("token")) {
            router.push('/login')
        } else {

            next()
        }
    } else {
        next()
    }

})


export default router