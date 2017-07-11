class DashboardController {
  constructor ($scope, userService, $state) {
    'ngInject'

    this.userService = userService;
    this.$state = $state;
  }

  $onInit() {
    let vm = this;
    this.fetchTasksAssignedToMe();
    this.getMyNotifications();
  }
  // both reporter taks and assigned tasks
  fetchTasksAssignedToMe() {
    let vm = this;
    this.userService.getMyTasks('assigned_to_me').then(function(resp){
      console.log(resp);
      vm.tasks_assigned = resp.data.tasks;
    }, function(error){
      console.log(error);
    })
  }

  getMyNotifications() {
    let vm = this;
    this.userService.getMyNotifications().then(function(resp){
      console.log(resp);
      vm.notifications = resp.data.notifications;
    }, function(error){
      console.log(error);
    });
  }

  markNotificationAsRead(notificationId) {
    let vm = this;
    this.userService.markNotificationAsRead().then(function(resp){
      console.log(resp);

    }, function(error){
      console.log(error);
    });
  }
  goToDetail(task) {
    this.$state.go('app.single-task', {id: task.id})  
  }
  


}

export const DashboardComponent = {
  templateUrl: './views/app/components/dashboard/dashboard.component.html',
  controller: DashboardController,
  controllerAs: 'vm',
  bindings: {}
}
