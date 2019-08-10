
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
// import AutoNumeric from 'autonumeric';

require('./bootstrap');

window.Vue = require('vue');
import VueMoment from 'vue-moment'
// import moment from 'moment-timezone'
//
// Vue.use(VueMoment, {
//     moment,
// })
window.vSelect = require('vue-select');
import 'vue-select/dist/vue-select.css';
// import VueRandomColor from 'vue-randomcolor';
//
// Vue.use(VueRandomColor);
// Vue.use(require('vue-moment'));
// Vue.use(require('moment-jalaali'));
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('v-select', vSelect);

Vue.component('tasks-component',        require('./components/TasksComponent.vue').default);
Vue.component('routine-component',      require('./components/TasksRoutineComponent').default);
Vue.component('status-list-box',        require('./components/status/StatusListBox').default);
Vue.component('user-tasks-self',        require('./components/status/userTasksSelf').default);
Vue.component('user-bar',               require('./components/status/userBar').default);
Vue.component('status-reply',           require('./components/status/StatusReply').default);
Vue.component('status-comment-form',    require('./components/status/StatusCommentForm').default);
Vue.component('user-statics',           require('./components/status/userStatics').default);
Vue.component('user-statics-boxes',     require('./components/status/userStaticsBoxes').default);
Vue.component('finance-task-form',      require('./components/tasks/financeTasksForm').default);
Vue.component('task-pay-form',          require('./components/tasks/taskPayForm').default);
Vue.component('main-home-box',          require('./components/MainHomeBox').default);
Vue.component('user-chart',             require('./components/UserChart').default);
Vue.component('report-designer',        require('./components/ReportDesigner').default);
Vue.component('checklist',              require('./components/Checklist').default);
Vue.component('status',                 require('./components/Status').default);

//Test
Vue.component('upload-image',           require('./components/tasks/UploadImage').default);

// Services
Vue.component('intercom',               require('./components/services/Intercom').default);
Vue.component('lunch-list',             require('./components/services/Lunch').default);
Vue.component('fin-list',               require('./components/services/FinList').default);
Vue.component('fin',                    require('./components/services/fin').default);
Vue.component('posts',                  require('./components/services/Posts').default);

//Admin
Vue.component('admin-panel',            require('./components/admin/AdminPanel').default);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});

// Echo.channel('articles')
//     .listen('ArticleEvent', (e) => {
//         console.log(e);
//     });


