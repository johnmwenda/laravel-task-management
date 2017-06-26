export class userService {
  constructor ($http) {
    'ngInject'
    this.$http = $http;
    this.urlBase = "https://cytonn-web-app.herokuapp.com/api/"
  }

  fetchUserTasks() {
    return this.$http.get(this.urlBase+ 'tasks/feed');
  }
}
