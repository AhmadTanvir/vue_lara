import moment from 'moment';
import Vue from 'vue'

Vue.filter('upText', (text) => {
    return text.charAt(0).toUpperCase() + text.slice(1);
});

Vue.filter('myDate', (created) => {
    return moment(created).format('MMMM Do YYYY'); /*h:mm:ss a*/
});

Vue.filter('shorttext', (text, length, suffix) => { //substring have two params 1-initial value 2-ending value
    return text.substring(0, length) + suffix;
});
