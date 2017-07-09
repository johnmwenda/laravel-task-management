export class userService {
  constructor ($http, $window) {
    'ngInject'  
    this.$http = $http;
    this.urlBase = "http://cytonn.local.app/api/";
    this.$window = $window;

    this.token = this.$window.localStorage.satellizer_token;
  } 

  fetchUserTasks() {
    let vm = this;
    return this.$http({
      method: 'get',
      url: this.urlBase+ 'tasks/feed',
      headers: {
        // authorization: 'Token '+vm.token
       }
    });
  }

  getTaskCategories() {
    let vm = this;
  	return this.$http({
      method: 'get',
      url: this.urlBase+ 'users/categories',
      headers: {
        // 'authorization': function(config) { 
        //   console.log(config);
        //   // 'Token '+vm.token
        // } 
       }
    });
    // get(this.urlBase+ 'users/categories');
  }

  getAllUsers() {
    let vm = this;
    return this.$http({
      method: 'get',
      url: this.urlBase+ 'users/all',
      headers: {
        // 'authorization': function(config) {
        //   console.log(config);
        //   // 'Token '+vm.token
        // } 
       }
    });
  }

  getDepartmentAndUsers() {
    let vm = this;
    return this.$http({
      method: 'get',
      url: this.urlBase+ 'departments ',
      headers: {
        // 'authorization': function(config) {
        //   console.log(config);
        //   // 'Token '+vm.token
        // } 
       }
    });
  }

  getTasks(filter) {
    return this.$http.get(this.urlBase + 'tasks');
  }

  createTask(data) {
    return this.$http.post(this.urlBase + 'tasks', data);
  }

}
