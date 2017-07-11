export class userService {
  constructor ($http, $window, __env) {
    'ngInject'  
    this.$http = $http;
    this.$window = $window;
    this.__env = __env;
    this.urlBase = this.__env.baseUrl;

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
      url: this.urlBase+ 'users/me/categories ',
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

  getMyTasks(filter) {
    if(filter=='all'){
      return this.$http.get(this.urlBase + 'users/me/tasks');
    }else {
      return this.$http.get(this.urlBase + 'users/me/tasks/?'+filter+'=true');  
    }
    
  }

  getMyNotifications() {
    return this.$http.get(this.urlBase + 'users/me/notifications');
  }

  markNotificationAsRead(id) {
    return this.$http.delete(this.urlBase + 'users/me/notifications/'+id);
  }

  createTask(data) {
    return this.$http.post(this.urlBase + 'tasks', data);
  }

  getSingleTask(id) {
    if(id == null){
      return
    }
    return this.$http.get(this.urlBase + 'tasks/' +id); 
  }

  addProgressMessage(id, progress) {
    return this.$http.post(this.urlBase + 'tasks/' +id +'/progress', progress);
  }

  //DEPARTMENT URLS
  getDepartmentTasks(id) {
    return this.$http.get(this.urlBase + 'departments/' + id +'/tasks');
  }

  getAllDepartments() {
    return this.$http.get(this.urlBase + 'departments'); 
  }

}
