import { createRouter, createWebHistory } from 'vue-router'
import { useUserStore } from '../stores/user'

let locale = window.location.pathname.replace(/^\/([^\/]+).*/i,'$1');
// console.log(locale);

const router = createRouter({
  // base: (locale.trim().length && locale != "/") ? '/' + locale : undefined,
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('../views/HomeView.vue'),
      meta: {
        title: 'Home - Final Project'
      }
    },
    {
      path: '/about-us',
      name: 'about',
      component: () => import('../views/AboutView.vue')
    },
    {
      path: '/shop',
      name: 'shop',
      component: () => import('../views/ShopView.vue')
    },
    {
      path: '/category/:id',
      name: 'category',
      component: () => import('../views/CategoryView.vue')
    },
    {
      path: '/product/:slug',
      name: 'product',
      props: true,
      component: () => import('../views/ProductView.vue')
    },
    {
      path: '/contact-us',
      name: 'contact',
      component: () => import('../views/ContactView.vue')
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('../views/LoginView.vue')
    },
    {
      path: '/otp',
      name: 'otp',
      component: () => import('../views/OTP.vue')
    },
    {
      path: '/register',
      name: 'register',
      component: () => import('../views/RegisterView.vue')
    },
    {
      path: '/cart',
      name: 'cart',
      component: () => import('../views/CartView.vue')
    },
    {
      path: '/wishlist',
      name: 'wishlist',
      component: () => import('../views/WishlistView.vue')
    },
    {
      path: '/account',
      name: 'account',
      component: () => import('../views/AccountView.vue')
    },
    ,
    {
      path: '/checkout',
      name: 'checkout',
      component: () => import('../views/CheckoutView.vue'),
      meta: {
        Auth: true
      }
    },
    {
      path: '/:path(.*)*',
      name: 'notFound',
      component: () => import('../views/NotFoundView.vue'),
      meta: {
        title: '404 - Final Project'
      }
    },
  ]
})

const DEFAULT_TITLE = 'Final Project';
router.afterEach((to) => {
  document.title = to.meta.title || DEFAULT_TITLE;
});

router.beforeEach((to, from, next) => {
  
  const user = useUserStore().getUser;

  // console.log(user);

  

  if(!user && to.meta.Auth) {
    router.push('/login')
  }

  if(user && !user.otp_verified_at && to.meta.Auth ) {
    router.push('/otp')
  }

  next();
});

export default router
