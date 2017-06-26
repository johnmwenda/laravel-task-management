class DashboardController {
  constructor ($scope, userService) {
    'ngInject'

    this.userService = userService;
  }

  $onInit() {
    this.fetchUserTasks();
  }
  // both reporter taks and assigned tasks
  fetchUserTasks() {
    this.userService.fetchUserTasks().then(function(resp){
      console.log(resp);

    }, function(error){
      console.log(error);
    })
  }


}

export const DashboardComponent = {
  templateUrl: './views/app/components/dashboard/dashboard.component.html',
  controller: DashboardController,
  controllerAs: 'vm',
  bindings: {}
}
