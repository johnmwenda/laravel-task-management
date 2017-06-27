export class userService {
  constructor ($http, $window) {
    'ngInject'
    this.$http = $http;
    this.urlBase = "http://localhost:8001/api/";
    this.$window = $window;

    this.token = this.$window.localStorage.satellizer_token;
  }

  fetchUserTasks() {
    let vm = this;
    return this.$http({
      method: 'get',
      url: this.urlBase+ 'tasks/feed',
      headers: {
        authorization: 'Token '+vm.token
       }
    });
  }

  getTaskCategories() {
    let vm = this;
  	return this.$http({
      method: 'get',
      url: this.urlBase+ 'users/categories',
      headers: {
        authorization: 'Token '+vm.token
       }
    });



    // get(this.urlBase+ 'users/categories');
  }
}
