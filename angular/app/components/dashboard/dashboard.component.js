class DashboardController {
  constructor ($scope, userService) {
    'ngInject'

    this.userService = userService;
  }

  $onInit() {
    this.fetchTasksAssignedToMe();
    this.getMyNotifications();
  }
  // both reporter taks and assigned tasks
  fetchTasksAssignedToMe() {
    this.userService.getMyTasks('assigned_to_me').then(function(resp){
      console.log(resp);

    }, function(error){
      console.log(error);
    })
  }

  getMyNotifications() {
    this.userService.getMyNotifications().then(function(resp){
      console.log(resp);

    }, function(error){
      console.log(error);
    });
  }

  markNotificationAsRead(notificationId) {
    this.userService.markNotificationAsRead().then(function(resp){
      console.log(resp);

    }, function(error){
      console.log(error);
    });
  }


}

export const DashboardComponent = {
  templateUrl: './views/app/components/dashboard/dashboard.component.html',
  controller: DashboardController,
  controllerAs: 'vm',
  bindings: {}
}
