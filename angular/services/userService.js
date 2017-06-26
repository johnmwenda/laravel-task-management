export class userService {
  constructor ($http) {
    'ngInject'
    this.$http = $http;
    this.urlBase = "http://localhost:8001/api/"
  }

  fetchUserTasks() {
    return this.$http.get(this.urlBase+ 'tasks/feed');
  }
}
